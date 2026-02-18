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
        if (Schema::hasTable('budget_categories')) {
            return;
        }

        Schema::create('budget_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_id');
            $table->unsignedBigInteger('department_id');
            $table->string('expense_type');
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            //foreign key constraint

            //budget foreign key
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_categories');
    }
};
