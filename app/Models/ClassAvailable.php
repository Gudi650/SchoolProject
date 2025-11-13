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
        return $this->belongsTo(School::class);
    }

    //relationship with AssignedRole model (one-to-many)
    public function assignedRoles()
    {
        return $this->hasMany(AssignedRole::class, 'class-available_id');
    }

}
