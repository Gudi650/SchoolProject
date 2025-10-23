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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Link to users table
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('email')->unique()->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table ->string('class');
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('ward')->nullable();
            $table->string('city')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
