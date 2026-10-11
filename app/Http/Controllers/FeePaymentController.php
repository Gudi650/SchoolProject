<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\FeePayment;
use App\Models\Student;
use App\Services\AccountantContextService;
use App\Services\BankingLedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeePaymentController extends Controller
{
    public function __construct(
        private AccountantContextService $accountantContext,
        private BankingLedgerService $ledger,
    ) {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $monthStart = now()->startOfMonth();

        $payments = FeePayment::with('student')
            ->where('school_id', $schoolId)
            ->latest('paid_at')
            ->limit(50)
            ->get();

        $students = Student::where('school_id', $schoolId)
            ->orderBy('fname')
            ->orderBy('lname')
            ->get();

        $stats = [
            'monthTotal' => (float) FeePayment::where('school_id', $schoolId)->where('paid_at', '>=', $monthStart)->sum('amount'),
            'todayTotal' => (float) FeePayment::where('school_id', $schoolId)->whereDate('paid_at', today())->sum('amount'),
            'count' => FeePayment::where('school_id', $schoolId)->count(),
        ];

        $accounts = BankAccount::where('school_id', $schoolId)->orderBy('kind')->orderBy('name')->get();

        return view('AccountantPanel.fees.feeCollection', compact('schoolId', 'payments', 'students', 'stats', 'accounts'));
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,mobile,bank,cheque',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
            'paid_at' => 'required|date',
        ]);

        $kind = $this->ledger->kindForMethod($validated['payment_method']);
        $account = BankAccount::where('school_id', $schoolId)
            ->where('kind', $kind)
            ->where('id', $validated['bank_account_id'])
            ->first();

        if (! $account) {
            return back()->withErrors(['bank_account_id' => 'Select an account that matches this payment method.'])->withInput();
        }

        $student = Student::where('id', $validated['student_id'])->where('school_id', $schoolId)->firstOrFail();

        $payment = FeePayment::create([
            'school_id' => $schoolId,
            'student_id' => $student->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference' => $validated['reference'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'paid_at' => $validated['paid_at'],
            'recorded_by' => Auth::id(),
        ]);

        $this->ledger->postFromFee($schoolId, $payment, $account);

        return redirect()->route('accounting.feeCollection')->with('success', 'Payment recorded.');
    }
}
