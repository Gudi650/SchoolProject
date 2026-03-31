<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;

    //creating the fillable data for the school table
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'city',
        'country',
    ];

    //relationship with class available model (many-to-many)
    public function classAvailables()
    {
        return $this->hasMany(ClassAvailable::class, 'school_id');
    }

    //relationship with availablesubjet model
    public function availablesubjects()
    {
        return $this->hasMany(availablesubject::class);
    }

    //relationship with student model(one to many)
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    //relationship with teacher model(one to many)
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'school_id');
    }

    //relationship with studentEnrollment model (one to many)
    public function studentEnrollments()
    {
        return $this->hasMany(studentEnrollment::class, 'school_id');
    }

    //relationship with NSSFPSSF model (one to many)
    public function nssfPsssf()
    {
        return $this->hasMany(NSSFPSSF::class, 'school_id');
    }

    //relationship with allowances table
    public function allowances()
    {
        return $this->hasMany(Allowances::class, 'school_id');
    }

    //relationship with deductions table
    public function deductions()
    {
        return $this->hasMany(Deductions::class, 'school_id');
    }

    //relationship with employee table
    public function employees()
    {
        return $this->hasMany(Employee::class, 'school_id');
    }

    //relationship with payroll configuration table
    public function payrollConfigurations()
    {
        return $this->hasMany(PayrollConfigurations::class, 'school_id');
    }

    //relationship with loan types table
    public function loanTypes()
    {
        return $this->hasMany(LoanTypes::class, 'school_id');
    }

    //relationship with loan configurations table
    public function loanConfigurations()
    {
        return $this->hasMany(LoanConfigurations::class, 'school_id');
    }

}
