<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAvailable extends Model
{
    use HasFactory;
    
    //explicit table name because the DB table uses a hyphen
    protected $table = 'class-availables';

    //fillable
    protected $fillable = [
        'name', 
        'school_id'
    ];

    //relationship with school model (many-to-many)
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with AssignedRole model (one-to-many)
    public function assignedRoles()
    {
        return $this->hasMany(AssignedRole::class, 'class-available_id');
    }

    //relationship with Student model (one-to-many)
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    //relationship with ExamResults model (one-to-many)
    public function examResults()
    {
        return $this->hasMany(ExamResults::class, 'class_id');  
    }

    //relationship with FeeStructure model (one-to-many)
    public function feeStructures()
    {
        return $this->hasMany(FeeStructure::class, 'class_id');
    }

    //relationship with ClassFeePivot model (one-to-many)
    public function classFeePivots()
    {
        return $this->hasMany(ClassFeePivot::class, 'class_id');
    }



}
