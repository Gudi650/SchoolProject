<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassFeeOptions extends Model
{
    //fillable fields
    protected $fillable = [
        'class_id',
        'fee_options_id',
    ];
}
