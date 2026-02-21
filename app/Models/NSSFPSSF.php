<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NSSFPSSF extends Model
{
    //make the model use the correct table name
    protected $table = 'nssf_pssfs';

    //fillable attributes
    protected $fillable = [
        'nssf_contribution',
        'psssf_contribution',
        'school_id',
        'contribution_type',
        'school_contribution'
    ];

    //relationship with school model (many-to-one)
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
