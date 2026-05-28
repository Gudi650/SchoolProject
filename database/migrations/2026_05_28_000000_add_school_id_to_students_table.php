<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->nullable()->after('class_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });

        // Populate `school_id` from the related class_availables record.
        // Uses a JOIN update which works on MySQL (XAMPP).
        DB::statement('UPDATE students JOIN class_availables ON students.class_id = class_availables.id SET students.school_id = class_availables.school_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
    }
};
