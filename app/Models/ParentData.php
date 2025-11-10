<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class ParentData extends Model
{
    protected $table = 'parent_data';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'rtnship',
        'phone',
        'street',
        'ward',
        'district',
        'city',
        'student_id',
    ];

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
