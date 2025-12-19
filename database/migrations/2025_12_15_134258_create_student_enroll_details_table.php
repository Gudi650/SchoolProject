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
        Schema::create('student_enroll_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_enrollment_id')->unique();
            $table->date('admission_date')->nullable();
            $table->string('grade_applied_for');
            $table->string('previous_school_name')->nullable();
            $table->string('academic_records')->nullable();
            $table->string('transfer_certificate')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('reports_card')->nullable();
            $table->string('previous_grades')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();


            //foreign key constraint
            $table->foreign('student_enrollment_id')->references('student_enrollment_id')->on('student_enrollments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enroll_details');
    }
};
