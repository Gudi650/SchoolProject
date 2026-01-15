<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    //protected table name
    protected $table = 'fee-structures';

    //fillable fields
    protected $fillable = [
        'school_id',
        'tuition_fee',
        'transport_fee',
        'hostel_fee',
        'library_fee',
        'exam_fee',
        'currency',
        'for',
        'class_id',
        'dynamic_attributes',
    ];

    //make json an array
    protected $casts =[
        'dynamic_attributes' => 'array',
    ];

}
