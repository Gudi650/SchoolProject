<x-Account-sidebar>
  <x-slot name="title">Fee Management</x-slot>
    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <!-- Page header (title + actions) -->
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between items-start gap-4">
            <div class="sm:flex-1">
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Fee Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Manage fee collection, structure, and student payments</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
              <button class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 justify-center shadow-sm">
                <i data-lucide="filter" class="w-4 h-4"></i>
                <span>Filter</span>
              </button>

              <button class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 justify-center shadow-sm">
                <i data-lucide="download" class="w-4 h-4"></i>
                <span>Export</span>
              </button>

              <div class="w-full sm:w-auto">
                <button class="w-full sm:w-auto px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center shadow-sm">
                  <i data-lucide="plus" class="w-4 h-4"></i>
                  <span>Record Payment</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Summary cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Collected (This Month)</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹52.5L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">+15.3% from last month</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Fees</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹7.5L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">30 students</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-red-100">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Overdue Payments</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.8L</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2">12 students</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <p class="text-xs sm:text-sm text-slate-600 mb-1">Collection Rate</p>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">87.5%</p>
            <button class="mt-2 text-xs sm:text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1">
              <i data-lucide="send" class="w-4 h-4"></i>
              Send Reminders
            </button>
          </div>
        </div>

        <!-- Page-level search (responsive) -->
        <div class="mb-4">
          <div class="w-full max-w-4xl">
            <label for="page-search" class="sr-only">Search fees</label>
            <div class="relative">
              <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
              <input id="page-search" type="search" placeholder="Search fees, students, fee IDs, classes..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
          </div>
        </div>

        <!-- Completed Fees Table -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
            Completed Fees
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Fee ID</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Student</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Class</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Fee Type</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Paid</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">FEE001</td>
                  <td class="px-4 py-3">Rahul Sharma</td>
                  <td class="px-4 py-3">10-A</td>
                  <td class="px-4 py-3">Tuition</td>
                  <td class="px-4 py-3">₹15,000</td>
                  <td class="px-4 py-3 text-green-600 font-medium">₹15,000</td>
                  <td class="px-4 py-3"><span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Paid</span></td>
                  <td class="px-4 py-3">2024-01-15</td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">FEE004</td>
                  <td class="px-4 py-3">Sneha Reddy</td>
                  <td class="px-4 py-3">8-C</td>
                  <td class="px-4 py-3">Hostel + Tuition</td>
                  <td class="px-4 py-3">₹35,000</td>
                  <td class="px-4 py-3 text-green-600 font-medium">₹35,000</td>
                  <td class="px-4 py-3"><span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">Paid</span></td>
                  <td class="px-4 py-3">2024-01-12</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Incomplete Fees Table -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600"></i>
            Incomplete Fees
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Fee ID</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Student</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Class</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Fee Type</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Paid</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Pending</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">FEE002</td>
                  <td class="px-4 py-3">Priya Patel</td>
                  <td class="px-4 py-3">9-B</td>
                  <td class="px-4 py-3">Tuition + Transport</td>
                  <td class="px-4 py-3">₹20,000</td>
                  <td class="px-4 py-3 text-green-600 font-medium">₹10,000</td>
                  <td class="px-4 py-3 text-red-600 font-medium">₹10,000</td>
                  <td class="px-4 py-3"><span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-xs rounded-full">Partial</span></td>
                  <td class="px-4 py-3">2024-01-14</td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">FEE003</td>
                  <td class="px-4 py-3">Amit Kumar</td>
                  <td class="px-4 py-3">10-A</td>
                  <td class="px-4 py-3">Tuition</td>
                  <td class="px-4 py-3">₹15,000</td>
                  <td class="px-4 py-3">₹0</td>
                  <td class="px-4 py-3 text-red-600 font-medium">₹15,000</td>
                  <td class="px-4 py-3"><span class="px-2 py-0.5 bg-slate-100 text-slate-700 text-xs rounded-full">Pending</span></td>
                  <td class="px-4 py-3">2024-01-10</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </main>
      
      @include('AccountantPanel.fees.feeStructureModal')

</x-Account-sidebar>