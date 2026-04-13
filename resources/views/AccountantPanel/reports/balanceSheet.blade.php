<x-Account-sidebar>
  <x-slot name="title">Balance Sheet</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Balance Sheet</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Snapshot of assets, liabilities, and equity for the selected period.</p>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
            <i data-lucide="calendar-range" class="w-4 h-4"></i>
            As of Date
          </button>
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
            <i data-lucide="download" class="w-4 h-4"></i>
            Export PDF
          </button>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white rounded-xl border border-indigo-100 p-4 shadow-sm">
        <p class="text-xs text-slate-500">Total Assets</p>
        <p class="text-2xl font-bold text-slate-900 mt-1">INR 12.48Cr</p>
      </div>
      <div class="bg-white rounded-xl border border-amber-100 p-4 shadow-sm">
        <p class="text-xs text-slate-500">Total Liabilities</p>
        <p class="text-2xl font-bold text-slate-900 mt-1">INR 4.21Cr</p>
      </div>
      <div class="bg-white rounded-xl border border-green-100 p-4 shadow-sm">
        <p class="text-xs text-slate-500">Net Worth (Equity)</p>
        <p class="text-2xl font-bold text-green-700 mt-1">INR 8.27Cr</p>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <div class="px-4 py-3 border-b border-slate-100">
          <h2 class="text-base font-semibold text-slate-900">Assets</h2>
        </div>
        <table class="w-full text-sm">
          <tbody class="divide-y divide-slate-100">
            <tr><td class="px-4 py-3 text-slate-600">Cash & Bank</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 2,84,00,000</td></tr>
            <tr><td class="px-4 py-3 text-slate-600">Accounts Receivable</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 1,12,00,000</td></tr>
            <tr><td class="px-4 py-3 text-slate-600">Fixed Assets</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 8,52,00,000</td></tr>
            <tr class="bg-slate-50"><td class="px-4 py-3 font-semibold text-slate-900">Total Assets</td><td class="px-4 py-3 text-right font-semibold text-slate-900">INR 12,48,00,000</td></tr>
          </tbody>
        </table>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <div class="px-4 py-3 border-b border-slate-100">
          <h2 class="text-base font-semibold text-slate-900">Liabilities & Equity</h2>
        </div>
        <table class="w-full text-sm">
          <tbody class="divide-y divide-slate-100">
            <tr><td class="px-4 py-3 text-slate-600">Accounts Payable</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 98,00,000</td></tr>
            <tr><td class="px-4 py-3 text-slate-600">Long-term Liabilities</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 3,23,00,000</td></tr>
            <tr><td class="px-4 py-3 text-slate-600">Retained Earnings & Capital</td><td class="px-4 py-3 text-right font-medium text-slate-900">INR 8,27,00,000</td></tr>
            <tr class="bg-slate-50"><td class="px-4 py-3 font-semibold text-slate-900">Total Liabilities + Equity</td><td class="px-4 py-3 text-right font-semibold text-slate-900">INR 12,48,00,000</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-Account-sidebar>
