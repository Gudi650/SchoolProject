<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class LibraryBookCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(LibraryBook::class, 'category_id');
    }

    protected static function booted(): void
    {
        static::saving(function (LibraryBookCategory $category) {
            $category->slug = Str::slug($category->name);
        });
    }
}