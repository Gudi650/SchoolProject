<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //function for fillable data in the teacher table
    protected $fillable = [
        'user_id',
        'school_id',
        'fname',
        'mname',
        'lname',
        'email',
        'phone',
        'gender',
        'subject_specialization',
        'qualification',
    ];

    //linking to the user model
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    //linking to the school model
    public function schools()
    {
        return $this->belongsTo(School::class);
    }

}
