@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Reports</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
        <h1 class="text-xl font-bold text-slate-900">
          @if($type === 'pl') Profit &amp; loss
          @elseif($type === 'cash') Cash flow
          @elseif($type === 'trial') Trial balance
          @elseif($type === 'balance') Position
          @else Financial reports
          @endif
        </h1>
        <p class="text-sm text-slate-600">{{ $from->format('M j, Y') }} – {{ $to->format('M j, Y') }}</p>
            </div>
      <form method="GET" class="flex flex-wrap gap-2 items-end">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Apply</button>
      </form>
        </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Total income</p><p class="text-xl font-bold">{{ $fmt($income) }}</p><p class="text-xs text-slate-500 mt-1">Fees {{ $fmt($fees) }} · Invoices {{ $fmt($invoiceOther) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Payroll</p><p class="text-xl font-bold">{{ $fmt($payroll) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Other expenses</p><p class="text-xl font-bold">{{ $fmt($type === 'cash' ? $expensesPaid : $expensesAll) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">{{ $type === 'cash' ? 'Net cash' : 'Surplus / deficit' }}</p><p class="text-xl font-bold {{ ($type === 'cash' ? $cash : $surplus) >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($type === 'cash' ? $cash : $surplus) }}</p></div>
        </div>

    <div class="grid lg:grid-cols-2 gap-6">
      <div class="bg-white border rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Statement</h2>
        <table class="w-full text-sm">
          <tbody class="divide-y">
            <tr><td class="px-4 py-2 font-medium">Income</td><td></td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Fee collections</td><td class="px-4 py-2 text-right">{{ $fmt($fees) }}</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Invoiced other</td><td class="px-4 py-2 text-right">{{ $fmt($invoiceOther) }}</td></tr>
            <tr class="bg-slate-50"><td class="px-4 py-2 font-semibold">Total income</td><td class="px-4 py-2 text-right font-semibold">{{ $fmt($income) }}</td></tr>
            <tr><td class="px-4 py-2 font-medium">Outflows</td><td></td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Payroll (processed)</td><td class="px-4 py-2 text-right">{{ $fmt($payroll) }}</td></tr>
            @foreach($byCategory as $cat => $amt)
              <tr><td class="px-4 py-2 text-slate-600">{{ ucfirst($cat) }}</td><td class="px-4 py-2 text-right">{{ $fmt($amt) }}</td></tr>
            @endforeach
            <tr class="bg-slate-50"><td class="px-4 py-2 font-semibold">Total outflows</td><td class="px-4 py-2 text-right font-semibold">{{ $fmt($payroll + ($type === 'cash' ? $expensesPaid : $expensesAll)) }}</td></tr>
            <tr><td class="px-4 py-2 font-bold">{{ $type === 'cash' ? 'Net cash' : 'Net surplus' }}</td><td class="px-4 py-2 text-right font-bold">{{ $fmt($type === 'cash' ? $cash : $surplus) }}</td></tr>
          </tbody>
        </table>
        @if($type === 'balance')
          <p class="px-4 py-3 text-xs text-slate-500">Operational position only (cash in vs recorded out). Full assets/liabilities are not on the books yet.</p>
        @endif
          </div>

      <div class="bg-white border rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-slate-50 text-sm">Last 6 months</h2>
        <table class="w-full text-sm">
          <thead class="border-b"><tr><th class="px-4 py-2 text-left">Month</th><th class="px-4 py-2 text-right">In</th><th class="px-4 py-2 text-right">Out</th></tr></thead>
          <tbody class="divide-y">
            @foreach($trend as $row)
              <tr>
                <td class="px-4 py-2">{{ $row['label'] }}</td>
                <td class="px-4 py-2 text-right">{{ $fmt($row['in']) }}</td>
                <td class="px-4 py-2 text-right">{{ $fmt($row['out']) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
          </div>
        </div>
      </main>
</x-Account-sidebar>
