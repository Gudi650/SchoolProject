<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>
 
    <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Budget Management</h1>
              <p class="text-sm text-slate-600 mt-1">Track and manage departmental budgets and allocations</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                Alerts
              </button>
              <button class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
              </button>
              <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Create Budget
              </button>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white">
            <p class="text-indigo-100 text-sm mb-1">Total Annual Budget</p>
            <p class="text-3xl font-bold">₹1.18Cr</p>
            <p class="text-indigo-100 text-sm mt-2">FY 2023-24</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Total Spent</p>
            <p class="text-2xl font-bold text-slate-900">₹1.02Cr</p>
            <p class="text-sm text-slate-600 mt-2">86% utilized</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Remaining Budget</p>
            <p class="text-2xl font-bold text-slate-900">₹16.0L</p>
            <p class="text-sm text-green-600 mt-2">14% available</p>
          </div>
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <p class="text-sm text-slate-600 mb-1">Critical Categories</p>
            <p class="text-2xl font-bold text-slate-900">2</p>
            <p class="text-sm text-red-600 mt-2">Requires attention</p>
          </div>
        </div>

        <!-- Department Summary -->
        <div class="mb-6">
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Department-wise Budget Summary</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 font-medium text-slate-700">Department</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Total Budget</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Total Spent</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Remaining</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Utilization</th>
                </tr>
              </thead>
              <tbody class="divide-y">
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
          <h2 class="text-lg font-semibold text-slate-900 mb-4">Detailed Budget Breakdown</h2>
          <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
            <table class="w-full text-left text-sm relative z-0">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 font-medium text-slate-700">Department</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Category</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Budget</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Spent</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Remaining</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Utilization</th>
                  <th class="px-4 py-3 font-medium text-slate-700">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y">
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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
                <tr>
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