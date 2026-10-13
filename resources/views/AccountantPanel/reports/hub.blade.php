@php
  $fmt = fn ($n) => money_format_app($n);
  $q = ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')];
@endphp

<x-Account-sidebar>
  <x-slot name="title">Reports</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-xl font-bold text-slate-900">Reports</h1>
        <p class="text-sm text-slate-600">{{ $from->format('M j, Y') }} – {{ $to->format('M j, Y') }}</p>
      </div>
      <form method="GET" class="flex flex-wrap gap-2 items-end">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Apply</button>
      </form>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Income</p><p class="text-xl font-bold">{{ $fmt($income) }}</p><p class="text-xs text-slate-500 mt-1">Fees {{ $fmt($fees) }} · Invoices {{ $fmt($invoiceOther) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Outflows (cash)</p><p class="text-xl font-bold">{{ $fmt($out) }}</p><p class="text-xs text-slate-500 mt-1">Payroll {{ $fmt($payroll) }} · Paid expenses {{ $fmt($expensesPaid) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Surplus / deficit</p><p class="text-xl font-bold {{ $surplus >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($surplus) }}</p><p class="text-xs text-slate-500 mt-1">Period cash {{ $fmt($cash) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Cash on hand</p><p class="text-xl font-bold">{{ $fmt($cashOnHand) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Overdue invoices</p><p class="text-xl font-bold text-red-700">{{ $fmt($overdue) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Recorded expenses</p><p class="text-xl font-bold">{{ $fmt($expensesAll) }}</p><p class="text-xs text-slate-500 mt-1">Includes unpaid</p></div>
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
      <a href="{{ route('accounting.reports.profitLoss', $q) }}" class="bg-white border rounded-xl p-4 hover:border-indigo-300">
        <h2 class="font-semibold">Profit &amp; loss</h2>
        <p class="text-sm text-slate-600 mt-1">Income vs recorded expenses and payroll</p>
      </a>
      <a href="{{ route('accounting.reports.cashFlow', $q) }}" class="bg-white border rounded-xl p-4 hover:border-indigo-300">
        <h2 class="font-semibold">Cash flow</h2>
        <p class="text-sm text-slate-600 mt-1">Cash in vs paid expenses and payroll</p>
      </a>
      <a href="{{ route('accounting.reports.trialBalance', $q) }}" class="bg-white border rounded-xl p-4 hover:border-indigo-300">
        <h2 class="font-semibold">Trial balance</h2>
        <p class="text-sm text-slate-600 mt-1">Totals by source for the period</p>
      </a>
      <a href="{{ route('accounting.reports.balanceSheet', $q) }}" class="bg-white border rounded-xl p-4 hover:border-indigo-300">
        <h2 class="font-semibold">Position</h2>
        <p class="text-sm text-slate-600 mt-1">Cash on hand vs unpaid items</p>
      </a>
    </div>
  </main>
</x-Account-sidebar>
