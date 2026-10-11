<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAudit extends Model
{
    public $timestamps = false;

    protected $fillable = ['school_id', 'subject', 'subject_id', 'user_id', 'action', 'changes'];

    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];
}
