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
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->string('TermName');
            $table->integer('score');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('student_id'); //link to students table
            $table->unsignedBigInteger('subject_id'); //link to availablesubjects table
            $table->unsignedBigInteger('teacher_id'); //link to teachers table
            $table->unsignedBigInteger('school_id'); //link to schools table
            $table->timestamps();




            //foreign key constraints
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); //referencing the students table
            $table->foreign('subject_id')->references('id')->on('availablesubjects')->onDelete('cascade'); //referencing the availablesubjects table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); //referencing the teachers table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade'); //referencing the schools table

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
