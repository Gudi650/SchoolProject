<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthInsurance extends Model
{
    //fillable fields for mass assignment
    protected $fillable = [
        'school_id',
        'provider_name',
        'type',
        'employee_contribution',
        'employer_contribution',
        'has_ranges',
    ];

    //relationship with the health insurance ranges model
    public function ranges()
    {
        return $this->hasMany(HealthInsuranceRanges::class);
    }
}
