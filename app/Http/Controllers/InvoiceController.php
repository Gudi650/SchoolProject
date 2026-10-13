<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\FeePayment;
use App\Models\FinanceCategory;
use App\Models\Invoice;
use App\Models\InvoiceAudit;
use App\Models\InvoiceItem;
use App\Models\Student;
use App\Services\AccountantContextService;
use App\Services\BankingLedgerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct(
        private AccountantContextService $accountantContext,
        private BankingLedgerService $ledger,
    ) {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoices = Invoice::with(['student', 'items'])
            ->where('school_id', $schoolId)
            ->latest()
            ->limit(50)
            ->get();
        $audits = InvoiceAudit::with('user')->where('school_id', $schoolId)->latest('created_at')->limit(20)->get();
        $accounts = BankAccount::where('school_id', $schoolId)->orderBy('kind')->orderBy('name')->get();

        $base = Invoice::where('school_id', $schoolId)->where('status', '!=', 'cancelled');
        $stats = [
            'count' => (clone $base)->count(),
            'paid' => (float) (clone $base)->where('status', 'paid')->sum('total'),
            'paidCount' => (clone $base)->where('status', 'paid')->count(),
            'pending' => (float) (clone $base)->whereIn('status', ['draft', 'sent', 'partial'])->sum(DB::raw('total - paid_amount')),
            'pendingCount' => (clone $base)->whereIn('status', ['draft', 'sent', 'partial'])->count(),
            'overdue' => (float) (clone $base)->whereIn('status', ['sent', 'partial'])->whereDate('due_date', '<', today())->sum(DB::raw('total - paid_amount')),
            'overdueCount' => (clone $base)->whereIn('status', ['sent', 'partial'])->whereDate('due_date', '<', today())->count(),
        ];

        return view('AccountantPanel.invoices.invoicing', compact('invoices', 'audits', 'stats', 'accounts'));
    }

    public function create()
    {
        return $this->formView();
    }

    public function edit(int $id)
    {
        return $this->formView($id);
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $this->validated($request, $schoolId);
        $totals = $this->totals($data['items']);

        $invoice = DB::transaction(function () use ($schoolId, $data, $totals) {
            $invoice = Invoice::create([
                ...$this->header($data, $schoolId),
                ...$totals,
                'invoice_number' => $this->nextNumber($schoolId),
                'paid_amount' => 0,
                'status' => 'draft',
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]);
            $this->syncItems($invoice, $data['items']);

            return $invoice;
        });

        $this->audit($schoolId, $invoice->id, 'created', ['after' => $invoice->only(['invoice_number', 'total', 'bill_to', 'customer_name'])]);

        return redirect()->route('accounting.invoiceManagement')->with('success', 'Invoice saved as draft.');
    }

    public function update(Request $request, int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoice = $this->owned($schoolId, $id);
        abort_unless($invoice->isEditable(), 403, 'Cannot edit a paid or cancelled invoice.');

        $data = $this->validated($request, $schoolId);
        $totals = $this->totals($data['items']);
        $before = $invoice->only(['total', 'bill_to', 'customer_name', 'due_date']);

        DB::transaction(function () use ($invoice, $data, $totals, $schoolId) {
            $invoice->update([...$this->header($data, $schoolId), ...$totals, 'updated_by' => Auth::id()]);
            InvoiceItem::where('invoice_id', $invoice->id)->delete();
            $this->syncItems($invoice, $data['items']);
        });

        $this->audit($schoolId, $invoice->id, 'updated', ['before' => $before, 'after' => $invoice->fresh()->only(['total', 'bill_to', 'customer_name', 'due_date'])]);

        return redirect()->route('accounting.invoiceManagement')->with('success', 'Invoice updated.');
    }

    public function destroy(int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoice = $this->owned($schoolId, $id);
        abort_unless($invoice->isEditable(), 403, 'Cannot delete a paid invoice.');
        $this->audit($schoolId, $invoice->id, 'deleted', ['before' => $invoice->only(['invoice_number', 'total'])]);
        $invoice->delete();

        return redirect()->route('accounting.invoiceManagement')->with('success', 'Invoice deleted.');
    }

    public function send(int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoice = $this->owned($schoolId, $id);
        abort_unless($invoice->status === 'draft', 403);
        $invoice->update(['status' => 'sent', 'updated_by' => Auth::id()]);
        $this->audit($schoolId, $invoice->id, 'sent', ['after' => ['status' => 'sent']]);

        return back()->with('success', 'Invoice marked sent.');
    }

    public function pay(Request $request, int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoice = $this->owned($schoolId, $id);
        abort_if($invoice->status === 'cancelled' || $invoice->remaining() <= 0, 403);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,mobile,bank,cheque',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'reference' => 'nullable|string|max:100',
            'paid_at' => 'required|date',
        ]);
        abort_if($validated['amount'] - $invoice->remaining() > 0.009, 422, 'Amount exceeds remaining balance.');

        $kind = $this->ledger->kindForMethod($validated['payment_method']);
        $account = BankAccount::where('school_id', $schoolId)->where('kind', $kind)->where('id', $validated['bank_account_id'])->first();
        if (! $account) {
            return back()->withErrors(['bank_account_id' => 'Select an account that matches this payment method.']);
        }

        if ($invoice->student_id) {
            $payment = FeePayment::create([
                'school_id' => $schoolId,
                'student_id' => $invoice->student_id,
                'invoice_id' => $invoice->id,
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'reference' => $validated['reference'] ?? $invoice->invoice_number,
                'notes' => 'Invoice '.$invoice->invoice_number,
                'paid_at' => $validated['paid_at'],
                'recorded_by' => Auth::id(),
            ]);
            $this->ledger->postFromFee($schoolId, $payment, $account);
        } else {
            $this->ledger->post($schoolId, $account, 'credit', (float) $validated['amount'], [
                'description' => 'Invoice '.$invoice->invoice_number,
                'reference' => $validated['reference'] ?? $invoice->invoice_number,
                'source' => 'invoice',
                'source_id' => $invoice->id,
                'occurred_at' => $validated['paid_at'],
            ]);
        }

        $paid = (float) $invoice->paid_amount + (float) $validated['amount'];
        $status = $paid + 0.009 >= (float) $invoice->total ? 'paid' : 'partial';
        $invoice->update([
            'paid_amount' => $paid,
            'status' => $status,
            'paid_at' => $status === 'paid' ? $validated['paid_at'] : $invoice->paid_at,
            'updated_by' => Auth::id(),
        ]);
        $this->audit($schoolId, $invoice->id, 'paid', ['amount' => $validated['amount'], 'status' => $status]);

        return redirect()->route('accounting.invoiceManagement')->with('success', 'Payment recorded.');
    }

    public function print(int $id)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $invoice = $this->owned($schoolId, $id)->load(['student', 'items']);

        return view('AccountantPanel.invoices.print', compact('invoice'));
    }

    private function formView(?int $id = null)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $students = Student::where('school_id', $schoolId)->orderBy('fname')->orderBy('lname')->get();
        $invoice = $id ? $this->owned($schoolId, $id)->load('items') : null;
        abort_if($invoice && ! $invoice->isEditable(), 403);
        $preset = request('preset');
        $categories = FinanceCategory::namesFor($schoolId);

        return view('AccountantPanel.invoices.createinvoices', compact('students', 'invoice', 'preset', 'categories'));
    }

    private function owned(int $schoolId, int $id): Invoice
    {
        return Invoice::where('school_id', $schoolId)->findOrFail($id);
    }

    private function validated(Request $request, int $schoolId): array
    {
        $data = $request->validate([
            'bill_to' => 'required|in:student,other',
            'student_id' => 'nullable|required_if:bill_to,student|exists:students,id',
            'customer_name' => 'nullable|required_if:bill_to,other|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:32',
            'billing_address' => 'nullable|string|max:500',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'payment_terms' => 'nullable|string|max:32',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
            'terms' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:120',
            'items.*.category' => 'nullable|string|max:64',
            'items.*.description' => 'nullable|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.rate' => 'required|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
        ]);
        if ($data['bill_to'] === 'student') {
            Student::where('school_id', $schoolId)->findOrFail($data['student_id']);
        }

        return $data;
    }

    private function header(array $data, int $schoolId): array
    {
        $name = $data['customer_name'] ?? null;
        if (($data['bill_to'] ?? '') === 'student') {
            $student = Student::find($data['student_id']);
            $name = $name ?: trim(($student->fname ?? '').' '.($student->lname ?? ''));
        }

        return [
            'school_id' => $schoolId,
            'bill_to' => $data['bill_to'],
            'student_id' => $data['bill_to'] === 'student' ? $data['student_id'] : null,
            'customer_name' => $name,
            'customer_email' => $data['customer_email'] ?? null,
            'customer_phone' => $data['customer_phone'] ?? null,
            'billing_address' => $data['billing_address'] ?? null,
            'issue_date' => $data['issue_date'],
            'due_date' => $data['due_date'],
            'payment_terms' => $data['payment_terms'] ?? null,
            'reference' => $data['reference'] ?? null,
            'notes' => $data['notes'] ?? null,
            'terms' => $data['terms'] ?? null,
        ];
    }

    private function totals(array $items): array
    {
        $subtotal = $tax = $discount = 0;
        foreach ($items as $item) {
            $line = $this->line($item);
            $base = $line['quantity'] * $line['rate'];
            $subtotal += $base;
            $tax += $base * $line['tax_percent'] / 100;
            $discount += $line['discount'];
        }

        return [
            'subtotal' => round($subtotal, 2),
            'tax_total' => round($tax, 2),
            'discount_total' => round($discount, 2),
            'total' => round(max(0, $subtotal + $tax - $discount), 2),
        ];
    }

    private function line(array $item): array
    {
        $qty = (float) $item['quantity'];
        $rate = (float) $item['rate'];
        $tax = (float) ($item['tax'] ?? 0);
        $discount = (float) ($item['discount'] ?? 0);
        $amount = max(0, $qty * $rate * (1 + $tax / 100) - $discount);

        return [
            'name' => $item['name'],
            'category' => trim((string) ($item['category'] ?? '')) ?: null,
            'description' => $item['description'] ?? null,
            'quantity' => $qty,
            'rate' => $rate,
            'tax_percent' => $tax,
            'discount' => $discount,
            'amount' => round($amount, 2),
        ];
    }

    private function syncItems(Invoice $invoice, array $items): void
    {
        foreach ($items as $item) {
            $line = $this->line($item);
            if ($line['category']) {
                FinanceCategory::remember((int) $invoice->school_id, $line['category']);
            }
            $invoice->items()->create($line);
        }
    }

    private function nextNumber(int $schoolId): string
    {
        $year = now()->year;
        $n = Invoice::where('school_id', $schoolId)->whereYear('created_at', $year)->count() + 1;

        return sprintf('INV-%d-%04d', $year, $n);
    }

    private function audit(int $schoolId, ?int $invoiceId, string $action, array $changes): void
    {
        InvoiceAudit::create([
            'school_id' => $schoolId,
            'invoice_id' => $invoiceId,
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }
}
