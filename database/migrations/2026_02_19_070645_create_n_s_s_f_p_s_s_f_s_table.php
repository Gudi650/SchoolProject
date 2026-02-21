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
        Schema::create('nssf_pssfs', function (Blueprint $table) {
            $table->id();
            $table->decimal('nssf_contribution', 8, 2)->default(0.10); // NSSF contribution percentage
            $table->decimal('psssf_contribution', 8, 2)->default(0.05); // PSSSF contribution percentage
            $table->unsignedBigInteger('school_id'); // Link to school table
            $table->string('contribution_type'); // Type of contribution (e.g., "NSSF", "PSSSF")
            $table->decimal('school_contribution', 15, 2)->nullable(); //money to be contributed by the school
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nssf_pssfs');
    }
};
