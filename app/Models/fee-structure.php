<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feestructure extends Model
{

    //fillable fields
    protected $fillable = [
        'school_id',
        'tuition_fee',
        'transport_fee',
        'hostel_fee',
        'library_fee',
        'exam_fee',
        'dynamic_attributes',
    ];

    //make json an array
    protected $cast =[
        'dynamic_attributes' => 'array',
    ]

}
