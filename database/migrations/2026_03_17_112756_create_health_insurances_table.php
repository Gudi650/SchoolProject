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
        Schema::create('health_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('provider_name');
            $table->enum('type', ['percentage', 'fixed_amount']);
            $table->decimal('employee_contribution', 8, 2);
            $table->decimal('employer_contribution', 8, 2);
            $table->boolean('has_ranges')->default(false);
            $table->timestamps();


            //foreign key constraint linking to the schools table
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_insurances');
    }
};
