<x-Account-sidebar>
  <x-slot name="title">Accountant Dashboard</x-slot>

  <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Payroll Management</h1>
              <p class="text-sm text-slate-600 mt-1">Manage staff salaries, advances, and payroll processing</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                Send Salary Slips
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Process Payroll
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
            <p class="text-purple-100 text-sm mb-1">Total Payroll (This Month)</p>
            <p class="text-3xl font-bold">₹42.5L</p>
            <p class="text-purple-100 text-sm mt-2">85 employees</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Processed</p>
            <p class="text-2xl font-bold text-slate-900">₹38.2L</p>
            <p class="text-sm text-green-600 mt-2">78 employees paid</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Pending</p>
            <p class="text-2xl font-bold text-slate-900">₹4.3L</p>
            <p class="text-sm text-amber-600 mt-2">7 employees pending</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Active Advances</p>
            <p class="text-2xl font-bold text-slate-900">₹2.8L</p>
            <p class="text-sm text-blue-600 mt-2">12 active loans</p>
          </div>
        </div>

        <!-- Payroll Table -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">January 2024 Payroll</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Employee ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Name</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Designation</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Department</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Basic Salary</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Allowances</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Deductions</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Net Salary</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP001</td>
                    <td class="px-4 py-3">Dr. Rajesh Kumar</td>
                    <td class="px-4 py-3">Principal</td>
                    <td class="px-4 py-3">Administration</td>
                    <td class="px-4 py-3">₹1,20,000</td>
                    <td class="px-4 py-3 text-green-600">+₹30,000</td>
                    <td class="px-4 py-3 text-red-600">-₹15,000</td>
                    <td class="px-4 py-3 font-semibold">₹1,35,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP002</td>
                    <td class="px-4 py-3">Mrs. Priya Sharma</td>
                    <td class="px-4 py-3">Senior Teacher</td>
                    <td class="px-4 py-3">Science</td>
                    <td class="px-4 py-3">₹65,000</td>
                    <td class="px-4 py-3 text-green-600">+₹12,000</td>
                    <td class="px-4 py-3 text-red-600">-₹7,500</td>
                    <td class="px-4 py-3 font-semibold">₹69,500</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP003</td>
                    <td class="px-4 py-3">Mr. Amit Patel</td>
                    <td class="px-4 py-3">Teacher</td>
                    <td class="px-4 py-3">Mathematics</td>
                    <td class="px-4 py-3">₹55,000</td>
                    <td class="px-4 py-3 text-green-600">+₹10,000</td>
                    <td class="px-4 py-3 text-red-600">-₹6,500</td>
                    <td class="px-4 py-3 font-semibold">₹58,500</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP004</td>
                    <td class="px-4 py-3">Ms. Sneha Reddy</td>
                    <td class="px-4 py-3">Teacher</td>
                    <td class="px-4 py-3">English</td>
                    <td class="px-4 py-3">₹52,000</td>
                    <td class="px-4 py-3 text-green-600">+₹9,500</td>
                    <td class="px-4 py-3 text-red-600">-₹6,000</td>
                    <td class="px-4 py-3 font-semibold">₹55,500</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP005</td>
                    <td class="px-4 py-3">Mr. Arjun Singh</td>
                    <td class="px-4 py-3">Lab Assistant</td>
                    <td class="px-4 py-3">Laboratory</td>
                    <td class="px-4 py-3">₹35,000</td>
                    <td class="px-4 py-3 text-green-600">+₹5,000</td>
                    <td class="px-4 py-3 text-red-600">-₹3,500</td>
                    <td class="px-4 py-3 font-semibold">₹36,500</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP006</td>
                    <td class="px-4 py-3">Mrs. Kavya Iyer</td>
                    <td class="px-4 py-3">Librarian</td>
                    <td class="px-4 py-3">Library</td>
                    <td class="px-4 py-3">₹42,000</td>
                    <td class="px-4 py-3 text-green-600">+₹7,000</td>
                    <td class="px-4 py-3 text-red-600">-₹4,500</td>
                    <td class="px-4 py-3 font-semibold">₹44,500</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP007</td>
                    <td class="px-4 py-3">Mr. Rohan Gupta</td>
                    <td class="px-4 py-3">Sports Coach</td>
                    <td class="px-4 py-3">Sports</td>
                    <td class="px-4 py-3">₹48,000</td>
                    <td class="px-4 py-3 text-green-600">+₹8,000</td>
                    <td class="px-4 py-3 text-red-600">-₹5,000</td>
                    <td class="px-4 py-3 font-semibold">₹51,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Processed</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">EMP008</td>
                    <td class="px-4 py-3">Ms. Ananya Das</td>
                    <td class="px-4 py-3">Admin Officer</td>
                    <td class="px-4 py-3">Administration</td>
                    <td class="px-4 py-3">₹45,000</td>
                    <td class="px-4 py-3 text-green-600">+₹7,500</td>
                    <td class="px-4 py-3 text-red-600">-₹4,800</td>
                    <td class="px-4 py-3 font-semibold">₹47,700</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        

        <!-- Advances & Loans -->
        <div>
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Staff Advances & Loans</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-slate-50">
                  <tr>
                    <th class="px-4 py-3 font-medium text-slate-700">Advance ID</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Employee</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Issued</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Installments</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Remaining</th>
                    <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y">
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">ADV001</td>
                    <td class="px-4 py-3">Mrs. Priya Sharma</td>
                    <td class="px-4 py-3">₹50,000</td>
                    <td class="px-4 py-3">2023-12-01</td>
                    <td class="px-4 py-3">3/10</td>
                    <td class="px-4 py-3 text-amber-600">₹35,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">ADV002</td>
                    <td class="px-4 py-3">Mr. Amit Patel</td>
                    <td class="px-4 py-3">₹30,000</td>
                    <td class="px-4 py-3">2023-11-15</td>
                    <td class="px-4 py-3">2/6</td>
                    <td class="px-4 py-3 text-amber-600">₹20,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">ADV003</td>
                    <td class="px-4 py-3">Ms. Sneha Reddy</td>
                    <td class="px-4 py-3">₹25,000</td>
                    <td class="px-4 py-3">2024-01-05</td>
                    <td class="px-4 py-3">0/5</td>
                    <td class="px-4 py-3 text-amber-600">₹25,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">ADV004</td>
                    <td class="px-4 py-3">Mr. Rohan Gupta</td>
                    <td class="px-4 py-3">₹40,000</td>
                    <td class="px-4 py-3">2023-10-01</td>
                    <td class="px-4 py-3">8/8</td>
                    <td class="px-4 py-3 text-green-600">₹0</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Cleared</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
 
</x-Account-sidebar>