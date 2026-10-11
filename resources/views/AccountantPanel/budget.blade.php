@php
  $stats = $stats ?? ['count' => 0, 'total' => 0, 'allocated' => 0, 'remaining' => 0, 'departments' => 0];
  $budgets = $budgets ?? collect();
  $departmentTotals = $departmentTotals ?? collect();
  $latest = $latest ?? null;
  $fmt = fn ($n) => money_format_app($n);
  $allocatedPct = ($stats['total'] ?? 0) > 0 ? min(100, round(($stats['allocated'] / $stats['total']) * 100, 1)) : 0;
@endphp

<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>

    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Budget Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Budgets and department allocations saved for this school</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <a href="{{ route('accounting.departmentManagement') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="building" class="w-4 h-4"></i>
                Departments
              </a>
              <a href="{{ route('accounting.createBudget') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Create budget
              </a>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Latest budget</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['total']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">{{ $latest->budget_name ?? 'None created' }}</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Allocated</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['allocated']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">{{ $allocatedPct }}% of the latest budget</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Spent (period)</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['spent'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Paid expenses + payroll on salary lines</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Remaining</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['remaining']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Allocated minus spent</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Overspend</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['overspend'] ?? 0) }}</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2">Unallocated {{ $fmt($stats['unallocated'] ?? 0) }}</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600">Budgets on file</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['count']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">{{ number_format($stats['departments']) }} departments on the latest</p>
          </div>
        </div>

        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Department totals (latest budget)</h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Department</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Lines</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Allocated</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Spent</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">% used</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                @forelse ($departmentTotals as $department)
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">{{ $department['name'] }}</td>
                    <td class="px-4 py-3">{{ number_format($department['lines']) }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $fmt($department['allocated']) }}</td>
                    <td class="px-4 py-3">{{ $fmt($department['spent'] ?? 0) }}</td>
                    <td class="px-4 py-3 {{ ($department['remaining'] ?? 0) < 0 ? 'text-red-600' : '' }}">{{ $fmt($department['remaining'] ?? 0) }}</td>
                    <td class="px-4 py-3 w-56">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="h-2 rounded-full {{ ($department['usedPct'] ?? 0) >= 100 ? 'bg-red-500' : (($department['usedPct'] ?? 0) >= 90 ? 'bg-amber-500' : 'bg-indigo-500') }}" style="width: {{ min(100, $department['usedPct'] ?? 0) }}%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-14">{{ $department['usedPct'] ?? 0 }}%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">
                      @if(($department['overspend'] ?? 0) > 0)
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Over {{ $fmt($department['overspend']) }}</span>
                      @elseif(($department['usedPct'] ?? 0) >= 90)
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Near limit</span>
                      @else
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On track</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-slate-500">No department allocations yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">All budgets</h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Name</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Period</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Total</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Allocated</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Unallocated</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                @forelse ($budgets as $budget)
                  @php
                    $lineTotal = (float) $budget->categories->sum('amount');
                  @endphp
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3 font-medium">{{ $budget->budget_name }}</td>
                    <td class="px-4 py-3">{{ $budget->start_date }} – {{ $budget->end_date }}</td>
                    <td class="px-4 py-3">{{ $fmt($budget->total_amount) }}</td>
                    <td class="px-4 py-3">{{ $fmt($lineTotal) }}</td>
                    <td class="px-4 py-3">{{ $fmt((float) $budget->total_amount - $lineTotal) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                      No budgets yet.
                      <a href="{{ route('accounting.createBudget') }}" class="text-indigo-600 hover:text-indigo-800">Create a budget</a>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        @if ($latest && $latest->categories->isNotEmpty())
          <div>
            <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Category lines — {{ $latest->budget_name }}</h2>
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
              <table class="w-full text-left text-sm">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Department</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Plan</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Spent</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  @foreach ($latest->categories as $category)
                    <tr class="hover:bg-indigo-50 transition-colors">
                      <td class="px-4 py-3">{{ $category->department->department_name ?? 'Unassigned' }}</td>
                      <td class="px-4 py-3">{{ $category->expense_type }}</td>
                      <td class="px-4 py-3 font-semibold">{{ $fmt($category->amount) }}</td>
                      <td class="px-4 py-3">{{ $fmt($category->spent ?? 0) }}</td>
                      <td class="px-4 py-3 {{ ($category->remaining ?? 0) < 0 ? 'text-red-600' : '' }}">{{ $fmt($category->remaining ?? 0) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </main>
</x-Account-sidebar>
