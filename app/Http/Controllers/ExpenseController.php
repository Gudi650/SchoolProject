<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseAudit;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private const CATEGORIES = ['utilities', 'salaries', 'maintenance', 'supplies', 'other'];
    private const STATUSES = ['paid', 'pending'];
    private const METHODS = ['cash', 'mobile', 'bank', 'cheque'];

    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $monthStart = now()->startOfMonth();

        $expenses = Expense::with(['creator', 'updater'])
            ->where('school_id', $schoolId)
            ->latest('expense_date')
            ->limit(50)
            ->get();

        $audits = ExpenseAudit::with('user')
            ->where('school_id', $schoolId)
            ->latest('created_at')
            ->limit(20)
            ->get();

        $monthTotal = (float) Expense::where('school_id', $schoolId)
            ->where('expense_date', '>=', $monthStart)
            ->sum('amount');

        $editExpense = request('edit')
            ? Expense::where('school_id', $schoolId)->find(request('edit'))
            : null;

        return view('AccountantPanel.expenses', compact(
            'expenses', 'audits', 'monthTotal', 'editExpense'
        ));
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $this->validated($request);

        $expense = Expense::create([
            ...$data,
            'school_id' => $schoolId,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $this->audit($schoolId, $expense->id, 'created', ['after' => $expense->only(array_keys($data))]);

        return redirect()->route('accounting.expensesManagement')->with('success', 'Expense recorded.');
    }

    public function update(Request $request, int $expense)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $row = Expense::where('school_id', $schoolId)->findOrFail($expense);
        $data = $this->validated($request);
        $before = $row->only(array_keys($data));

        $row->fill([...$data, 'updated_by' => Auth::id()]);
        $row->save();

        $this->audit($schoolId, $row->id, 'updated', ['before' => $before, 'after' => $data]);

        return redirect()->route('accounting.expensesManagement')->with('success', 'Expense updated.');
    }

    public function destroy(int $expense)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $row = Expense::where('school_id', $schoolId)->findOrFail($expense);
        $snapshot = $row->toArray();

        $this->audit($schoolId, $row->id, 'deleted', ['before' => $snapshot]);
        $row->delete();

        return redirect()->route('accounting.expensesManagement')->with('success', 'Expense deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category' => 'required|in:' . implode(',', self::CATEGORIES),
            'vendor' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:' . implode(',', self::STATUSES),
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|in:' . implode(',', self::METHODS),
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);
    }

    private function audit(int $schoolId, ?int $expenseId, string $action, array $changes): void
    {
        ExpenseAudit::create([
            'school_id' => $schoolId,
            'expense_id' => $expenseId,
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }
}
