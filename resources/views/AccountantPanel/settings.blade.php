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
                <a href="#profile" class="settings-nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors bg-indigo-50 text-indigo-700 font-medium">
                  <i data-lucide="user" class="w-5 h-5"></i>
                  <span>Profile Settings</span>
                </a>
                <a href="#notifications" class="settings-nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="bell" class="w-5 h-5"></i>
                  <span>Notifications</span>
                </a>
                <a href="#security" class="settings-nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="lock" class="w-5 h-5"></i>
                  <span>Security</span>
                </a>
                <a href="#data-backup" class="settings-nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="database" class="w-5 h-5"></i>
                  <span>Data & Backup</span>
                </a>
                <a href="#payment-gateway" class="settings-nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left transition-colors text-slate-700 hover:bg-slate-50">
                  <i data-lucide="credit-card" class="w-5 h-5"></i>
                  <span>Payment Gateway</span>
                </a>
              </nav>
            </div>
          </div>

          <div class="lg:col-span-2 space-y-6">
            <!-- Profile Settings Section -->
            <div id="profile" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
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
!-- Notifications Section -->
            <div id="notifications" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6
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
!-- Security Section -->
            <div id="security" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6
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

            <!-- Data & Backup Section -->
            <div id="data-backup" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Data & Backup</h3>
              <div class="space-y-4">
                <div class="p-4 border border-slate-300 rounded-lg">
                  <div class="flex items-center justify-between mb-3">
                    <div>
                      <p class="font-medium text-slate-900">Automatic Backup</p>
                      <p class="text-sm text-slate-600">Daily backup at 2:00 AM</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" checked class="sr-only peer">
                      <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                  </div>
                  <p class="text-sm text-slate-600">Last backup: Today at 2:00 AM</p>
                </div>

                <button class="w-full px-4 py-3 text-left border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="font-medium text-slate-900">Download Backup</p>
                      <p class="text-sm text-slate-600">Export all financial data</p>
                    </div>
                    <i data-lucide="download" class="w-5 h-5 text-slate-400"></i>
                  </div>
                </button>

                <button class="w-full px-4 py-3 text-left border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="font-medium text-slate-900">Restore Data</p>
                      <p class="text-sm text-slate-600">Import from backup file</p>
                    </div>
                    <i data-lucide="upload" class="w-5 h-5 text-slate-400"></i>
                  </div>
                </button>
              </div>
            </div>

            <!-- Payment Gateway Section -->
            <div id="payment-gateway" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Payment Gateway Settings</h3>
              <div class="space-y-6">
                <!-- Razorpay -->
                <div class="p-4 border border-slate-300 rounded-lg">
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-5 h-5 text-indigo-600"></i>
                      </div>
                      <div>
                        <p class="font-semibold text-slate-900">Razorpay</p>
                        <p class="text-sm text-slate-600">Online payment gateway</p>
                      </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" checked class="sr-only peer">
                      <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                  </div>
                  <div class="space-y-3">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">API Key</label>
                      <input type="text" value="rzp_test_1234567890" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">API Secret</label>
                      <input type="password" value="••••••••••••••••" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                  </div>
                </div>

                <!-- PayPal -->
                <div class="p-4 border border-slate-300 rounded-lg">
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="wallet" class="w-5 h-5 text-blue-600"></i>
                      </div>
                      <div>
                        <p class="font-semibold text-slate-900">PayPal</p>
                        <p class="text-sm text-slate-600">International payments</p>
                      </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                  </div>
                  <div class="space-y-3">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Client ID</label>
                      <input type="text" placeholder="Enter PayPal Client ID" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Client Secret</label>
                      <input type="password" placeholder="Enter PayPal Client Secret" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                  </div>
                </div>

                <!-- Stripe -->
                <div class="p-4 border border-slate-300 rounded-lg">
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="zap" class="w-5 h-5 text-purple-600"></i>
                      </div>
                      <div>
                        <p class="font-semibold text-slate-900">Stripe</p>
                        <p class="text-sm text-slate-600">Credit card processing</p>
                      </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                      <input type="checkbox" class="sr-only peer">
                      <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                  </div>
                  <div class="space-y-3">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Publishable Key</label>
                      <input type="text" placeholder="Enter Stripe Publishable Key" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Secret Key</label>
                      <input type="password" placeholder="Enter Stripe Secret Key" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                  </div>
                </div>

                <!-- Payment Settings -->
                <div class="p-4 border border-slate-300 rounded-lg bg-slate-50">
                  <h4 class="font-semibold text-slate-900 mb-3">Payment Settings</h4>
                  <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer">
                      <input type="checkbox" checked class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-2 focus:ring-indigo-500" />
                      <span class="text-sm text-slate-700">Enable partial payments</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                      <input type="checkbox" checked class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-2 focus:ring-indigo-500" />
                      <span class="text-sm text-slate-700">Send payment confirmation emails</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                      <input type="checkbox" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-2 focus:ring-indigo-500" />
                      <span class="text-sm text-slate-700">Auto-generate receipts</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

<script>
  // Wait for page to load
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (window.lucide) lucide.createIcons();

    // Get all navigation links
    const navLinks = document.querySelectorAll('.settings-nav-link');

    // Add click event to each link
    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active class from all links
        navLinks.forEach(l => {
          l.classList.remove('bg-indigo-50', 'text-indigo-700', 'font-medium');
          l.classList.add('text-slate-700', 'hover:bg-slate-50');
        });

        // Add active class to clicked link
        this.classList.remove('text-slate-700', 'hover:bg-slate-50');
        this.classList.add('bg-indigo-50', 'text-indigo-700', 'font-medium');

        // Get the target section ID from href
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);

        // Scroll to the section smoothly
        if (targetSection) {
          targetSection.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
          });
        }

        // Re-initialize icons after DOM changes
        if (window.lucide) lucide.createIcons();
      });
    });
  });
</script>

</x-Account-sidebar>