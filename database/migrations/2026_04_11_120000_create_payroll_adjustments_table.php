<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_changes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('payroll_configuration_id')->constrained('payroll_configurations')->cascadeOnDelete();
            $table->foreignId('loan_application_id')->nullable()->constrained('loan_applications')->nullOnDelete();

            $table->enum('adjustment_type', [
                'loan_repayment',
                'manual_deduction',
                'manual_allowance',
            ]);

            // Loan repayment deduction
            $table->decimal('loan_installment_amount', 15, 2)->default(0);
            $table->decimal('loan_remaining_balance', 15, 2)->nullable();
            $table->decimal('loan_total_applied', 15, 2)->default(0);

            // Fringe benefit (allowance or deduction)
            $table->boolean('has_fringe_benefit')->default(false);
            $table->decimal('fringe_benefit_amount', 15, 2)->default(0);
            $table->enum('fringe_benefit_effect', ['deduction', 'allowance'])->nullable();

            // Generic fields for manual adjustments
            $table->enum('calculation_mode', ['fixed_amount', 'percentage'])->default('fixed_amount');
            $table->decimal('manual_amount', 15, 2)->default(0);
            $table->decimal('manual_rate', 8, 4)->nullable();
            $table->enum('manual_effect', ['deduction', 'allowance'])->nullable();

            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('stop_on_zero_balance')->default(true);

            $table->unsignedTinyInteger('priority')->default(100);
            $table->enum('status', ['scheduled', 'active', 'paused', 'completed', 'cancelled'])->default('scheduled');
            $table->date('last_applied_at')->nullable();

            $table->string('source_reference')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['school_id', 'status']);
            $table->index(['payroll_configuration_id', 'status']);
            $table->index('loan_application_id');
            $table->index(['adjustment_type', 'status']);
            $table->index('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_changes');
    }
};
