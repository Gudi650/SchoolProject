<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studentEnrollment extends Model
{
    //fillable fields
    protected $fillable = [
        'student_enrollment_id',
        'previous_school',
        'fname',
        'lname',
        'mname',
        'gender',
        'date_of_birth',
        'school_id',
        'student_profile_picture',
        'parent_enrollment_id',
        'status',
    ]; 
}
