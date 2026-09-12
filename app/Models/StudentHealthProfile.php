<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHealthProfile extends Model
{
    protected $fillable = [
        'student_id', 'blood_group', 'allergies', 'chronic_conditions',
        'medications', 'insurance_provider', 'insurance_number', 'emergency_notes',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
