<x-Account-sidebar>
  <x-slot name="title">Vendor Management</x-slot>
 
    <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Vendor Management</h1>
              <p class="text-sm text-slate-600 mt-1">Manage vendors, suppliers, and payment tracking</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="phone" class="w-4 h-4"></i>
                Contact Vendor
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Vendor
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Total Vendors</p>
            <p class="text-2xl font-bold text-slate-900">47</p>
            <p class="text-sm text-green-600 mt-2">42 active</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Total Payables</p>
            <p class="text-2xl font-bold text-slate-900">₹3.05L</p>
            <p class="text-sm text-amber-600 mt-2">Outstanding amount</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Paid This Month</p>
            <p class="text-2xl font-bold text-slate-900">₹8.5L</p>
            <p class="text-sm text-slate-600 mt-2">24 payments</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending Payments</p>
            <p class="text-2xl font-bold text-slate-900">₹1.53L</p>
            <p class="text-sm text-red-600 mt-2">2 pending</p>
          </div>
        </div>

        <!-- Vendors Table -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">All Vendors</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Vendor ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Vendor Name</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Category</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Contact</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Email</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Total Paid</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Outstanding</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Last Payment</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">VEN001</td>
                    <td class="px-4 py-3">ABC Furniture</td>
                    <td class="px-4 py-3">Furniture</td>
                    <td class="px-4 py-3">+91 98765 43210</td>
                    <td class="px-4 py-3">contact@abcfurniture.com</td>
                    <td class="px-4 py-3">₹4,50,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹28,000</td>
                    <td class="px-4 py-3">2024-01-13</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">VEN002</td>
                    <td class="px-4 py-3">Scientific Supplies Co</td>
                    <td class="px-4 py-3">Laboratory</td>
                    <td class="px-4 py-3">+91 98765 43211</td>
                    <td class="px-4 py-3">sales@scisupplies.com</td>
                    <td class="px-4 py-3">₹8,50,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹1,25,000</td>
                    <td class="px-4 py-3">2024-01-10</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">VEN003</td>
                    <td class="px-4 py-3">Office Mart</td>
                    <td class="px-4 py-3">Stationery</td>
                    <td class="px-4 py-3">+91 98765 43212</td>
                    <td class="px-4 py-3">info@officemart.com</td>
                    <td class="px-4 py-3">₹2,80,000</td>
                    <td class="px-4 py-3 text-green-600 font-medium">Cleared</td>
                    <td class="px-4 py-3">2024-01-12</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">VEN004</td>
                    <td class="px-4 py-3">Book Distributors Ltd</td>
                    <td class="px-4 py-3">Books</td>
                    <td class="px-4 py-3">+91 98765 43213</td>
                    <td class="px-4 py-3">orders@bookdist.com</td>
                    <td class="px-4 py-3">₹5,20,000</td>
                    <td class="px-4 py-3 text-red-600 font-medium">₹42,000</td>
                    <td class="px-4 py-3">2024-01-10</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        <!-- Payment History -->
        <div>
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Payments</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Payment ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Date</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Vendor</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Invoice No.</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Payment Mode</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">PAY001</td>
                    <td class="px-4 py-3">2024-01-14</td>
                    <td class="px-4 py-3">State Electricity Board</td>
                    <td class="px-4 py-3">INV-2024-045</td>
                    <td class="px-4 py-3 font-semibold">₹45,000</td>
                    <td class="px-4 py-3">Online</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">PAY002</td>
                    <td class="px-4 py-3">2024-01-13</td>
                    <td class="px-4 py-3">ABC Furniture</td>
                    <td class="px-4 py-3">INV-2024-038</td>
                    <td class="px-4 py-3 font-semibold">₹28,000</td>
                    <td class="px-4 py-3">Cheque</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">PAY003</td>
                    <td class="px-4 py-3">2024-01-12</td>
                    <td class="px-4 py-3">Office Mart</td>
                    <td class="px-4 py-3">INV-2024-032</td>
                    <td class="px-4 py-3 font-semibold">₹15,000</td>
                    <td class="px-4 py-3">Bank Transfer</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Paid</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>