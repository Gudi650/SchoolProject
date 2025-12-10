<x-Account-sidebar>
  <x-slot name="title">Accountant Dashboard</x-slot>
 
    <main class="p-6 bg-white">
        <div class="mb-6">
          <div class="flex items-start justify-between">
            <div>
              <h1 class="text-2xl font-bold text-slate-900">Settings</h1>
              <p class="text-sm text-slate-600 mt-1">Configure application preferences and integrations</p>
            </div>
            <div class="flex items-center gap-3">
              <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg">Save Changes</button>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-1">
            <div class="bg-white rounded-xl p-4 border border-slate-200 sticky top-6">
              <nav class="space-y-1">
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors bg-indigo-50 text-indigo-700 font-medium">
                  <i data-lucide="user" class="w-5 h-5"></i>
                  <span>Profile Settings</span>
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="bell" class="w-5 h-5"></i>
                  <span>Notifications</span>
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="lock" class="w-5 h-5"></i>
                  <span>Security</span>
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="database" class="w-5 h-5"></i>
                  <span>Data & Backup</span>
                </button>
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="credit-card" class="w-5 h-5"></i>
                  <span>Payment Gateway</span>
                </button>
              </nav>
            </div>
          </div>

          <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl p-6 border border-slate-200">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Profile Information</h3>
              <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                    <input type="text" value="Sarah Johnson" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Designation</label>
                    <input type="text" value="Chief Accountant" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                  <input type="email" value="sarah.johnson@school.edu" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                  <input type="tel" value="+91 98765 43210" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
              </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-slate-200">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Financial Year Configuration</h3>
              <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Current Financial Year</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option>2023-2024</option>
                      <option>2024-2025</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Currency</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option>INR (₹)</option>
                      <option>USD ($)</option>
                      <option>EUR (€)</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-slate-200">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Notification Preferences</h3>
              <div class="space-y-3">
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">Email notifications for overdue payments</span>
                </label>
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">SMS alerts for large transactions</span>
                </label>
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">Daily collection summary</span>
                </label>
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">Weekly financial reports</span>
                </label>
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" checked class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">Budget overspending alerts</span>
                </label>
              </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-slate-200">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Security</h3>
              <div class="space-y-4">
                <button class="w-full px-4 py-3 text-left border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="font-medium text-slate-900">Change Password</p>
                      <p class="text-sm text-slate-600">Last changed 45 days ago</p>
                    </div>
                    <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                  </div>
                </button>

                <button class="w-full px-4 py-3 text-left border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="font-medium text-slate-900">Two-Factor Authentication</p>
                      <p class="text-sm text-green-600">Enabled</p>
                    </div>
                    <i data-lucide="lock" class="w-5 h-5 text-green-600"></i>
                  </div>
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>

</x-Account-sidebar>