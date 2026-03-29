<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allowances extends Model
{
    protected $fillable = [
        'school_id',
        'housing_allowance',
        'transportation_allowance',
        'meal_allowance',
        'leave_travel_allowance',
        'medical_allowance',
        'other_allowances',
        'extra_time',
        'total_allowance',
    ];
}
