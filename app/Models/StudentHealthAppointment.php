<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHealthAppointment extends Model
{
    protected $fillable = [
        'student_id', 'provider_name', 'appointment_date', 'reason', 'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
