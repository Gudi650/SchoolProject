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

}
