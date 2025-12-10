<x-Account-sidebar>
  <x-slot name="title">Banking And Cash Management</x-slot>
 
    <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Banking & Cash Management</h1>
              <p class="text-sm text-slate-600 mt-1">Manage bank accounts, transactions, and cash flow</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                Reconcile
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Transaction
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
            <p class="text-blue-100 text-sm mb-1">Total Bank Balance</p>
            <p class="text-3xl font-bold">₹21.5L</p>
            <p class="text-blue-100 text-sm mt-2">Across 3 accounts</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Cash in Hand</p>
            <p class="text-2xl font-bold text-slate-900">₹2.85L</p>
            <p class="text-sm text-green-600 mt-2">As of today</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Today's Deposits</p>
            <p class="text-2xl font-bold text-slate-900">₹2.45L</p>
            <p class="text-sm text-slate-600 mt-2">3 transactions</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Reconciliation</p>
            <p class="text-2xl font-bold text-slate-900">5</p>
            <p class="text-sm text-amber-600 mt-2">Requires attention</p>
          </div>
        </div>

        <!-- Bank Accounts -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Bank Accounts</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Bank Name</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Account Number</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Account Type</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Balance</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Last Updated</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">State Bank of India</td>
                    <td class="px-4 py-3">****5678</td>
                    <td class="px-4 py-3">Current</td>
                    <td class="px-4 py-3 font-semibold text-green-600">₹12,50,000</td>
                    <td class="px-4 py-3">2024-01-15 10:30 AM</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">HDFC Bank</td>
                    <td class="px-4 py-3">****9012</td>
                    <td class="px-4 py-3">Savings</td>
                    <td class="px-4 py-3 font-semibold text-green-600">₹5,80,000</td>
                    <td class="px-4 py-3">2024-01-15 09:15 AM</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">ICICI Bank</td>
                    <td class="px-4 py-3">****3456</td>
                    <td class="px-4 py-3">Current</td>
                    <td class="px-4 py-3 font-semibold text-green-600">₹3,20,000</td>
                    <td class="px-4 py-3">2024-01-14 05:45 PM</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        

        <!-- Recent Transactions -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Bank Transactions</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Transaction ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Type</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Description</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Account</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Balance</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Reference</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">TXN001</td>
                    <td class="px-4 py-3">2024-01-15</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Credit</span></td>
                    <td class="px-4 py-3">Fee Collection Deposit</td>
                    <td class="px-4 py-3">SBI ****5678</td>
                    <td class="px-4 py-3 font-semibold text-green-600">+₹2,45,000</td>
                    <td class="px-4 py-3">₹12,50,000</td>
                    <td class="px-4 py-3">DEP/2024/001</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">TXN002</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Debit</span></td>
                    <td class="px-4 py-3">Salary Payment</td>
                    <td class="px-4 py-3">SBI ****5678</td>
                    <td class="px-4 py-3 font-semibold text-red-600">-₹8,50,000</td>
                    <td class="px-4 py-3">₹10,05,000</td>
                    <td class="px-4 py-3">SAL/2024/001</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">TXN003</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Credit</span></td>
                    <td class="px-4 py-3">Government Grant</td>
                    <td class="px-4 py-3">HDFC ****9012</td>
                    <td class="px-4 py-3 font-semibold text-green-600">+₹5,00,000</td>
                    <td class="px-4 py-3">₹5,80,000</td>
                    <td class="px-4 py-3">GRT/2024/005</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        

        <!-- Cash Book -->
        <div>
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Cash Book (Last 4 Days)</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Opening Balance</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Cash Received</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Cash Paid</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Closing Balance</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Verified By</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50"><td class="px-4 py-3">2024-01-15</td><td class="px-4 py-3">₹1,25,000</td><td class="px-4 py-3 text-green-600">+₹2,45,000</td><td class="px-4 py-3 text-red-600">-₹85,000</td><td class="px-4 py-3 font-semibold">₹2,85,000</td><td class="px-4 py-3">Cashier</td></tr>
                  <tr class="hover:bg-slate-50"><td class="px-4 py-3">2024-01-14</td><td class="px-4 py-3">₹98,000</td><td class="px-4 py-3 text-green-600">+₹1,80,000</td><td class="px-4 py-3 text-red-600">-₹1,53,000</td><td class="px-4 py-3 font-semibold">₹1,25,000</td><td class="px-4 py-3">Cashier</td></tr>
                  <tr class="hover:bg-slate-50"><td class="px-4 py-3">2024-01-13</td><td class="px-4 py-3">₹1,45,000</td><td class="px-4 py-3 text-green-600">+₹1,65,000</td><td class="px-4 py-3 text-red-600">-₹2,12,000</td><td class="px-4 py-3 font-semibold">₹98,000</td><td class="px-4 py-3">Cashier</td></tr>
                  <tr class="hover:bg-slate-50"><td class="px-4 py-3">2024-01-12</td><td class="px-4 py-3">₹1,12,000</td><td class="px-4 py-3 text-green-600">+₹2,20,000</td><td class="px-4 py-3 text-red-600">-₹1,87,000</td><td class="px-4 py-3 font-semibold">₹1,45,000</td><td class="px-4 py-3">Cashier</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>