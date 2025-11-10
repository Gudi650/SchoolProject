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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('school_id'); // Link to schools table to know which school the announcement belongs to
            $table->unsignedBigInteger('teacher_id'); // Link to teachers table to know who created the announcement
            $table->unsignedBigInteger('class-available_id')->nullable(); // Optional link to classes table
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade'); //referencing the schools table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); //referencing the teachers table
            $table->foreign('class-available_id')->references('id')->on('class-availables')->onDelete('cascade'); //referencing the classes table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
