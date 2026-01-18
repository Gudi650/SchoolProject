<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeOptions extends Model
{
    //fillable fields
    protected $fillable = [
        'school_id',
        'tuition_fee',
        'library_fee',
        'transport_fee',
        'hostel_fee',
        'exam_fee',
        'dynamic_attributes',
    ];

    //make json an array
    protected $casts =[
        'dynamic_attributes' => 'array',
    ];

    //relationships with School model
    public function school()
    {
        return $this->belongsTo(School::class , 'school_id');
    }

    

}
