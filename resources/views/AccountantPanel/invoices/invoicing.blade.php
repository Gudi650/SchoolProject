<x-Account-sidebar>
  <x-slot name="title">Invoicing Management</x-slot>
 
    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <!-- Header -->
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Invoicing & Billing</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Create, manage, and track invoices</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Send Reminders</span>
                <span class="sm:hidden">Reminders</span>
              </button>

              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Export</span>
                <span class="sm:hidden">Export</span>
              </button>

              <a href="{{ route('accounting.createInvoice') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Create Invoice
              </a>

            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="file-text" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Invoices</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">1,248</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">This year</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Paid Invoices</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹52.5L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">1,092 invoices</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Amount</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹7.5L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">126 invoices</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-red-100">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Overdue Amount</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.8L</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2">30 invoices</p>
          </div>
        </div>

        <!-- Invoice Templates -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Invoice Templates
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <button class="p-4 bg-white border border-indigo-200 rounded-lg hover:border-indigo-400 hover:shadow-md transition-all text-left hover:bg-indigo-50">
              <h3 class="font-semibold text-slate-900 mb-1">Tuition Fee Invoice</h3>
              <p class="text-sm text-slate-600">Standard tuition fee billing template</p>
            </button>
            <button class="p-4 bg-white border border-indigo-200 rounded-lg hover:border-indigo-400 hover:shadow-md transition-all text-left hover:bg-indigo-50">
              <h3 class="font-semibold text-slate-900 mb-1">Transport Fee Invoice</h3>
              <p class="text-sm text-slate-600">Monthly transport fee template</p>
            </button>
            <button class="p-4 bg-white border border-indigo-200 rounded-lg hover:border-indigo-400 hover:shadow-md transition-all text-left hover:bg-indigo-50">
              <h3 class="font-semibold text-slate-900 mb-1">Hostel Fee Invoice</h3>
              <p class="text-sm text-slate-600">Hostel accommodation billing</p>
            </button>
          </div>
        </div>

        <!-- Invoices Table -->
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Recent Invoices
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Invoice ID</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Date</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden sm:table-cell">Customer</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden md:table-cell">Items</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Amount</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden md:table-cell">Due Date</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Status</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden lg:table-cell">Paid Date</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-001</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-15</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Rahul Sharma (Class 10-A)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition Fee - Q4</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹15,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-20</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">2024-01-15</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-002</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-14</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Priya Patel (Class 9-B)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition + Transport</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹20,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-19</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700 font-medium">Partial</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">-</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-003</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-14</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Amit Kumar (Class 10-A)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition Fee - Q4</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹15,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-14</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">Overdue</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">-</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-004</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-13</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Sneha Reddy (Class 8-C)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Hostel + Tuition</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹35,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-18</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">2024-01-13</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-005</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-12</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Arjun Singh (Class 9-A)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition Fee - Q4</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹15,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-17</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-700 font-medium">Pending</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">-</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-006</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-12</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Kavya Iyer (Class 10-B)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition + Library</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹16,500</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-17</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">2024-01-12</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-007</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-11</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Rohan Gupta (Class 7-A)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Tuition Fee - Q4</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹12,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-11</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">Overdue</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">-</td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">INV-2024-008</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-10</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Ananya Das (Class 9-C)</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">Transport Fee</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹5,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-15</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">2024-01-10</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>