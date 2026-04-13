<x-Account-sidebar>
  <x-slot name="title">Income Management</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">School Income Overview</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Monitor institution-wide income, collection performance, and financial control status</p>
        </div>
        <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-2 sm:gap-3 pt-3">
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
            <i data-lucide="calendar-range" class="w-4 h-4"></i>
            This Academic Year
          </button>
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
            <i data-lucide="download" class="w-4 h-4"></i>
            Export Summary
          </button>
          <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Record Income
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
          <p class="text-xs sm:text-sm text-slate-600">Total Income (YTD)</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">₹8.42Cr</p>
        <p class="text-xs sm:text-sm text-green-600 mt-2">+9.8% vs last year</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-indigo-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-indigo-100">
            <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Collected (MTD)</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">₹72.6L</p>
        <p class="text-xs sm:text-sm text-slate-600 mt-2">Target: ₹80L</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-green-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-green-100">
            <i data-lucide="target" class="w-4 h-4 text-green-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Collection Efficiency</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">90.8%</p>
        <p class="text-xs sm:text-sm text-green-600 mt-2">On track</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-amber-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-amber-100">
            <i data-lucide="clock" class="w-4 h-4 text-amber-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Pending & Overdue</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">₹41.3L</p>
        <p class="text-xs sm:text-sm text-amber-600 mt-2">₹12.8L overdue</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-blue-100 shadow-sm">
        <div class="flex items-center gap-3 mb-2">
          <div class="p-2 rounded-md bg-blue-100">
            <i data-lucide="book-check" class="w-4 h-4 text-blue-600"></i>
          </div>
          <p class="text-xs sm:text-sm text-slate-600">Reconciliation Health</p>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-slate-900">86%</p>
        <p class="text-xs sm:text-sm text-blue-600 mt-2">44 entries unmatched</p>
      </div>
    </div>

    <div class="mb-6 rounded-xl border border-indigo-100 bg-white shadow-sm p-4 sm:p-5">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Enrollment Income Snapshot
          </h2>
          <p class="text-xs sm:text-sm text-slate-600 mt-1">Student-wise enrollment collections are managed in a dedicated tracker and rolled up here.</p>
        </div>
        <a href="{{ route('accounting.enrollmentIncome') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 w-full sm:w-auto justify-center sm:justify-start">
          <i data-lucide="external-link" class="w-4 h-4"></i>
          Open Enrollment Income
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 mt-4">
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Collected (Cycle)</p>
          <p class="text-lg font-semibold text-slate-900 mt-1">INR 23.8L</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Fully Paid Students</p>
          <p class="text-lg font-semibold text-slate-900 mt-1">182</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Pending Enrollment Dues</p>
          <p class="text-lg font-semibold text-amber-600 mt-1">INR 5.1L</p>
        </div>
        <div class="rounded-lg border border-slate-200 p-3">
          <p class="text-xs text-slate-500">Overdue Cases</p>
          <p class="text-lg font-semibold text-red-600 mt-1">41 Students</p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
      <div class="flex items-center justify-between gap-3 mb-4">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Whole-School Filters
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
          <option>All Standards</option>
          <option>Primary</option>
          <option>Secondary</option>
          <option>Higher Secondary</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Categories</option>
          <option>Tuition Fee</option>
          <option>Transport Fee</option>
          <option>Hostel Fee</option>
        </select>
        <select class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100 text-slate-700">
          <option>All Status</option>
          <option>Collected</option>
          <option>Pending</option>
          <option>Overdue</option>
        </select>
        <input type="text" placeholder="Search source / class / route" class="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-100" />
      </div>
      <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="filter" class="w-4 h-4"></i>
          Apply Filters
        </button>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="download" class="w-4 h-4"></i>
          Download Variance Report
        </button>
        <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center">
          <i data-lucide="file-up" class="w-4 h-4"></i>
          Upload Bank Statement
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Income Composition (YTD)
        </h2>
        <div class="space-y-4 text-sm">
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Tuition Fee</span>
              <span class="font-semibold text-slate-900">62%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:62%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Transport Fee</span>
              <span class="font-semibold text-slate-900">15%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:15%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Hostel Fee</span>
              <span class="font-semibold text-slate-900">13%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:13%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Enrollment Fee</span>
              <span class="font-semibold text-slate-900">7%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:7%"></div></div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <span class="text-slate-600">Other Income</span>
              <span class="font-semibold text-slate-900">3%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width:3%"></div></div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Collection Trend (Last 6 Months)
        </h2>
        <div class="grid grid-cols-6 gap-2 text-center text-xs text-slate-600 mt-2">
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:58%"></div></div><p class="mt-1">Nov</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:64%"></div></div><p class="mt-1">Dec</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:70%"></div></div><p class="mt-1">Jan</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:78%"></div></div><p class="mt-1">Feb</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:83%"></div></div><p class="mt-1">Mar</p></div>
          <div><div class="h-20 bg-indigo-100 rounded-md flex items-end"><div class="w-full bg-indigo-500 rounded-md" style="height:76%"></div></div><p class="mt-1">Apr</p></div>
        </div>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-indigo-600 rounded"></span>
        Branch / Unit Collection Performance
      </h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
        <table class="w-full text-left text-sm relative z-0">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Unit</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Expected</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Collected</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Efficiency</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Variance</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">Main Campus - Secondary</td>
              <td class="px-4 py-3">₹26,00,000</td>
              <td class="px-4 py-3 font-semibold">₹24,90,000</td>
              <td class="px-4 py-3">95.8%</td>
              <td class="px-4 py-3 text-amber-600 font-medium">-₹1,10,000</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Healthy</span></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">City Campus - Primary</td>
              <td class="px-4 py-3">₹18,00,000</td>
              <td class="px-4 py-3 font-semibold">₹14,20,000</td>
              <td class="px-4 py-3">78.9%</td>
              <td class="px-4 py-3 text-amber-600 font-medium">-₹3,80,000</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Needs Follow-up</span></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">Hostel Operations</td>
              <td class="px-4 py-3">₹9,00,000</td>
              <td class="px-4 py-3 font-semibold">₹9,45,000</td>
              <td class="px-4 py-3">105.0%</td>
              <td class="px-4 py-3 text-green-600 font-medium">+₹45,000</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Above Target</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="mb-6 rounded-xl border border-amber-100 bg-amber-50 px-4 py-3">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div class="flex items-start gap-2">
          <i data-lucide="triangle-alert" class="w-4 h-4 text-amber-600 mt-0.5"></i>
          <p class="text-xs sm:text-sm text-amber-800">2 units dropped below 80% collection efficiency and 44 records are pending bank reconciliation.</p>
        </div>
        <button class="text-xs sm:text-sm px-3 py-1.5 bg-white border border-amber-200 rounded-lg text-amber-700 hover:bg-amber-100">Open Action Queue</button>
      </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Reconciliation Snapshot
        </h2>
        <div class="space-y-4">
          <div>
            <div class="flex items-center justify-between text-sm mb-1">
              <span class="text-slate-600">Matched Transactions</span>
              <span class="font-semibold text-slate-900">86%</span>
            </div>
            <div class="w-full h-2 bg-slate-100 rounded-full">
              <div class="h-2 bg-indigo-500 rounded-full" style="width: 86%"></div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-3 text-sm">
            <div class="rounded-lg border border-slate-200 p-3">
              <p class="text-slate-500">Matched</p>
              <p class="font-semibold text-slate-900">274</p>
            </div>
            <div class="rounded-lg border border-slate-200 p-3">
              <p class="text-slate-500">Unmatched</p>
              <p class="font-semibold text-amber-600">44</p>
            </div>
          </div>
          <button class="w-full px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">Open Reconciliation Queue</button>
        </div>
      </div>

      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
          <span class="w-1 h-6 bg-indigo-600 rounded"></span>
          Pending Income Aging
        </h2>
        <div class="space-y-3 text-sm">
          <div class="flex items-center justify-between">
            <span class="text-slate-600">0-15 days</span>
            <span class="font-semibold text-slate-900">₹15.2L</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-slate-600">16-30 days</span>
            <span class="font-semibold text-slate-900">₹13.3L</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-slate-600">31+ days</span>
            <span class="font-semibold text-amber-600">₹12.8L</span>
          </div>
          <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
            <span class="text-slate-600">Total Pending</span>
            <span class="font-semibold text-slate-900">₹41.3L</span>
          </div>
          <button class="w-full px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">View Defaulter Breakdown</button>
        </div>
      </div>
    </div>

    <div>
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
        <span class="w-1 h-6 bg-indigo-600 rounded"></span>
        Recent School Income Transactions
      </h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0 isolate px-4 md:px-0">
        <table class="w-full text-left text-sm relative z-0">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Income ID</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Unit</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Mode</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">INC1120</td>
              <td class="px-4 py-3">2026-04-12</td>
              <td class="px-4 py-3">Main Campus</td>
              <td class="px-4 py-3">Tuition Fee</td>
              <td class="px-4 py-3 font-semibold text-green-600">₹4,80,000</td>
              <td class="px-4 py-3">Online</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Collected</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">View</button></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">INC1119</td>
              <td class="px-4 py-3">2026-04-11</td>
              <td class="px-4 py-3">Admissions Desk</td>
              <td class="px-4 py-3">Enrollment Fee</td>
              <td class="px-4 py-3 font-semibold text-green-600">INR 2,10,000</td>
              <td class="px-4 py-3">Online</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Collected</span></td>
              <td class="px-4 py-3"><a href="{{ route('accounting.enrollmentIncome') }}" class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100 inline-flex">View</a></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">INC1118</td>
              <td class="px-4 py-3">2026-04-11</td>
              <td class="px-4 py-3">City Campus</td>
              <td class="px-4 py-3">Library Fee</td>
              <td class="px-4 py-3 font-semibold text-green-600">₹45,000</td>
              <td class="px-4 py-3">Cash</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Collected</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">View</button></td>
            </tr>
            <tr class="hover:bg-indigo-50 transition-colors">
              <td class="px-4 py-3">INC1115</td>
              <td class="px-4 py-3">2026-04-10</td>
              <td class="px-4 py-3">Hostel Block A</td>
              <td class="px-4 py-3">Hostel Fee</td>
              <td class="px-4 py-3 font-semibold text-amber-600">₹3,20,000</td>
              <td class="px-4 py-3">Bank Transfer</td>
              <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending Receipt</span></td>
              <td class="px-4 py-3"><button class="text-xs px-2.5 py-1.5 border border-slate-200 rounded-md text-slate-600 hover:bg-slate-100">Follow Up</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
 
</x-Account-sidebar>