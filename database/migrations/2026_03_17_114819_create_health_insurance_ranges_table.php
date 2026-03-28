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
        Schema::create('health_insurance_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('health_insurance_id');
            $table->decimal('lower_bound', 15, 2);
            $table->decimal('upper_bound', 15, 2);
            $table->decimal('employee_contribution', 15, 2);
            $table->decimal('employer_contribution', 15, 2);
            $table->timestamps();

            //foreign key constraint linking to the health_insurances table
            $table->foreign('health_insurance_id')->references('id')->on('health_insurances')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_insurance_ranges');
    }
};
