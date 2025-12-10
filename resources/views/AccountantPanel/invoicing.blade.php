<x-Account-sidebar>
  <x-slot name="title">Invoicing Management</x-slot>
 
    <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Invoicing & Billing</h1>
              <p class="text-sm text-slate-600 mt-1">Create, manage, and track invoices</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                Send Reminders
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Create Invoice
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Total Invoices</p>
            <p class="text-2xl font-bold text-slate-900">1,248</p>
            <p class="text-sm text-slate-600 mt-2">This year</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Paid Invoices</p>
            <p class="text-2xl font-bold text-slate-900">₹52.5L</p>
            <p class="text-sm text-green-600 mt-2">1,092 invoices</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Amount</p>
            <p class="text-2xl font-bold text-slate-900">₹7.5L</p>
            <p class="text-sm text-amber-600 mt-2">126 invoices</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Overdue Amount</p>
            <p class="text-2xl font-bold text-slate-900">₹2.8L</p>
            <p class="text-sm text-red-600 mt-2">30 invoices</p>
          </div>
        </div>

        <!-- Invoice Templates -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Invoice Templates</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <h3 class="font-semibold text-slate-900 mb-1">Tuition Fee Invoice</h3>
              <p class="text-sm text-slate-600">Standard tuition fee billing template</p>
            </button>
            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <h3 class="font-semibold text-slate-900 mb-1">Transport Fee Invoice</h3>
              <p class="text-sm text-slate-600">Monthly transport fee template</p>
            </button>
            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <h3 class="font-semibold text-slate-900 mb-1">Hostel Fee Invoice</h3>
              <p class="text-sm text-slate-600">Hostel accommodation billing</p>
            </button>
          </div>
        </div>

        <!-- Invoices Table -->
        <div>
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Invoices</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Invoice ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Customer</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Items</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Due Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Paid Date</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-001</td>
                    <td class="px-4 py-3">2024-01-15</td>
                    <td class="px-4 py-3">Rahul Sharma (Class 10-A)</td>
                    <td class="px-4 py-3">Tuition Fee - Q4</td>
                    <td class="px-4 py-3 font-semibold">₹15,000</td>
                    <td class="px-4 py-3">2024-01-20</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-4 py-3">2024-01-15</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-002</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3">Priya Patel (Class 9-B)</td>
                    <td class="px-4 py-3">Tuition + Transport</td>
                    <td class="px-4 py-3 font-semibold">₹20,000</td>
                    <td class="px-4 py-3">2024-01-19</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700 font-medium">Partial</span></td>
                    <td class="px-4 py-3">-</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-003</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3">Amit Kumar (Class 10-A)</td>
                    <td class="px-4 py-3">Tuition Fee - Q4</td>
                    <td class="px-4 py-3 font-semibold">₹15,000</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">Overdue</span></td>
                    <td class="px-4 py-3">-</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-004</td>
                    <td class="px-4 py-3">2024-01-13</td>
                    <td class="px-4 py-3">Sneha Reddy (Class 8-C)</td>
                    <td class="px-4 py-3">Hostel + Tuition</td>
                    <td class="px-4 py-3 font-semibold">₹35,000</td>
                    <td class="px-4 py-3">2024-01-18</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-4 py-3">2024-01-13</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-005</td>
                    <td class="px-4 py-3">2024-01-12</td>
                    <td class="px-4 py-3">Arjun Singh (Class 9-A)</td>
                    <td class="px-4 py-3">Tuition Fee - Q4</td>
                    <td class="px-4 py-3 font-semibold">₹15,000</td>
                    <td class="px-4 py-3">2024-01-17</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-700 font-medium">Pending</span></td>
                    <td class="px-4 py-3">-</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-006</td>
                    <td class="px-4 py-3">2024-01-12</td>
                    <td class="px-4 py-3">Kavya Iyer (Class 10-B)</td>
                    <td class="px-4 py-3">Tuition + Library</td>
                    <td class="px-4 py-3 font-semibold">₹16,500</td>
                    <td class="px-4 py-3">2024-01-17</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-4 py-3">2024-01-12</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-007</td>
                    <td class="px-4 py-3">2024-01-11</td>
                    <td class="px-4 py-3">Rohan Gupta (Class 7-A)</td>
                    <td class="px-4 py-3">Tuition Fee - Q4</td>
                    <td class="px-4 py-3 font-semibold">₹12,000</td>
                    <td class="px-4 py-3">2024-01-11</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">Overdue</span></td>
                    <td class="px-4 py-3">-</td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">INV-2024-008</td>
                    <td class="px-4 py-3">2024-01-10</td>
                    <td class="px-4 py-3">Ananya Das (Class 9-C)</td>
                    <td class="px-4 py-3">Transport Fee</td>
                    <td class="px-4 py-3 font-semibold">₹5,000</td>
                    <td class="px-4 py-3">2024-01-15</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">Paid</span></td>
                    <td class="px-4 py-3">2024-01-10</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>