<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class budgetCategories extends Model
{
    //
    //fillable fields
    protected $fillable = [
        'budget_id',
        'department_id',
        'expense_type',
        'amount',
    ];

    //relationships

    //relationship with budget
    public function budget()
    {
        return $this->belongsTo(budget::class, 'budget_id');
    }

}
