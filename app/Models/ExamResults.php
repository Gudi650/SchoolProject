<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResults extends Model
{
    //fillables
    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'school_id',
        'class_id',
        'TermName',
        'score',
        'remarks',
        'exam_date',
    ];

    //define relationships below

    //relationship to Student
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    //relationship to Subject
    public function availablesubject()
    {
        return $this->belongsTo(AvailableSubject::class, 'subject_id');
    }

    //relationship to Teacher
    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    //relationship to School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship to ClassAvailable
    public function classavailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }


}
