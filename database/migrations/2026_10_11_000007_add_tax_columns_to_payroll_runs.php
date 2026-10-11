<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payroll_runs', function (Blueprint $table) {
            $table->decimal('paye_amount', 15, 2)->default(0)->after('taxable_income');
            $table->decimal('nssf_amount', 15, 2)->default(0)->after('paye_amount');
            $table->decimal('psssf_amount', 15, 2)->default(0)->after('nssf_amount');
        });
    }

    public function down(): void
    {
        Schema::table('payroll_runs', function (Blueprint $table) {
            $table->dropColumn(['paye_amount', 'nssf_amount', 'psssf_amount']);
        });
    }
};
