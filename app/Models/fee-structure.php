<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    //fillable fields
    protected $fillable = [
        'school_id',
        'tuition_fee',
        'transport_fee',
        'hostel_fee',
        'library_fee',
        'exam_fee',
        'currency',
        'dynamic_attributes',
        'for',
    ];

    //make json an array
    protected $casts = [
        'dynamic_attributes' => 'array',
    ];

}
