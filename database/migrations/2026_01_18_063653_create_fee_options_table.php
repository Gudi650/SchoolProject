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
        Schema::create('fee_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');//link with the school
            $table->string('tuition_fee')->nullable();
            $table->string('library_fee')->nullable();
            $table->string('transport_fee')->nullable();
            $table->string('hostel_fee')->nullable();
            $table->string('exam_fee')->nullable();
             
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
        Schema::dropIfExists('fee_options');
    }
};
