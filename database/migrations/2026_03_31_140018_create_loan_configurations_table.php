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
        Schema::create('loan_configurations', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->decimal('max_loan_multiplier', 4, 2)->default(3.00);
            $table->decimal('min_interest_rate', 5, 2)->default(5.75);
            $table->boolean('enable_paye')->default(false);
            $table->tinyInteger('approval_levels')->default(1);
            $table->boolean('allow_override')->default(false);
            $table->boolean('warn_exceed_multiplier')->default(true);
            $table->boolean('warn_exceed_duration')->default(true);
            $table->boolean('notify_on_approval')->default(true);
            $table->boolean('notify_on_deduction')->default(true);
            $table->boolean('notify_on_completion')->default(true);
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_configurations');
    }
};
