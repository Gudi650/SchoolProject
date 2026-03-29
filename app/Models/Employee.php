<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'school_id',
        'employee_id',
        'full_name',
        'email',
        'phone',
        'employee_type',
        'position',
    ];
}
