<x-Account-sidebar>
  <x-slot name="title">Accountant Dashboard</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Payroll Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Manage staff salaries, advances, and payroll processing</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="send" class="w-4 h-4"></i>
                Send Salary Slips
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Process Payroll
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
              <p class="text-xs sm:text-sm text-slate-600">Total Payroll (This Month)</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹42.5L</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">85 employees</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Processed</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹38.2L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">78 employees paid</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Pending</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹4.3L</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">7 employees pending</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-indigo-100">
                <i data-lucide="receipt" class="w-4 h-4 text-indigo-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Active Advances</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.8L</p>
            <p class="text-xs sm:text-sm text-indigo-600 mt-2">12 active loans</p>
          </div>
        </div>

        <!-- Payroll Table -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            January 2024 Payroll
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Employee ID</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Name</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Designation</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Department</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Basic Salary</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Allowances</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Deductions</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Net Salary</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
                  <tr class="hover:bg-indigo-50 transition-colors">
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
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Staff Advances & Loans
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
              <table class="w-full text-left text-sm relative z-0">
                <thead class="bg-indigo-50 border-b border-indigo-100">
                  <tr>
                    <th class="px-4 py-3 font-medium text-indigo-900">Advance ID</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Employee</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Issued</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Installments</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                    <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">ADV001</td>
                    <td class="px-4 py-3">Mrs. Priya Sharma</td>
                    <td class="px-4 py-3">₹50,000</td>
                    <td class="px-4 py-3">2023-12-01</td>
                    <td class="px-4 py-3">3/10</td>
                    <td class="px-4 py-3 text-amber-600">₹35,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">ADV002</td>
                    <td class="px-4 py-3">Mr. Amit Patel</td>
                    <td class="px-4 py-3">₹30,000</td>
                    <td class="px-4 py-3">2023-11-15</td>
                    <td class="px-4 py-3">2/6</td>
                    <td class="px-4 py-3 text-amber-600">₹20,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
                    <td class="px-4 py-3">ADV003</td>
                    <td class="px-4 py-3">Ms. Sneha Reddy</td>
                    <td class="px-4 py-3">₹25,000</td>
                    <td class="px-4 py-3">2024-01-05</td>
                    <td class="px-4 py-3">0/5</td>
                    <td class="px-4 py-3 text-amber-600">₹25,000</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Active</span></td>
                  </tr>
                  <tr class="hover:bg-indigo-50 transition-colors">
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