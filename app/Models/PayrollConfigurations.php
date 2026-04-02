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
        'base_salary',
        'net_salary',
    ];

    //relationships

    //teacher table rtnship
    public function teachers()
    {
        return $this->belongsTo(Teacher::class);
    }

    //relationship with school table
    public function schools()
    {
        return $this->belongsTo(School::class);
    }

    //relationship with employee table
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    //relationship with allowances table
    public function allowances()
    {
        return $this->belongsTo(Allowances::class, 'allowances_id');
    }

    //relationhip with deductions table
    public function deductions()
    {
        return $this->belongsTo(Deductions::class, 'deductions_id');
    }
    

    //Cascade delete related records in the allowances and deductions tables when a payroll configuration record is deleted
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($payrollConfiguration) {
            //delete related allowances record
            if ($payrollConfiguration->allowances) {
                $payrollConfiguration->allowances->delete();
            }

            //delete related deductions record
            if ($payrollConfiguration->deductions) {
                $payrollConfiguration->deductions->delete();
            }

            //delete the employee record 
            if($payrollConfiguration->employee){
                $payrollConfiguration->employee->delete();
            }

        });
    }



}
