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
        Schema::create('loan_configurations', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('school_id')->unique();

            // GENERAL RULES
            $table->decimal('max_loan_multiplier', 5, 2)->default(3.00);
            $table->decimal('max_loan_amount', 12, 2)->nullable();
            $table->integer('max_duration_months')->default(24);
            $table->integer('grace_period_days')->default(0);

            // INTEREST SETTINGS
            $table->decimal('default_interest_rate', 5, 2)->default(8.00);
            $table->decimal('min_interest_rate', 5, 2)->default(5.75);
            $table->enum('interest_type', ['flat', 'reducing'])->default('flat');

            // REPAYMENT RULES
            $table->decimal('max_deduction_percent', 5, 2)->default(40.00);
            $table->boolean('allow_early_repayment')->default(true);
            $table->boolean('allow_multiple_loans')->default(false);
            $table->boolean('auto_payroll_deduction')->default(true);

            // PAYE SETTINGS
            $table->boolean('enable_paye_calculation')->default(true);
            $table->boolean('warn_high_loan')->default(true);
            $table->boolean('warn_long_duration')->default(true);

            // APPROVAL SETTINGS
            $table->boolean('require_approval')->default(true);
            $table->integer('approval_levels')->default(1);
            $table->boolean('allow_override')->default(true);

            // NOTIFICATIONS
            $table->boolean('notify_on_approval')->default(true);
            $table->boolean('notify_on_deduction')->default(true);
            $table->boolean('notify_on_completion')->default(true);

            $table->timestamps();

            //relationship

            //relationship with the schools table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_configurations');
    }
};
