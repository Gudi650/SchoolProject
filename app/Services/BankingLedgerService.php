<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\BankAudit;
use App\Models\BankTransaction;
use Illuminate\Support\Facades\Auth;

class BankingLedgerService
{
    public function accountForMethod(int $schoolId, string $method): ?BankAccount
    {
        $kind = $method === 'cash' ? 'cash' : 'bank';

        return BankAccount::where('school_id', $schoolId)->where('kind', $kind)->orderBy('id')->first();
    }

    public function post(int $schoolId, BankAccount $account, string $type, float $amount, array $meta = []): BankTransaction
    {
        $txn = BankTransaction::create([
            'school_id' => $schoolId,
            'bank_account_id' => $account->id,
            'type' => $type,
            'amount' => $amount,
            'description' => $meta['description'] ?? null,
            'reference' => $meta['reference'] ?? null,
            'source' => $meta['source'] ?? 'manual',
            'source_id' => $meta['source_id'] ?? null,
            'occurred_at' => $meta['occurred_at'] ?? now(),
            'reconciled_at' => ! empty($meta['reference']) ? now() : null,
            'created_by' => Auth::id(),
        ]);

        BankAudit::create([
            'school_id' => $schoolId,
            'subject' => 'transaction',
            'subject_id' => $txn->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'changes' => ['after' => $txn->only(['type', 'amount', 'source'])],
        ]);

        return $txn;
    }

    public function postFromFee(int $schoolId, $payment): void
    {
        $account = $this->accountForMethod($schoolId, $payment->payment_method);
        if (! $account) {
            return;
        }
        if (BankTransaction::where('source', 'fee_payment')->where('source_id', $payment->id)->exists()) {
            return;
        }
        $this->post($schoolId, $account, 'credit', (float) $payment->amount, [
            'description' => 'Fee collection',
            'reference' => $payment->reference,
            'source' => 'fee_payment',
            'source_id' => $payment->id,
            'occurred_at' => $payment->paid_at,
        ]);
    }

    public function postFromExpense(int $schoolId, $expense): void
    {
        if (($expense->status ?? '') !== 'paid' || empty($expense->payment_method)) {
            return;
        }
        $account = $this->accountForMethod($schoolId, $expense->payment_method);
        if (! $account) {
            return;
        }
        if (BankTransaction::where('source', 'expense')->where('source_id', $expense->id)->exists()) {
            return;
        }
        $this->post($schoolId, $account, 'debit', (float) $expense->amount, [
            'description' => $expense->title ?: 'Expense',
            'reference' => $expense->reference,
            'source' => 'expense',
            'source_id' => $expense->id,
            'occurred_at' => $expense->expense_date,
        ]);
    }
}
