<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //protected fillable fields
    protected $fillable = [
        'student_id',
        'class-available_id',
        'teacher_id',
        'school_id',
        'date',
        'status',
    ];

    //relationship with student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
