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
        'dynamic_attributes',
    ];

    //make json an array
    protected $casts =[
        'dynamic_attributes' => 'array',
    ];

    //relationship with School model
    public function school()
    {
        return $this->belongsTo(School::class , 'school_id');
    }

    //many-to-many relationship with ClassAvailable model through pivot table
    public function classes()
    {
        return $this->belongsToMany(ClassAvailable::class, 'class_fee_pivots', 'fee_structure_id', 'class_id');
    }

}
