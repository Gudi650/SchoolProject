<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_health_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('blood_group')->nullable();
            $table->text('allergies')->nullable();
            $table->text('chronic_conditions')->nullable();
            $table->text('medications')->nullable();
            $table->string('insurance_provider')->nullable();
            $table->string('insurance_number')->nullable();
            $table->text('emergency_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('student_health_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('provider_name');
            $table->date('appointment_date');
            $table->text('reason')->nullable();
            $table->string('status')->default('upcoming');
            $table->timestamps();
        });

        Schema::create('student_health_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('record_type')->default('other');
            $table->date('record_date')->nullable();
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_health_documents');
        Schema::dropIfExists('student_health_appointments');
        Schema::dropIfExists('student_health_profiles');
    }
};
