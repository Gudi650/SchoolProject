<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollChange extends Model
{
    use HasFactory;

    protected $table = 'payroll_changes';

    protected $fillable = [
        'school_id',
        'payroll_configuration_id',
        'loan_application_id',
        'adjustment_type',
        'loan_installment_amount',
        'loan_remaining_balance',
        'loan_total_applied',
        'has_fringe_benefit',
        'fringe_benefit_amount',
        'fringe_benefit_effect',
        'calculation_mode',
        'manual_amount',
        'manual_rate',
        'manual_effect',
        'start_date',
        'end_date',
        'stop_on_zero_balance',
        'priority',
        'status',
        'last_applied_at',
        'source_reference',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'loan_installment_amount' => 'decimal:2',
        'loan_remaining_balance' => 'decimal:2',
        'loan_total_applied' => 'decimal:2',
        'has_fringe_benefit' => 'boolean',
        'fringe_benefit_amount' => 'decimal:2',
        'manual_amount' => 'decimal:2',
        'manual_rate' => 'decimal:4',
        'stop_on_zero_balance' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'last_applied_at' => 'date',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function payrollConfiguration(): BelongsTo
    {
        return $this->belongsTo(PayrollConfigurations::class, 'payroll_configuration_id');
    }

    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
