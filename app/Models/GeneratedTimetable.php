<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedTimetable extends Model
{
    //protected fillables
    protected $fillable = [
        'class_id',
        'school_id',
        'subject_id',
        'teacher_id',
        'start_time',
        'end_time',
        'day_of_week',
    ];


    //relationships to link with other models

    //relationship with ClassAvailable model
    public function classAvailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }

    //relationship with School model
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with AvailableSubject model
    public function subject()
    {
        return $this->belongsTo(AvailableSubject::class, 'subject_id');
    }

    //relationship with Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    

}
