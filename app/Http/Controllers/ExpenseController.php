<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseAudit;
use App\Models\FinanceCategory;
use App\Models\Vendor;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private const STATUSES = ['paid', 'pending'];
    private const METHODS = ['cash', 'mobile', 'bank', 'cheque'];

    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $monthStart = now()->startOfMonth();

        $expenses = Expense::with(['creator', 'vendorRecord'])
            ->where('school_id', $schoolId)
            ->latest('expense_date')
            ->limit(50)
            ->get();

        $vendors = Vendor::where('school_id', $schoolId)->where('status', 'active')->orderBy('name')->get();
        $categories = FinanceCategory::namesFor($schoolId);

        $audits = ExpenseAudit::with('user')
            ->where('school_id', $schoolId)
            ->latest('created_at')
            ->limit(20)
            ->get();

        $base = Expense::where('school_id', $schoolId);
        $stats = [
            'monthTotal' => (float) (clone $base)->where('expense_date', '>=', $monthStart)->sum('amount'),
            'pending' => (float) (clone $base)->where('status', 'pending')->sum('amount'),
            'pendingCount' => (clone $base)->where('status', 'pending')->count(),
            'count' => (clone $base)->count(),
        ];

        return view('AccountantPanel.expenses', compact('expenses', 'audits', 'stats', 'vendors', 'categories'));
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $this->validated($request, $schoolId);

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
        $data = $this->validated($request, $schoolId);
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

    private function validated(Request $request, int $schoolId): array
    {
        $data = $request->validate([
            'category' => 'required|string|max:64',
            'vendor_id' => 'nullable|exists:vendors,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:' . implode(',', self::STATUSES),
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|in:' . implode(',', self::METHODS),
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ]);

        if (!empty($data['vendor_id'])) {
            $vendor = Vendor::where('school_id', $schoolId)->where('id', $data['vendor_id'])->firstOrFail();
            $data['vendor'] = $vendor->name;
            if (trim((string) $vendor->category) !== '') {
                $data['category'] = $vendor->category;
            }
        } else {
            $data['vendor_id'] = null;
            $data['vendor'] = null;
        }

        $data['category'] = FinanceCategory::remember($schoolId, $data['category']);

        return $data;
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
