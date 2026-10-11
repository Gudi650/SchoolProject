@php
  $stats = $stats ?? [];
  $runs = $runs ?? collect();
  $fmt = fn ($n) => money_format_app($n);
  $staffName = function ($config) {
      $name = $config?->employee?->full_name
          ?? trim(($config?->teachers?->fname ?? '') . ' ' . ($config?->teachers?->lname ?? ''));
      return $name !== '' ? $name : 'Staff';
  };
@endphp

<x-Account-sidebar>
  <x-slot name="title">Payroll Management</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Payroll Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Staff payroll configurations and processed runs</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <a href="{{ route('accounting.payrollSettings') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Payroll settings
              </a>
              <button type="button" onclick="document.getElementById('payrollPayModal').classList.remove('hidden')" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="play" class="w-4 h-4"></i>
                Process payroll
              </button>
            </div>
          </div>
        </div>

        @if (session('success'))
          <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif
        @if ($errors->any())
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="users" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Configured staff</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ number_format($stats['employees'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Net {{ $fmt($stats['configuredNet'] ?? 0) }}</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Processed this month</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($stats['monthNet'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">{{ number_format($stats['processedCount'] ?? 0) }} runs</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Draft runs this month</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ number_format($stats['draftCount'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">{{ number_format($stats['monthRuns'] ?? 0) }} runs created</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="hand-coins" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Loan deductions</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($stats['loanDeductions'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Taken on processed runs this month</p>
          </div>
        </div>

        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Recent payroll runs
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Staff</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Period</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Basic</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Allowances</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Deductions</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Net</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  @forelse ($runs as $run)
                    @php
                      $status = (string) $run->status;
                      $badge = match ($status) {
                          'processed', 'paid' => 'bg-green-100 text-green-700',
                          'draft' => 'bg-amber-100 text-amber-700',
                          'cancelled' => 'bg-slate-100 text-slate-700',
                          default => 'bg-indigo-100 text-indigo-700',
                      };
                    @endphp
                    <tr class="hover:bg-indigo-50 transition-colors">
                      <td class="px-4 py-3">{{ $staffName($run->payrollConfiguration) }}</td>
                      <td class="px-4 py-3">{{ $run->pay_period_label ?: '—' }}</td>
                      <td class="px-4 py-3">{{ $fmt($run->base_salary) }}</td>
                      <td class="px-4 py-3 text-green-600">{{ $fmt($run->total_allowances) }}</td>
                      <td class="px-4 py-3 text-red-600">{{ $fmt($run->total_deductions) }}</td>
                      <td class="px-4 py-3 font-semibold">{{ $fmt($run->net_salary) }}</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $badge }}">{{ ucfirst($status) }}</span></td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="px-4 py-8 text-center text-slate-500">No payroll runs yet. Configure staff, then process the current period.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
      </main>

  <div id="payrollPayModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40" onclick="this.parentElement.classList.add('hidden')"></div>
    <form method="POST" action="{{ route('accounting.payrollRuns.process') }}" class="relative mx-auto mt-20 w-full max-w-md bg-white rounded-xl p-6 space-y-3">
      @csrf
      <h2 class="text-lg font-semibold">Process payroll</h2>
      <p class="text-sm text-slate-600">Net pay will be deducted from the account(s) you select.</p>
      @if($needsBank ?? true)
        <div>
          <label class="block text-sm font-medium mb-1">Bank account</label>
          <select name="bank_account_id" required class="w-full border rounded-lg px-3 py-2">
            <option value="">Select bank</option>
            @foreach(($accounts ?? collect())->where('kind', 'bank') as $a)
              <option value="{{ $a->id }}">{{ $a->name }}</option>
            @endforeach
          </select>
        </div>
      @endif
      @if($needsCash ?? false)
        <div>
          <label class="block text-sm font-medium mb-1">Cash account</label>
          <select name="cash_account_id" required class="w-full border rounded-lg px-3 py-2">
            <option value="">Select cash</option>
            @foreach(($accounts ?? collect())->where('kind', 'cash') as $a)
              <option value="{{ $a->id }}">{{ $a->name }}</option>
            @endforeach
          </select>
        </div>
      @endif
      @if(($accounts ?? collect())->isEmpty())
        <p class="text-xs text-amber-700">Add a bank/cash account under Banking first.</p>
      @endif
      <div class="flex justify-end gap-2 pt-2">
        <button type="button" onclick="document.getElementById('payrollPayModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg text-sm">Cancel</button>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Process</button>
      </div>
    </form>
  </div>
</x-Account-sidebar>
