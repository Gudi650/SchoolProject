<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('invoices')) {
            return;
        }
        if (! Schema::hasColumn('invoices', 'customer_name')) {
            Schema::table('invoices', function (Blueprint $table) {
                $table->dropForeign(['student_id']);
            });
            Schema::table('invoices', function (Blueprint $table) {
                $table->unsignedBigInteger('student_id')->nullable()->change();
                $table->string('bill_to', 16)->default('other')->after('school_id');
                $table->string('customer_name')->nullable()->after('student_id');
                $table->string('customer_email')->nullable()->after('customer_name');
                $table->string('customer_phone', 32)->nullable()->after('customer_email');
                $table->string('billing_address', 500)->nullable()->after('customer_phone');
                $table->foreign('student_id')->references('id')->on('students')->nullOnDelete();
            });
        }
        if (Schema::hasTable('invoice_items') && ! Schema::hasColumn('invoice_items', 'category')) {
            Schema::table('invoice_items', function (Blueprint $table) {
                $table->string('category', 64)->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        //
    }
};
