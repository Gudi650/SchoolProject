<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankTransaction extends Model
{
    protected $fillable = [
        'school_id', 'bank_account_id', 'type', 'amount', 'description', 'reference',
        'source', 'source_id', 'occurred_at', 'reconciled_at', 'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'occurred_at' => 'datetime',
        'reconciled_at' => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
