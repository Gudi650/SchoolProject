@php
  $fmt = fn ($n) => money_format_app($n);
  $feeParts = $feeParts ?? [];
  $feeTotal = $feeConfigured ?: 0;
  $pct = fn ($n) => $feeTotal > 0 ? (int) round(($n / $feeTotal) * 100) : 0;
  $trendMax = $trendMax ?: 1;
@endphp

<x-Account-sidebar>
  <x-slot name="title">Income Management</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">School Income Overview</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Whole-school collections, enrollment income, and reconciliation.</p>
        </div>
        <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-2 sm:gap-3 pt-3">
          <a href="{{ route('accounting.enrollmentIncome') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            Enrollment applications
          </a>
          <a href="{{ route('accounting.feeCollection') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
            <i data-lucide="receipt" class="w-4 h-4"></i>
            Fee collection
          </a>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-6">
      <div class="bg-white rounded-xl p-4 border border-indigo-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-indigo-100">
            <i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Total Income (YTD)</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($ytd ?? 0) }}</p>
        <p class="text-xs sm:text-sm text-green-600 mt-2">{{ now()->year }} collections</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-indigo-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-indigo-100">
            <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Collected (MTD)</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($mtd ?? 0) }}</p>
        <p class="text-xs sm:text-sm text-slate-600 mt-2">{{ now()->format('F') }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-green-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-green-100">
            <i data-lucide="target" class="w-4 h-4 text-green-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Collection Efficiency</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $efficiency ?? 0 }}%</p>
        <p class="text-xs sm:text-sm {{ ($efficiency ?? 0) >= 80 ? 'text-green-600' : 'text-amber-600' }} mt-2">{{ ($efficiency ?? 0) >= 80 ? 'On track' : 'Needs follow-up' }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-amber-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-amber-100">
            <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Pending & Overdue</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($pendingAmt ?? 0) }}</p>
        <p class="text-xs sm:text-sm text-amber-600 mt-2">{{ max(0, ($students ?? 0) - ($paidStudents ?? 0)) }} students unpaid</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-blue-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-blue-100">
            <i data-lucide="book-check" class="w-4 h-4 text-blue-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Reconciliation Health</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $reconPct ?? 0 }}%</p>
        <p class="text-xs sm:text-sm text-blue-600 mt-2">{{ $unmatched ?? 0 }} entries unmatched</p>
      </div>
    </div>

    <div class="mb-6 rounded-xl border border-indigo-100 bg-white shadow-sm p-4 sm:p-5">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Enrollment Income Snapshot
          </h2>
          <p class="text-xs sm:text-sm text-slate-600 mt-1">Student-wise enrollment collections are managed in a dedicated tracker and rolled up here.</p>
        </div>
        <a href="{{ route('accounting.enrollmentIncome') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 w-full sm:w-auto justify-center sm:justify-start">
          <i data-lucide="external-link" class="w-4 h-4"></i>
          Open Enrollment Income
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 mt-4">
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Collected (Cycle)</p>
          <p class="text-lg font-semibold text-slate-900 mt-1">{{ $fmt($mtd ?? 0) }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Fully Paid Students</p>
          <p class="text-lg font-semibold text-slate-900 mt-1">{{ number_format($paidStudents ?? 0) }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Pending Enrollment Dues</p>
          <p class="text-lg font-semibold text-amber-600 mt-1">{{ number_format($pendingEnroll ?? 0) }} pending</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Overdue Cases</p>
          <p class="text-lg font-semibold text-red-600 mt-1">{{ number_format(max(0, ($students ?? 0) - ($paidStudents ?? 0))) }} Students</p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
      <div class="flex items-center justify-between gap-3 mb-4">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Whole-School Filters
        </h2>
        <button class="text-xs sm:text-sm px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50">Reset</button>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 mb-4">
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>Academic Year: {{ now()->year }}-{{ now()->year + 1 }}</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Branches</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Standards</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Categories</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Status</option>
        </select>
        <input type="text" placeholder="Search source / class / route" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100" />
      </div>
      <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="filter" class="w-4 h-4"></i>
          Apply Filters
        </button>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="download" class="w-4 h-4"></i>
          Download Variance Report
        </button>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="file-up" class="w-4 h-4"></i>
          Upload Bank Statement
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Income Composition (YTD)
        </h2>
        <div class="space-y-4 text-sm">
          @forelse($feeParts as $label => $amt)
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-slate-600">{{ $label }}</span>
                <span class="font-semibold text-slate-900">{{ $pct($amt) }}%</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:{{ $pct($amt) }}%"></div></div>
            </div>
          @empty
            <p class="text-slate-500">No fee structures yet.</p>
          @endforelse
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Collection Trend (Last 6 Months)
        </h2>
        <div class="grid grid-cols-6 gap-2 text-center text-xs text-slate-600 mt-2">
          @foreach($trend ?? [] as $row)
            <div>
              <div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:{{ (int) round(($row['total'] / $trendMax) * 100) }}%"></div></div>
              <p class="mt-1">{{ $row['label'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-indigo-600 rounded"></span>
        Branch / Unit Collection Performance
      </h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
        <table class="w-full text-left text-sm relative z-0">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Unit</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Expected</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Collected</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Efficiency</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Variance</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($units as $u)
              @php
                $status = $u['efficiency'] >= 100 ? ['Above Target', 'bg-green-100 text-green-700'] : ($u['efficiency'] >= 80 ? ['Healthy', 'bg-green-100 text-green-700'] : ['Needs Follow-up', 'bg-amber-100 text-amber-700']);
              @endphp
              <tr class="hover:bg-indigo-50 transition-colors">
                <td class="px-4 py-3">{{ $u['name'] }}</td>
                <td class="px-4 py-3">{{ $fmt($u['expected']) }}</td>
                <td class="px-4 py-3 font-semibold">{{ $fmt($u['collected']) }}</td>
                <td class="px-4 py-3">{{ $u['efficiency'] }}%</td>
                <td class="px-4 py-3 {{ $u['variance'] >= 0 ? 'text-green-600' : 'text-amber-600' }} font-medium">{{ $u['variance'] >= 0 ? '+' : '' }}{{ $fmt($u['variance']) }}</td>
                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $status[1] }}">{{ $status[0] }}</span></td>
              </tr>
            @empty
              <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">No fee structures yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="mb-6 rounded-xl border border-amber-100 bg-amber-50 px-4 py-3">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div class="flex items-start gap-2">
          <i data-lucide="triangle-alert" class="w-4 h-4 text-amber-600 mt-0.5"></i>
          <p class="text-xs sm:text-sm text-amber-800">{{ $lowUnits ?? 0 }} units dropped below 80% collection efficiency and {{ $unmatched ?? 0 }} records are pending bank reconciliation.</p>
        </div>
        <a href="{{ route('accounting.feeCollection') }}" class="text-xs sm:text-sm px-3 py-1.5 bg-white border border-amber-200 rounded-lg text-amber-700 hover:bg-amber-100">Open Action Queue</a>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Reconciliation Snapshot
        </h2>
        <div class="space-y-4">
          <div>
            <div class="flex items-center justify-between text-sm mb-1">
              <span class="text-slate-600">Matched Transactions</span>
              <span class="font-semibold text-slate-900">{{ $reconPct ?? 0 }}%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full">
              <div class="h-2 bg-indigo-500 rounded-full" style="width: {{ $reconPct ?? 0 }}%"></div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-3 text-sm">
            <div class="rounded-lg border border-slate-200 p-3">
              <p class="text-slate-500">Matched</p>
              <p class="font-semibold text-slate-900">{{ number_format($matched ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 p-3">
              <p class="text-slate-500">Unmatched</p>
              <p class="font-semibold text-amber-600">{{ number_format($unmatched ?? 0) }}</p>
            </div>
          </div>
          <a href="{{ route('accounting.feeCollection') }}" class="block text-center w-full px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">Open Reconciliation Queue</a>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Pending Income Aging
        </h2>
        <div class="space-y-3 text-sm">
          <div class="flex items-center justify-between">
            <span class="text-slate-600">0-15 days</span>
            <span class="font-semibold text-slate-900">{{ $fmt($pendingAmt ?? 0) }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-slate-600">16-30 days</span>
            <span class="font-semibold text-slate-900">{{ $fmt(0) }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-slate-600">31+ days</span>
            <span class="font-semibold text-amber-600">{{ $fmt(0) }}</span>
          </div>
          <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
            <span class="text-slate-600">Total Pending</span>
            <span class="font-semibold text-slate-900">{{ $fmt($pendingAmt ?? 0) }}</span>
          </div>
          <a href="{{ route('accounting.feeCollection') }}" class="block text-center w-full px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">View Defaulter Breakdown</a>
        </div>
      </div>
    </div>

    <div>
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-indigo-600 rounded"></span>
        Recent School Income Transactions
      </h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
        <table class="w-full text-left text-sm relative z-0">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Income ID</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Unit</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Mode</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($recent as $p)
              <tr class="hover:bg-indigo-50 transition-colors">
                <td class="px-4 py-3">INC{{ $p->id }}</td>
                <td class="px-4 py-3">{{ $p->paid_at?->format('Y-m-d') }}</td>
                <td class="px-4 py-3">{{ trim(($p->student->fname ?? '').' '.($p->student->lname ?? '')) ?: 'Student' }}</td>
                <td class="px-4 py-3">Tuition Fee</td>
                <td class="px-4 py-3 font-semibold text-green-600">{{ $fmt($p->amount) }}</td>
                <td class="px-4 py-3">{{ ucfirst($p->payment_method) }}</td>
                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Collected</span></td>
                <td class="px-4 py-3"><a href="{{ route('accounting.feeCollection') }}" class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100 inline-flex">View</a></td>
              </tr>
            @empty
              <tr><td colspan="8" class="px-4 py-8 text-center text-slate-500">No payments recorded yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-Account-sidebar>
