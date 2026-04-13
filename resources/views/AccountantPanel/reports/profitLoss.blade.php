<x-Account-sidebar>
  <x-slot name="title">Profit & Loss</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Profit & Loss Statement</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Review revenue, expenditure, and net surplus for the selected period.</p>
        </div>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
          <i data-lucide="download" class="w-4 h-4"></i>
          Export P&L
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white rounded-xl border border-indigo-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Total Revenue</p><p class="text-2xl font-bold text-slate-900 mt-1">INR 8.42Cr</p></div>
      <div class="bg-white rounded-xl border border-red-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Total Expenses</p><p class="text-2xl font-bold text-red-700 mt-1">INR 6.98Cr</p></div>
      <div class="bg-white rounded-xl border border-green-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Net Surplus</p><p class="text-2xl font-bold text-green-700 mt-1">INR 1.44Cr</p></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-indigo-50 border-b border-indigo-100">
          <tr>
            <th class="px-4 py-3 text-left font-medium text-indigo-900">Particulars</th>
            <th class="px-4 py-3 text-right font-medium text-indigo-900">Amount</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr><td class="px-4 py-3 font-medium text-slate-900">Revenue</td><td class="px-4 py-3 text-right"></td></tr>
          <tr><td class="px-4 py-3 text-slate-600">Tuition & Academic Fees</td><td class="px-4 py-3 text-right">INR 5,95,00,000</td></tr>
          <tr><td class="px-4 py-3 text-slate-600">Enrollment & Other Income</td><td class="px-4 py-3 text-right">INR 2,47,00,000</td></tr>
          <tr class="bg-slate-50"><td class="px-4 py-3 font-semibold text-slate-900">Total Revenue</td><td class="px-4 py-3 text-right font-semibold text-slate-900">INR 8,42,00,000</td></tr>
          <tr><td class="px-4 py-3 font-medium text-slate-900">Expenses</td><td class="px-4 py-3 text-right"></td></tr>
          <tr><td class="px-4 py-3 text-slate-600">Payroll & Benefits</td><td class="px-4 py-3 text-right">INR 4,92,00,000</td></tr>
          <tr><td class="px-4 py-3 text-slate-600">Utilities, Maintenance, Operations</td><td class="px-4 py-3 text-right">INR 2,06,00,000</td></tr>
          <tr class="bg-slate-50"><td class="px-4 py-3 font-semibold text-slate-900">Total Expenses</td><td class="px-4 py-3 text-right font-semibold text-red-700">INR 6,98,00,000</td></tr>
          <tr class="bg-green-50"><td class="px-4 py-3 font-semibold text-green-800">Net Surplus</td><td class="px-4 py-3 text-right font-semibold text-green-800">INR 1,44,00,000</td></tr>
        </tbody>
      </table>
    </div>
  </main>
</x-Account-sidebar>
