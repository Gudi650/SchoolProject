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
        Schema::create('assigned-subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // Link to teachers table
            $table->unsignedBigInteger('availablesubject_id'); // Link to availablesubjects table
            $table->unsignedBigInteger('school_id'); // Link to schools table
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); //referencing the teachers table
            $table->foreign('availablesubject_id')->references('id')->on('availablesubjects')->onDelete('cascade'); //referencing the availablesubjects table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade'); //referencing the schools table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned-subjects');
    }
};
