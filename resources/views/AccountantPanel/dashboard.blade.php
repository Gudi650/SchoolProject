<x-Account-sidebar>
  <x-slot name="title">Accountant Dashboard</x-slot>
 
    <main class="p-6 bg-white">
        <!-- Today's Collection Highlight -->
        <div class="mb-6">
          <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl p-8 text-white shadow-xl">
            <div class="flex items-start justify-between">
              <div>
                <p class="text-indigo-100 text-sm font-medium mb-2">Today's Cash Collection</p>
                <h2 class="text-4xl font-bold mb-2">₹2,45,500</h2>
                <p class="text-indigo-100 text-sm"><span class="font-semibold text-white">+18.5%</span> vs yesterday (₹2,07,200)</p>
              </div>
              <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl">
                <i data-lucide="dollar-sign" class="w-8 h-8"></i>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-indigo-500/30">
              <div>
                <p class="text-indigo-100 text-xs mb-1">Cash</p>
                <p class="text-lg font-semibold">₹1,25,000</p>
              </div>
              <div>
                <p class="text-indigo-100 text-xs mb-1">Online</p>
                <p class="text-lg font-semibold">₹95,500</p>
              </div>
              <div>
                <p class="text-indigo-100 text-xs mb-1">Cheque</p>
                <p class="text-lg font-semibold">₹25,000</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-xl p-4 border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
              </div>
              <div>
                <p class="text-xs text-slate-600">Total Students</p>
                <p class="text-lg font-semibold">1,248</p>
                <p class="text-xs text-slate-500">+24 this month</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl p-4 border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
              </div>
              <div>
                <p class="text-xs text-slate-600">Fee Defaulters</p>
                <p class="text-lg font-semibold">30</p>
                <p class="text-xs text-slate-500">5 overdue &gt;30 days</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl p-4 border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i data-lucide="calendar" class="w-5 h-5 text-purple-600"></i>
              </div>
              <div>
                <p class="text-xs text-slate-600">Upcoming Expenses</p>
                <p class="text-lg font-semibold">₹4.2L</p>
                <p class="text-xs text-slate-500">Due in next 7 days</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-xl p-4 border border-slate-200">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i data-lucide="building-2" class="w-5 h-5 text-green-600"></i>
              </div>
              <div>
                <p class="text-xs text-slate-600">Bank Balance</p>
                <p class="text-lg font-semibold">₹18.5L</p>
                <p class="text-xs text-slate-500">+12.3% this month</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts and Outstanding -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
          <div class="lg:col-span-2 bg-white rounded-xl p-6 border border-slate-200">
            <h3 class="text-sm font-semibold mb-4">Revenue (last 6 months)</h3>
            <div class="h-64 bg-slate-50 rounded-lg flex items-center justify-center text-slate-400">(Chart placeholder)</div>
          </div>

          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-start justify-between mb-6">
              <div>
                <h3 class="text-lg font-semibold text-slate-900">Outstanding Fee Balance</h3>
                <p class="text-sm text-slate-600 mt-1">Total pending payments</p>
              </div>
              <div class="p-2 bg-amber-100 rounded-lg">
                <i data-lucide="alert-circle" class="w-5 h-5 text-amber-600"></i>
              </div>
            </div>

            <div class="mb-6">
              <p class="text-3xl font-bold text-slate-900">₹4,36,000</p>
              <p class="text-sm text-slate-600 mt-1">30 students with pending fees</p>
            </div>

            <div class="space-y-3">
              <p class="text-sm font-medium text-slate-700 mb-3">Class-wise Breakdown</p>
              <div>
                <div class="flex items-center justify-between mb-2">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-900">Class 10</span>
                    <span class="text-xs text-slate-500">(8 students)</span>
                  </div>
                  <span class="text-sm font-semibold text-slate-900">₹1,25,000</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-amber-500 h-2 rounded-full" style="width:28%"></div></div>
              </div>

              <div>
                <div class="flex items-center justify-between mb-2">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-900">Class 9</span>
                    <span class="text-xs text-slate-500">(6 students)</span>
                  </div>
                  <span class="text-sm font-semibold text-slate-900">₹98,000</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-amber-500 h-2 rounded-full" style="width:22%"></div></div>
              </div>

              <div>
                <div class="flex items-center justify-between mb-2">
                  <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-900">Class 8</span>
                    <span class="text-xs text-slate-500">(5 students)</span>
                  </div>
                  <span class="text-sm font-semibold text-slate-900">₹76,000</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-amber-500 h-2 rounded-full" style="width:16%"></div></div>
              </div>

            </div>

            <button class="w-full mt-6 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
              <i data-lucide="trending-up" class="w-4 h-4"></i>
              Send Payment Reminders
            </button>
          </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-sm font-semibold text-slate-900">Fee Collection Rate</h3>
              <i data-lucide="percent" class="w-5 h-5 text-green-600"></i>
            </div>
            <div class="relative pt-1">
              <div class="flex items-center justify-center mb-2"><span class="text-4xl font-bold text-slate-900">87.5%</span></div>
              <div class="w-full bg-slate-100 rounded-full h-3"><div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full" style="width:87.5%"></div></div>
              <p class="text-xs text-slate-600 mt-3 text-center">₹52.5L collected of ₹60L total fees</p>
            </div>
          </div>

          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-sm font-semibold text-slate-900">Budget vs Actual</h3>
              <i data-lucide="target" class="w-5 h-5 text-indigo-600"></i>
            </div>
            <div class="space-y-4">
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="text-xs text-slate-600">Budget</span>
                  <span class="text-sm font-semibold text-slate-900">₹5.2L</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-indigo-500 h-2 rounded-full" style="width:100%"></div></div>
              </div>

              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="text-xs text-slate-600">Actual Spent</span>
                  <span class="text-sm font-semibold text-slate-900">₹4.8L</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2"><div class="bg-green-500 h-2 rounded-full" style="width:92.3%"></div></div>
              </div>
            </div>
            <div class="mt-4 p-3 bg-green-50 rounded-lg"><p class="text-xs text-green-700 font-medium">₹40,000 under budget (7.7%)</p></div>
          </div>

          <div class="bg-white rounded-xl p-6 border border-slate-200">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-sm font-semibold text-slate-900">This Month</h3>
              <i data-lucide="trending-up" class="w-5 h-5 text-purple-600"></i>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between py-2 border-b border-slate-100">
                <span class="text-sm text-slate-600">Total Income</span>
                <span class="text-sm font-semibold text-green-600">₹6.8L</span>
              </div>
              <div class="flex items-center justify-between py-2 border-b border-slate-100">
                <span class="text-sm text-slate-600">Total Expenses</span>
                <span class="text-sm font-semibold text-red-600">₹4.2L</span>
              </div>
              <div class="flex items-center justify-between py-2">
                <span class="text-sm font-semibold text-slate-900">Net Profit</span>
                <span class="text-sm font-bold text-indigo-600">₹2.6L</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Transactions Feed -->
        <div class="bg-white rounded-xl p-6 border border-slate-200">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold">Recent Transactions</h3>
            <a href="#" class="text-sm text-indigo-600">View all</a>
          </div>
          <div class="space-y-3">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center">
                  <i data-lucide="credit-card" class="w-5 h-5 text-slate-400"></i>
                </div>
                <div>
                  <p class="text-sm font-medium">Tuition Fee — Rahul</p>
                  <p class="text-xs text-slate-500">Class 10 • 2 hours ago</p>
                </div>
              </div>
              <div class="text-sm font-semibold text-slate-900">₹12,000</div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center">
                  <i data-lucide="dollar-sign" class="w-5 h-5 text-slate-400"></i>
                </div>
                <div>
                  <p class="text-sm font-medium">Bus Fee — Grade 9</p>
                  <p class="text-xs text-slate-500">2 days ago</p>
                </div>
              </div>
              <div class="text-sm font-semibold text-slate-900">₹1,200</div>
            </div>

          </div>
        </div>

      </main>

</x-Account-sidebar>