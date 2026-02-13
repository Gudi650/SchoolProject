<x-Account-sidebar>
  <x-slot name="title">Vendor Management</x-slot>
 
    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <!-- Header -->
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Vendor Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Manage vendors, suppliers, and payment tracking</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-2">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="phone" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Contact Vendor</span>
                <span class="sm:hidden">Contact</span>
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Export</span>
                <span class="sm:hidden">Export</span>
              </button>
              <a href="{{ route('accounting.createVendor') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Vendor
              </a>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="users" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Vendors</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">47</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2 font-medium">42 active</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="credit-card" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Payables</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹3.05L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2 font-medium">Outstanding amount</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="trending-up" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Paid This Month</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹8.5L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2 font-medium">24 payments</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-red-100">
                <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending Payments</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.53L</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2 font-medium">2 pending</p>
          </div>
        </div>

        <!-- Vendors Table -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            All Vendors
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Vendor ID</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Vendor Name</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden sm:table-cell">Category</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden lg:table-cell">Contact</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden lg:table-cell">Email</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Total Paid</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Outstanding</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden md:table-cell">Last Payment</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">VEN001</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">ABC Furniture</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Furniture</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">+91 98765 43210</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">contact@abcfurniture.com</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">₹4,50,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-red-600 font-medium">₹28,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-13</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">VEN002</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">Scientific Supplies Co</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Laboratory</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">+91 98765 43211</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">sales@scisupplies.com</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">₹8,50,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-red-600 font-medium">₹1,25,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-10</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">VEN003</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">Office Mart</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Stationery</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">+91 98765 43212</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">info@officemart.com</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">₹2,80,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-green-600 font-medium">Cleared</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-12</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">VEN004</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">Book Distributors Ltd</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Books</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">+91 98765 43213</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">orders@bookdist.com</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">₹5,20,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm text-red-600 font-medium">₹42,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">2024-01-10</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        <!-- Payment History -->
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Recent Payments
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Payment ID</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Date</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden sm:table-cell">Vendor</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden md:table-cell">Invoice No.</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Amount</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900 hidden lg:table-cell">Payment Mode</th>
                    <th class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium text-indigo-900">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">PAY001</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-14</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">State Electricity Board</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">INV-2024-045</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹45,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">Online</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">PAY002</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-13</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">ABC Furniture</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">INV-2024-038</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹28,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">Cheque</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">PAY003</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">2024-01-12</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">Office Mart</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">INV-2024-032</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-semibold">₹15,000</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">Bank Transfer</td>
                    <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>