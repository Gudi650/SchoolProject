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
            
            // Foreign keys
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('loan_type_id')->constrained('loan_types')->cascadeOnDelete();
            
            // Loan application details
            $table->decimal('amount', 12, 2); // Loan amount requested
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('total_interest', 12, 2)->nullable();
            $table->decimal('total_repayment', 12, 2)->nullable();
            $table->decimal('monthly_installment', 12, 2)->nullable();
            $table->integer('duration'); // Duration in months
            $table->text('purpose'); // Purpose/reason for loan
            $table->string('attachment')->nullable(); // File path for supporting documents
            
            // Status tracking
            $table->enum('status', [
                'pending',
                'under_review',
                'approved',
                'rejected',
                'disbursed',
                'active',
                'completed'
            ])->default('pending');
            
            $table->text('remarks')->nullable(); // Admin remarks or rejection reason
            
            // Approval tracking
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->date('repayment_start_date')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('school_id');
            $table->index('user_id');
            $table->index('loan_type_id');
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
