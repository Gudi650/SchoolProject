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
        Schema::table('assigned-subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('assigned-subjects', 'class_id')) {
                $table->unsignedBigInteger('class_id')->after('availablesubject_id')->nullable();
                $table->foreign('class_id')->references('id')->on('class_availables')->onDelete('cascade');
            }
        });

        // Optionally backfill using related data if possible
        try {
            if (Schema::hasColumn('assigned-subjects', 'class_id')) {
                // no-op: leave backfilling to application logic or a separate script
            }
        } catch (\Exception $e) {
            // ignore during migration if DB doesn't support introspection
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assigned-subjects', function (Blueprint $table) {
            if (Schema::hasColumn('assigned-subjects', 'class_id')) {
                $table->dropForeign([ 'class_id' ]);
                $table->dropColumn('class_id');
            }
        });
    }
};
