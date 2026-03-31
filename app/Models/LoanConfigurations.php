<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanConfigurations extends Model
{
    //fillable fields
    protected $fillable = [
        'school_id',
        'max_loan_mutliplier',
        'max_loan_amount',
        'max_duration_months',
        'grace_period_days',
        'default_interest_rate',
        'min_interest_rate',
        'interest_type',
        'max_deduction_percent',
        'allow_early_repayment',
        'allow_multiple_loans',
        'auto_payroll_deduction',
        'enable_paye_calculation',
        'warn_high_loan',
        'warn_long_duration',
        'require_approval',
        'approval_levels',
        'allow_override',
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
