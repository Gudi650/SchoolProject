<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccount extends Model
{
    protected $fillable = [
        'school_id', 'name', 'kind', 'account_type', 'account_number', 'opening_balance', 'created_by',
    ];

    protected $casts = ['opening_balance' => 'decimal:2'];

    public function transactions(): HasMany
    {
        return $this->hasMany(BankTransaction::class);
    }

    public function balance(): float
    {
        $credits = (float) $this->transactions()->where('type', 'credit')->sum('amount');
        $debits = (float) $this->transactions()->where('type', 'debit')->sum('amount');

        return (float) $this->opening_balance + $credits - $debits;
    }
}
