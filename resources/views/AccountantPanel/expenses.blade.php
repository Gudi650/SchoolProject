<x-Account-sidebar>
  <x-slot name="title">Expenses Management</x-slot>

    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <!-- Page header (title + actions) -->
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Expense Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Track and manage all school expenses</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                Pending Approvals
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Record Expense
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
              <p class="text-xs sm:text-sm text-slate-600">Total Expenses (This Month)</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹42.8L</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2">+8.3% from last month</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Payments</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.2L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">8 pending</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="alert-circle" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Approvals</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹3.5L</p>
            <p class="text-xs sm:text-sm text-indigo-600 mt-2">5 awaiting approval</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Average Daily Expense</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.4L</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">Last 30 days</p>
          </div>
        </div>

        <!-- Budget Utilization -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Budget Utilization (This Month)
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Budget</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Spent</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Utilization</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Salary &amp; Wages</td>
                    <td class="px-4 py-3">₹50,00,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹42,00,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">₹8,00,000</td>
                    <td class="px-4 py-3 w-64"><div class="flex items-center gap-3"><div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-red-500" style="width:84%"></div></div><span class="text-sm font-medium text-slate-700 w-12">84%</span></div></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Utilities</td>
                    <td class="px-4 py-3">₹3,00,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹2,45,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">₹55,000</td>
                    <td class="px-4 py-3 w-64"><div class="flex items-center gap-3"><div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-amber-500" style="width:82%"></div></div><span class="text-sm font-medium text-slate-700 w-12">82%</span></div></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">Maintenance</td>
                    <td class="px-4 py-3">₹4,00,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹3,20,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">₹80,000</td>
                    <td class="px-4 py-3 w-64"><div class="flex items-center gap-3"><div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-amber-500" style="width:80%"></div></div><span class="text-sm font-medium text-slate-700 w-12">80%</span></div></td>
                  </tr>
                </tbody>
              </table>
            </div>

        <!-- Recent Expenses -->
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Recent Expenses
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Expense ID</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Description</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Vendor</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Approved By</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">EXP001</td>
                    <td class="px-4 py-3">2024-01-15</td>
                    <td class="px-4 py-3">Salary</td>
                    <td class="px-4 py-3">Teaching Staff Salary - January</td>
                    <td class="px-4 py-3">Payroll</td>
                    <td class="px-4 py-3 font-semibold text-red-600">₹8,50,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                    <td class="px-4 py-3">Principal</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">EXP002</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3">Utilities</td>
                    <td class="px-4 py-3">Electricity Bill - December</td>
                    <td class="px-4 py-3">State Electricity Board</td>
                    <td class="px-4 py-3 font-semibold text-red-600">₹45,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                    <td class="px-4 py-3">Admin Head</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">EXP003</td>
                    <td class="px-4 py-3">2024-01-13</td>
                    <td class="px-4 py-3">Maintenance</td>
                    <td class="px-4 py-3">Classroom Furniture Repair</td>
                    <td class="px-4 py-3">ABC Furniture</td>
                    <td class="px-4 py-3 font-semibold text-red-600">₹28,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
                    <td class="px-4 py-3">Maintenance Head</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>