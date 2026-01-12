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
        Schema::create('fee-structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');//link with the school
            $table->decimal('tuition_fee', 12,3);
            $table->decimal('library_fee', 12,3)->nullable();
            $table->decimal('transport_fee', 12,3)->nullable();
            $table->decimal('hostel_fee', 12,3)->nullable();
            $table->decimal('exam_fee', 12,3)->nullable();

            //dynamic attributes comes below in the column
            $table->json('dynamic_attributes')->nullable();

            $table->timestamps();


            //foreign key definition
            //school_id foreign key definition
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee-structures');
    }
};
