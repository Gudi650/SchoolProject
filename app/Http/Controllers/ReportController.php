<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\FeePayment;
use App\Models\Invoice;
use App\Models\PayrollRun;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index(Request $request)
    {
        return $this->show($request, 'hub');
    }

    public function profitLoss(Request $request)
    {
        return $this->show($request, 'pl');
    }

    public function cashFlow(Request $request)
    {
        return $this->show($request, 'cash');
    }

    public function trialBalance(Request $request)
    {
        return $this->show($request, 'trial');
    }

    public function balanceSheet(Request $request)
    {
        return $this->show($request, 'balance');
    }

    private function show(Request $request, string $type)
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

        $data = compact('type', 'from', 'to', 'fees', 'invoiceOther', 'income', 'expensesPaid', 'expensesAll', 'payroll', 'byCategory', 'trend');
        $data['out'] = $expensesPaid + $payroll;
        $data['surplus'] = $income - $expensesAll - $payroll;
        $data['cash'] = $income - $expensesPaid - $payroll;

        return view('AccountantPanel.reports.report', $data);
    }
}
