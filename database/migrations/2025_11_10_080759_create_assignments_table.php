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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('due_date');
            $table->unsignedBigInteger('school_id'); // Link to schools table to know which school the assignment belongs to
            $table->unsignedBigInteger('teacher_id'); // Link to teachers table to know who created the assignment
            $table->unsignedBigInteger('class-available_id'); // Link to classes table
            $table->string('attachment')->nullable(); // Optional attachment for the assignment
            $table->timestamps();



            // Foreign key constraints

            //referencing the schools table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade'); 

            //referencing the teachers table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); 

            //referencing the classes table
            $table->foreign('class-available_id')->references('id')->on('class-availables')->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
