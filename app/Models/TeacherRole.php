<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherRole extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherRoleFactory> */
    use HasFactory;

    //protectd filables fields
    protected $fillable = [
        'name',
    ];


    //define the relationship with the AssignedRole model
    public function assignedRoles()
    {
        return $this->hasMany(AssignedRole::class, 'teacher_role_id');
    }
}
