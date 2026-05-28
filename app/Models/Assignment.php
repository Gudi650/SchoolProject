<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'school_id',
        'teacher_id',
        'class-available_id',
        'subject_id',
        'attachment',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function classAvailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class-available_id');
    }

    public function subject()
    {
        return $this->belongsTo(availablesubject::class, 'subject_id');
    }
}
