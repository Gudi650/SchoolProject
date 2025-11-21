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
        Schema::create('generated_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('school_id');
            $table->date('exam_date');
            $table->float('average_score');
            $table->float('total_score');
            $table->integer('rank');
            $table->timestamps();


            // Foreign key constraints

            //linking to the student table
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            //linking to the classes table
            $table->foreign('class_id')->references('id')->on('class-availables')->onDelete('cascade');

            //linking to the schools table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_results');
    }
};
