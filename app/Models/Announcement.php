<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //fillable properties
    protected $fillable = [
        'title',
        'content',
        'school_id',
        'created_by',
        'class-available_id',
        'teacher_roles_id',
        'subject_id',
        'attachements',
        'intended_audience',

    ];

    //relationship with Teacher
    public function teacher()
    {

        return $this->belongsTo(Teacher::class, 'created_by');

    }

    //relationship with School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with class-available
    public function classAvailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class-available_id');
    }

    //relationship with Subject
    public function subject()
    {
        return $this->belongsTo(AvailableSubject::class, 'subject_id');
    }

}