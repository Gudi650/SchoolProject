@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Position</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-xl font-bold text-slate-900">Position</h1>
        <p class="text-sm text-slate-600">As of {{ $to->format('M j, Y') }} · cash, receivables, and unpaid items</p>
      </div>
      <form method="GET" class="flex flex-wrap gap-2 items-end">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Apply</button>
        <a href="{{ route('accounting.reportsManagement', ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}" class="px-4 py-2 border rounded-lg text-sm">Hub</a>
      </form>
    </div>
    <div class="grid md:grid-cols-3 gap-4">
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Assets</p><p class="text-2xl font-bold">{{ $fmt($assets) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Liabilities</p><p class="text-2xl font-bold text-red-700">{{ $fmt($liabilities) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Net position</p><p class="text-2xl font-bold {{ $equity >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($equity) }}</p></div>
    </div>
    <div class="grid lg:grid-cols-2 gap-6">
      <div class="bg-white border rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Assets</h2>
        <table class="w-full text-sm">
          <tbody class="divide-y">
            @forelse($accounts as $a)
              <tr><td class="px-4 py-2 text-slate-600">{{ $a['name'] }} ({{ ucfirst($a['kind']) }})</td><td class="px-4 py-2 text-right">{{ $fmt($a['balance']) }}</td></tr>
            @empty
              <tr><td class="px-4 py-2 text-slate-500" colspan="2">No bank accounts</td></tr>
            @endforelse
            <tr class="bg-slate-50"><td class="px-4 py-2 font-semibold">Cash on hand</td><td class="px-4 py-2 text-right font-semibold">{{ $fmt($cashOnHand) }}</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Open invoices (receivable)</td><td class="px-4 py-2 text-right">{{ $fmt($invoicesOpen) }}</td></tr>
            <tr class="font-bold"><td class="px-4 py-2">Total assets</td><td class="px-4 py-2 text-right">{{ $fmt($assets) }}</td></tr>
          </tbody>
        </table>
      </div>
      <div class="bg-white border rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-slate-50 text-sm">Liabilities</h2>
        <table class="w-full text-sm">
          <tbody class="divide-y">
            <tr><td class="px-4 py-2 text-slate-600">Unpaid expenses</td><td class="px-4 py-2 text-right">{{ $fmt($expensesUnpaid) }}</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Staff loans outstanding</td><td class="px-4 py-2 text-right">{{ $fmt($loansOutstanding) }}</td></tr>
            <tr class="bg-slate-50 font-semibold"><td class="px-4 py-2">Total liabilities</td><td class="px-4 py-2 text-right">{{ $fmt($liabilities) }}</td></tr>
            <tr class="font-bold"><td class="px-4 py-2">Net position</td><td class="px-4 py-2 text-right {{ $equity >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($equity) }}</td></tr>
          </tbody>
        </table>
        <p class="px-4 py-3 text-xs text-slate-500">Operational snapshot. Buildings, inventory, and other assets are not on the books.</p>
      </div>
    </div>
  </main>
</x-Account-sidebar>
