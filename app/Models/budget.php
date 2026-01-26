<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class budget extends Model
{
    //
    //fillable fields
    protected $fillable = [
        'school_id',
        'budget_name',
        'start_date',
        'end_date',
        'total_amount',
        'description',
    ];

    //relationships 

    //relationship with school_id
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    //relationship with budget categories
    public function categories()
    {
        return $this->hasMany(budgetCategories::class, 'budget_id');
    }

}
