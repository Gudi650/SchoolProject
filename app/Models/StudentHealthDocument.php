<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHealthDocument extends Model
{
    protected $fillable = [
        'student_id', 'title', 'record_type', 'record_date', 'file_path',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
