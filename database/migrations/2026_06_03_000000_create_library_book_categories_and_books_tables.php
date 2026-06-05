<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('library_book_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('library_book_categories')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('isbn')->unique()->nullable();
            $table->string('publisher')->nullable();
            $table->unsignedSmallInteger('publication_year')->nullable();
            $table->string('shelf_location')->nullable();
            $table->unsignedInteger('total_copies')->default(1);
            $table->unsignedInteger('available_copies')->default(1);
            $table->text('description')->nullable();
            $table->string('cover_url')->nullable();
            $table->enum('status', ['available', 'reference', 'checked-out'])->default('available');
            $table->timestamps();

            $table->index(['title', 'author', 'isbn']);
            $table->index('status');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_books');
        Schema::dropIfExists('library_book_categories');
    }
};