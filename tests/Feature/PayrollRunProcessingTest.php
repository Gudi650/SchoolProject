<?php

namespace Tests\Feature;

use App\Models\LoanApplication;
use App\Models\LoanType;
use App\Models\NSSFPSSF;
use App\Models\PayeeRanges;
use App\Models\PayrollChange;
use App\Models\PayrollConfigurations;
use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PayrollRunProcessingTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_payroll_creates_runs_for_employees_with_and_without_loans(): void
    {
        $school = School::create([
            'name' => 'Payroll School',
            'email' => 'payroll-school@example.com',
        ]);

        $accountant = User::create([
            'fname' => 'Pay',
            'lname' => 'Accountant',
            'email' => 'pay-accountant@example.com',
            'password' => bcrypt('password'),
            'roles' => 'accountant',
        ]);

        $borrowerUser = User::create([
            'fname' => 'Loan',
            'lname' => 'Teacher',
            'email' => 'loan-teacher@example.com',
            'password' => bcrypt('password'),
            'roles' => 'teacher',
        ]);

        $plainUser = User::create([
            'fname' => 'Plain',
            'lname' => 'Teacher',
            'email' => 'plain-teacher@example.com',
            'password' => bcrypt('password'),
            'roles' => 'teacher',
        ]);

        $borrowerTeacher = Teacher::create([
            'fname' => 'Loan',
            'lname' => 'Teacher',
            'email' => 'loan-teacher-record@example.com',
            'gender' => 'male',
            'school_id' => $school->id,
            'user_id' => $borrowerUser->id,
        ]);

        $plainTeacher = Teacher::create([
            'fname' => 'Plain',
            'lname' => 'Teacher',
            'email' => 'plain-teacher-record@example.com',
            'gender' => 'female',
            'school_id' => $school->id,
            'user_id' => $plainUser->id,
        ]);

        $loanType = LoanType::create([
            'school_id' => $school->id,
            'name' => 'Staff Loan',
            'max_amount' => 5000000,
            'interest_rate' => 8,
            'duration_months' => 12,
            'status' => 'active',
        ]);

        NSSFPSSF::create([
            'school_id' => $school->id,
            'contribution_type' => 'nssf',
            'nssf_contribution' => 0.1,
            'psssf_contribution' => 0,
            'school_contribution' => 0,
        ]);

        DB::table('payee_ranges')->insert([
            'effective_year' => now()->toDateString(),
            'lower_bound' => 0,
            'upper_bound' => null,
            'percentage' => 0,
            'added_amount' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $configWithLoan = PayrollConfigurations::create([
            'school_id' => $school->id,
            'academic_year' => now(),
            'teacher_id' => $borrowerTeacher->id,
            'payment_method' => 'bank',
            'employee_status' => 'active',
            'base_salary' => 1000000,
            'gross_salary' => 1100000,
            'net_salary' => 900000,
            'taxable_income' => 1000000,
        ]);

        $configWithoutLoan = PayrollConfigurations::create([
            'school_id' => $school->id,
            'academic_year' => now(),
            'teacher_id' => $plainTeacher->id,
            'payment_method' => 'bank',
            'employee_status' => 'active',
            'base_salary' => 800000,
            'gross_salary' => 850000,
            'net_salary' => 750000,
            'taxable_income' => 780000,
        ]);

        $loan = LoanApplication::create([
            'loan_reference' => 'LN-PR-001',
            'school_id' => $school->id,
            'user_id' => $borrowerUser->id,
            'loan_type_id' => $loanType->id,
            'amount' => 1200000,
            'duration_months' => 12,
            'interest_rate' => 8,
            'total_interest' => 96000,
            'total_repayment' => 1296000,
            'monthly_installment' => 108000,
            'status' => 'disbursed',
            'total_paid' => 0,
            'repayment_start_date' => now()->toDateString(),
        ]);

        PayrollChange::create([
            'school_id' => $school->id,
            'payroll_configuration_id' => $configWithLoan->id,
            'loan_application_id' => $loan->id,
            'adjustment_type' => 'loan_repayment',
            'loan_installment_amount' => 108000,
            'loan_remaining_balance' => 1296000,
            'loan_total_applied' => 0,
            'has_fringe_benefit' => false,
            'fringe_benefit_amount' => 0,
            'fringe_benefit_effect' => null,
            'calculation_mode' => 'fixed_amount',
            'manual_amount' => 0,
            'manual_rate' => null,
            'manual_effect' => null,
            'start_date' => now()->toDateString(),
            'stop_on_zero_balance' => true,
            'priority' => 100,
            'status' => 'active',
        ]);

        PayrollChange::create([
            'school_id' => $school->id,
            'payroll_configuration_id' => $configWithLoan->id,
            'loan_application_id' => null,
            'adjustment_type' => 'manual_allowance',
            'loan_installment_amount' => 0,
            'loan_remaining_balance' => null,
            'loan_total_applied' => 0,
            'has_fringe_benefit' => true,
            'fringe_benefit_amount' => 50000,
            'fringe_benefit_effect' => 'allowance',
            'calculation_mode' => 'fixed_amount',
            'manual_amount' => 0,
            'manual_rate' => null,
            'manual_effect' => null,
            'start_date' => now()->toDateString(),
            'stop_on_zero_balance' => true,
            'priority' => 50,
            'status' => 'active',
        ]);

        $this->actingAs($accountant)
            ->post(route('accounting.payrollRuns.process'))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('payroll_runs', 2);

        $this->assertDatabaseHas('payroll_runs', [
            'payroll_configuration_id' => $configWithLoan->id,
            'status' => 'processed',
        ]);

        $this->assertDatabaseHas('payroll_runs', [
            'payroll_configuration_id' => $configWithLoan->id,
            'taxable_income' => 950000,
        ]);

        $this->assertDatabaseHas('payroll_runs', [
            'payroll_configuration_id' => $configWithoutLoan->id,
            'status' => 'processed',
        ]);

        $this->assertDatabaseHas('payroll_changes', [
            'payroll_configuration_id' => $configWithLoan->id,
            'loan_total_applied' => 108000,
            'loan_remaining_balance' => 1188000,
        ]);
    }
}
