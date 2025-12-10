<x-Account-sidebar>
  <x-slot name="title">Report Dashboard</x-slot>

  <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Reports & Analytics</h1>
              <p class="text-sm text-slate-600 mt-1">Generate and export financial reports</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Date Range
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export All
              </button>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Reports Generated</p>
            <p class="text-2xl font-bold text-slate-900">248</p>
            <p class="text-sm text-slate-600 mt-2">This month</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Most Downloaded</p>
            <p class="text-lg font-semibold text-slate-900">Fee Collection</p>
            <p class="text-sm text-slate-600 mt-2">45 downloads</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Last Generated</p>
            <p class="text-lg font-semibold text-slate-900">P&L Statement</p>
            <p class="text-sm text-slate-600 mt-2">2 hours ago</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Scheduled Reports</p>
            <p class="text-2xl font-bold text-slate-900">12</p>
            <p class="text-sm text-blue-600 mt-2">Auto-generated</p>
          </div>
        </div>

        <!-- Report Categories -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Financial Reports -->
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-center gap-3 mb-4">
              <div class="p-2 bg-blue-100 rounded-lg">
                <i data-lucide="trending-up" class="w-5 h-5 text-blue-600"></i>
              </div>
              <h3 class="text-lg font-semibold text-slate-900">Financial Reports</h3>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition-colors group">
                <div class="flex-1">
                  <p class="text-sm font-medium text-slate-900">Profit & Loss Statement</p>
                  <p class="text-xs text-slate-600 mt-0.5">Income and expenses summary</p>
                  <p class="text-xs text-slate-500 mt-1"><span class="inline-flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> Monthly/Yearly</span></p>
                </div>
                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 flex items-center gap-1">
                  <i data-lucide="download" class="w-3 h-3"></i>
                  Generate
                </button>
              </div>
              <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition-colors group">
                <div class="flex-1">
                  <p class="text-sm font-medium text-slate-900">Balance Sheet</p>
                  <p class="text-xs text-slate-600 mt-0.5">Assets, liabilities, and equity</p>
                  <p class="text-xs text-slate-500 mt-1"><span class="inline-flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> Quarterly/Yearly</span></p>
                </div>
                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 flex items-center gap-1">
                  <i data-lucide="download" class="w-3 h-3"></i>
                  Generate
                </button>
              </div>
              <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition-colors group">
                <div class="flex-1">
                  <p class="text-sm font-medium text-slate-900">Cash Flow Statement</p>
                  <p class="text-xs text-slate-600 mt-0.5">Cash inflows and outflows</p>
                  <p class="text-xs text-slate-500 mt-1"><span class="inline-flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> Monthly</span></p>
                </div>
                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 flex items-center gap-1">
                  <i data-lucide="download" class="w-3 h-3"></i>
                  Generate
                </button>
              </div>
            </div>
          </div>

          <!-- Fee Reports -->
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-center gap-3 mb-4">
              <div class="p-2 bg-blue-100 rounded-lg">
                <i data-lucide="pie-chart" class="w-5 h-5 text-blue-600"></i>
              </div>
              <h3 class="text-lg font-semibold text-slate-900">Fee Reports</h3>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition-colors group">
                <div class="flex-1">
                  <p class="text-sm font-medium text-slate-900">Fee Collection Register</p>
                  <p class="text-xs text-slate-600 mt-0.5">All fee collections</p>
                  <p class="text-xs text-slate-500 mt-1"><span class="inline-flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> Daily/Monthly</span></p>
                </div>
                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 flex items-center gap-1">
                  <i data-lucide="download" class="w-3 h-3"></i>
                  Generate
                </button>
              </div>
              <div class="flex items-center justify-between p-3 hover:bg-slate-50 rounded-lg transition-colors group">
                <div class="flex-1">
                  <p class="text-sm font-medium text-slate-900">Outstanding Fee Report</p>
                  <p class="text-xs text-slate-600 mt-0.5">Pending fee details</p>
                  <p class="text-xs text-slate-500 mt-1"><span class="inline-flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> Real-time</span></p>
                </div>
                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 flex items-center gap-1">
                  <i data-lucide="download" class="w-3 h-3"></i>
                  Generate
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Export Options -->
        <div class="mt-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">Export Options</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-green-100 rounded-lg">
                  <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                </div>
                <span class="font-semibold text-slate-900">Excel (.xlsx)</span>
              </div>
              <p class="text-sm text-slate-600">Export data in spreadsheet format</p>
            </button>

            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-red-100 rounded-lg">
                  <i data-lucide="file-text" class="w-5 h-5 text-red-600"></i>
                </div>
                <span class="font-semibold text-slate-900">PDF</span>
              </div>
              <p class="text-sm text-slate-600">Export formatted PDF reports</p>
            </button>

            <button class="p-4 bg-white border border-slate-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all text-left">
              <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-blue-100 rounded-lg">
                  <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>
                </div>
                <span class="font-semibold text-slate-900">CSV</span>
              </div>
              <p class="text-sm text-slate-600">Export raw data in CSV format</p>
            </button>
          </div>
        </div>
      </main>
 
</x-Account-sidebar>