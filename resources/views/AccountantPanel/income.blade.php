<x-Account-sidebar>
  <x-slot name="title">Income Management</x-slot>

    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <!-- Page header (title + actions) -->
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Income Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Track and manage all revenue streams</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="pie-chart" class="w-4 h-4"></i>
                Analytics
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Record Income
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Income (This Month)</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹69.2L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">+12.5% from last month</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Today's Collection</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.45L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">18 transactions</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Receipts</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.8L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">5 pending</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Average Daily Income</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.3L</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Last 30 days</p>
          </div>
        </div>

        <!-- Income by Category -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Income by Category (This Month)
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Income Category</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Total Amount</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Share</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Transactions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Tuition Fee</td>
                    <td class="px-4 py-3 font-semibold">₹45,00,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-indigo-500 h-2 rounded-full" style="width:65%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-12">65%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">1248</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Transport Fee</td>
                    <td class="px-4 py-3 font-semibold">₹8,50,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-indigo-500 h-2 rounded-full" style="width:12%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-12">12%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">420</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Hostel Fee</td>
                    <td class="px-4 py-3 font-semibold">₹7,20,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-indigo-500 h-2 rounded-full" style="width:10%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-12">10%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">180</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Recent Income Transactions -->
          <div class="">
            <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
              <span class="w-1 h-6 bg-indigo-600 rounded"></span>
              Recent Income Transactions
            </h2>
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
                <table class="w-full text-left text-sm relative z-0">
                  <thead class="bg-indigo-50 border-b border-indigo-100">
                    <tr>
                      <th class="px-4 py-3 font-medium text-indigo-900">Income ID</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Source</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Mode</th>
                      <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-indigo-50 transition-colors">
                      <td class="px-4 py-3">INC001</td>
                      <td class="px-4 py-3">2024-01-15</td>
                      <td class="px-4 py-3">Tuition Fee</td>
                      <td class="px-4 py-3">Class 10-A Students</td>
                      <td class="px-4 py-3 font-semibold text-green-600">₹4,50,000</td>
                      <td class="px-4 py-3">Online</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Received</span></td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition-colors">
                      <td class="px-4 py-3">INC002</td>
                      <td class="px-4 py-3">2024-01-14</td>
                      <td class="px-4 py-3">Transport Fee</td>
                      <td class="px-4 py-3">Monthly Collection</td>
                      <td class="px-4 py-3 font-semibold text-green-600">₹1,25,000</td>
                      <td class="px-4 py-3">Cash</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Received</span></td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition-colors">
                      <td class="px-4 py-3">INC003</td>
                      <td class="px-4 py-3">2024-01-14</td>
                      <td class="px-4 py-3">Hostel Fee</td>
                      <td class="px-4 py-3">Hostel Students</td>
                      <td class="px-4 py-3 font-semibold text-green-600">₹3,80,000</td>
                      <td class="px-4 py-3">Bank Transfer</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Received</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </main>
 
</x-Account-sidebar>