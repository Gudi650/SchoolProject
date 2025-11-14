<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedSubject extends Model
{


    //explicit table name because the DB table uses a hyphen
    protected $table = 'assigned-subjects';

    //fiillable fields
    protected $fillable = [
        'availablesubject_id',
        'class_id',
        'teacher_id',
        'school_id',
    ];

    //placing relationships
    //relationship with the available subjects
    public function availablesubject()
    {
        return $this->belongsTo(availablesubject::class, 'availablesubject_id');
    }

    //relationship with the classes
    public function classAvailable()
    {
        return $this->belongsTo(ClassAvailable::class, 'class_id');
    }

    //rtnship with teacher table
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    //

}
