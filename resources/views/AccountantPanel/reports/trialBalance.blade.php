<x-Account-sidebar>
  <x-slot name="title">Trial Balance</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Trial Balance</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Validate debit and credit totals before final statement generation.</p>
        </div>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
          <i data-lucide="download" class="w-4 h-4"></i>
          Export XLSX
        </button>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-indigo-50 border-b border-indigo-100">
          <tr>
            <th class="px-4 py-3 text-left font-medium text-indigo-900">Account</th>
            <th class="px-4 py-3 text-right font-medium text-indigo-900">Debit</th>
            <th class="px-4 py-3 text-right font-medium text-indigo-900">Credit</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr><td class="px-4 py-3">Cash & Bank</td><td class="px-4 py-3 text-right">INR 2,84,00,000</td><td class="px-4 py-3 text-right">-</td></tr>
          <tr><td class="px-4 py-3">Accounts Receivable</td><td class="px-4 py-3 text-right">INR 1,12,00,000</td><td class="px-4 py-3 text-right">-</td></tr>
          <tr><td class="px-4 py-3">Revenue</td><td class="px-4 py-3 text-right">-</td><td class="px-4 py-3 text-right">INR 6,74,00,000</td></tr>
          <tr><td class="px-4 py-3">Operating Expenses</td><td class="px-4 py-3 text-right">INR 2,19,00,000</td><td class="px-4 py-3 text-right">-</td></tr>
          <tr><td class="px-4 py-3">Accounts Payable</td><td class="px-4 py-3 text-right">-</td><td class="px-4 py-3 text-right">INR 98,00,000</td></tr>
          <tr class="bg-slate-50">
            <td class="px-4 py-3 font-semibold text-slate-900">Total</td>
            <td class="px-4 py-3 text-right font-semibold text-slate-900">INR 9,89,00,000</td>
            <td class="px-4 py-3 text-right font-semibold text-slate-900">INR 9,89,00,000</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</x-Account-sidebar>
