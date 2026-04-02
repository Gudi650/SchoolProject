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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();

            $table->string('loan_reference')->unique();

            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('loan_type_id')->constrained('loan_types')->cascadeOnDelete();

            $table->decimal('amount', 12, 2);
            $table->integer('duration_months');
            $table->text('purpose')->nullable();
            $table->string('attachment')->nullable();

            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_interest', 12, 2)->nullable();
            $table->decimal('total_repayment', 12, 2)->nullable();
            $table->decimal('monthly_installment', 12, 2)->nullable();


            $table->boolean('paye_applicable')->default(false);
            $table->decimal('paye_benefit_monthly', 12, 2)->nullable();
            $table->decimal('paye_benefit_annual', 12, 2)->nullable();

            $table->enum('status', [
                'pending',
                'under_review',
                'approved',
                'rejected',
                'disbursed',
                'active',
                'completed',
            ])->default('pending');

            $table->text('remarks')->nullable();

            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();

            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('rejected_at')->nullable();

            $table->timestamp('disbursed_at')->nullable();
            $table->foreignId('disbursed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->date('repayment_start_date')->nullable();

            $table->decimal('total_paid', 12, 2)->default(0);

            $table->timestamps();

            $table->index(['school_id', 'user_id']);
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
