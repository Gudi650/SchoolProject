<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BankAudit;
use App\Models\BankTransaction;
use App\Services\AccountantContextService;
use App\Services\BankingLedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankingController extends Controller
{
    public function __construct(
        private AccountantContextService $accountantContext,
        private BankingLedgerService $ledger,
    ) {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $accounts = BankAccount::where('school_id', $schoolId)->orderBy('kind')->orderBy('name')->get();
        $accounts->each(fn ($a) => $a->computed_balance = $a->balance());

        $bankBalance = (float) $accounts->where('kind', 'bank')->sum('computed_balance');
        $cashBalance = (float) $accounts->where('kind', 'cash')->sum('computed_balance');
        $pendingRecon = BankTransaction::where('school_id', $schoolId)->whereNull('reconciled_at')->count();
        $todayDeposits = (float) BankTransaction::where('school_id', $schoolId)->where('type', 'credit')->whereDate('occurred_at', today())->sum('amount');
        $todayCount = (int) BankTransaction::where('school_id', $schoolId)->where('type', 'credit')->whereDate('occurred_at', today())->count();

        $txns = BankTransaction::with('account')->where('school_id', $schoolId)->latest('occurred_at')->limit(20)->get();
        $txns->each(fn ($t) => $t->running = $t->account?->balance());

        $cashIds = $accounts->where('kind', 'cash')->pluck('id');
        $cashBook = [];
        $running = $cashBalance;
        for ($i = 0; $i < 4; $i++) {
            $day = now()->subDays($i)->startOfDay();
            $in = $cashIds->isEmpty() ? 0 : (float) BankTransaction::whereIn('bank_account_id', $cashIds)->where('type', 'credit')->whereDate('occurred_at', $day)->sum('amount');
            $out = $cashIds->isEmpty() ? 0 : (float) BankTransaction::whereIn('bank_account_id', $cashIds)->where('type', 'debit')->whereDate('occurred_at', $day)->sum('amount');
            $opening = $running - $in + $out;
            $cashBook[] = [
                'date' => $day->copy(),
                'opening' => $opening,
                'in' => $in,
                'out' => $out,
                'closing' => $running,
            ];
            $running = $opening;
        }

        return view('AccountantPanel.bankingCash', [
            'accounts' => $accounts,
            'txns' => $txns,
            'cashBook' => $cashBook,
            'bankBalance' => $bankBalance,
            'cashBalance' => $cashBalance,
            'todayDeposits' => $todayDeposits,
            'todayCount' => $todayCount,
            'pendingRecon' => $pendingRecon,
        ]);
    }

    public function storeAccount(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'kind' => 'required|in:bank,cash',
            'account_type' => 'nullable|string|max:32',
            'account_number' => 'nullable|string|max:64',
            'opening_balance' => 'nullable|numeric|min:0',
        ]);

        $account = BankAccount::create([
            ...$data,
            'school_id' => $schoolId,
            'opening_balance' => $data['opening_balance'] ?? 0,
            'created_by' => Auth::id(),
        ]);

        BankAudit::create([
            'school_id' => $schoolId,
            'subject' => 'account',
            'subject_id' => $account->id,
            'user_id' => Auth::id(),
            'action' => 'created',
            'changes' => ['after' => $data],
        ]);

        return redirect()->route('accounting.bankingCashManagement')->with('success', 'Account added.');
    }

    public function storeTransaction(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:100',
            'occurred_at' => 'required|date',
        ]);

        $account = BankAccount::where('school_id', $schoolId)->findOrFail($data['bank_account_id']);
        $this->ledger->post($schoolId, $account, $data['type'], (float) $data['amount'], [
            'description' => $data['description'] ?? 'Manual',
            'reference' => $data['reference'] ?? null,
            'occurred_at' => $data['occurred_at'],
            'source' => 'manual',
        ]);

        return redirect()->route('accounting.bankingCashManagement')->with('success', 'Transaction added.');
    }

    public function reconcile(int $transaction)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $txn = BankTransaction::where('school_id', $schoolId)->findOrFail($transaction);
        $txn->update(['reconciled_at' => now()]);
        BankAudit::create([
            'school_id' => $schoolId,
            'subject' => 'transaction',
            'subject_id' => $txn->id,
            'user_id' => Auth::id(),
            'action' => 'reconciled',
        ]);

        return redirect()->route('accounting.bankingCashManagement')->with('success', 'Reconciled.');
    }
}
