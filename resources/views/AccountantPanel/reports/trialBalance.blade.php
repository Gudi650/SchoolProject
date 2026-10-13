@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Trial Balance</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-xl font-bold text-slate-900">Trial balance</h1>
        <p class="text-sm text-slate-600">{{ $from->format('M j, Y') }} – {{ $to->format('M j, Y') }} · period totals by source</p>
      </div>
      <form method="GET" class="flex flex-wrap gap-2 items-end">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Apply</button>
        <a href="{{ route('accounting.reportsManagement', ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}" class="px-4 py-2 border rounded-lg text-sm">Hub</a>
      </form>
    </div>
    <div class="bg-white border rounded-xl overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-indigo-50 border-b"><tr><th class="px-4 py-3 text-left">Source</th><th class="px-4 py-3 text-right">Debit</th><th class="px-4 py-3 text-right">Credit</th></tr></thead>
        <tbody class="divide-y">
          <tr><td class="px-4 py-2">Fee collections</td><td class="px-4 py-2 text-right">—</td><td class="px-4 py-2 text-right">{{ $fmt($fees) }}</td></tr>
          <tr><td class="px-4 py-2">Invoiced other</td><td class="px-4 py-2 text-right">—</td><td class="px-4 py-2 text-right">{{ $fmt($invoiceOther) }}</td></tr>
          <tr><td class="px-4 py-2">Payroll (processed)</td><td class="px-4 py-2 text-right">{{ $fmt($payroll) }}</td><td class="px-4 py-2 text-right">—</td></tr>
          <tr><td class="px-4 py-2">Recorded expenses</td><td class="px-4 py-2 text-right">{{ $fmt($expensesAll) }}</td><td class="px-4 py-2 text-right">—</td></tr>
          <tr><td class="px-4 py-2">Staff loans disbursed</td><td class="px-4 py-2 text-right">{{ $fmt($loansOut) }}</td><td class="px-4 py-2 text-right">—</td></tr>
          <tr class="bg-slate-50 font-semibold"><td class="px-4 py-2">Total</td><td class="px-4 py-2 text-right">{{ $fmt($debitTotal) }}</td><td class="px-4 py-2 text-right">{{ $fmt($creditTotal) }}</td></tr>
        </tbody>
      </table>
      <p class="px-4 py-3 text-xs text-slate-500">Not a full ledger. Debits and credits will not match until every movement is double-entry.</p>
    </div>
  </main>
</x-Account-sidebar>
