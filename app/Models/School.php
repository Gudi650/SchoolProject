<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;

    //creating the fillable data for the school table
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'city',
        'country',
    ];

}
