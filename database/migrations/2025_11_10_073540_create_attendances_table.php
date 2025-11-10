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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable(); // Link to students table
            $table->unsignedBigInteger('class-available_id')->nullable(); // Link to classes table
            $table->unsignedBigInteger('school_id')->nullable(); // Link to schools table
            $table->unsignedBigInteger('teacher_id')->nullable(); // Link to teachers table
            $table->date('date'); // Date of attendance
            $table->boolean('status'); // Attendance status: present or absent
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); //referencing the students table
            $table->foreign('class-available_id')->references('id')->on('class-availables')->onDelete('cascade'); //referencing the classes table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade'); //referencing the schools table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); //referencing the teachers table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
