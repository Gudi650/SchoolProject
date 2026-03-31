<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    // Fillable fields (should match your migration)
    protected $fillable = [
        'school_id',
        'name',
        'max_amount',
        'interest_rate',
        'duration_months',
        'status',
    ];

    // Relationship: LoanType belongs to School
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
