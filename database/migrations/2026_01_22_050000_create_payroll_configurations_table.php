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
        Schema::create('payroll_configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->dateTime('academic_year');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('payment_method');
            $table->string('employee_status');
            $table->string('contract_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('Account_name')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('allowances_id')->nullable();
            $table->unsignedBigInteger('deductions_id')->nullable();
            $table->decimal('gross_salary', 15, 2)->nullable();
            $table->decimal('net_salary', 15, 2)->nullable();
            //$table->string('Payment_frequency');
            $table->timestamps();


            //foreign keys
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('allowances_id')->references('id')->on('allowances')->onDelete('set null');
            $table->foreign('deductions_id')->references('id')->on('deductions')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_configurations');
    }
};
