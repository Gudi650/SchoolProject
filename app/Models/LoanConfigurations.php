<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanConfigurations extends Model
{
    //fillable fields
    protected $fillable = [
        'school_id',
        'max_loan_multiplier',
        'min_interest_rate',
        'enable_paye',
        'approval_levels',
        'allow_override',
        'warn_exceed_multiplier',
        'warn_exceed_duration',
        'notify_on_approval',
        'notify_on_deduction',
        'notify_on_completion',
    ];


    //realtionship 

    //school relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    

}
