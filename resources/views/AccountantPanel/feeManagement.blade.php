@php
  $stats = $stats ?? ['count' => 0, 'general' => 0, 'specific' => 0, 'configuredTotal' => 0];
  $rows = $rows ?? collect();
  $fmt = fn ($n) => money_format_app($n);
@endphp

<x-Account-sidebar>
  <x-slot name="title">Fee Management</x-slot>
    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between items-start gap-4">
            <div class="sm:flex-1">
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Fee Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Configured fee structures for this school</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
              <a href="{{ route('accounting.feeStructure') }}" class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center shadow-sm">
                <i data-lucide="layers" class="w-4 h-4"></i>
                <span>Fee structure</span>
              </a>
              <a href="{{ route('accounting.feeSettings') }}" class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 justify-center shadow-sm">
                <i data-lucide="settings" class="w-4 h-4"></i>
                <span>Fee settings</span>
              </a>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="layers" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Fee structures</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ number_format($stats['count']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Saved for this school</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Configured total</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $fmt($stats['configuredTotal']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Standard fees plus custom components</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600 mb-1">General structures</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ number_format($stats['general']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Apply school-wide</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600 mb-1">Class-specific</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ number_format($stats['specific']) }}</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Tied to selected classes</p>
          </div>
        </div>

        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <i data-lucide="list" class="w-5 h-5 text-indigo-600"></i>
            Fee structures
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Scope</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Classes</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Tuition</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Other fees</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Total</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Currency</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                @forelse ($rows as $row)
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">{{ $row['scope'] }}</td>
                    <td class="px-4 py-3">{{ $row['classes'] }}</td>
                    <td class="px-4 py-3">{{ $fmt($row['tuition']) }}</td>
                    <td class="px-4 py-3">{{ $fmt($row['other']) }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $fmt($row['total']) }}</td>
                    <td class="px-4 py-3">{{ $row['currency'] ?: '—' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                      No fee structures yet.
                      <a href="{{ route('accounting.feeStructure') }}" class="text-indigo-600 hover:text-indigo-800">Create one</a>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </main>
</x-Account-sidebar>
