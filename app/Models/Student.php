<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'email',
        'date_of_birth',
        'gender',
        'class_id',
        'street',
        'ward',
        'city',
        'district',
        'school_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function parent_data()
    {
        return $this->hasOne(ParentData::class);
    }

    public function classAvailables()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with exam results
    public function examResults()
    {
        return $this->hasMany(ExamResults::class, 'student_id');
    }   

    //relationship with attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

}
