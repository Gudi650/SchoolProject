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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender');
            $table->string('subject_specialization')->nullable();
            $table->string('qualification')->nullable();
            $table->unsignedBigInteger('school_id')->unique();  //link to the schools table where the teacher belongs
            $table->unsignedBigInteger('user_id')->unique();    // Link to users table
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');    //references the schools table 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   //reference the users table


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
