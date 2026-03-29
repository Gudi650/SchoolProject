<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    protected $fillable = [
        'school_id',
        'PAYE',
        'NSSF_contribution',
        'NHIF_contribution',
        'loan_deductions',
        'other_deductions',
        'total_deductions',
    ];

    //relationships

    //relationship with the school table
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
