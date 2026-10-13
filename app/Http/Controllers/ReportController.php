<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Expense;
use App\Models\FeePayment;
use App\Models\Invoice;
use App\Models\LoanApplication;
use App\Models\PayrollRun;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index(Request $request)
    {
        $data = $this->metrics($request);
        $schoolId = $data['schoolId'];
        $data['cashOnHand'] = BankAccount::where('school_id', $schoolId)->get()->sum(fn ($a) => $a->balance());
        $data['overdue'] = (float) Invoice::where('school_id', $schoolId)
            ->whereIn('status', ['sent', 'partial'])
            ->whereDate('due_date', '<', today())
            ->sum(DB::raw('total - paid_amount'));

        return view('AccountantPanel.reports.hub', $data);
    }

    public function profitLoss(Request $request)
    {
        return view('AccountantPanel.reports.profitLoss', $this->metrics($request));
    }

    public function cashFlow(Request $request)
    {
        return view('AccountantPanel.reports.cashFlow', $this->extra($this->metrics($request)));
    }

    public function trialBalance(Request $request)
    {
        return view('AccountantPanel.reports.trialBalance', $this->extra($this->metrics($request)));
    }

    public function balanceSheet(Request $request)
    {
        return view('AccountantPanel.reports.balanceSheet', $this->extra($this->metrics($request)));
    }

    private function extra(array $data): array
    {
        $schoolId = $data['schoolId'];
        $from = $data['from'];
        $to = $data['to'];
        $data['loansOut'] = (float) LoanApplication::where('school_id', $schoolId)
            ->whereNotNull('disbursed_at')
            ->whereBetween('disbursed_at', [$from, $to])
            ->sum('amount');
        $data['loansOutstanding'] = (float) LoanApplication::where('school_id', $schoolId)
            ->whereIn('status', ['disbursed', 'active'])
            ->get()
            ->sum(fn ($l) => max(0, (float) $l->total_repayment - (float) $l->total_paid));
        $data['expensesUnpaid'] = (float) Expense::where('school_id', $schoolId)->where('status', '!=', 'paid')->sum('amount');
        $data['invoicesOpen'] = (float) Invoice::where('school_id', $schoolId)
            ->whereIn('status', ['sent', 'partial'])
            ->sum(DB::raw('total - paid_amount'));
        $accounts = BankAccount::where('school_id', $schoolId)->orderBy('kind')->orderBy('name')->get();
        $data['accounts'] = $accounts->map(fn ($a) => [
            'name' => $a->name,
            'kind' => $a->kind,
            'balance' => $a->balance(),
        ]);
        $data['cashOnHand'] = (float) $data['accounts']->sum('balance');
        $data['cashNet'] = $data['cash'] - $data['loansOut'];
        $data['receivables'] = $data['invoicesOpen'];
        $data['assets'] = $data['cashOnHand'] + $data['invoicesOpen'];
        $data['liabilities'] = $data['expensesUnpaid'] + $data['loansOutstanding'];
        $data['equity'] = $data['assets'] - $data['liabilities'];
        $data['debitTotal'] = $data['payroll'] + $data['expensesAll'] + $data['loansOut'];
        $data['creditTotal'] = $data['fees'] + $data['invoiceOther'];

        return $data;
    }

    private function metrics(Request $request): array
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $from = $request->date('from')?->startOfDay() ?? now()->startOfMonth();
        $to = $request->date('to')?->endOfDay() ?? now()->endOfMonth();

        $fees = (float) FeePayment::where('school_id', $schoolId)->whereBetween('paid_at', [$from, $to])->sum('amount');
        $invoiceOther = Invoice::otherCredits($schoolId, $from, $to);
        $income = $fees + $invoiceOther;
        $expensesPaid = (float) Expense::where('school_id', $schoolId)->where('status', 'paid')->whereBetween('expense_date', [$from, $to])->sum('amount');
        $expensesAll = (float) Expense::where('school_id', $schoolId)->whereBetween('expense_date', [$from, $to])->sum('amount');
        $payroll = (float) PayrollRun::where('school_id', $schoolId)
            ->where('status', 'processed')
            ->whereBetween('created_at', [$from, $to])
            ->sum('net_salary');

        $byCategory = Expense::where('school_id', $schoolId)
            ->whereBetween('expense_date', [$from, $to])
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        $trend = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->subMonths($i)->startOfMonth();
            $end = now()->subMonths($i)->endOfMonth();
            $in = (float) FeePayment::where('school_id', $schoolId)->whereBetween('paid_at', [$start, $end])->sum('amount')
                + Invoice::otherCredits($schoolId, $start, $end);
            $out = (float) Expense::where('school_id', $schoolId)->where('status', 'paid')->whereBetween('expense_date', [$start, $end])->sum('amount')
                + (float) PayrollRun::where('school_id', $schoolId)->where('status', 'processed')->whereBetween('created_at', [$start, $end])->sum('net_salary');
            $trend[] = ['label' => $start->format('M Y'), 'in' => $in, 'out' => $out];
        }

        $out = $expensesPaid + $payroll;
        $surplus = $income - $expensesAll - $payroll;
        $cash = $income - $expensesPaid - $payroll;

        return compact(
            'schoolId', 'from', 'to', 'fees', 'invoiceOther', 'income',
            'expensesPaid', 'expensesAll', 'payroll', 'byCategory', 'trend',
            'out', 'surplus', 'cash'
        );
    }
}
