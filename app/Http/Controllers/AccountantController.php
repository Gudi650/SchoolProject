<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Expense;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\LoanApplication;
use App\Models\PayrollConfigurations;
use App\Models\PayrollRun;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\budget;
use App\Models\BudgetAudit;
use App\Models\studentEnrollDetails;
use App\Services\AccountantContextService;
use Illuminate\Support\Facades\Auth;
class AccountantController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function dashboard()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();

        if (!$schoolId) {
            return view('AccountantPanel.dashboard', ['schoolId' => null, 'stats' => [], 'recentActivity' => collect(), 'payrollTrend' => []]);
        }

        $monthStart = now()->startOfMonth();

        $payrollThisMonth = PayrollRun::where('school_id', $schoolId)
            ->where('status', 'processed')
            ->where(function ($q) use ($monthStart) {
                $q->where('paid_at', '>=', $monthStart)
                    ->orWhere(fn ($q2) => $q2->whereNull('paid_at')->where('created_at', '>=', $monthStart));
            })
            ->get();

        $latestBudget = budget::where('school_id', $schoolId)->latest()->first();
        $budgetTotal = (float) ($latestBudget?->total_amount ?? 0);
        $budgetAllocated = $latestBudget
            ? (float) $latestBudget->categories()->sum('amount')
            : 0;

        $stats = [
            'students' => Student::where('school_id', $schoolId)->count(),
            'teachers' => Teacher::where('school_id', $schoolId)->count(),
            'feeStructures' => FeeStructure::where('school_id', $schoolId)->count(),
            'pendingLoans' => LoanApplication::where('school_id', $schoolId)->whereIn('status', ['pending', 'under_review'])->count(),
            'approvedLoans' => LoanApplication::where('school_id', $schoolId)->where('status', 'approved')->count(),
            'payrollRunsMonth' => $payrollThisMonth->count(),
            'payrollNetMonth' => (float) $payrollThisMonth->sum('net_salary'),
            'pendingEnrollments' => studentEnrollDetails::where('status', 'pending')
                ->whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))
                ->count(),
            'budgetTotal' => $budgetTotal,
            'budgetAllocated' => $budgetAllocated,
            'payrollEmployees' => PayrollConfigurations::where('school_id', $schoolId)->count(),
            'loansDisbursedMonth' => LoanApplication::where('school_id', $schoolId)->where('status', 'disbursed')->where('disbursed_at', '>=', $monthStart)->count(),
            'rejectedLoans' => LoanApplication::where('school_id', $schoolId)->where('status', 'rejected')->count(),
            'feeConfiguredTotal' => (float) FeeStructure::where('school_id', $schoolId)->get()->sum(fn ($f) => (float) $f->tuition_fee + (float) $f->transport_fee + (float) $f->hostel_fee + (float) $f->library_fee + (float) $f->exam_fee),
            'collectedMonth' => (float) FeePayment::where('school_id', $schoolId)->where('paid_at', '>=', $monthStart)->sum('amount'),
            'collectedToday' => (float) FeePayment::where('school_id', $schoolId)->whereDate('paid_at', today())->sum('amount'),
        ];

        $payrollTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->subMonths($i)->startOfMonth();
            $end = now()->subMonths($i)->endOfMonth();
            $payrollTrend[] = [
                'label' => $start->format('M Y'),
                'total' => (float) PayrollRun::where('school_id', $schoolId)
                    ->whereBetween('created_at', [$start, $end])
                    ->sum('net_salary'),
            ];
        }

        $recentPayrolls = PayrollRun::where('school_id', $schoolId)->latest()->limit(5)->get();
        $recentLoans = LoanApplication::where('school_id', $schoolId)->latest()->limit(5)->get();

        $recentActivity = collect()
            ->merge($recentPayrolls->map(fn ($r) => [
                'type' => 'payroll',
                'title' => 'Payroll — ' . ($r->pay_period_label ?? 'Run'),
                'meta' => ucfirst($r->status) . ' · ' . $r->created_at->diffForHumans(),
                'amount' => (float) $r->net_salary,
                'at' => $r->created_at,
            ]))
            ->merge($recentLoans->map(fn ($l) => [
                'type' => 'loan',
                'title' => 'Loan ' . ($l->loan_reference ?? '#' . $l->id),
                'meta' => ucfirst(str_replace('_', ' ', (string) $l->status)) . ' · ' . $l->created_at->diffForHumans(),
                'amount' => (float) $l->amount,
                'at' => $l->created_at,
            ]))
            ->sortByDesc('at')
            ->take(6)
            ->values();

        $school = School::find($schoolId);
        $user = Auth::user();
        $alerts = array_values(array_filter([
            ($stats['pendingLoans'] ?? 0) > 0 ? ['text' => $stats['pendingLoans'] . ' loan(s) need review', 'url' => route('accounting.proposalManagement')] : null,
            ($stats['approvedLoans'] ?? 0) > 0 ? ['text' => $stats['approvedLoans'] . ' loan(s) ready to disburse', 'url' => route('accounting.loanDisbursements')] : null,
            ($stats['pendingEnrollments'] ?? 0) > 0 ? ['text' => $stats['pendingEnrollments'] . ' enrollment pending', 'url' => route('accounting.enrollmentIncome')] : null,
            $budgetTotal <= 0 ? ['text' => 'No budget set', 'url' => route('accounting.createBudget')] : null,
        ]));

        return view('AccountantPanel.dashboard', compact('schoolId', 'stats', 'payrollTrend', 'recentActivity', 'school', 'user', 'alerts', 'latestBudget'));
    }

    public function feeManagement()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();
        $structures = $schoolId
            ? FeeStructure::with('classes')->where('school_id', $schoolId)->latest()->get()
            : collect();

        $rows = $structures->map(function (FeeStructure $structure) {
            $standard = (float) $structure->tuition_fee
                + (float) $structure->transport_fee
                + (float) $structure->hostel_fee
                + (float) $structure->library_fee
                + (float) $structure->exam_fee;
            $custom = collect($structure->dynamic_attributes['all_components'] ?? [])
                ->sum(fn ($component) => (float) ($component['amount'] ?? 0));

            return [
                'scope' => $structure->for === 'specific' ? 'Specific classes' : 'General',
                'classes' => $structure->classes->pluck('name')->filter()->implode(', ') ?: '—',
                'tuition' => (float) $structure->tuition_fee,
                'other' => (float) $structure->transport_fee + (float) $structure->hostel_fee + (float) $structure->library_fee + (float) $structure->exam_fee + $custom,
                'total' => $standard + $custom,
                'currency' => $structure->currency,
            ];
        });

        $stats = [
            'count' => $rows->count(),
            'general' => $rows->where('scope', 'General')->count(),
            'specific' => $rows->where('scope', 'Specific classes')->count(),
            'configuredTotal' => (float) $rows->sum('total'),
        ];

        return view('AccountantPanel.feeManagement', compact('schoolId', 'rows', 'stats'));
    }

    public function payrollHub()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();
        $monthStart = now()->startOfMonth();

        $configs = $schoolId
            ? PayrollConfigurations::with(['employee', 'teachers'])->where('school_id', $schoolId)->get()
            : collect();

        $runs = $schoolId
            ? PayrollRun::with(['payrollConfiguration.employee', 'payrollConfiguration.teachers'])
                ->where('school_id', $schoolId)
                ->latest()
                ->limit(25)
                ->get()
            : collect();

        $monthRuns = $schoolId
            ? PayrollRun::where('school_id', $schoolId)
                ->where(function ($q) use ($monthStart) {
                    $q->where('paid_at', '>=', $monthStart)
                        ->orWhere(fn ($q2) => $q2->whereNull('paid_at')->where('created_at', '>=', $monthStart));
                })
                ->get()
            : collect();

        $processed = $monthRuns->whereIn('status', ['processed', 'paid']);

        $stats = [
            'employees' => $configs->count(),
            'configuredNet' => (float) $configs->sum('net_salary'),
            'configuredGross' => (float) $configs->sum('gross_salary'),
            'monthRuns' => $monthRuns->count(),
            'monthNet' => (float) $processed->sum('net_salary'),
            'processedCount' => $processed->count(),
            'draftCount' => $monthRuns->where('status', 'draft')->count(),
            'loanDeductions' => (float) $processed->sum('loan_deductions_total'),
            'paye' => (float) $processed->sum('paye_amount'),
            'nssf' => (float) $processed->sum('nssf_amount'),
            'psssf' => (float) $processed->sum('psssf_amount'),
        ];
        $stats['pension'] = $stats['nssf'] + $stats['psssf'];
        $stats['statutoryDue'] = $stats['paye'] + $stats['pension'];

        $accounts = $schoolId
            ? BankAccount::where('school_id', $schoolId)->orderBy('kind')->orderBy('name')->get()
            : collect();
        $needsBank = $configs->contains(fn ($c) => ($c->payment_method ?? 'bank') !== 'cash');
        $needsCash = $configs->contains(fn ($c) => ($c->payment_method ?? '') === 'cash');

        return view('AccountantPanel.payrolls.payroll', compact('schoolId', 'configs', 'runs', 'stats', 'accounts', 'needsBank', 'needsCash'));
    }

    public function loansHub()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();

        $loans = $schoolId
            ? LoanApplication::with(['user', 'loanType'])->where('school_id', $schoolId)->latest()->get()
            : collect();

        $active = $loans->whereIn('status', ['disbursed', 'active']);
        $counts = [
            'total' => $loans->count(),
            'pending' => $loans->where('status', 'pending')->count(),
            'under_review' => $loans->where('status', 'under_review')->count(),
            'approved' => $loans->where('status', 'approved')->count(),
            'rejected' => $loans->where('status', 'rejected')->count(),
            'disbursed' => $loans->whereIn('status', ['disbursed', 'active', 'completed'])->count(),
        ];

        $stats = [
            'portfolio' => (float) $active->sum('amount'),
            'activeCount' => $active->count(),
            'repaid' => (float) $active->sum('total_paid'),
            'outstanding' => (float) $active->sum(fn ($loan) => max(0, (float) $loan->total_repayment - (float) $loan->total_paid)),
            'awaitingAmount' => (float) $loans->whereIn('status', ['pending', 'under_review'])->sum('amount'),
            'approvedAmount' => (float) $loans->where('status', 'approved')->sum('amount'),
        ];

        return view('AccountantPanel.Loans.dashboard', [
            'schoolId' => $schoolId,
            'loans' => $loans->take(20),
            'counts' => $counts,
            'stats' => $stats,
        ]);
    }

    public function budgetHub()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();

        $budgets = $schoolId
            ? budget::with(['categories.department'])->where('school_id', $schoolId)->latest()->get()
            : collect();

        $latest = $budgets->first();
        $allocated = $latest ? (float) $latest->categories->sum('amount') : 0;
        $total = (float) ($latest?->total_amount ?? 0);

        $spentByCategory = collect();
        $payrollSpent = 0.0;
        if ($schoolId && $latest?->start_date && $latest?->end_date) {
            $from = $latest->start_date;
            $to = $latest->end_date;
            $spentByCategory = Expense::where('school_id', $schoolId)
                ->where('status', 'paid')
                ->whereBetween('expense_date', [$from, $to])
                ->selectRaw('LOWER(category) as cat, SUM(amount) as total')
                ->groupByRaw('LOWER(category)')
                ->pluck('total', 'cat');
            $payrollSpent = (float) PayrollRun::where('school_id', $schoolId)
                ->whereIn('status', ['processed', 'paid'])
                ->whereDate('pay_period_start', '>=', $from)
                ->whereDate('pay_period_end', '<=', $to)
                ->sum('net_salary');
        }

        $salaryKeys = ['salaries', 'salary', 'payroll', 'wages'];
        $spent = 0.0;
        if ($latest) {
            foreach ($latest->categories->groupBy(fn ($l) => strtolower(trim((string) $l->expense_type))) as $key => $lines) {
                $raw = (float) ($spentByCategory[$key] ?? 0);
                if (in_array($key, $salaryKeys, true)) {
                    $raw += $payrollSpent;
                }
                $allocSum = (float) $lines->sum('amount');
                foreach ($lines as $line) {
                    $line->spent = $allocSum > 0 ? $raw * ((float) $line->amount / $allocSum) : 0;
                    $line->remaining = (float) $line->amount - $line->spent;
                }
                $spent += $raw;
            }
        }

        $departmentTotals = $latest
            ? $latest->categories
                ->groupBy(fn ($category) => $category->department_id ?: 0)
                ->map(function ($rows) use ($total) {
                    $amount = (float) $rows->sum('amount');
                    $deptSpent = (float) $rows->sum(fn ($r) => (float) ($r->spent ?? 0));
                    $usedPct = $amount > 0 ? round(($deptSpent / $amount) * 100, 1) : ($deptSpent > 0 ? 100 : 0);

                    return [
                        'name' => $rows->first()->department->department_name ?? 'Unassigned',
                        'allocated' => $amount,
                        'spent' => $deptSpent,
                        'remaining' => $amount - $deptSpent,
                        'overspend' => max(0, $deptSpent - $amount),
                        'usedPct' => $usedPct,
                        'lines' => $rows->count(),
                        'share' => $total > 0 ? min(100, round(($amount / $total) * 100, 1)) : 0,
                    ];
                })
                ->sortByDesc('allocated')
                ->values()
            : collect();

        $stats = [
            'count' => $budgets->count(),
            'total' => $total,
            'allocated' => $allocated,
            'spent' => $spent,
            'remaining' => $allocated - $spent,
            'overspend' => max(0, $spent - $allocated),
            'unallocated' => $total - $allocated,
            'departments' => $departmentTotals->count(),
        ];

        $audits = $schoolId
            ? BudgetAudit::with('user')->where('school_id', $schoolId)->latest('created_at')->limit(20)->get()
            : collect();

        return view('AccountantPanel.budget', compact('schoolId', 'budgets', 'latest', 'departmentTotals', 'stats', 'audits'));
    }

    public function enrollmentIncome()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();

        $details = $schoolId
            ? studentEnrollDetails::with('studentEnrollment')
                ->whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))
                ->latest()
                ->get()
            : collect();

        $pending = $details->where('status', 'pending')->values();
        $byGrade = $pending
            ->groupBy(fn ($detail) => $detail->grade_applied_for ?: 'Unspecified')
            ->map->count()
            ->sortDesc();

        $stats = [
            'pending' => $pending->count(),
            'approved' => $details->where('status', 'approved')->count(),
            'rejected' => $details->where('status', 'rejected')->count(),
            'total' => $details->count(),
        ];

        return view('AccountantPanel.income.enrollmentIncome', compact('schoolId', 'pending', 'byGrade', 'stats'));
    }

    public function incomeHub()
    {
        $schoolId = $this->accountantContext->resolveSchoolId();
        $yearStart = now()->startOfYear();
        $monthStart = now()->startOfMonth();
        $pay = fn () => FeePayment::where('school_id', $schoolId);

        $ytd = $schoolId ? (float) $pay()->where('paid_at', '>=', $yearStart)->sum('amount') : 0;
        $mtd = $schoolId ? (float) $pay()->where('paid_at', '>=', $monthStart)->sum('amount') : 0;
        $structures = $schoolId ? FeeStructure::where('school_id', $schoolId)->get() : collect();
        $feeParts = [
            'Tuition Fee' => (float) $structures->sum('tuition_fee'),
            'Transport Fee' => (float) $structures->sum('transport_fee'),
            'Hostel Fee' => (float) $structures->sum('hostel_fee'),
            'Enrollment Fee' => (float) $structures->sum('exam_fee'),
            'Other Income' => (float) $structures->sum('library_fee'),
        ];
        $feeConfigured = array_sum($feeParts);
        $students = $schoolId ? Student::where('school_id', $schoolId)->count() : 0;
        $paidStudents = $schoolId ? (int) $pay()->distinct('student_id')->count('student_id') : 0;
        $pendingEnroll = $schoolId ? studentEnrollDetails::where('status', 'pending')->whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))->count() : 0;
        $matched = $schoolId ? (int) $pay()->whereNotNull('reference')->where('reference', '!=', '')->count() : 0;
        $payCount = $schoolId ? (int) $pay()->count() : 0;
        $unmatched = max(0, $payCount - $matched);
        $pendingAmt = max(0, $feeConfigured - $ytd);
        $efficiency = $feeConfigured > 0 ? round(($ytd / $feeConfigured) * 100, 1) : ($ytd > 0 ? 100 : 0);
        $reconPct = $payCount > 0 ? (int) round(($matched / $payCount) * 100) : 0;

        $trend = [];
        $trendMax = 1;
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->subMonths($i)->startOfMonth();
            $end = now()->subMonths($i)->endOfMonth();
            $total = $schoolId ? (float) $pay()->whereBetween('paid_at', [$start, $end])->sum('amount') : 0;
            $trend[] = ['label' => $start->format('M'), 'total' => $total];
            $trendMax = max($trendMax, $total);
        }

        $units = $structures->map(function ($f) use ($ytd, $feeConfigured) {
            $expected = (float) $f->tuition_fee + (float) $f->transport_fee + (float) $f->hostel_fee + (float) $f->library_fee + (float) $f->exam_fee;
            $share = $feeConfigured > 0 ? $ytd * ($expected / $feeConfigured) : 0;
            $eff = $expected > 0 ? round(($share / $expected) * 100, 1) : 0;
            return [
                'name' => $f->for ?: ('Structure #'.$f->id),
                'expected' => $expected,
                'collected' => $share,
                'efficiency' => $eff,
                'variance' => $share - $expected,
            ];
        });

        $recent = $schoolId
            ? FeePayment::with('student')->where('school_id', $schoolId)->latest('paid_at')->limit(8)->get()
            : collect();

        $lowUnits = $units->where('efficiency', '<', 80)->count();

        return view('AccountantPanel.income.income', compact(
            'schoolId', 'ytd', 'mtd', 'feeParts', 'feeConfigured', 'students', 'paidStudents',
            'pendingEnroll', 'matched', 'unmatched', 'pendingAmt', 'efficiency', 'reconPct',
            'trend', 'trendMax', 'units', 'recent', 'lowUnits', 'payCount'
        ));
    }
}
