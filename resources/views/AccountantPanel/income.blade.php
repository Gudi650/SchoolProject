<x-Account-sidebar>
  <x-slot name="title">Income Management</x-slot>

    <main class="p-6 bg-white">
        <!-- Page header (title + actions) -->
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Income Management</h1>
              <p class="text-sm text-slate-600 mt-1">Track and manage all revenue streams</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-4 h-4"></i>
                Analytics
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Record Income
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white">
            <p class="text-green-100 text-sm mb-1">Total Income (This Month)</p>
            <p class="text-3xl font-bold">₹69.2L</p>
            <p class="text-green-100 text-sm mt-2">+12.5% from last month</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Today's Collection</p>
            <p class="text-2xl font-bold text-slate-900">₹2.45L</p>
            <p class="text-sm text-green-600 mt-2">18 transactions</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Receipts</p>
            <p class="text-2xl font-bold text-slate-900">₹1.8L</p>
            <p class="text-sm text-amber-600 mt-2">5 pending</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Average Daily Income</p>
            <p class="text-2xl font-bold text-slate-900">₹2.3L</p>
            <p class="text-sm text-slate-600 mt-2">Last 30 days</p>
          </div>
        </div>

        <!-- Income by Category -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Income by Category (This Month)</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0 isolate px-4 md:px-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Income Category</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Total Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Share</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Transactions</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">Tuition Fee</td>
                    <td class="px-4 py-3 font-semibold">₹45,00,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-blue-500 h-2 rounded-full" style="width:65%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-12">65%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">1248</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">Transport Fee</td>
                    <td class="px-4 py-3 font-semibold">₹8,50,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-blue-500 h-2 rounded-full" style="width:12%"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-700 w-12">12%</span>
                      </div>
                    </td>
                    <td class="px-4 py-3">420</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">Hostel Fee</td>
                    <td class="px-4 py-3 font-semibold">₹7,20,000</td>
                    <td class="px-4 py-3 w-64">
                      <div class="flex items-center gap-3">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                          <div class="bg-blue-500 h-2 rounded-full" style="width:10%"></div>
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
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Income Transactions</h2>
            <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0 isolate px-4 md:px-0">
                <table class="w-full text-left text-sm relative z-0">
                  <thead class="bg-slate-50">
                    <tr>
                      <th class="px-4 py-3 font-medium text-slate-700">Income ID</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Category</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Source</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Mode</th>
                      <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y">
                    <tr class="hover:bg-slate-50">
                      <td class="px-4 py-3">INC001</td>
                      <td class="px-4 py-3">2024-01-15</td>
                      <td class="px-4 py-3">Tuition Fee</td>
                      <td class="px-4 py-3">Class 10-A Students</td>
                      <td class="px-4 py-3 font-semibold text-green-600">₹4,50,000</td>
                      <td class="px-4 py-3">Online</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Received</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                      <td class="px-4 py-3">INC002</td>
                      <td class="px-4 py-3">2024-01-14</td>
                      <td class="px-4 py-3">Transport Fee</td>
                      <td class="px-4 py-3">Monthly Collection</td>
                      <td class="px-4 py-3 font-semibold text-green-600">₹1,25,000</td>
                      <td class="px-4 py-3">Cash</td>
                      <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Received</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50">
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