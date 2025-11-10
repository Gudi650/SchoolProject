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
        Schema::create('assigned_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // Link to teachers table
            $table->unsignedBigInteger('teacher_role_id'); // Link to teacher_roles table
            $table->unsignedBigInteger('class-available_id')->nullable(); // Link to class_availables table
            $table->timestamps();


            // Foreign key constraints

            //referencing the teachers table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade'); 
            
            //referencing the teacher_roles table
            $table->foreign('teacher_role_id')->references('id')->on('teacher_roles')->onDelete('cascade');     

            //referencing the class_availables table
            $table->foreign('class-available_id')->references('id')->on('class-availables')->onDelete('cascade'); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_roles');
    }
};
