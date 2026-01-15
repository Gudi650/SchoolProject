<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassFeePivot extends Model
{
    //fillable 
    protected $fillable = [
        'class_id',
        'fee_structure_id',
    ];

    //relationship with ClassAvailable model
    public function classavailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }

    //relationship with FeeStructure model
    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class, 'fee_structure_id');
    }

}
