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
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_enrollment_id')->unique();
            $table->string('previous_school_name')->nullable();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('student_profile_picture')->nullable();
            $table->unsignedBigInteger('parent_enrollment_id');
            $table->timestamps();


            //foreign key
            $table->foreign('parent_enrollment_id')->references('id')->on('parent_enrollments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};
