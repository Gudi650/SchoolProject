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
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Financial Configuration</h3>
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
                        <option>TSH (tsh)</option>
                        <option>USD ($)</option>
                        <option>EUR (€)</option>
                      </select>
                    </div>
                  </div>

                <form action="{{ route('accounting.contributionsSettings') }}" method="POST">
                  @csrf

                  <!-- NSSF/PSSF Configuration -->
                  <div class="mt-6 p-4 border border-slate-300 rounded-lg bg-slate-50">
                    <h4 class="font-semibold text-slate-900 mb-4">Social Security Contributions</h4>
                    
                    <!-- NSSF Configuration -->
                    <div class="mb-4 p-4 bg-white rounded-lg border border-slate-200">
                      <div class="flex items-center justify-between mb-3">
                        <div>
                          <p class="font-medium text-slate-900">NSSF (National Social Security Fund)</p>
                          <p class="text-sm text-slate-600">Enable NSSF contributions for employees</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                          <input type="checkbox" name= "contribution_type" value="nssf" id="nssfToggle" class="sr-only peer">
                          <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                      </div>

                      <div id="nssfPercentageField" class="hidden">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Contribution Percentage (%)</label>
                        <div class="flex items-center gap-2">
                          <input type="number" step="0.01" min="0" max="100" name= "nssf_contribution" value="10.00" placeholder="e.g., 10.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                          <span class="text-slate-600">%</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Default: 10% of gross salary</p>
                      </div>

                    </div>

                    <!-- PSSF Configuration -->
                    <div class="p-4 bg-white rounded-lg border border-slate-200">
                      <div class="flex items-center justify-between mb-3">
                        <div>
                          <p class="font-medium text-slate-900">PSSSF (Public Service Social Security Fund)</p>
                          <p class="text-sm text-slate-600">Enable PSSF contributions for employees</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                          <input type="checkbox" name= "contribution_type" value="psssf" id="pssfToggle" class="sr-only peer">
                          <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                      </div>
                      <div id="pssfPercentageField" class="hidden">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Contribution Percentage (%)</label>
                        <div class="flex items-center gap-2">
                          <input type="number" name= "psssf_contribution" step="0.01" min="0" max="100" value="5.00" placeholder="e.g., 5.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                          <span class="text-slate-600">%</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">Default: 5% of gross salary</p>
                      </div>
                    </div>

                    <p class="text-xs text-amber-600 mt-3 flex items-start gap-2">
                      <i data-lucide="alert-circle" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                      <span>Note: Employees can typically only be enrolled in either NSSF or PSSF, not both. The system will validate this during payroll processing.</span>
                    </p>

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                          <i data-lucide="check" class="w-4 h-4"></i>
                          Save Contribution Settings
                        </button>
                    </div>

                  </div>
                </form>
              </div>
            </div>

            <!-- Loan Settings Configuration (Modern UI, Grouped) -->
            <div id="loan-settings" class="max-w-3xl mx-auto">
              <div class="bg-white rounded-xl shadow border border-slate-200 p-0 md:p-2">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 px-6 pt-6">Loan Settings Configuration</h2>
                <div class="space-y-6 px-0 md:px-6 pb-6">
                  <!-- 1. General Loan Rules -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="settings" class="w-5 h-5 text-indigo-600"></i>General Loan Rules</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Maximum Loan Multiplier</label>
                      <input type="number" min="1" max="5" step="0.1" value="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">E.g. 3× Basic Salary</p>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Maximum Loan Amount (TZS)</label>
                      <input type="number" min="0" step="10000" value="5000000" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">Absolute cap for any loan</p>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Maximum Duration (months)</label>
                      <input type="number" min="1" max="24" value="12" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">Max 24 months</p>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Grace Period (days)</label>
                      <input type="number" min="0" max="90" value="30" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">Time before first repayment</p>
                    </div>
                  </div>
                </div>

                  <!-- 2. Interest Settings -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                  <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="percent" class="w-5 h-5 text-indigo-600"></i>Interest Settings</h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Default Interest Rate (%)</label>
                      <input type="number" min="0" max="100" step="0.01" value="8.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">Recommended: 8%</p>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Minimum Interest Rate (BOT Rate)</label>
                      <input type="number" value="5.75" readonly class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-slate-100 text-slate-500" />
                      <p class="text-xs text-slate-500 mt-1">Bank of Tanzania minimum rate</p>
                    </div>
                  </div>
                  <div class="mt-4 flex items-center gap-6">
                    <div class="flex items-center gap-2">
                      <input type="radio" id="flat-rate" name="interest_type" checked class="accent-indigo-600" />
                      <label for="flat-rate" class="text-sm text-slate-700">Flat Rate</label>
                    </div>
                    <div class="flex items-center gap-2">
                      <input type="radio" id="reducing-balance" name="interest_type" class="accent-indigo-600" />
                      <label for="reducing-balance" class="text-sm text-slate-700">Reducing Balance</label>
                    </div>
                  </div>
                  <p class="text-xs text-slate-500 mt-2">Choose how interest is calculated on loans</p>
                </div>

                  <!-- 3. Repayment Rules -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                  <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="repeat" class="w-5 h-5 text-indigo-600"></i>Repayment Rules</h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Maximum Deduction from Salary (%)</label>
                      <input type="number" min="0" max="100" value="40" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                      <p class="text-xs text-slate-500 mt-1">Default: 40% of net salary</p>
                    </div>
                    <div class="flex flex-col gap-2">
                      <label class="block text-sm font-medium text-slate-700 mb-1">Repayment Options</label>
                      <div class="flex items-center gap-3 flex-wrap">
                        <label class="flex items-center gap-2 cursor-pointer">
                          <input type="checkbox" checked class="accent-indigo-600" />
                          <span class="text-sm text-slate-700">Allow Early Repayment</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                          <input type="checkbox" checked class="accent-indigo-600" />
                          <span class="text-sm text-slate-700">Allow Multiple Loans per Employee</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                          <input type="checkbox" checked class="accent-indigo-600" />
                          <span class="text-sm text-slate-700">Auto Payroll Deduction</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                  <!-- 4. PAYE & Compliance Rules -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                  <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="shield-check" class="w-5 h-5 text-indigo-600"></i>PAYE & Compliance Rules</h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">BOT Rate (Reference)</label>
                      <input type="number" value="5.75" readonly class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-slate-100 text-slate-500" />
                    </div>
                    <div class="flex items-center gap-2 mt-6 md:mt-0">
                      <input type="checkbox" checked class="accent-indigo-600" id="enable-paye" />
                      <label for="enable-paye" class="text-sm text-slate-700">Enable PAYE Fringe Benefit Calculation</label>
                    </div>
                  </div>
                  <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-blue-900 text-sm">
                    <strong>Rule:</strong> If interest rate is less than BOT rate, PAYE applies to the difference as a fringe benefit.
                  </div>
                  <div class="mb-4">
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-300 text-yellow-900 text-sm flex items-center gap-2 mb-2">
                      <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                      <span>Warning: Loan amount greater than 3× salary will trigger a compliance warning.</span>
                    </div>
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-300 text-yellow-900 text-sm flex items-center gap-2">
                      <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                      <span>Warning: Loan duration greater than 12 months will trigger a compliance warning.</span>
                    </div>
                  </div>
                </div>

                  <!-- 5. Approval Workflow -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                  <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="user-check" class="w-5 h-5 text-indigo-600"></i>Approval Workflow</h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                      <input type="checkbox" checked class="accent-indigo-600" id="require-approval" />
                      <label for="require-approval" class="text-sm text-slate-700">Require Approval</label>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-1">Approval Levels</label>
                      <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option>Accountant</option>
                        <option>Admin</option>
                      </select>
                    </div>
                    <div class="flex items-center gap-2">
                      <input type="checkbox" class="accent-indigo-600" id="allow-override" />
                      <label for="allow-override" class="text-sm text-slate-700">Allow Override for High Loans</label>
                    </div>
                  </div>
                </div>

                  <!-- 6. Notifications Settings -->
                  <div class="bg-slate-50 rounded-lg border border-slate-100 p-6">
                  <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2"><i data-lucide="bell" class="w-5 h-5 text-indigo-600"></i>Notifications Settings</h3>
                  <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="checkbox" checked class="accent-indigo-600" />
                      <span class="text-sm text-slate-700">Notify Employee on Approval</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="checkbox" checked class="accent-indigo-600" />
                      <span class="text-sm text-slate-700">Notify on Deduction</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="checkbox" checked class="accent-indigo-600" />
                      <span class="text-sm text-slate-700">Notify on Completion</span>
                    </label>
                  </div>
                </div>

                  <!-- Save Button -->
                  <div class="sticky bottom-0 bg-white py-4 flex justify-end border-t border-slate-200 z-10 rounded-b-xl">
                    <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition-colors flex items-center gap-2 text-base font-semibold">
                      <i data-lucide="save" class="w-5 h-5"></i>
                      Save Loan Settings
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <div id="health-insurance" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Health Insurance</h3>

              @if(session('error'))
                <div class="mb-4 p-3 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm">
                  {{ session('error') }}
                </div>
              @endif

              @if(session('success'))
                <div class="mb-4 p-3 rounded-lg border border-green-200 bg-green-50 text-green-700 text-sm">
                  {{ session('success') }}
                </div>
              @endif

              @if($errors->has('health_insurance'))
                <div class="mb-4 p-3 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm">
                  {{ $errors->first('health_insurance') }}
                </div>
              @endif

              @if($errors->has('range_lower_bound.*') || $errors->has('range_upper_bound.*') || $errors->has('range_employer_contribution.*') || $errors->has('range_employee_contribution.*'))
                <div class="mb-4 p-3 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm">
                  <ul class="list-disc ml-5 space-y-1">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="space-y-4">

                <form action="{{ route('accounting.healthInsuranceSettings') }}" method = "POST" id="healthInsuranceForm">
                  @csrf
                  <!-- Hidden input to track if rate ranges is selected -->
                  <input type="hidden" name="insurance_has_ranges_hidden" id="insurance_has_ranges_hidden" value="no" />
                <!--
                <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-lg cursor-pointer">
                  <input type="checkbox" checked class="w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                  <span class="text-sm text-slate-700">Enable health insurance benefits for employees</span>
                </label> -->
                
                <!--choose the insurance provider-->
                <div class="p-4 border border-slate-300 rounded-lg bg-slate-50">

                  <h4 class="font-semibold text-slate-900 mb-3">Select Insurance Provider</h4>

                  <select name="health_insurance_provider" id="insuranceProviderSelect" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Choose Insurance Provider</option>
                    <option value="nhif">NHIF</option>
                    <option value="jubilee">Jubilee</option>
                    <option value="aar">AAR (Assemble)</option>
                    <option value="strategis">Strategis</option>
                    <option value="resolution-health">Resolution Health</option>
                    <option value="metropolitan">Metropolitan</option>
                    <option value="other">Other</option>
                  </select>
                  <p class="text-xs text-slate-500 mt-1">Choose the health insurance provider that best suits your employees' needs.</p>

                  <!--choose if its percentages or fixed amounts for both employer and employee-->
                  <div class="flex items-center gap-4 mt-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="radio" name="contribution_type" value="percentage" class="health-contribution-type w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                      <span class="text-sm text-slate-700">Percentage</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="radio" name="contribution_type" value="fixed" class="health-contribution-type w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                      <span class="text-sm text-slate-700">Fixed Amount</span>
                    </label>
                  </div>

                  <!--check if the insurance provider has rate ranges-->
                  <div class="flex items-center gap-4 mt-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="radio" name="insurance_has_ranges" value="yes" id="hasRangesYes" class="w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                      <span class="text-sm text-slate-700">Insurance has rate ranges</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                      <input type="radio" name="insurance_has_ranges" value="no" id="hasRangesNo" class="w-4 h-4 text-green-600 border-slate-300 rounded focus:ring-2 focus:ring-blue-500" />
                      <span class="text-sm text-slate-700">No rate ranges</span>
                    </label>
                  </div>
                  <p class="text-xs text-slate-500 mt-2">Choose selection based on your insurance provider's structure.</p>

                  <!--rate ranges input section - hidden by default-->
                  <div id="rateRangesSection" class="hidden mt-4 p-4 border border-slate-300 rounded-lg bg-slate-50">
                    <h5 class="font-semibold text-slate-900 mb-3">Define Rate Ranges</h5>
                    <div id="rangesContainer" class="space-y-4">
                      <!-- Rate range row will be added dynamically -->
                      <div class="rangeRow grid grid-cols-4 gap-3 p-3 bg-white rounded-lg border border-slate-200">
                        <div>
                          <label class="block text-xs font-medium text-slate-700 mb-1">Lower Bound</label>
                          <input type="number" name="range_lower_bound[]" step="0.01" min="0" placeholder="0.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div>
                          <label class="block text-xs font-medium text-slate-700 mb-1">Upper Bound</label>
                          <input type="number" name="range_upper_bound[]" step="0.01" min="0" placeholder="5000.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div>
                          <label class="block text-xs font-medium text-slate-700 mb-1">Employer Contribution <span class="contribution-unit-label">(%)</span></label>
                          <input type="number" name="range_employer_contribution[]" step="0.01" min="0" placeholder="5.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                        <div>
                          <label class="block text-xs font-medium text-slate-700 mb-1">Employee Contribution <span class="contribution-unit-label">(%)</span></label>
                          <input type="number" name="range_employee_contribution[]" step="0.01" min="0" placeholder="3.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
                        </div>
                      </div>
                    </div>
                    
                    <!-- Add range button -->
                    <button type="button" onclick="addRateRange()" class="mt-3 px-3 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center gap-2">
                      <i data-lucide="plus" class="w-4 h-4"></i>
                      Add Another Range
                    </button>
                  </div>

                  <!--show the insurance contribution percentages for both employer and employee if health insurance is enabled-->
                  <div id="defaultInsuranceContributionFields" class="flex">

                    <!--empoyer contribution-->
                    <div class="mt-4 w-full">
                      <label class="block text-sm font-medium text-slate-700 mb-2">Employer Contribution <span class="contribution-unit-label">(%)</span></label>
                      <div class="flex items-center gap-2 mb-4">
                        <input name="employer_contribution" id="employerContributionInput" type="number" step="0.01" min="0" max="100" placeholder="e.g., 5.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <span class="text-slate-600 contribution-unit-symbol">%</span>
                      </div>
                    </div>

                    <!--employee contribution -->
                    <div class="mt-4 w-full">
                      <label class="block text-sm font-medium text-slate-700 mb-2">Employee Contribution <span class="contribution-unit-label">(%)</span></label>
                      <div class="flex items-center gap-2 mb-4">
                        <input name="employee_contribution" id="employeeContributionInput" type="number" step="0.01" min="0" max="100" placeholder="e.g., 5.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <span class="text-slate-600 contribution-unit-symbol">%</span>
                      </div>
                    </div>
                  </div>

                  <!--now if the user selects "Other" from the insurance provider dropdown, show a text field to enter the name of the insurance provider-->
                  <div id="otherInsuranceField" class=" mt-4 hidden">
                    <label class="block text-sm font-medium text-slate-700 mb-2 hidden">Specify Insurance Provider</label>
                    <input name="other_insurance_provider" type="text" placeholder="Enter insurance provider name" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <!--also input the contributions if percentage is selected for both employer and employee-->
                    <div class="flex items-center gap-2 mt-4">

                      <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Employer Contribution <span class="contribution-unit-label">(%)</span></label>
                        <div class="flex items-center gap-2">
                          <input name="employer_contribution" type="number" step="0.01" min="0" max="100" value="" placeholder="Employer Contribution (%) e.g., 5.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                          <span class="text-slate-600 contribution-unit-symbol">%</span>
                        </div>
                      </div>
                        
                      <div class="w-full">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Employee Contribution <span class="contribution-unit-label">(%)</span></label>
                        <div class="flex items-center gap-2">
                          <input name="employee_contribution" type="number" step="0.01" min="0" max="100" value="" placeholder="Employee Contribution (%) e.g., 5.00" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                          <span class="text-slate-600 contribution-unit-symbol">%</span>
                        </div>
                      </div>
                        
                    </div>
                  </div>

                </div>

                <!--adding the submit button for the health insurance settings-->
                <div class="mt-6">
                  <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Save Health Insurance Settings
                  </button>
                </div>

                </form>
              </div>
            </div>
            

            <!-- Notifications Section -->
            <div id="notifications" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
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
            
            <!-- Security Section -->
            <div id="security" class="bg-white rounded-xl p-6 border border-slate-200 scroll-mt-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Security</h3>
              <div class="space-y-4">
                <button id="togglePasswordForm" class="w-full px-4 py-3 text-left border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="font-medium text-slate-900">Change Password</p>
                      <p class="text-sm text-slate-600">Last changed 45 days ago</p>
                    </div>
                    <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
                  </div>
                </button>

                <!-- Change Password Form (Initially Hidden) -->
                <div id="passwordChangeForm" class="hidden p-4 border border-indigo-200 rounded-lg bg-indigo-50/30">
                  <h4 class="font-semibold text-slate-900 mb-4">Change Your Password</h4>
                  <form class="space-y-4">
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Current Password</label>
                      <input type="password" placeholder="Enter current password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">New Password</label>
                      <input type="password" placeholder="Enter new password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                      <p class="text-xs text-slate-500 mt-1">Must be at least 8 characters with uppercase, lowercase, and numbers</p>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-slate-700 mb-2">Confirm New Password</label>
                      <input type="password" placeholder="Re-enter new password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div class="flex gap-3 pt-2">
                      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        Update Password
                      </button>
                      <button type="button" id="cancelPasswordChange" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors">
                        Cancel
                      </button>
                    </div>
                  </form>
                </div>

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

    // ===== PASSWORD CHANGE FORM TOGGLE =====
    const togglePasswordBtn = document.getElementById('togglePasswordForm');
    const passwordForm = document.getElementById('passwordChangeForm');
    const cancelPasswordBtn = document.getElementById('cancelPasswordChange');

    // Show password form when clicking "Change Password" button
    if (togglePasswordBtn && passwordForm) {
      togglePasswordBtn.addEventListener('click', function() {
        passwordForm.classList.toggle('hidden');
        // Re-initialize icons after showing form
        if (window.lucide) lucide.createIcons();
      });
    }

    // Hide password form when clicking "Cancel" button
    if (cancelPasswordBtn && passwordForm) {
      cancelPasswordBtn.addEventListener('click', function() {
        passwordForm.classList.add('hidden');
      });
    }

    // ===== NSSF/PSSF TOGGLE FUNCTIONALITY =====
    const nssfToggle = document.getElementById('nssfToggle');
    const nssfPercentageField = document.getElementById('nssfPercentageField');
    const pssfToggle = document.getElementById('pssfToggle');
    const pssfPercentageField = document.getElementById('pssfPercentageField');

    // ===== HEALTH INSURANCE TOGGLE AND FUNCTIONIALITIES =====
    const insuranceProviderSelect = document.getElementById('insuranceProviderSelect');
    const otherInsuranceField = document.getElementById('otherInsuranceField');
    const defaultInsuranceContributionFields = document.getElementById('defaultInsuranceContributionFields');
    const employerContributionInput = document.getElementById('employerContributionInput');
    const employeeContributionInput = document.getElementById('employeeContributionInput');
    const healthContributionTypeRadios = document.querySelectorAll('.health-contribution-type');

    // Change contribution unit text based on selected type (percentage/fixed amount)
    function updateContributionUnit() {
      const selectedType = document.querySelector('.health-contribution-type:checked')?.value || 'percentage';
      const unitLabel = selectedType === 'fixed' ? '(Tsh)' : '(%)';
      const unitSymbol = selectedType === 'fixed' ? 'Tsh' : '%';

      // Update all contribution labels
      document.querySelectorAll('.contribution-unit-label').forEach(function(label) {
        label.textContent = unitLabel;
      });

      // Update all contribution symbols near inputs
      document.querySelectorAll('.contribution-unit-symbol').forEach(function(symbol) {
        symbol.textContent = unitSymbol;
      });
    }

    // Run once on load and whenever user changes the contribution type
    updateContributionUnit();
    healthContributionTypeRadios.forEach(function(radio) {
      radio.addEventListener('change', updateContributionUnit);
    });

    // Enable or disable inputs inside a section
    function setSectionInputsEnabled(section, enabled) {
      if (!section) return;
      section.querySelectorAll('input, select, textarea').forEach(function(field) {
        field.disabled = !enabled;
      });
    }

    // Keep contribution input state in sync so hidden duplicate fields are not submitted
    function syncHealthInsuranceInputState() {
      const isOtherProvider = insuranceProviderSelect?.value === 'other';
      const hasRateRanges = document.getElementById('hasRangesYes')?.checked;

      if (defaultInsuranceContributionFields) {
        const defaultContributionInputs = defaultInsuranceContributionFields.querySelectorAll('input[name="employer_contribution"], input[name="employee_contribution"]');
        defaultContributionInputs.forEach(function(input) {
          input.disabled = isOtherProvider || !!hasRateRanges || defaultInsuranceContributionFields.classList.contains('hidden');
        });
      }

      if (otherInsuranceField) {
        const otherContributionInputs = otherInsuranceField.querySelectorAll('input[name="employer_contribution"], input[name="employee_contribution"]');
        otherContributionInputs.forEach(function(input) {
          input.disabled = !isOtherProvider || !!hasRateRanges || otherInsuranceField.classList.contains('hidden');
        });

        const otherProviderInput = otherInsuranceField.querySelector('input[name="other_insurance_provider"]');
        if (otherProviderInput) {
          otherProviderInput.disabled = !isOtherProvider;
        }
      }
    }

    // Show "Other Insurance" field only when user selects "Other"
    if (insuranceProviderSelect && otherInsuranceField) {
      insuranceProviderSelect.addEventListener('change', function() {
        // If user selects "Other", hide default contribution fields and show custom fields
        if (this.value === 'other') {
          otherInsuranceField.classList.remove('hidden');
          if (defaultInsuranceContributionFields) defaultInsuranceContributionFields.classList.add('hidden');
        } else {
          otherInsuranceField.classList.add('hidden');
          if (defaultInsuranceContributionFields && !document.getElementById('hasRangesYes')?.checked) {
            defaultInsuranceContributionFields.classList.remove('hidden');
          }
        }

        // If NHIF is selected, auto-fill both contributions with 3%
        if (this.value === 'nhif') {
          if (employerContributionInput) employerContributionInput.value = '3.00';
          if (employeeContributionInput) employeeContributionInput.value = '3.00';
        }

        syncHealthInsuranceInputState();
      });
    }

    // ===== HEALTH INSURANCE RATE RANGES TOGGLE =====
    const hasRangesYes = document.getElementById('hasRangesYes');
    const hasRangesNo = document.getElementById('hasRangesNo');
    const rateRangesSection = document.getElementById('rateRangesSection');
    const insuranceHasRangesHidden = document.getElementById('insurance_has_ranges_hidden');

    // Show rate ranges section when "has ranges" is selected
    if (hasRangesYes && hasRangesNo && rateRangesSection) {
      hasRangesYes.addEventListener('change', function() {
        if (this.checked) {
          rateRangesSection.classList.remove('hidden');
          // Hide default contribution fields when rate ranges are enabled
          if (defaultInsuranceContributionFields) {
            defaultInsuranceContributionFields.classList.add('hidden');
          }
          // Update hidden field
          if (insuranceHasRangesHidden) {
            insuranceHasRangesHidden.value = 'yes';
          }
          syncHealthInsuranceInputState();
        }
      });

      hasRangesNo.addEventListener('change', function() {
        if (this.checked) {
          rateRangesSection.classList.add('hidden');
          // Show default contribution fields when rate ranges are disabled
          if (defaultInsuranceContributionFields && insuranceProviderSelect?.value !== 'other') {
            defaultInsuranceContributionFields.classList.remove('hidden');
          }
          // Update hidden field
          if (insuranceHasRangesHidden) {
            insuranceHasRangesHidden.value = 'no';
          }
          syncHealthInsuranceInputState();
        }
      });
    }

    // Toggle NSSF percentage field
    if (nssfToggle && nssfPercentageField) {
      nssfToggle.addEventListener('change', function() {
        if (this.checked) {
          nssfPercentageField.classList.remove('hidden');
          // Optionally uncheck PSSF if NSSF is enabled (mutual exclusivity)
          // Uncomment the next two lines if you want to enforce only one can be active
          // if (pssfToggle) pssfToggle.checked = false;
          // if (pssfPercentageField) pssfPercentageField.classList.add('hidden');
        } else {
          nssfPercentageField.classList.add('hidden');
        }
        // Re-initialize icons after showing/hiding fields
        if (window.lucide) lucide.createIcons();
      });
    }

    // Toggle PSSF percentage field
    if (pssfToggle && pssfPercentageField) {
      pssfToggle.addEventListener('change', function() {
        if (this.checked) {
          pssfPercentageField.classList.remove('hidden');
          // Optionally uncheck NSSF if PSSF is enabled (mutual exclusivity)
          // Uncomment the next two lines if you want to enforce only one can be active
          // if (nssfToggle) nssfToggle.checked = false;
          // if (nssfPercentageField) nssfPercentageField.classList.add('hidden');
        } else {
          pssfPercentageField.classList.add('hidden');
        }
        // Re-initialize icons after showing/hiding fields
        if (window.lucide) lucide.createIcons();
      });
    }

    // ===== HEALTH INSURANCE FORM SUBMISSION =====
    const healthInsuranceForm = document.getElementById('healthInsuranceForm');
    if (healthInsuranceForm) {
      healthInsuranceForm.addEventListener('submit', function(e) {
        // Ensure rate ranges selection is properly set
        const hasRangesYesChecked = document.getElementById('hasRangesYes')?.checked;
        const insuranceHasRangesHidden = document.getElementById('insurance_has_ranges_hidden');
        
        if (hasRangesYesChecked && insuranceHasRangesHidden) {
          insuranceHasRangesHidden.value = 'yes';
        } else if (insuranceHasRangesHidden) {
          insuranceHasRangesHidden.value = 'no';
        }

        syncHealthInsuranceInputState();
      });
    }

    // Initial sync on page load
    syncHealthInsuranceInputState();
  });
</script>

<script>
  // Function to add new rate range row
  function addRateRange() {
    const rangesContainer = document.getElementById('rangesContainer');
    
    // Get current unit label for dynamic display
    const selectedType = document.querySelector('.health-contribution-type:checked')?.value || 'percentage';
    const unitLabel = selectedType === 'fixed' ? '(Tsh)' : '(%)';
    
    // Create new range row HTML
    const newRow = document.createElement('div');
    newRow.className = 'rangeRow grid grid-cols-4 gap-3 p-3 bg-white rounded-lg border border-slate-200';
    newRow.innerHTML = `
      <div>
        <label class="block text-xs font-medium text-slate-700 mb-1">Lower Bound</label>
        <input type="number" name="range_lower_bound[]" step="0.01" min="0" placeholder="0.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-700 mb-1">Upper Bound</label>
        <input type="number" name="range_upper_bound[]" step="0.01" min="0" placeholder="5000.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-700 mb-1">Employer Contribution <span class="contribution-unit-label">${unitLabel}</span></label>
        <input type="number" name="range_employer_contribution[]" step="0.01" min="0" placeholder="5.00" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>
      <div class="flex flex-col">
        <label class="block text-xs font-medium text-slate-700 mb-1">Employee Contribution <span class="contribution-unit-label">${unitLabel}</span></label>
        <div class="flex gap-2 items-start">
          <input type="number" name="range_employee_contribution[]" step="0.01" min="0" placeholder="3.00" class="flex-1 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />
          <button type="button" onclick="removeRateRange(this)" class="px-2 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors mt-0.5">
            <i data-lucide="trash-2" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    `;
    
    rangesContainer.appendChild(newRow);
    
    // Re-initialize Lucide icons for the new button
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  }

  // Function to remove a rate range row
  function removeRateRange(button) {
    const rangeRow = button.closest('.rangeRow');
    if (rangeRow) {
      rangeRow.remove();
    }
  }
</script>

</x-Account-sidebar>