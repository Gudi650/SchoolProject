<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>
 
    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
          <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
            <div>
              <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Budget Management</h1>
              <p class="text-xs sm:text-sm text-slate-700 mt-1">Track and manage departmental budgets and allocations</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                Alerts
              </button>
              <button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <a href="{{ route('accounting.createBudget') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Create Budget
              </a>
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
              <p class="text-xs sm:text-sm text-slate-600">Total Annual Budget</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.18Cr</p>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">FY 2023-24</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-red-100">
                <i data-lucide="trending-up" class="w-4 h-4 text-red-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Total Spent</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.02Cr</p>
            <p class="text-xs sm:text-sm text-red-600 mt-2">86% utilized</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-green-100">
                <i data-lucide="piggy-bank" class="w-4 h-4 text-green-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Remaining Budget</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">₹16.0L</p>
            <p class="text-xs sm:text-sm text-green-600 mt-2">14% available</p>
          </div>
          <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
            <div class="flex items-center gap-3 mb-2">
              <div class="p-2 rounded-md bg-amber-100">
                <i data-lucide="alert-circle" class="w-4 h-4 text-amber-600"></i>
              </div>
              <p class="text-xs sm:text-sm text-slate-600">Critical Categories</p>
            </div>
            <p class="text-xl sm:text-2xl font-bold text-slate-900">2</p>
            <p class="text-xs sm:text-sm text-amber-600 mt-2">Requires attention</p>
          </div>
        </div>

        <!-- Department Summary -->
        <div class="mb-6">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Department-wise Budget Summary
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Department</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Total Budget</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Total Spent</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Utilization</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Academic</td>
                  <td class="px-4 py-3 font-semibold">₹68,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹59,20,000</td>
                  <td class="px-4 py-3 text-green-600">₹8,80,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:87%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">87%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Administration</td>
                  <td class="px-4 py-3 font-semibold">₹24,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹21,00,000</td>
                  <td class="px-4 py-3 text-green-600">₹3,00,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:88%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">88%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Infrastructure</td>
                  <td class="px-4 py-3 font-semibold">₹10,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹8,30,000</td>
                  <td class="px-4 py-3 text-green-600">₹1,70,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:83%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">83%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Sports</td>
                  <td class="px-4 py-3 font-semibold">₹3,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹2,85,000</td>
                  <td class="px-4 py-3 text-green-600">₹15,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-red-500" style="width:95%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">95%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Library</td>
                  <td class="px-4 py-3 font-semibold">₹5,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,80,000</td>
                  <td class="px-4 py-3 text-green-600">₹1,20,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:76%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">76%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Transportation</td>
                  <td class="px-4 py-3 font-semibold">₹4,50,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,60,000</td>
                  <td class="px-4 py-3 text-green-600">₹90,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:80%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">80%</span>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Marketing</td>
                  <td class="px-4 py-3 font-semibold">₹3,50,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,20,000</td>
                  <td class="px-4 py-3 text-green-600">₹30,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-amber-500" style="width:91%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">91%</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Detailed Budget -->
        <div>
          <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
            <span class="w-1 h-6 bg-indigo-600 rounded"></span>
            Detailed Budget Breakdown
          </h2>
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-indigo-50 border-b border-indigo-100">
                <tr>
                  <th class="px-4 py-3 font-medium text-indigo-900">Department</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Category</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Budget</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Spent</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Utilization</th>
                  <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Academic</td>
                  <td class="px-4 py-3">Teaching Staff Salary</td>
                  <td class="px-4 py-3">₹60,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹52,00,000</td>
                  <td class="px-4 py-3 text-green-600">₹8,00,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:87%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">87%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Academic</td>
                  <td class="px-4 py-3">Laboratory Equipment</td>
                  <td class="px-4 py-3">₹8,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹7,20,000</td>
                  <td class="px-4 py-3 text-green-600">₹80,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-amber-500" style="width:90%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">90%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Warning</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Administration</td>
                  <td class="px-4 py-3">Admin Staff Salary</td>
                  <td class="px-4 py-3">₹24,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹21,00,000</td>
                  <td class="px-4 py-3 text-green-600">₹3,00,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:88%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">88%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Infrastructure</td>
                  <td class="px-4 py-3">Maintenance & Repairs</td>
                  <td class="px-4 py-3">₹6,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹4,80,000</td>
                  <td class="px-4 py-3 text-green-600">₹1,20,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:80%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">80%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Infrastructure</td>
                  <td class="px-4 py-3">Utilities</td>
                  <td class="px-4 py-3">₹4,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,50,000</td>
                  <td class="px-4 py-3 text-green-600">₹50,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:88%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">88%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Sports</td>
                  <td class="px-4 py-3">Sports Equipment</td>
                  <td class="px-4 py-3">₹3,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹2,85,000</td>
                  <td class="px-4 py-3 text-green-600">₹15,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-red-500" style="width:95%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">95%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Critical</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Library</td>
                  <td class="px-4 py-3">Books & Resources</td>
                  <td class="px-4 py-3">₹5,00,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,80,000</td>
                  <td class="px-4 py-3 text-green-600">₹1,20,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:76%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">76%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Transportation</td>
                  <td class="px-4 py-3">Vehicle Maintenance</td>
                  <td class="px-4 py-3">₹4,50,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,60,000</td>
                  <td class="px-4 py-3 text-green-600">₹90,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-500" style="width:80%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">80%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
                </tr>
                <tr class="hover:bg-indigo-50 transition-colors">
                  <td class="px-4 py-3">Marketing</td>
                  <td class="px-4 py-3">Admission Campaign</td>
                  <td class="px-4 py-3">₹3,50,000</td>
                  <td class="px-4 py-3 text-red-600">₹3,20,000</td>
                  <td class="px-4 py-3 text-green-600">₹30,000</td>
                  <td class="px-4 py-3 w-64">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-slate-100 rounded-full h-2">
                        <div class="h-2 rounded-full bg-amber-500" style="width:91%"></div>
                      </div>
                      <span class="text-sm font-medium text-slate-700 w-12">91%</span>
                    </div>
                  </td>
                  <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Warning</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>

</x-Account-sidebar>