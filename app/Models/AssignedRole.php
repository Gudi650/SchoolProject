<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedRole extends Model
{
    //fillable fields
    protected $fillable = [
        'teacher_id',
        'teacher_role_id',
        'class-available_id',
    ];


    //relationship with Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    //relationship with TeacherRole model
    public function teacherRole()
    {
        return $this->belongsTo(TeacherRole::class);
    }

    //relationship with ClassAvailable model
    public function classAvailable()
    {
        return $this->belongsTo(ClassAvailable::class);
    }
}
