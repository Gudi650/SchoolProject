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
        Schema::create('payee_ranges', function (Blueprint $table) {
            $table->id();
            $table->date('effective_year');    //year when the payee range becomes effective
            $table->decimal('lower_bound', 15,2);    //lower bound of the payee range
            $table->decimal('upper_bound', 15,2)->nullable();    //upper bound of the payee range
            $table->decimal('percentage', 5, 4);    //amount to be paid for payees within the range
            $table->decimal('added_amount', 15, 2)->default(0); //additional deduction for payees within the range
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payee_ranges');
    }
};
