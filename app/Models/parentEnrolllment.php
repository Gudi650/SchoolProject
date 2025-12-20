<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class parentEnrolllment extends Model
{
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
}
