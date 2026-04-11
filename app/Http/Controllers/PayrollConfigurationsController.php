<?php

namespace App\Http\Controllers;

use App\Models\Allowances;
use App\Models\Deductions;
use App\Models\Employee;
use App\Models\LoanApplication;
use App\Models\NSSFPSSF;
use App\Models\PayeeRanges;
use App\Models\PayrollChange;
use App\Models\PayrollConfigurations;
use App\Models\PayrollRun;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class PayrollConfigurationsController extends Controller
{
    //process payroll runs for a period using baseline payroll + active payroll changes
    public function processPayrollRuns(Request $request)
    {

        // 1) Validate optional period inputs from request.
        $validated = $request->validate([
            'pay_period_start' => ['nullable', 'date'],
            'pay_period_end' => ['nullable', 'date', 'after_or_equal:pay_period_start'],
        ]);

        // 2) Resolve school/user context for this run.
        $schoolId = $this->getSchoolId();

        /**
         * get the userId
         * 
         */
        $userId = Auth::id()?? 100;
        

        // 3) Resolve processing window (default: current month).
        $periodStart = isset($validated['pay_period_start'])
            ? Carbon::parse($validated['pay_period_start'])->startOfDay()
            : now()->startOfMonth()->startOfDay();

        $periodEnd = isset($validated['pay_period_end'])
            ? Carbon::parse($validated['pay_period_end'])->endOfDay()
            : now()->endOfMonth()->endOfDay();

        $payPeriodLabel = $periodStart->format('M Y');

        // 4) Load baseline payroll configs (employees with/without loans are all included).
        $payrollConfigs = PayrollConfigurations::with(['allowances', 'deductions'])
            ->where('school_id', $schoolId)
            ->get();

        if ($payrollConfigs->isEmpty()) {
            return redirect()->route('accounting.payrollManagement')
                ->with('error', 'No payroll configurations found for processing.');
        }

        // 5) Load PAYE rules + NSSF/PSSSF contribution setup used in calculations.
        $payeeRules = PayeeRanges::whereYear('effective_year', '>=', now()->subYear()->year)
            ->orderBy('lower_bound', 'asc')
            ->get();

        $contributions = $this->resolveNssfPsssfContributions($schoolId);

        DB::transaction(function () use (
            
            $payrollConfigs,
            $schoolId,
            $userId,
            $periodStart,
            $periodEnd,
            $payPeriodLabel,
            $payeeRules,
            $contributions,
        ) {
            // 6) Process each employee payroll configuration independently.
            foreach ($payrollConfigs as $config) {
                // Baseline payroll figures from payroll_configurations + linked tables.
                $baseSalary = (float) ($config->base_salary ?? 0);
                $standardAllowances = (float) optional($config->allowances)->total_allowance;
                $standardNhif = (float) optional($config->deductions)->NHIF_contribution;
                $standardOtherDeductions = (float) optional($config->deductions)->other_deductions;
                $standardLoanDeductions = (float) optional($config->deductions)->loan_deductions;

                // 7) Load active payroll changes valid for this pay period.
                $activeChanges = PayrollChange::where('school_id', $schoolId)
                    ->where('payroll_configuration_id', $config->id)
                    ->whereIn('status', ['scheduled', 'active'])
                    ->whereDate('start_date', '<=', $periodEnd->toDateString())
                    ->where(function ($query) use ($periodStart) {
                        $query->whereNull('end_date')
                            ->orWhereDate('end_date', '>=', $periodStart->toDateString());
                    })
                    ->orderBy('priority')
                    ->orderBy('id')
                    ->get();

                $loanDeductionsFromChanges = 0.0;
                $fringeDeductions = 0.0;
                $fringeAllowances = 0.0;
                $taxableFringeAmount = 0.0;
                $manualDeductions = 0.0;
                $manualAllowances = 0.0;
                $appliedLoanInstallments = [];

                // 8) Aggregate adjustments (loan installments, fringe, manual items).
                foreach ($activeChanges as $change) {
                    $appliedLoanInstallment = 0.0;

                    if ($change->adjustment_type === 'loan_repayment') {
                        $remaining = (float) ($change->loan_remaining_balance ?? 0);
                        $installment = (float) ($change->loan_installment_amount ?? 0);

                        $appliedLoanInstallment = $remaining > 0
                            ? min($installment, $remaining)
                            : 0;

                        $loanDeductionsFromChanges += $appliedLoanInstallment;
                    }

                    if ((bool) $change->has_fringe_benefit) {
                        $fringeAmount = (float) ($change->fringe_benefit_amount ?? 0);
                        $taxableFringeAmount += $fringeAmount;
                        if ($change->fringe_benefit_effect === 'allowance') {
                            //as of now just add zero
                            //$fringeAllowances += $fringeAmount;
                            $fringeAllowances += 0;
                        } elseif ($change->fringe_benefit_effect === 'deduction') {
                            //as of now just deduct zero
                            //$fringeAllowances += $fringeAmount;
                            $fringeDeductions += 0;
                        }
                    }

                    $manualAmount = (float) ($change->manual_amount ?? 0);
                    if ($manualAmount > 0) {
                        if ($change->manual_effect === 'allowance') {
                            $manualAllowances += $manualAmount;
                        } elseif ($change->manual_effect === 'deduction') {
                            $manualDeductions += $manualAmount;
                        }
                    }

                    $appliedLoanInstallments[$change->id] = $appliedLoanInstallment;
                }

                // 9) Build gross salary from base + computed allowances.
                $totalAllowances = round($standardAllowances + $fringeAllowances + $manualAllowances, 2);
                $grossSalary = round($baseSalary + $totalAllowances, 2);

                // 10) Compute statutory contributions + taxable income + PAYE.
                $nssfAmount = round($grossSalary * $contributions['nssf'], 2);
                $psssfAmount = round($grossSalary * $contributions['psssf'], 2);

                // Taxable income is gross salary less employee pension contributions.
                // Fringe benefit is added separately before PAYE is calculated.
                $taxableIncome = max(0, round($grossSalary - $nssfAmount - $psssfAmount, 2));
                $taxableIncomeForPaye = max(0, round($taxableIncome + $taxableFringeAmount, 2));
                $payeAmount = round($this->calculatePayeAmount($taxableIncomeForPaye, $payeeRules), 2);

                // 11) Compute final deductions and net salary for this pay period.
                $totalDeductions = round(
                    $payeAmount
                    + $nssfAmount
                    + $psssfAmount
                    + $standardNhif
                    + $standardLoanDeductions
                    + $standardOtherDeductions
                    + $loanDeductionsFromChanges
                    + $fringeDeductions
                    + $manualDeductions,
                    2
                );

                $netSalary = max(0, round($grossSalary - $totalDeductions, 2));

                // 12) Persist payroll snapshot row for this employee + period.
                PayrollRun::updateOrCreate(
                    [
                        'school_id' => $schoolId,
                        'payroll_configuration_id' => $config->id,
                        'pay_period_start' => $periodStart->toDateString(),
                        'pay_period_end' => $periodEnd->toDateString(),
                    ],
                    [
                        'created_by' => $userId,
                        'pay_period_label' => $payPeriodLabel,
                        'base_salary' => $baseSalary,
                        'total_allowances' => $totalAllowances,
                        'taxable_income' => $taxableIncomeForPaye,
                        'total_deductions' => $totalDeductions,
                        'net_salary' => $netSalary,
                        'loan_deductions_total' => round($standardLoanDeductions + $loanDeductionsFromChanges, 2),
                        'fringe_benefit_total' => round($fringeAllowances - $fringeDeductions, 2),
                        'other_deductions_total' => round($standardOtherDeductions + $manualDeductions, 2),
                        'other_allowances_total' => round($manualAllowances, 2),
                        'status' => 'processed',
                        'notes' => 'Auto-processed payroll run.',
                        'processed_at' => now(),
                    ]
                );

                // 13) Update payroll_changes progress and linked loan balances/status.
                foreach ($activeChanges as $change) {
                    $appliedInstallment = $appliedLoanInstallments[$change->id] ?? 0.0;
                    $nextStatus = $change->status === 'scheduled' ? 'active' : $change->status;

                    if ($change->adjustment_type === 'loan_repayment' && $appliedInstallment > 0) {
                        $updatedRemaining = max(0, round((float) ($change->loan_remaining_balance ?? 0) - $appliedInstallment, 2));
                        $updatedApplied = round((float) ($change->loan_total_applied ?? 0) + $appliedInstallment, 2);

                        if ((bool) $change->stop_on_zero_balance && $updatedRemaining <= 0) {
                            $nextStatus = 'completed';
                        }

                        $change->loan_remaining_balance = $updatedRemaining;
                        $change->loan_total_applied = $updatedApplied;

                        if ($change->loan_application_id) {
                            $loan = LoanApplication::find($change->loan_application_id);
                            if ($loan) {
                                $loan->total_paid = round((float) ($loan->total_paid ?? 0) + $appliedInstallment, 2);
                                if ($nextStatus === 'completed') {
                                    $loan->status = 'completed';
                                } elseif ($loan->status === 'disbursed') {
                                    $loan->status = 'active';
                                }
                                $loan->save();
                            }
                        }
                    }

                    $change->status = $nextStatus;
                    $change->last_applied_at = $periodEnd->toDateString();
                    $change->save();
                }
            }
        });

        // 14) Return with processing outcome message.
        return redirect()->route('accounting.payrollManagement')
            ->with('success', 'Payroll processed successfully for ' . $payPeriodLabel . '.');
    }

    //show the payroll configuration page
    public function showPayrollConfiguration()
    {
        //get the school id from the authenticated user and use it to get the teachers of the school and show them in the payroll configuration page
        $schoolId = $this->getSchoolId();

        //get the teachers of the school and show them in the payroll configuration page
        $teachers = $this->getTeachers($schoolId);

        //get the employees of the school and show them in the payroll configuration page
        $employees = DB::table('payroll_configurations')
            ->leftJoin('employees', 'payroll_configurations.employee_id', '=', 'employees.id')
            ->leftJoin('teachers', 'payroll_configurations.teacher_id', '=', 'teachers.id')
            ->leftJoin('allowances', 'payroll_configurations.allowances_id', '=', 'allowances.id')
            ->leftJoin('deductions', 'payroll_configurations.deductions_id', '=', 'deductions.id')
            ->where('payroll_configurations.school_id', $schoolId)
            ->select([
                'payroll_configurations.id',
                DB::raw("COALESCE(CAST(employees.employee_id as CHAR), CONCAT('T-', payroll_configurations.teacher_id)) as employee_id"),
                DB::raw("COALESCE(employees.full_name, CONCAT(teachers.fname, ' ', teachers.lname)) as name"),
                DB::raw("COALESCE(employees.email, teachers.email) as email"),
                DB::raw("COALESCE(employees.employee_type, 'teacher') as type"),
                DB::raw("COALESCE(employees.position, teachers.subject_specialization, '-') as position"),
                'payroll_configurations.gross_salary as base_salary',
                DB::raw('COALESCE(allowances.total_allowance, 0) as allowances'),
                DB::raw('COALESCE(deductions.total_deductions, 0) as deductions'),
                'payroll_configurations.net_salary',
                'payroll_configurations.payment_method',
                'payroll_configurations.employee_status as status',
                'allowances.housing_allowance',
                'allowances.transportation_allowance',
                'allowances.meal_allowance',
                'allowances.medical_allowance',
                'allowances.extra_time',
                'allowances.other_allowances',
                'deductions.PAYE',
                'deductions.NHIF_contribution',
                'deductions.NSSF_contribution',
                'deductions.loan_deductions',
                'deductions.other_deductions',
            ])
            ->orderByDesc('payroll_configurations.id')
            ->paginate(10);
        
        // Transform the data to include allowances and deductions as separate arrays for each employee
        $employees->getCollection()->transform(function ($employee) {
            
            $employee->allowances_data = [
                'housing_allowance' => $employee->housing_allowance ?? 0,
                'transport_allowance' => $employee->transportation_allowance ?? 0,
                'meal_allowance' => $employee->meal_allowance ?? 0,
                'medical_allowance' => $employee->medical_allowance ?? 0,
                'extra_time' => $employee->extra_time ?? 0,
                'other_allowances' => $employee->other_allowances ?? 0,
            ];
            
            $employee->deductions_data = [
                'PAYE' => $employee->PAYE ?? 0,
                'NHIF_contribution' => $employee->NHIF_contribution ?? 0,
                'NSSF_contribution' => $employee->NSSF_contribution ?? 0,
                'loan_deductions' => $employee->loan_deductions ?? 0,
                'other_deductions' => $employee->other_deductions ?? 0,
                'heslb_deduction' => 0,
            ];
            
            return $employee;
        });


        //get the total number of employees 
        $totalEmployees = PayrollConfigurations::where('school_id', $schoolId)->count();

        //get the numbers of teachers
        $totalTeachers = PayrollConfigurations::where('school_id', $schoolId)->whereNotNull('teacher_id')->count();

        //get the number of staff and admin
        $totalStaff = DB::table('payroll_configurations')
            ->leftJoin('employees', 'payroll_configurations.employee_id', '=', 'employees.id')
            ->where('payroll_configurations.school_id', $schoolId)
            ->whereIn('employees.employee_type', ['staff', 'admin'])
            ->count();

        //get teh total payroll amount for the school
        $totalPayroll = PayrollConfigurations::where('school_id', $schoolId)->sum('net_salary');

        //return the view with the teachers and employees data
        return view('AccountantPanel.payrolls.payrollsetting', [
            'teachers' => $teachers,
            'employees' => $employees,
            'totalEmployees' => $totalEmployees,
            'totalTeachers' => $totalTeachers,
            'totalStaff' => $totalStaff,
            'totalPayroll' => $totalPayroll,
        ]);
    }

    //save the payroll configuration data to the database
    public function storePayrollConfiguration(Request $request)
    {
        $request->merge([
            'create_new_employee' => $request->boolean('create_new_employee'),
        ]);

        /*dump the data
        dd($request->all());
        */

        //validate the request data
        $validated = $request->validate([
            'teacher_id' => ['nullable', 'integer', 'exists:teachers,id'],
            'employee_id' => ['nullable', 'integer', 'exists:employees,id'],
            'create_new_employee' => ['nullable', 'boolean'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'type' => ['nullable', 'in:teacher,staff,admin'],
            'position' => ['nullable', 'string', 'max:255'],

            'base_salary' => ['required', 'numeric', 'min:0'],
            'housing_allowance' => ['nullable', 'numeric', 'min:0'],
            'transport_allowance' => ['nullable', 'numeric', 'min:0'],
            'meal_allowance' => ['nullable', 'numeric', 'min:0'],
            'medical_allowance' => ['nullable', 'numeric', 'min:0'],
            'extra_time_allowance' => ['nullable', 'numeric', 'min:0'],
            'other_allowance' => ['nullable', 'numeric', 'min:0'],

            'tax_deduction' => ['nullable', 'numeric', 'min:0'],
            'insurance_deduction' => ['nullable', 'numeric', 'min:0'],
            'provident_fund' => ['nullable', 'numeric', 'min:0'],
            'loan_deduction' => ['nullable', 'numeric', 'min:0'],
            'other_deduction' => ['nullable', 'numeric', 'min:0'],
            'heslb_deduction' => ['nullable', 'numeric', 'min:0'],
            'taxable_income' => ['nullable', 'numeric', 'min:0'],

            'payment_method' => ['required', 'in:bank,cash,check'],
            'status' => ['required', 'in:active,inactive,on_leave'],
            'contract_type' => ['nullable', 'string', 'max:100'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:100'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'ifsc_code' => ['nullable', 'string', 'max:100'],
            'branch_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        /*dump the data
        Log::info('Received payroll configuration data', [
            'data' => $validated,
        ]);

        dd($validated); */

        //get the school_id from the authenticated user and use it to save the payroll configuration data to the database
        $schoolId = $this->getSchoolId();

        //get the teacher_id from the validated data, if teacher_id is not provided then give a null value to it
        $teacherId = !empty($validated['teacher_id']) ? (int) $validated['teacher_id'] : null;

        //check if the teacher_id is not provided and the create_new_employee is not checked, then return an error message to the user
        $createNewEmployee = $request->boolean('create_new_employee');

        if (!$teacherId && !$createNewEmployee) {
            return redirect()->back()->withInput()->withErrors([
                'teacher_select' => 'Please select a teacher/staff member or check "Create new employee record".',
            ]);
        }

        //if new employee record is to be created, then validate the employee data
        if ($createNewEmployee) {
            $request->validate([
                'employee_id' => ['nullable', 'integer', 'exists:employees,id'],
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:30'],
                'type' => ['required', 'in:teacher,staff,admin'],
                'position' => ['required', 'string', 'max:255'],
            ]);
        }

        try {

        //begin transaction to ensure data integrity in case of any failure during the payroll configuration saving process
            DB::beginTransaction();

            $employeeRecordId = null;

            if ($createNewEmployee || !$teacherId) {
                
                //generate a unique employee number for the new employee record to be created
                $generatedEmployeeId = $this->generateEmployeeNumber();

                //check the if the bank number already exists in the database for another employee, if it exists then return an error message to the user
                if (!$this->isBankAccountNumberUnique($validated['account_number'] ?? null, $validated['bank_name'] ?? null)) {
                    return redirect()->back()->withInput()->withErrors([
                        'account_number' => 'The provided bank account number already exists for another employee. Please provide a unique bank account number.',
                    ]);
                }

                //store the employee data in the employees table and get the employee record id to be used in the payroll configuration record
                $employee = Employee::create([
                    'school_id' => $schoolId,
                    'employee_id' => $generatedEmployeeId,
                    'full_name' => $validated['name'],
                    'email' => $validated['email'] ?? null,
                    'phone' => $validated['phone'],
                    'employee_type' => $validated['type'],
                    'position' => $validated['position'],
                ]);

                $employeeRecordId = $employee->id;

                $teacherId = null;

            }/* else {

                $teacher = Teacher::findOrFail($teacherId);

                $employee = Employee::where('school_id', $schoolId)
                    ->where('email', $teacher->email)
                    ->first();

                if (!$employee) {
                    $employee = Employee::create([
                        'school_id' => $schoolId,
                        'employee_id' => $this->generateEmployeeNumber($teacher->id),
                        'full_name' => trim(($teacher->fname ?? '') . ' ' . ($teacher->lname ?? '')),
                        'email' => $teacher->email,
                        'phone' => $teacher->phone ?? '-',
                        'employee_type' => 'teacher',
                        'position' => $teacher->subject_specialization ?? 'Teacher',
                    ]);
                }

                $employeeRecordId = $employee->id;
            } */

            $housingAllowance = (float) ($validated['housing_allowance'] ?? 0);
            $transportAllowance = (float) ($validated['transport_allowance'] ?? 0);
            $mealAllowance = (float) ($validated['meal_allowance'] ?? 0);
            $medicalAllowance = (float) ($validated['medical_allowance'] ?? 0);
            $extraTimeAllowance = (float) ($validated['extra_time_allowance'] ?? 0);
            $otherAllowance = (float) ($validated['other_allowance'] ?? 0);

            $totalAllowances = $housingAllowance
                + $transportAllowance
                + $mealAllowance
                + $medicalAllowance
                + $extraTimeAllowance
                + $otherAllowance;

            $allowances = Allowances::create([
                'school_id' => $schoolId,
                'housing_allowance' => $housingAllowance,
                'transportation_allowance' => $transportAllowance,
                'meal_allowance' => $mealAllowance,
                'leave_travel_allowance' => 0,
                'medical_allowance' => $medicalAllowance,
                'other_allowances' => $otherAllowance,
                'extra_time' => $extraTimeAllowance,
                'total_allowance' => $totalAllowances,
            ]);

            $taxDeduction = (float) ($validated['tax_deduction'] ?? 0);
            $insuranceDeduction = (float) ($validated['insurance_deduction'] ?? 0);
            $providentFund = (float) ($validated['provident_fund'] ?? 0);
            $loanDeduction = (float) ($validated['loan_deduction'] ?? 0);
            $otherDeduction = (float) ($validated['other_deduction'] ?? 0);
            $heslbDeduction = (float) ($validated['heslb_deduction'] ?? 0);

            $totalDeductions = $taxDeduction
                + $insuranceDeduction
                + $providentFund
                + $loanDeduction
                + $otherDeduction
                + $heslbDeduction;

            $deductions = Deductions::create([
                'school_id' => $schoolId,
                'PAYE' => $taxDeduction,
                'NSSF_contribution' => $providentFund,
                'NHIF_contribution' => $insuranceDeduction,
                'loan_deductions' => $loanDeduction,
                'other_deductions' => $otherDeduction + $heslbDeduction,
                'total_deductions' => $totalDeductions,
            ]);

            $baseSalary = (float) $validated['base_salary'];
            $grossSalary = $baseSalary + $totalAllowances;
            $netSalary = $grossSalary - $totalDeductions;
            $taxableIncome = (float) ($validated['taxable_income'] ?? 0);

            //check the if the bank number already exists in the database for another employee, if it exists then return an error message to the user
            if (!$this->isBankAccountNumberUnique($validated['account_number'] ?? null, $validated['bank_name'] ?? null)) {
                return redirect()->back()->withInput()->withErrors([
                    'account_number' => 'The provided bank account number already exists for another employee. Please provide a unique bank account number.',
                ]);
            }

            PayrollConfigurations::create([
                'school_id' => $schoolId,
                'academic_year' => now(),
                'teacher_id' => $teacherId,
                'employee_id' => $employeeRecordId,
                'payment_method' => $validated['payment_method'],
                'employee_status' => $validated['status'],
                'contract_type' => $validated['contract_type'] ?? null,
                'bank_name' => $validated['bank_name'] ?? null,
                'bank_account_number' => $validated['account_number'] ?? null,
                'Account_name' => $validated['account_name'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'allowances_id' => $allowances->id,
                'deductions_id' => $deductions->id,
                'gross_salary' => $grossSalary,
                'base_salary' => $baseSalary,
                'net_salary' => $netSalary,
                'taxable_income' => $taxableIncome,
            ]);

            DB::commit();

            return redirect()->route('accounting.payrollSettings')->with('success', 'Payroll data saved successfully.');
        } catch (ValidationException $exception) {
            DB::rollBack();
            throw $exception;
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error('Failed to save payroll configuration', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Failed to save payroll data. Please try again.');
        }
    }

    //function to update the payroll configuration data in the database
    public function updatePayrollConfiguration(Request $request, int $id)
    {
        $request->merge([
            'create_new_employee' => $request->boolean('create_new_employee'),
        ]);

        //validate the request data
        $validated = $request->validate([
            'teacher_id' => ['nullable', 'integer', 'exists:teachers,id'],
            'employee_id' => ['nullable', 'integer', 'exists:employees,id'],
            'create_new_employee' => ['nullable', 'boolean'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'type' => ['nullable', 'in:teacher,staff,admin'],
            'position' => ['nullable', 'string', 'max:255'],

            'base_salary' => ['required', 'numeric', 'min:0'],
            'housing_allowance' => ['nullable', 'numeric', 'min:0'],
            'transport_allowance' => ['nullable', 'numeric', 'min:0'],
            'meal_allowance' => ['nullable', 'numeric', 'min:0'],
            'medical_allowance' => ['nullable', 'numeric', 'min:0'],
            'extra_time_allowance' => ['nullable', 'numeric', 'min:0'],
            'other_allowance' => ['nullable', 'numeric', 'min:0'],

            'tax_deduction' => ['nullable', 'numeric', 'min:0'],
            'insurance_deduction' => ['nullable', 'numeric', 'min:0'],
            'provident_fund' => ['nullable', 'numeric', 'min:0'],
            'loan_deduction' => ['nullable', 'numeric', 'min:0'],
            'other_deduction' => ['nullable', 'numeric', 'min:0'],
            'heslb_deduction' => ['nullable', 'numeric', 'min:0'],
            'taxable_income' => ['nullable', 'numeric', 'min:0'],

            'payment_method' => ['required', 'in:bank,cash,check'],
            'status' => ['required', 'in:active,inactive,on_leave'],
            'contract_type' => ['nullable', 'string', 'max:100'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:100'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'ifsc_code' => ['nullable', 'string', 'max:100'],
            'branch_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $schoolId = $this->getSchoolId();

        try {
            //find the payroll configuration record
            $payrollConfig = PayrollConfigurations::findOrFail($id);

            //check if the payroll configuration belongs to the authenticated user's school
            if ($payrollConfig->school_id !== $schoolId) {
                return redirect()->route('accounting.payrollSettings')->with('error', 'Unauthorized action. You cannot update this payroll configuration.');
            }

            DB::beginTransaction();

            //calculate allowances
            $housingAllowance = (float) ($validated['housing_allowance'] ?? 0);
            $transportAllowance = (float) ($validated['transport_allowance'] ?? 0);
            $mealAllowance = (float) ($validated['meal_allowance'] ?? 0);
            $medicalAllowance = (float) ($validated['medical_allowance'] ?? 0);
            $extraTimeAllowance = (float) ($validated['extra_time_allowance'] ?? 0);
            $otherAllowance = (float) ($validated['other_allowance'] ?? 0);

            $totalAllowances = $housingAllowance
                + $transportAllowance
                + $mealAllowance
                + $medicalAllowance
                + $extraTimeAllowance
                + $otherAllowance;

            //update allowances
            $allowances = Allowances::findOrFail($payrollConfig->allowances_id);
            $allowances->update([
                'housing_allowance' => $housingAllowance,
                'transportation_allowance' => $transportAllowance,
                'meal_allowance' => $mealAllowance,
                'leave_travel_allowance' => 0,
                'medical_allowance' => $medicalAllowance,
                'other_allowances' => $otherAllowance,
                'extra_time' => $extraTimeAllowance,
                'total_allowance' => $totalAllowances,
            ]);

            //calculate deductions
            $taxDeduction = (float) ($validated['tax_deduction'] ?? 0);
            $insuranceDeduction = (float) ($validated['insurance_deduction'] ?? 0);
            $providentFund = (float) ($validated['provident_fund'] ?? 0);
            $loanDeduction = (float) ($validated['loan_deduction'] ?? 0);
            $otherDeduction = (float) ($validated['other_deduction'] ?? 0);
            $heslbDeduction = (float) ($validated['heslb_deduction'] ?? 0);

            $totalDeductions = $taxDeduction
                + $insuranceDeduction
                + $providentFund
                + $loanDeduction
                + $otherDeduction
                + $heslbDeduction;

            //update deductions
            $deductions = Deductions::findOrFail($payrollConfig->deductions_id);
            $deductions->update([
                'PAYE' => $taxDeduction,
                'NSSF_contribution' => $providentFund,
                'NHIF_contribution' => $insuranceDeduction,
                'loan_deductions' => $loanDeduction,
                'other_deductions' => $otherDeduction + $heslbDeduction,
                'total_deductions' => $totalDeductions,
            ]);

            //calculate salaries
            $baseSalary = (float) $validated['base_salary'];
            $grossSalary = $baseSalary + $totalAllowances;
            $netSalary = $grossSalary - $totalDeductions;
            $taxableIncome = (float) ($validated['taxable_income'] ?? 0);

            //check if the bank number is unique (excluding current record)
            if (!empty($validated['account_number']) && !empty($validated['bank_name'])) {
                $duplicate = PayrollConfigurations::where('bank_account_number', $validated['account_number'])
                    ->where('bank_name', $validated['bank_name'])
                    ->where('id', '!=', $id)
                    ->exists();

                if ($duplicate) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->withErrors([
                        'account_number' => 'The provided bank account number already exists for another employee. Please provide a unique bank account number.',
                    ]);
                }
            }

            //update employee record if create_new_employee is checked
            if ($validated['create_new_employee'] && $payrollConfig->employee_id) {
                $employee = Employee::findOrFail($payrollConfig->employee_id);
                $employee->update([
                    'full_name' => $validated['name'],
                    'email' => $validated['email'] ?? null,
                    'phone' => $validated['phone'],
                    'employee_type' => $validated['type'],
                    'position' => $validated['position'],
                ]);
            }

            //update payroll configuration
            $payrollConfig->update([
                'payment_method' => $validated['payment_method'],
                'employee_status' => $validated['status'],
                'contract_type' => $validated['contract_type'] ?? null,
                'bank_name' => $validated['bank_name'] ?? null,
                'bank_account_number' => $validated['account_number'] ?? null,
                'Account_name' => $validated['account_name'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'gross_salary' => $grossSalary,
                'net_salary' => $netSalary,
                'taxable_income' => $taxableIncome,
            ]);

            DB::commit();

            return redirect()->route('accounting.payrollSettings')->with('success', 'Payroll data updated successfully.');
        } catch (ValidationException $exception) {
            DB::rollBack();
            throw $exception;
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error('Failed to update payroll configuration', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Failed to update payroll data. Please try again.');
        }
    }

    //save a temporary manual payroll change (allowance or deduction)
    public function storeTemporaryPayrollChange(Request $request)
    {
        $validated = $request->validate([
            'payroll_configuration_id' => ['required', 'integer', 'exists:payroll_configurations,id'],
            'adjustment_type' => ['required', 'in:manual_allowance,manual_deduction'],
            'manual_amount' => ['required', 'numeric', 'gt:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:scheduled,active'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $schoolId = $this->getSchoolId();

        $payrollConfiguration = PayrollConfigurations::where('id', $validated['payroll_configuration_id'])
            ->where('school_id', $schoolId)
            ->first();

        if (!$payrollConfiguration) {
            return redirect()->route('accounting.payrollSettings')
                ->with('error', 'Selected payroll record was not found for your school.');
        }

        $manualEffect = $validated['adjustment_type'] === 'manual_allowance' ? 'allowance' : 'deduction';

        PayrollChange::create([
            'school_id' => $schoolId,
            'payroll_configuration_id' => $payrollConfiguration->id,
            'loan_application_id' => null,
            'adjustment_type' => $validated['adjustment_type'],
            'loan_installment_amount' => 0,
            'loan_remaining_balance' => null,
            'loan_total_applied' => 0,
            'has_fringe_benefit' => false,
            'fringe_benefit_amount' => 0,
            'fringe_benefit_effect' => null,
            'calculation_mode' => 'fixed_amount',
            'manual_amount' => round((float) $validated['manual_amount'], 2),
            'manual_rate' => null,
            'manual_effect' => $manualEffect,
            'start_date' => Carbon::parse($validated['start_date'])->toDateString(),
            'end_date' => isset($validated['end_date'])
                ? Carbon::parse($validated['end_date'])->toDateString()
                : null,
            'stop_on_zero_balance' => false,
            'priority' => 120,
            'status' => $validated['status'],
            'last_applied_at' => null,
            'source_reference' => 'manual-temp',
            'notes' => $validated['notes'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('accounting.payrollSettings')
            ->with('success', 'Temporary payroll change saved successfully.');
    }

    //function to delete the payroll configuration data from the database
    public function deletePayrollConfiguration(int $id)
    {

        try {
            //try to find the user with that id, if not found then return an error message to the user
            $payrollConfig = PayrollConfigurations::findOrFail($id);

            //just to be safe check if the payroll configuration record belongs to the school of the authenticated user, if not then return an error message to the user
            if ($payrollConfig->school_id !== $this->getSchoolId()) {
                return redirect()->route('accounting.payrollSettings')->with('error', 'Unauthorized action. You cannot delete this payroll configuration.');
            }

            //delete the user record from the database
            $payrollConfig->delete();

            return redirect()->route('accounting.payrollSettings')->with('success', 'Payroll configuration deleted successfully.');
        } catch (Throwable $exception) {
            Log::error('Failed to delete payroll configuration', [
                'message' => $exception->getMessage(),            
                ]);
        }
    }

    //function to get the teachers of the school and show them in the payroll configuration page
    protected function getTeachers(int $schoolId)
    {
        return Teacher::where('school_id', $schoolId)->get();
    }

    //function to get the school id from the authenticated user
    protected function getSchoolId(): int
    {
        // In a real application, you would typically get the school ID from the authenticated user's session or profile
        return (int) (Auth::user()?->school_id ?? 1);
    }


    /**
     * generate a unique id for the emloyee
     * if the employee_id exists then regenerate and check again till we get the correct unique employee_id
     */
    protected function generateEmployeeNumber(): string
    {
        do {
            $employeeNumber = str_pad(random_int(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Employee::where('employee_id', $employeeNumber)->exists());

        return $employeeNumber;
    }

    /**
     * function to check the bank number is not existing in the db to avoid duplicate bank account numbers for different employees
     * if the bank account number exists for another employee, then return an error message to the user
     */
    protected function isBankAccountNumberUnique(?string $accountNumber, ?string $bankName): bool
    {
        if (empty($accountNumber) || empty($bankName)) {
            return true; // If account number is empty, we consider it as unique (or handle it separately if needed)
        }

        $query = PayrollConfigurations::where('bank_account_number', $accountNumber)->where('bank_name', $bankName);


        return !$query->exists();
    }

    protected function resolveNssfPsssfContributions(int $schoolId): array
    {
        $config = NSSFPSSF::where('school_id', $schoolId)->first();

        if (!$config) {
            return ['nssf' => 0.1, 'psssf' => 0.0];
        }

        $normalize = function ($value) {
            $number = (float) $value;
            return $number > 1 ? $number / 100 : $number;
        };

        if ($config->contribution_type === 'psssf') {
            return ['nssf' => 0.0, 'psssf' => $normalize($config->psssf_contribution)];
        }

        return ['nssf' => $normalize($config->nssf_contribution), 'psssf' => 0.0];
    }

    protected function calculatePayeAmount(float $taxableIncome, $payeeRules): float
    {
        foreach ($payeeRules as $rule) {
            $lower = (float) $rule->lower_bound;
            $upper = $rule->upper_bound !== null ? (float) $rule->upper_bound : null;
            $withinLower = $taxableIncome >= $lower;
            $withinUpper = $upper === null || $taxableIncome <= $upper;

            if ($withinLower && $withinUpper) {
                return (float) $rule->added_amount + (($taxableIncome - $lower) * (float) $rule->percentage);
            }
        }

        return 0.0;
    }

}
