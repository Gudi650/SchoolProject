<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'email',
        'date_of_birth',
        'gender',
        'class',
        'street',
        'ward',
        'city',
        'district'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function parent_data()
    {
        return $this->hasOne(ParentData::class);
    }

}
