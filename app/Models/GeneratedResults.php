<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedResults extends Model
{
    //fillables
    protected $fillable = [
        'student_id',
        'class_id',
        'school_id',
        'exam_date',
        'total_score',
        'average_score',
        'rank',
    ];


    //relationships

    //relationship with student
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    //relationship with class
    public function classavailables()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }

    //relationship with school
    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

}
