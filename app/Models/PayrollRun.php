<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollRun extends Model
{
    use HasFactory;

    protected $table = 'payroll_runs';

    protected $fillable = [
        'school_id',
        'payroll_configuration_id',
        'created_by',
        'pay_period_label',
        'pay_period_start',
        'pay_period_end',
        'base_salary',
        'total_allowances',
        'taxable_income',
        'total_deductions',
        'net_salary',
        'loan_deductions_total',
        'fringe_benefit_total',
        'other_deductions_total',
        'other_allowances_total',
        'status',
        'notes',
        'processed_at',
        'paid_at',
    ];

    protected $casts = [
        'pay_period_start' => 'date',
        'pay_period_end' => 'date',
        'base_salary' => 'decimal:2',
        'total_allowances' => 'decimal:2',
        'taxable_income' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'loan_deductions_total' => 'decimal:2',
        'fringe_benefit_total' => 'decimal:2',
        'other_deductions_total' => 'decimal:2',
        'other_allowances_total' => 'decimal:2',
        'processed_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function payrollConfiguration(): BelongsTo
    {
        return $this->belongsTo(PayrollConfigurations::class, 'payroll_configuration_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
