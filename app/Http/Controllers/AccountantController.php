<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Models\LoanApplication;
use App\Models\PayrollRun;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\budget;
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
        $alerts = array_filter([
            ($stats['pendingLoans'] ?? 0) > 0 ? $stats['pendingLoans'] . ' loan(s) need review' : null,
            ($stats['approvedLoans'] ?? 0) > 0 ? $stats['approvedLoans'] . ' loan(s) ready to disburse' : null,
            ($stats['pendingEnrollments'] ?? 0) > 0 ? $stats['pendingEnrollments'] . ' enrollment application(s) pending' : null,
            $budgetTotal <= 0 ? 'No budget set for this school' : null,
        ]);

        return view('AccountantPanel.dashboard', compact('schoolId', 'stats', 'payrollTrend', 'recentActivity', 'school', 'user', 'alerts'));
    }
}
