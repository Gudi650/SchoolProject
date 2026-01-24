<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class budgetDepartment extends Model
{
    //fillable fields
    protected $fillable = [
        'department_name',
        'description',
        'school_id',
    ];
}
