@php
  $stats = $stats ?? [];
  $payrollTrend = $payrollTrend ?? [];
  $recentActivity = $recentActivity ?? collect();
  $maxTrend = max(1, collect($payrollTrend)->max('total') ?: 0);
  $budgetTotal = (float) ($stats['budgetTotal'] ?? 0);
  $budgetAllocated = (float) ($stats['budgetAllocated'] ?? 0);
  $budgetPct = $budgetTotal > 0 ? min(100, round(($budgetAllocated / $budgetTotal) * 100, 1)) : 0;
  $fmt = fn ($n) => money_format_app($n);
@endphp

<x-Account-sidebar>
  <x-slot name="title">Accountant Dashboard</x-slot>

  <main class="p-6 bg-white min-w-0">
    @if(empty($schoolId))
      <div class="rounded-xl border border-amber-200 bg-amber-50 p-8 text-center text-slate-700">
        <i data-lucide="building-2" class="w-10 h-10 mx-auto text-amber-600 mb-3"></i>
        <p class="font-semibold">School context not found</p>
        <p class="text-sm mt-2 text-slate-600">Sign in with an accountant account linked to a school, or set your school in session.</p>
      </div>
    @else
      <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <h1 class="text-xl font-bold text-slate-900">Welcome{{ $user ? ', ' . trim($user->fname . ' ' . $user->lname) : '' }}</h1>
          <p class="text-sm text-slate-600 mt-1">{{ $school->name ?? 'Finance overview' }} · {{ now()->format('l, M j, Y') }}</p>
        </div>
      </div>
      @if(!empty($alerts))
        <div class="mb-4 flex flex-wrap gap-2">
          @foreach($alerts as $alert)
            <a href="{{ $alert['url'] }}" class="text-xs px-3 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">{{ $alert['text'] }}</a>
          @endforeach
        </div>
      @endif

      <div class="mb-6">
        <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl p-8 text-white shadow-xl">
          <div class="flex items-start justify-between gap-4">
            <div>
              <p class="text-indigo-100 text-sm font-medium mb-2">Processed payroll this month</p>
              <h2 class="text-4xl font-bold mb-2">{{ $fmt($stats['payrollNetMonth'] ?? 0) }}</h2>
              <p class="text-indigo-100 text-sm">
                <span class="font-semibold text-white">{{ (int) ($stats['payrollRunsMonth'] ?? 0) }}</span>
                payroll run(s) in {{ now()->format('F') }}
              </p>
            </div>
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl shrink-0">
              <i data-lucide="wallet" class="w-8 h-8"></i>
            </div>
          </div>
          <p class="text-xs text-indigo-200 mt-4 border-t border-indigo-500/30 pt-4">
            Fee collections and bank balances are not tracked in the database yet — this dashboard uses modules that already exist.
          </p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl p-4 border border-slate-200">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
              <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
            </div>
            <div>
              <p class="text-xs text-slate-600">Students</p>
              <p class="text-lg font-semibold">{{ number_format($stats['students'] ?? 0) }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-4 border border-slate-200">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
              <i data-lucide="graduation-cap" class="w-5 h-5 text-sky-600"></i>
            </div>
            <div>
              <p class="text-xs text-slate-600">Staff (teachers)</p>
              <p class="text-lg font-semibold">{{ number_format($stats['teachers'] ?? 0) }}</p>
            </div>
          </div>
        </div>

        <a href="{{ route('accounting.proposalManagement') }}" class="bg-white rounded-xl p-4 border border-slate-200 hover:border-amber-300 block">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
              <i data-lucide="file-clock" class="w-5 h-5 text-amber-600"></i>
            </div>
            <div>
              <p class="text-xs text-slate-600">Loans pending review</p>
              <p class="text-lg font-semibold">{{ number_format($stats['pendingLoans'] ?? 0) }}</p>
            </div>
          </div>
        </a>

        <a href="{{ route('accounting.loanDisbursements') }}" class="bg-white rounded-xl p-4 border border-slate-200 hover:border-emerald-300 block">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
              <i data-lucide="badge-check" class="w-5 h-5 text-emerald-600"></i>
            </div>
            <div>
              <p class="text-xs text-slate-600">Loans approved (awaiting disburse)</p>
              <p class="text-lg font-semibold">{{ number_format($stats['approvedLoans'] ?? 0) }}</p>
            </div>
          </div>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('accounting.payrollSettings') }}" class="bg-slate-50 rounded-lg p-3 border border-slate-200 hover:border-indigo-300 block text-sm">
          <span class="text-slate-500">On payroll</span>
          <span class="font-semibold block">{{ number_format($stats['payrollEmployees'] ?? 0) }} staff</span>
        </a>
        <a href="{{ route('accounting.loanDisbursements') }}" class="bg-slate-50 rounded-lg p-3 border border-slate-200 hover:border-indigo-300 block text-sm">
          <span class="text-slate-500">Disbursed this month</span>
          <span class="font-semibold block">{{ number_format($stats['loansDisbursedMonth'] ?? 0) }} loans</span>
        </a>
        <a href="{{ route('accounting.proposalManagement') }}" class="bg-slate-50 rounded-lg p-3 border border-slate-200 hover:border-indigo-300 block text-sm">
          <span class="text-slate-500">Rejected loans</span>
          <span class="font-semibold block">{{ number_format($stats['rejectedLoans'] ?? 0) }}</span>
        </a>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-white rounded-xl p-6 border border-slate-200">
          <h3 class="text-sm font-semibold mb-4 text-slate-900">Payroll net pay (last 6 months)</h3>
          @if(collect($payrollTrend)->sum('total') <= 0)
            <div class="h-48 bg-slate-50 rounded-lg flex items-center justify-center text-slate-500 text-sm">
              No payroll runs recorded yet.
            </div>
          @else
            <div class="space-y-3">
              @foreach($payrollTrend as $row)
                @php $w = round(((float) $row['total'] / $maxTrend) * 100); @endphp
                <div>
                  <div class="flex items-center justify-between mb-1 text-sm">
                    <span class="text-slate-600">{{ $row['label'] }}</span>
                    <span class="font-semibold text-slate-900">{{ $fmt($row['total']) }}</span>
                  </div>
                  <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all" style="width: {{ $w }}%"></div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h3 class="text-lg font-semibold text-slate-900">Latest budget</h3>
              <p class="text-sm text-slate-600 mt-1">Category allocation vs total</p>
            </div>
            <div class="p-2 bg-indigo-100 rounded-lg">
              <i data-lucide="pie-chart" class="w-5 h-5 text-indigo-600"></i>
            </div>
          </div>

          @if($budgetTotal <= 0)
            <p class="text-sm text-slate-500 py-6 text-center">No budget created yet.</p>
            <a href="{{ route('accounting.createBudget') }}" class="block w-full text-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg">
              Create budget
            </a>
          @else
            @if($latestBudget ?? null)
              <p class="text-sm font-medium text-slate-800">{{ $latestBudget->budget_name }}</p>
              <p class="text-xs text-slate-500 mb-2">{{ $latestBudget->start_date }} – {{ $latestBudget->end_date }}</p>
            @endif
            <p class="text-3xl font-bold text-slate-900">{{ $fmt($budgetTotal) }}</p>
            <p class="text-sm text-slate-600 mt-1">{{ $fmt($budgetAllocated) }} allocated ({{ $budgetPct }}%)</p>
            <div class="w-full bg-slate-100 rounded-full h-3 mt-4">
              <div class="bg-indigo-500 h-3 rounded-full" style="width: {{ $budgetPct }}%"></div>
            </div>
            <a href="{{ route('accounting.budgetingManagement') }}" class="block w-full mt-6 text-center px-4 py-2.5 border border-slate-200 hover:bg-slate-50 text-sm font-medium rounded-lg text-indigo-700">
              Manage budgets
            </a>
          @endif
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl p-6 border border-slate-200">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-900">Fee structures</h3>
            <i data-lucide="receipt" class="w-5 h-5 text-indigo-600"></i>
          </div>
          <p class="text-2xl font-bold text-slate-900">{{ $fmt($stats['feeConfiguredTotal'] ?? 0) }}</p>
          <p class="text-xs text-slate-600 mt-1">{{ number_format($stats['feeStructures'] ?? 0) }} structure(s) · standard fees total</p>
          <a href="{{ route('accounting.feeStructure') }}" class="inline-block mt-4 text-sm text-indigo-600 hover:text-indigo-800">Open fee structure →</a>
        </div>

        <a href="{{ route('accounting.enrollmentIncome') }}" class="bg-white rounded-xl p-6 border border-slate-200 hover:border-purple-300 block">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-900">Enrollment applications</h3>
            <i data-lucide="user-plus" class="w-5 h-5 text-purple-600"></i>
          </div>
          <p class="text-4xl font-bold text-slate-900">{{ number_format($stats['pendingEnrollments'] ?? 0) }}</p>
          <p class="text-xs text-slate-600 mt-3">Pending · view enrollment income</p>
        </a>

        <div class="bg-white rounded-xl p-6 border border-slate-200">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-900">Quick links</h3>
            <i data-lucide="link" class="w-5 h-5 text-slate-500"></i>
          </div>
          <div class="space-y-2 text-sm">
            <a href="{{ route('accounting.payrollManagement') }}" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-800"><i data-lucide="banknote" class="w-4 h-4"></i> Payroll</a>
            <a href="{{ route('accounting.proposalManagement') }}" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-800"><i data-lucide="hand-coins" class="w-4 h-4"></i> Loan proposals</a>
            <a href="{{ route('accounting.feeManagement') }}" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-800"><i data-lucide="wallet-cards" class="w-4 h-4"></i> Fee management</a>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between mb-4 gap-2 flex-wrap">
          <h3 class="text-sm font-semibold text-slate-900">Recent payroll &amp; loans</h3>
          <div class="text-xs flex gap-3">
            <a href="{{ route('accounting.payrollManagement') }}" class="text-indigo-600 hover:text-indigo-800">Payroll</a>
            <a href="{{ route('accounting.proposalManagement') }}" class="text-indigo-600 hover:text-indigo-800">Loans</a>
          </div>
        </div>
        <div class="space-y-3">
          @forelse($recentActivity as $item)
            <div class="flex items-center justify-between gap-4">
              <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center shrink-0">
                  <i data-lucide="{{ $item['type'] === 'payroll' ? 'banknote' : 'hand-coins' }}" class="w-5 h-5 text-slate-500"></i>
                </div>
                <div class="min-w-0">
                  <p class="text-sm font-medium text-slate-900 truncate">{{ $item['title'] }}</p>
                  <p class="text-xs text-slate-500">{{ $item['meta'] }}</p>
                </div>
              </div>
              <div class="text-sm font-semibold text-slate-900 shrink-0">{{ $fmt($item['amount']) }}</div>
            </div>
          @empty
            <p class="text-sm text-slate-500 text-center py-6">No payroll runs or loan applications yet.</p>
          @endforelse
        </div>
      </div>
    @endif
  </main>
</x-Account-sidebar>
