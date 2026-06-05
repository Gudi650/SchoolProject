<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'isbn',
        'publisher',
        'publication_year',
        'shelf_location',
        'total_copies',
        'available_copies',
        'description',
        'cover_url',
        'status',
        'school_id',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(LibraryBookCategory::class, 'category_id');
    }
}