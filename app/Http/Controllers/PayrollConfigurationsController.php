<?php

namespace App\Http\Controllers;

use App\Models\Allowances;
use App\Models\Deductions;
use App\Models\Employee;
use App\Models\PayrollConfigurations;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class PayrollConfigurationsController extends Controller
{
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
            ])
            ->orderByDesc('payroll_configurations.id')
            ->paginate(10);

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
                'net_salary' => $netSalary,
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

}
