<x-Account-sidebar>
  <x-slot name="title">Enrollment Income</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Enrollment Income Tracker</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Track per-student enrollment payments while keeping school-level income summaries clean</p>
        </div>
        <div class="flex flex-col sm:flex-row lg:flex-nowrap sm:items-center gap-2 sm:gap-3 lg:justify-end">
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center whitespace-nowrap">
            <i data-lucide="calendar-range" class="w-4 h-4"></i>
            Current Admissions Cycle
          </button>
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center whitespace-nowrap">
            <i data-lucide="download" class="w-4 h-4"></i>
            Export Student Ledger
          </button>
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center whitespace-nowrap">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Record Enrollment Payment
          </button>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-6">
      <div class="bg-white rounded-xl p-4 border border-indigo-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-indigo-100">
            <i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Collected (Cycle)</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">INR 23.8L</p>
        <p class="text-xs sm:text-sm text-green-600 mt-2">74.6% of enrollment target</p>
      </div>

      <div class="bg-white rounded-xl p-4 border border-green-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-green-100">
            <i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Fully Paid Students</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">182</p>
        <p class="text-xs sm:text-sm text-green-600 mt-2">+26 this month</p>
      </div>

      <div class="bg-white rounded-xl p-4 border border-amber-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-amber-100">
            <i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Partially Paid</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">67</p>
        <p class="text-xs sm:text-sm text-amber-600 mt-2">INR 5.1L pending</p>
      </div>

      <div class="bg-white rounded-xl p-4 border border-red-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-red-100">
            <i data-lucide="alert-octagon" class="w-4 h-4 text-red-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Overdue Enrollment</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">41</p>
        <p class="text-xs sm:text-sm text-red-600 mt-2">INR 3.2L at risk</p>
      </div>

      <div class="bg-white rounded-xl p-4 border border-blue-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-blue-100">
            <i data-lucide="receipt" class="w-4 h-4 text-blue-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Receipt Coverage</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">93%</p>
        <p class="text-xs sm:text-sm text-blue-600 mt-2">17 pending confirmations</p>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
      <div class="flex items-center justify-between gap-3 mb-4">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Student-Level Filters
        </h2>
        <button class="text-xs sm:text-sm px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50">Reset</button>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 mb-4">
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>Academic Year: 2026-27</option>
          <option>Academic Year: 2025-26</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Branches</option>
          <option>Main Campus</option>
          <option>City Campus</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Classes</option>
          <option>Class 6</option>
          <option>Class 7</option>
          <option>Class 8</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Payment Modes</option>
          <option>Cash</option>
          <option>Bank Transfer</option>
          <option>Online</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Status</option>
          <option>Fully Paid</option>
          <option>Partially Paid</option>
          <option>Overdue</option>
        </select>
        <input type="text" placeholder="Search student / admission no." class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100" />
      </div>

      <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="filter" class="w-4 h-4"></i>
          Apply Filters
        </button>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="file-down" class="w-4 h-4"></i>
          Download Defaulters
        </button>
        <a href="{{ route('accounting.incomeManagement') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to Income Overview
        </a>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Enrollment Fee Progress by Class
        </h2>
        <div class="space-y-4 text-sm">
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Class 6</span>
              <span class="font-semibold text-slate-900">89%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:89%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Class 7</span>
              <span class="font-semibold text-slate-900">77%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:77%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Class 8</span>
              <span class="font-semibold text-slate-900">69%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:69%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Class 9</span>
              <span class="font-semibold text-slate-900">73%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:73%"></div></div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Collection Pulse (Last 6 Weeks)
        </h2>
        <div class="grid grid-cols-6 gap-2 text-center text-xs text-slate-600 mt-2">
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:45%"></div></div><p class="mt-1">W1</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:55%"></div></div><p class="mt-1">W2</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:60%"></div></div><p class="mt-1">W3</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:72%"></div></div><p class="mt-1">W4</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:80%"></div></div><p class="mt-1">W5</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:67%"></div></div><p class="mt-1">W6</p></div>
        </div>
      </div>
    </div>

    <div class="mb-6 rounded-xl border border-amber-100 bg-amber-50 px-4 py-3">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div class="flex items-start gap-2">
          <i data-lucide="triangle-alert" class="w-4 h-4 text-amber-600 mt-0.5"></i>
          <p class="text-xs sm:text-sm text-amber-800">41 students crossed due date for enrollment payment and 17 receipts are still pending confirmation.</p>
        </div>
        <button class="text-xs sm:text-sm px-3 py-1.5 bg-white border border-amber-200 rounded-lg text-amber-700 hover:bg-amber-100">Open Enrollment Follow-up Queue</button>
      </div>
    </div>

    <div>
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-indigo-600 rounded"></span>
        Recent Enrollment Payments
      </h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
        <table class="w-full text-left text-sm relative z-0">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Txn ID</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Student</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Admission No.</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Class</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Mode</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">ENR-2091</td>
              <td class="px-4 py-3">2026-04-12</td>
              <td class="px-4 py-3">Aarav Mehta</td>
              <td class="px-4 py-3">ADM-2247</td>
              <td class="px-4 py-3">Class 7</td>
              <td class="px-4 py-3 font-semibold text-green-600">INR 35,000</td>
              <td class="px-4 py-3">Online</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Fully Paid</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">View Receipt</button></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">ENR-2088</td>
              <td class="px-4 py-3">2026-04-11</td>
              <td class="px-4 py-3">Siya Nair</td>
              <td class="px-4 py-3">ADM-2239</td>
              <td class="px-4 py-3">Class 6</td>
              <td class="px-4 py-3 font-semibold text-amber-600">INR 20,000</td>
              <td class="px-4 py-3">Bank Transfer</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Partially Paid</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">Collect Balance</button></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">ENR-2075</td>
              <td class="px-4 py-3">2026-04-08</td>
              <td class="px-4 py-3">Rohan Kamat</td>
              <td class="px-4 py-3">ADM-2204</td>
              <td class="px-4 py-3">Class 8</td>
              <td class="px-4 py-3 font-semibold text-red-600">INR 12,000</td>
              <td class="px-4 py-3">Cash</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Overdue</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">Send Reminder</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-Account-sidebar>
