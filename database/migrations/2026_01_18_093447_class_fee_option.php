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
        Schema::create('class_fee_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('fee_options_id');
            $table->timestamps();


            //foreign keys
            
            //foreign key referencing class-availables table
            $table->foreign('class_id')->references('id')->on('class-availables')->onDelete('cascade');

            //foreign key referencing fee-structures table
            $table->foreign('fee_options_id')->references('id')->on('fee_options')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_fee_options');
    }
};
