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
        Schema::table('budget_categories', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('budget_departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budget_categories', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
};
