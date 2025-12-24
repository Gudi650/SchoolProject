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

    //relationship with parentEnrollment
    public function parentEnrollment()
    {
        return $this->belongsTo(parentEnrolllment::class, 'parent_enrollment_id');
    }

    //relationship with studentEnrollDetails
    public function studentEnrollDetails()
    {
        // local key is student_enrollment_id, not the primary id
        return $this->hasOne(studentEnrollDetails::class, 'student_enrollment_id', 'student_enrollment_id');
    }

    //relationship with School
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

}
