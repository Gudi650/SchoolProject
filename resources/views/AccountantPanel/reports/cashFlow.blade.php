<x-Account-sidebar>
  <x-slot name="title">Cash Flow Statement</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Cash Flow Statement</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Track operating, investing, and financing cash movement.</p>
        </div>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
          <i data-lucide="download" class="w-4 h-4"></i>
          Download Statement
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white rounded-xl border border-green-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Net Operating Cash</p><p class="text-2xl font-bold text-green-700 mt-1">INR 1.86Cr</p></div>
      <div class="bg-white rounded-xl border border-amber-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Net Investing Cash</p><p class="text-2xl font-bold text-amber-700 mt-1">INR -42.0L</p></div>
      <div class="bg-white rounded-xl border border-indigo-100 p-4 shadow-sm"><p class="text-xs text-slate-500">Net Financing Cash</p><p class="text-2xl font-bold text-slate-900 mt-1">INR 18.5L</p></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-indigo-50 border-b border-indigo-100">
          <tr>
            <th class="px-4 py-3 text-left font-medium text-indigo-900">Section</th>
            <th class="px-4 py-3 text-left font-medium text-indigo-900">Line Item</th>
            <th class="px-4 py-3 text-right font-medium text-indigo-900">Amount</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr><td class="px-4 py-3 font-medium">Operating</td><td class="px-4 py-3">Cash received from students</td><td class="px-4 py-3 text-right text-green-700">INR 2,54,00,000</td></tr>
          <tr><td class="px-4 py-3"></td><td class="px-4 py-3">Cash paid to suppliers and staff</td><td class="px-4 py-3 text-right text-red-600">INR -68,00,000</td></tr>
          <tr><td class="px-4 py-3 font-medium">Investing</td><td class="px-4 py-3">Lab equipment purchase</td><td class="px-4 py-3 text-right text-red-600">INR -42,00,000</td></tr>
          <tr><td class="px-4 py-3 font-medium">Financing</td><td class="px-4 py-3">Loan inflow (net)</td><td class="px-4 py-3 text-right text-slate-900">INR 18,50,000</td></tr>
          <tr class="bg-slate-50"><td class="px-4 py-3 font-semibold" colspan="2">Net Increase in Cash</td><td class="px-4 py-3 text-right font-semibold text-slate-900">INR 1,62,50,000</td></tr>
        </tbody>
      </table>
    </div>
  </main>
</x-Account-sidebar>
