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
        Schema::create('generated_timetables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('day_of_week');
            $table->timestamps();


            //foreign keys constraints

            //linking to the classes table
            $table->foreign('class_id')->references('id')->on('class-availables')->onDelete('cascade');

            //linking to the schools table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

            //linking to the subjects table
            $table->foreign('subject_id')->references('id')->on('availablesubjects')->onDelete('cascade');

            //linking to the teachers table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');


        });

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_timetables');
    }
};
