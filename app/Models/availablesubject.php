<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class availablesubject extends Model
{

    //make it use the HasFactory trait
    use HasFactory;

    //fillable fields
    protected $fillable = [
        'name',
        'school_id',
    ];





    //placing relationships
    //relationship with the schools
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with assigned subjects
    public function assignedSubjects()
    {
        return $this->hasMany(AssignedSubject::class, 'availablesubject_id');
    }

}
