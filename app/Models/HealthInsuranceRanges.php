<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthInsuranceRanges extends Model
{
    //fillable fields for mass assignment
    protected $fillable = [
        'health_insurance_id',
        'lower_bound',
        'upper_bound',
        'employee_contribution',
        'employer_contribution',
    ];

    //relationship with the health insurance model
    public function healthInsurance()
    {
        return $this->belongsTo(HealthInsurance::class);
    }
}
