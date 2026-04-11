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

class LoanFlowFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function seedCoreData(): array
    {
        $school = School::create([
            'name' => 'Flow School',
            'email' => 'flow-school@example.com',
        ]);

        $accountant = User::create([
            'fname' => 'Flow',
            'lname' => 'Accountant',
            'email' => 'flow-accountant@example.com',
            'password' => bcrypt('password'),
            'roles' => 'accountant',
        ]);

        $borrower = User::create([
            'fname' => 'Flow',
            'lname' => 'Borrower',
            'email' => 'flow-borrower@example.com',
            'password' => bcrypt('password'),
            'roles' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'fname' => 'Flow',
            'lname' => 'Borrower',
            'email' => 'flow-teacher@example.com',
            'gender' => 'male',
            'school_id' => $school->id,
            'user_id' => $borrower->id,
        ]);

        $loanType = LoanType::create([
            'school_id' => $school->id,
            'name' => 'Emergency Loan',
            'max_amount' => 5000000,
            'interest_rate' => 8.50,
            'duration_months' => 12,
            'status' => 'active',
        ]);

        PayrollConfigurations::create([
            'school_id' => $school->id,
            'academic_year' => now(),
            'teacher_id' => $teacher->id,
            'payment_method' => 'bank',
            'employee_status' => 'active',
            'base_salary' => 900000,
            'gross_salary' => 1000000,
            'net_salary' => 800000,
            'taxable_income' => 850000,
        ]);

        return compact('school', 'accountant', 'borrower', 'teacher', 'loanType');
    }

    public function test_teacher_can_apply_for_loan_and_application_is_saved_as_pending(): void
    {
        $data = $this->seedCoreData();

        $this->actingAs($data['borrower'])
            ->post(route('teacher.loans.apply.store'), [
                'loan_type_id' => $data['loanType']->id,
                'amount' => 1200000,
                'duration_months' => 12,
                'purpose' => 'Medical support',
            ])
            ->assertSessionHas('success');

        $this->assertDatabaseHas('loan_applications', [
            'user_id' => $data['borrower']->id,
            'school_id' => $data['school']->id,
            'loan_type_id' => $data['loanType']->id,
            'amount' => 1200000,
            'status' => 'pending',
        ]);
    }

    public function test_pending_loan_can_move_to_under_review(): void
    {
        $data = $this->seedCoreData();

        $loan = LoanApplication::create([
            'loan_reference' => 'LN-FLOW-0001',
            'school_id' => $data['school']->id,
            'user_id' => $data['borrower']->id,
            'loan_type_id' => $data['loanType']->id,
            'amount' => 500000,
            'duration_months' => 10,
            'interest_rate' => 8.5,
            'total_interest' => 35416.67,
            'total_repayment' => 535416.67,
            'monthly_installment' => 53541.67,
            'status' => 'pending',
        ]);

        $this->actingAs($data['accountant'])
            ->post(route('accounting.proposal.moveUnderReview', $loan->id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('loan_applications', [
            'id' => $loan->id,
            'status' => 'under_review',
        ]);
    }

    public function test_disburse_is_blocked_when_loan_is_not_approved(): void
    {
        $data = $this->seedCoreData();

        $loan = LoanApplication::create([
            'loan_reference' => 'LN-FLOW-0002',
            'school_id' => $data['school']->id,
            'user_id' => $data['borrower']->id,
            'loan_type_id' => $data['loanType']->id,
            'amount' => 800000,
            'duration_months' => 8,
            'interest_rate' => 8.5,
            'total_interest' => 45333.33,
            'total_repayment' => 845333.33,
            'monthly_installment' => 105666.67,
            'status' => 'pending',
        ]);

        $this->actingAs($data['accountant'])
            ->post(route('accounting.loanDisburse', $loan->id))
            ->assertSessionHas('error');

        $this->assertDatabaseMissing('payroll_changes', [
            'loan_application_id' => $loan->id,
        ]);

        $this->assertDatabaseHas('loan_applications', [
            'id' => $loan->id,
            'status' => 'pending',
        ]);
    }

    public function test_approved_loan_disbursement_creates_payroll_change_and_updates_status(): void
    {
        $data = $this->seedCoreData();

        $loan = LoanApplication::create([
            'loan_reference' => 'LN-FLOW-0003',
            'school_id' => $data['school']->id,
            'user_id' => $data['borrower']->id,
            'loan_type_id' => $data['loanType']->id,
            'amount' => 1000000,
            'duration_months' => 10,
            'interest_rate' => 8.5,
            'total_interest' => 70833.33,
            'total_repayment' => 1070833.33,
            'monthly_installment' => 107083.33,
            'status' => 'approved',
            'paye_applicable' => true,
            'paye_benefit_monthly' => 12000,
            'total_paid' => 0,
            'repayment_start_date' => now()->toDateString(),
        ]);

        $this->actingAs($data['accountant'])
            ->post(route('accounting.loanDisburse', $loan->id))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('loan_applications', [
            'id' => $loan->id,
            'status' => 'disbursed',
        ]);

        $this->assertDatabaseHas('payroll_changes', [
            'loan_application_id' => $loan->id,
            'school_id' => $data['school']->id,
            'adjustment_type' => 'loan_repayment',
            'loan_installment_amount' => 107083.33,
            'status' => 'active',
            'has_fringe_benefit' => 1,
            'fringe_benefit_amount' => 12000,
            'fringe_benefit_effect' => 'allowance',
        ]);
    }
}
