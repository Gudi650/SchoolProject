<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollConfigurations extends Model
{
    protected $fillable = [
        'school_id',
        'academic_year',
        'teacher_id',
        'employee_id',
        'payment_method',
        'employee_status',
        'contract_type',
        'bank_name',
        'bank_account_number',
        'Account_name',
        'notes',
        'allowances_id',
        'deductions_id',
        'gross_salary',
        'net_salary',
    ];
}
