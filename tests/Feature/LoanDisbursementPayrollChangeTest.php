<?php

namespace Tests\Feature;

use App\Models\LoanApplication;
use App\Models\LoanType;
use App\Models\PayrollConfigurations;
use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanDisbursementPayrollChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_disbursing_approved_loan_creates_payroll_change_and_updates_loan_status(): void
    {
        $school = School::create([
            'name' => 'Test School',
            'email' => 'school@example.com',
        ]);

        $accountant = User::create([
            'fname' => 'Acct',
            'lname' => 'User',
            'email' => 'accountant@example.com',
            'password' => bcrypt('password'),
            'roles' => 'accountant',
        ]);

        $borrower = User::create([
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'borrower@example.com',
            'password' => bcrypt('password'),
            'roles' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'teacher@example.com',
            'gender' => 'male',
            'school_id' => $school->id,
            'user_id' => $borrower->id,
        ]);

        $loanType = LoanType::create([
            'school_id' => $school->id,
            'name' => 'Staff Loan',
            'max_amount' => 10000000,
            'interest_rate' => 10,
            'duration_months' => 24,
            'status' => 'active',
        ]);

        PayrollConfigurations::create([
            'school_id' => $school->id,
            'academic_year' => now(),
            'teacher_id' => $teacher->id,
            'payment_method' => 'bank',
            'employee_status' => 'active',
            'gross_salary' => 1000000,
            'base_salary' => 900000,
            'net_salary' => 800000,
            'taxable_income' => 850000,
        ]);

        $loan = LoanApplication::create([
            'loan_reference' => 'LN-TEST-0001',
            'school_id' => $school->id,
            'user_id' => $borrower->id,
            'loan_type_id' => $loanType->id,
            'amount' => 1200000,
            'duration_months' => 12,
            'interest_rate' => 10,
            'total_interest' => 120000,
            'total_repayment' => 1320000,
            'monthly_installment' => 110000,
            'status' => 'approved',
            'paye_applicable' => true,
            'paye_benefit_monthly' => 10000,
            'total_paid' => 0,
            'repayment_start_date' => now()->toDateString(),
        ]);

        $this->actingAs($accountant)
            ->post(route('accounting.loanDisburse', $loan->id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('loan_applications', [
            'id' => $loan->id,
            'status' => 'disbursed',
        ]);

        $this->assertDatabaseHas('payroll_changes', [
            'loan_application_id' => $loan->id,
            'school_id' => $school->id,
            'adjustment_type' => 'loan_repayment',
            'loan_installment_amount' => 110000,
            'loan_remaining_balance' => 1320000,
            'has_fringe_benefit' => 1,
            'fringe_benefit_amount' => 10000,
            'fringe_benefit_effect' => 'allowance',
            'status' => 'active',
        ]);
    }
}
