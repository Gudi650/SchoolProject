<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studentEnrollDetails extends Model
{
    //fillable fields
    protected $fillable = [
        'student_enrollment_id',
        'admission_date',
        'grade_applied_for',
        'previous_school_name',
        'academic_records',
        'transfer_certificate',
        'birth_certificate',
        'reports_card',
        'status',
    ];


    //relatiosnip with studentEnrollment
    public function studentEnrollment()
    {
        // foreign key is student_enrollment_id referencing student_enrollment_id column on student_enrollments
        return $this->belongsTo(studentEnrollment::class, 'student_enrollment_id', 'student_enrollment_id');
    }

}
