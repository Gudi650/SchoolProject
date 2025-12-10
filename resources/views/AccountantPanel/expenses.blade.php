<x-Account-sidebar>
  <x-slot name="title">Expenses Management</x-slot>

    <main class="p-6 bg-white">
        <!-- Page header (title + actions) -->
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Expense Management</h1>
              <p class="text-sm text-slate-600 mt-1">Track and manage all school expenses</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                Pending Approvals
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Record Expense
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white">
            <p class="text-red-100 text-sm mb-1">Total Expenses (This Month)</p>
            <p class="text-3xl font-bold">₹42.8L</p>
            <p class="text-red-100 text-sm mt-2">+8.3% from last month</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Payments</p>
            <p class="text-2xl font-bold text-slate-900">₹1.2L</p>
            <p class="text-sm text-amber-600 mt-2">8 pending</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Approvals</p>
            <p class="text-2xl font-bold text-slate-900">₹3.5L</p>
            <p class="text-sm text-blue-600 mt-2">5 awaiting approval</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Average Daily Expense</p>
            <p class="text-2xl font-bold text-slate-900">₹1.4L</p>
            <p class="text-sm text-slate-600 mt-2">Last 30 days</p>
          </div>
        </div>

        <!-- Budget Utilization -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Budget Utilization (This Month)</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Category</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Budget</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Spent</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Remaining</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Utilization</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">Salary &amp; Wages</td>
                    <td class="px-4 py-3">₹50,00,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹42,00,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">₹8,00,000</td>
                    <td class="px-4 py-3 w-64"><div class="flex items-center gap-3"><div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-red-500" style="width:84%"></div></div><span class="text-sm font-medium text-slate-700 w-12">84%</span></div></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">Utilities</td>
                    <td class="px-4 py-3">₹3,00,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹2,45,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">₹55,000</td>
                    <td class="px-4 py-3 w-64"><div class="flex items-center gap-3"><div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 rounded-full bg-amber-500" style="width:82%"></div></div><span class="text-sm font-medium text-slate-700 w-12">82%</span></div></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
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
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Expenses</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Expense ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Category</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Description</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Vendor</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Approved By</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EXP001</td>
                    <td class="px-4 py-3">2024-01-15</td>
                    <td class="px-4 py-3">Salary</td>
                    <td class="px-4 py-3">Teaching Staff Salary - January</td>
                    <td class="px-4 py-3">Payroll</td>
                    <td class="px-4 py-3 font-semibold text-red-600">₹8,50,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                    <td class="px-4 py-3">Principal</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EXP002</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3">Utilities</td>
                    <td class="px-4 py-3">Electricity Bill - December</td>
                    <td class="px-4 py-3">State Electricity Board</td>
                    <td class="px-4 py-3 font-semibold text-red-600">₹45,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                    <td class="px-4 py-3">Admin Head</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
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