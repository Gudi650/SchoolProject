<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'loan_reference',
        'school_id',
        'user_id',
        'loan_type_id',
        'amount',
        'duration_months',
        'purpose',
        'attachment',
        'interest_rate',
        'total_interest',
        'total_repayment',
        'monthly_installment',
        'paye_applicable',
        'paye_benefit_monthly',
        'paye_benefit_annual',
        'status',
        'remarks',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
        'disbursed_at',
        'disbursed_by',
        'repayment_start_date',
        'total_paid'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'total_interest' => 'decimal:2',
        'total_repayment' => 'decimal:2',
        'monthly_installment' => 'decimal:2',
        'paye_applicable' => 'boolean',
        'paye_benefit_monthly' => 'decimal:2',
        'paye_benefit_annual' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'disbursed_at' => 'datetime',
        'repayment_start_date' => 'date',
    ];

    /**
     * Get the user that submitted the loan application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the loan type of this application.
     */
    public function loanType(): BelongsTo
    {
        return $this->belongsTo(LoanType::class);
    }

    /**
     * Get the user who approved the application.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
