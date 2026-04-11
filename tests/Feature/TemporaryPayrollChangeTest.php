<?php

namespace Tests\Feature;

use App\Models\PayrollConfigurations;
use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TemporaryPayrollChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_accountant_can_store_temporary_manual_allowance_change(): void
    {
        $school = School::create([
            'name' => 'Temporary Change School',
            'email' => 'temporary-change-school@example.com',
        ]);

        $accountant = User::create([
            'fname' => 'Account',
            'lname' => 'Manager',
            'email' => 'temporary-accountant@example.com',
            'password' => bcrypt('password'),
            'roles' => 'accountant',
            'school_id' => $school->id,
        ]);

        $teacherUser = User::create([
            'fname' => 'Temp',
            'lname' => 'Teacher',
            'email' => 'temp-teacher-user@example.com',
            'password' => bcrypt('password'),
            'roles' => 'teacher',
        ]);

        $teacher = Teacher::create([
            'fname' => 'Temp',
            'lname' => 'Teacher',
            'email' => 'temp-teacher@example.com',
            'gender' => 'female',
            'school_id' => $school->id,
            'user_id' => $teacherUser->id,
        ]);

        $payrollConfig = PayrollConfigurations::create([
            'school_id' => $school->id,
            'academic_year' => now(),
            'teacher_id' => $teacher->id,
            'payment_method' => 'bank',
            'employee_status' => 'active',
            'base_salary' => 900000,
            'gross_salary' => 950000,
            'net_salary' => 800000,
            'taxable_income' => 900000,
        ]);

        $this->actingAs($accountant)
            ->post(route('accounting.payrollChanges.storeTemporary'), [
                'payroll_configuration_id' => $payrollConfig->id,
                'adjustment_type' => 'manual_allowance',
                'manual_amount' => 75000,
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonths(2)->toDateString(),
                'status' => 'active',
                'notes' => 'Temporary allowance for project assignment',
            ])
            ->assertRedirect(route('accounting.payrollSettings'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('payroll_changes', [
            'school_id' => $school->id,
            'payroll_configuration_id' => $payrollConfig->id,
            'adjustment_type' => 'manual_allowance',
            'manual_amount' => 75000,
            'manual_effect' => 'allowance',
            'status' => 'active',
            'source_reference' => 'manual-temp',
        ]);
    }
}
