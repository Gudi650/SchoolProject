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
        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('payroll_configuration_id')->constrained('payroll_configurations')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('pay_period_label')->nullable();
            $table->date('pay_period_start')->nullable();
            $table->date('pay_period_end')->nullable();

            $table->decimal('base_salary', 15, 2)->default(0);
            $table->decimal('total_allowances', 15, 2)->default(0);
            $table->decimal('taxable_income', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);

            $table->decimal('loan_deductions_total', 15, 2)->default(0);
            $table->decimal('fringe_benefit_total', 15, 2)->default(0);
            $table->decimal('other_deductions_total', 15, 2)->default(0);
            $table->decimal('other_allowances_total', 15, 2)->default(0);

            $table->enum('status', ['draft', 'processed', 'paid', 'cancelled'])->default('draft');
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index(['school_id', 'pay_period_start']);
            $table->index(['payroll_configuration_id', 'status']);
            $table->index(['school_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_runs');
    }
};
