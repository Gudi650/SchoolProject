@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Cash Flow</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-xl font-bold text-slate-900">Cash flow</h1>
        <p class="text-sm text-slate-600">{{ $from->format('M j, Y') }} – {{ $to->format('M j, Y') }} · cash movements only</p>
      </div>
      <form method="GET" class="flex flex-wrap gap-2 items-end">
        <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Apply</button>
        <a href="{{ route('accounting.reportsManagement', ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}" class="px-4 py-2 border rounded-lg text-sm">Hub</a>
      </form>
    </div>
    <div class="grid md:grid-cols-3 gap-4">
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Cash in</p><p class="text-2xl font-bold text-green-700">{{ $fmt($income) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Cash out</p><p class="text-2xl font-bold text-red-700">{{ $fmt($out + $loansOut) }}</p></div>
      <div class="bg-white border rounded-xl p-4"><p class="text-xs text-slate-500">Net cash</p><p class="text-2xl font-bold {{ $cashNet >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($cashNet) }}</p></div>
    </div>
    <div class="grid lg:grid-cols-2 gap-6">
      <div class="bg-white border rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Statement</h2>
        <table class="w-full text-sm">
          <tbody class="divide-y">
            <tr><td class="px-4 py-2 font-medium" colspan="2">Operating in</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Fee collections</td><td class="px-4 py-2 text-right">{{ $fmt($fees) }}</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Invoiced other</td><td class="px-4 py-2 text-right">{{ $fmt($invoiceOther) }}</td></tr>
            <tr class="bg-slate-50"><td class="px-4 py-2 font-semibold">Total in</td><td class="px-4 py-2 text-right font-semibold">{{ $fmt($income) }}</td></tr>
            <tr><td class="px-4 py-2 font-medium" colspan="2">Operating out</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Payroll (processed)</td><td class="px-4 py-2 text-right">{{ $fmt($payroll) }}</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Paid expenses</td><td class="px-4 py-2 text-right">{{ $fmt($expensesPaid) }}</td></tr>
            <tr><td class="px-4 py-2 font-medium" colspan="2">Financing</td></tr>
            <tr><td class="px-4 py-2 text-slate-600">Staff loans disbursed</td><td class="px-4 py-2 text-right">{{ $fmt($loansOut) }}</td></tr>
            <tr><td class="px-4 py-2 font-bold">Net cash</td><td class="px-4 py-2 text-right font-bold {{ $cashNet >= 0 ? 'text-green-700' : 'text-red-700' }}">{{ $fmt($cashNet) }}</td></tr>
          </tbody>
        </table>
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
