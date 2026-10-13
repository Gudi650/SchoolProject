<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'school_id', 'bill_to', 'student_id', 'customer_name', 'customer_email', 'customer_phone',
        'billing_address', 'invoice_number', 'issue_date', 'due_date',
        'payment_terms', 'reference', 'notes', 'terms', 'subtotal', 'tax_total',
        'discount_total', 'total', 'paid_amount', 'status', 'paid_at', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'subtotal' => 'float',
        'tax_total' => 'float',
        'discount_total' => 'float',
        'total' => 'float',
        'paid_amount' => 'float',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function remaining(): float
    {
        return max(0, (float) $this->total - (float) $this->paid_amount);
    }

    public function partyName(): string
    {
        if ($this->bill_to === 'student' && $this->student) {
            return trim($this->student->fname.' '.$this->student->lname);
        }

        return $this->customer_name ?: '—';
    }

    public static function otherCredits(int $schoolId, $from = null, $to = null): float
    {
        $q = BankTransaction::query()
            ->where('school_id', $schoolId)
            ->where('source', 'invoice')
            ->where('type', 'credit');
        if ($from && $to) {
            $q->whereBetween('occurred_at', [$from, $to]);
        } elseif ($from) {
            $q->where('occurred_at', '>=', $from);
        }

        return (float) $q->sum('amount');
    }

    public function displayStatus(): string
    {
        if (in_array($this->status, ['sent', 'partial'], true) && $this->due_date && $this->due_date->lt(today())) {
            return 'overdue';
        }

        return $this->status;
    }

    public function isEditable(): bool
    {
        return (float) $this->paid_amount <= 0 && $this->status !== 'cancelled';
    }
}
