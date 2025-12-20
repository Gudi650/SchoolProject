<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class parentEnrolllment extends Model
{

    //name of the table
    protected $table = 'parent_enrollments';

    //fillable fields
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'gender',
        'relationship',
        'phone',
        'email',
        'city',
        'district',
        'ward',
        'street',
    ];


    //relationship with studentEnrollment
    public function studentEnrollments()
    {
        return $this->hasMany(studentEnrollment::class, 'parent_enrollment_id');
    }

}
