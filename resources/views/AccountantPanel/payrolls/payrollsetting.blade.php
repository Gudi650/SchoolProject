<x-Account-sidebar>
    <x-slot name="title">Payroll Settings</x-slot>
    
    <main class="p-4 min-h-screen">
        <div class="max-w-full mx-auto px-6">
        
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Payroll Management</h2>
                <p class="text-sm text-slate-600 mt-1">Manage staff and teacher payroll settings</p>
            </div>
            <button type="button" onclick="openAddModal()" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-150">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add New Employee
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Total Employees</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $totalEmployees ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Teachers</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $totalTeachers ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="user-check" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Staff</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $totalStaff ?? 0 }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="dollar-sign" class="w-6 h-6 text-amber-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600">Monthly Payroll</p>
                        <p class="text-2xl font-bold text-slate-900">${{ number_format($totalPayroll ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search Section -->
        <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-1">
                    <input type="text" id="searchEmployee" placeholder="Search by name or ID..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors text-sm">
                </div>
                <div>
                    <select id="filterType" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors text-sm">
                        <option value="">All Types</option>
                        <option value="teacher">Teachers</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Administrative</option>
                    </select>
                </div>
                <div>
                    <select id="filterStatus" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors text-sm">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <button onclick="resetFilters()" class="w-full inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition-colors duration-150 text-sm">
                        <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Payroll Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h5 class="text-lg font-semibold text-slate-900">Employee Payroll Records</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200" id="payrollTable">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Employee ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Base Salary</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Allowances</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Deductions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Net Salary</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($employees ?? [] as $employee)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $employee->employee_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <span class="text-indigo-600 font-semibold text-sm">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $employee->name }}</div>
                                        <div class="text-sm text-slate-500">{{ $employee->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->type === 'teacher' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($employee->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $employee->position }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">${{ number_format($employee->base_salary, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">${{ number_format($employee->allowances ?? 0, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">${{ number_format($employee->deductions ?? 0, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">${{ number_format($employee->net_salary, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                @if($employee->payment_method === 'bank')
                                <i data-lucide="landmark" class="w-4 h-4 inline mr-1"></i>Bank
                                @else
                                <i data-lucide="banknote" class="w-4 h-4 inline mr-1"></i>Cash
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($employee->status === 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button onclick="viewEmployee({{ $employee->id }})" class="text-indigo-600 hover:text-indigo-900 mx-1" title="View">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <button onclick="editEmployee({{ $employee->id }})" class="text-amber-600 hover:text-amber-900 mx-1" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <button onclick="deleteEmployee({{ $employee->id }})" class="text-red-600 hover:text-red-900 mx-1" title="Delete">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="users" class="w-16 h-16 text-slate-300 mb-4"></i>
                                    <p class="text-slate-500 text-sm">No payroll records found. Click "Add New Employee" to get started.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($employees) && $employees->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $employees->links() }}
            </div>
            @endif
        </div>

        </div>
    </main>

    <!-- Add/Edit Payroll Modal -->
    <div id="payrollModal" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center p-4" style="margin-left: 280px !important; left: 0;">
        <div class="w-full max-w-3xl max-h-[95vh] bg-white shadow-2xl rounded-xl flex flex-col overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-slate-200 bg-white flex-shrink-0">
                <h3 class="text-xl font-bold text-slate-900" id="modalTitle">
                    <i data-lucide="user-plus" class="w-5 h-5 inline mr-2"></i>
                    Add New Employee to Payroll
                </h3>
                <button onclick="closeModal()" type="button" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition-colors flex-shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="payrollForm" method="POST" action="" class="flex flex-col h-full overflow-hidden">
                @csrf
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    
                    <!-- Teacher Search Section -->
                    <div class="mb-8 pb-6 border-b-2 border-slate-200">
                        <h6 class="text-indigo-600 font-bold text-base mb-4">
                            <i data-lucide="search" class="w-4 h-4 inline mr-2"></i>
                            Find Teacher or Staff Member
                        </h6>
                        <div class="space-y-3">
                            <div>
                                <label for="teacher_select" class="block text-sm font-semibold text-slate-700 mb-2">Select by Name or ID</label>
                                <select id="teacher_select" name="teacher_select" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="">Select a teacher...</option>
                                    @forelse($teachers ?? [] as $teacher)
                                        <option 
                                            value="{{ $teacher->id }}" 
                                            data-name="{{ $teacher->name }}" 
                                            data-idnumber="{{ $teacher->employee_id ?? ($teacher->id_number ?? '') }}" 
                                            data-position="{{ $teacher->position ?? '' }}">
                                            {{ $teacher->name }}
                                            @if(!empty($teacher->employee_id ?? ($teacher->id_number ?? ''))) ({{ $teacher->employee_id ?? $teacher->id_number }}) @endif
                                        </option>
                                    @empty
                                        <option value="" disabled>No teachers available</option>
                                    @endforelse
                                </select>
                                <p class="mt-1 text-xs text-slate-500">This list will be populated by Laravel.</p>
                            </div>
                            
                            <!-- Selected Teacher Info (Hidden by default) -->
                            <div id="selectedTeacherInfo" class="hidden p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-slate-600 mb-1">Selected Teacher:</p>
                                        <p id="selectedTeacherName" class="text-lg font-bold text-indigo-600"></p>
                                        <p id="selectedTeacherId" class="text-sm text-slate-500 mt-1"></p>
                                        <p id="selectedTeacherPosition" class="text-sm text-slate-500"></p>
                                    </div>
                                    <button type="button" onclick="clearSelectedTeacher()" class="text-indigo-600 hover:text-indigo-700 p-1 hover:bg-indigo-100 rounded">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                <input type="hidden" id="selected_teacher_id" name="teacher_id">
                            </div>
                            
                            <!-- Toggle for New Employee -->
                            <div class="flex items-center gap-2 pt-2">
                                <input type="checkbox" id="createNewEmployee" name="create_new_employee" class="w-4 h-4 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                                <label for="createNewEmployee" class="text-sm font-medium text-slate-700 cursor-pointer">
                                    Create new employee record (if not found above)
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Personal Information (Hidden by default, shown when creating new or toggle is checked) -->
                    <div id="personalInfoSection" class="mb-8 hidden">
                        <h6 class="text-indigo-600 font-bold text-base mb-4 pb-2 border-b-2 border-indigo-200">
                            <i data-lucide="user" class="w-4 h-4 inline mr-2"></i>
                            Personal Information
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="employee_id" class="block text-sm font-semibold text-slate-700 mb-2">Employee ID <span class="text-red-600">*</span></label>
                                <input type="text" id="employee_id" name="employee_id" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                <p class="mt-1 text-xs text-slate-500">Unique identifier for the employee</p>
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name <span class="text-red-600">*</span></label>
                                <input type="text" id="name" name="name" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                <p class="mt-1 text-xs text-slate-500">Optional</p>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone Number <span class="text-red-600">*</span></label>
                                <input type="tel" id="phone" name="phone" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-semibold text-slate-700 mb-2">Employee Type <span class="text-red-600">*</span></label>
                                <select id="type" name="type" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="">Select Type</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Administrative</option>
                                </select>
                            </div>
                            <div>
                                <label for="position" class="block text-sm font-semibold text-slate-700 mb-2">Position/Designation <span class="text-red-600">*</span></label>
                                <input type="text" id="position" name="position" placeholder="e.g., Mathematics Teacher" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Salary Information -->
                    <div class="mb-8">
                        <h6 class="text-indigo-600 font-bold text-base mb-4 pb-2 border-b-2 border-indigo-200">
                            <i data-lucide="dollar-sign" class="w-4 h-4 inline mr-2"></i>
                            Salary Information
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="base_salary" class="block text-sm font-medium text-slate-700 mb-1">Base Salary <span class="text-red-600">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="base_salary" name="base_salary" step="0.01" min="0" required class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="payment_frequency" class="block text-sm font-medium text-slate-700 mb-1">Payment Frequency <span class="text-red-600">*</span></label>
                                <select id="payment_frequency" name="payment_frequency" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="">Select Frequency</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="bi-weekly">Bi-Weekly</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Allowances -->
                    <div class="mb-6">
                        <h6 class="text-green-700 font-semibold mb-4 pb-2 border-b border-slate-200">
                            <i data-lucide="plus-circle" class="w-4 h-4 inline mr-2"></i>
                            Allowances
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="housing_allowance" class="block text-sm font-medium text-slate-700 mb-1">Housing Allowance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="housing_allowance" name="housing_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="transport_allowance" class="block text-sm font-medium text-slate-700 mb-1">Transport Allowance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="transport_allowance" name="transport_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="meal_allowance" class="block text-sm font-medium text-slate-700 mb-1">Meal Allowance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="meal_allowance" name="meal_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="medical_allowance" class="block text-sm font-medium text-slate-700 mb-1">Medical Allowance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="medical_allowance" name="medical_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="extra_time_allowance" class="block text-sm font-medium text-slate-700 mb-1">Extra Time Allowance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="extra_time_allowance" name="extra_time_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="other_allowance" class="block text-sm font-medium text-slate-700 mb-1">Other Allowances</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="other_allowance" name="other_allowance" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deductions -->
                    <div class="mb-6">
                        <h6 class="text-red-700 font-semibold mb-4 pb-2 border-b border-slate-200">
                            <i data-lucide="minus-circle" class="w-4 h-4 inline mr-2"></i>
                            Deductions
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="tax_deduction" class="block text-sm font-medium text-slate-700 mb-1">Tax Deduction</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="tax_deduction" name="tax_deduction" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="insurance_deduction" class="block text-sm font-medium text-slate-700 mb-1">Insurance</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="insurance_deduction" name="insurance_deduction" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="provident_fund" class="block text-sm font-medium text-slate-700 mb-1">Provident Fund</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="provident_fund" name="provident_fund" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="loan_deduction" class="block text-sm font-medium text-slate-700 mb-1">Loan Deduction</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="loan_deduction" name="loan_deduction" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                </div>
                            </div>
                            <div>
                                <label for="other_deduction" class="block text-sm font-medium text-slate-700 mb-1">Other Deductions</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" id="other_deduction" name="other_deduction" step="0.01" min="0" value="0" class="w-full pl-8 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Net Salary Display -->
                    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h6 class="font-semibold text-slate-900">Net Salary (Calculated)</h6>
                                <p class="text-xs text-slate-600 mt-1">Base Salary + Total Allowances - Total Deductions</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-blue-600" id="netSalaryDisplay">$0.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-6">
                        <h6 class="text-indigo-700 font-semibold mb-4 pb-2 border-b border-slate-200">
                            <i data-lucide="landmark" class="w-4 h-4 inline mr-2"></i>
                            Payment Information
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="payment_method" class="block text-sm font-medium text-slate-700 mb-1">Payment Method <span class="text-red-600">*</span></label>
                                <select id="payment_method" name="payment_method" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="">Select Method</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                </select>
                            </div>
                            <div id="bankDetailsSection" class="md:col-span-2 hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="bank_name" class="block text-sm font-medium text-slate-700 mb-1">Bank Name</label>
                                        <input type="text" id="bank_name" name="bank_name" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    </div>
                                    <div>
                                        <label for="account_number" class="block text-sm font-medium text-slate-700 mb-1">Account Number</label>
                                        <input type="text" id="account_number" name="account_number" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    </div>
                                    <div>
                                        <label for="account_name" class="block text-sm font-medium text-slate-700 mb-1">Account Holder Name</label>
                                        <input type="text" id="account_name" name="account_name" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    </div>
                                    <div>
                                        <label for="ifsc_code" class="block text-sm font-medium text-slate-700 mb-1">IFSC/Routing Code</label>
                                        <input type="text" id="ifsc_code" name="ifsc_code" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="branch_name" class="block text-sm font-medium text-slate-700 mb-1">Branch Name</label>
                                        <input type="text" id="branch_name" name="branch_name" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <h6 class="text-indigo-700 font-semibold mb-4 pb-2 border-b border-slate-200">
                            <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                            Additional Information
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Employment Status <span class="text-red-600">*</span></label>
                                <select id="status" name="status" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="on_leave">On Leave</option>
                                </select>
                            </div>
                            <div>
                                <label for="contract_type" class="block text-sm font-medium text-slate-700 mb-1">Contract Type</label>
                                <select id="contract_type" name="contract_type" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm">
                                    <option value="permanent">Permanent</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-slate-700 mb-1">Notes/Remarks</label>
                                <textarea id="notes" name="notes" rows="3" placeholder="Any additional information..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 px-6 py-4 border-t border-slate-200 bg-slate-50 flex-shrink-0">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors border border-red-700 text-sm">
                        <i data-lucide="x" class="w-4 h-4 inline mr-2"></i>
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors shadow-md text-sm">
                        <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                        Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Utility: Initialize Lucide icons
        function initLucideIcons() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Utility: Get element value or fallback
        function getNumericValue(elementId) {
            return parseFloat(document.getElementById(elementId)?.value) || 0;
        }

        // Modal functions
        function openAddModal() {
            document.getElementById('payrollModal').classList.remove('hidden');
            document.getElementById('payrollForm').reset();
            document.getElementById('modalTitle').innerHTML = '<i data-lucide="user-plus" class="w-5 h-5 inline mr-2"></i>Add New Employee to Payroll';
            document.getElementById('personalInfoSection').classList.add('hidden');
            document.getElementById('selectedTeacherInfo').classList.add('hidden');
            document.getElementById('bankDetailsSection').classList.add('hidden');
            initLucideIcons();
        }

        function closeModal() {
            document.getElementById('payrollModal').classList.add('hidden');
        }

        // Calculate Net Salary in real-time
        function calculateNetSalary() {
            const baseSalary = getNumericValue('base_salary');
            
            // Allowances
            const allowances = [
                'housing_allowance', 'transport_allowance', 'meal_allowance',
                'medical_allowance', 'extra_time_allowance', 'other_allowance'
            ].reduce((sum, id) => sum + getNumericValue(id), 0);
            
            // Deductions
            const deductions = [
                'tax_deduction', 'insurance_deduction', 'provident_fund',
                'loan_deduction', 'other_deduction'
            ].reduce((sum, id) => sum + getNumericValue(id), 0);
            
            const netSalary = baseSalary + allowances - deductions;
            document.getElementById('netSalaryDisplay').textContent = '$' + netSalary.toFixed(2);
        }

        // Select/Clear Teacher functions
        function selectTeacher(teacherId, name, idNumber, position) {
            document.getElementById('selected_teacher_id').value = teacherId;
            document.getElementById('selectedTeacherName').textContent = name;
            document.getElementById('selectedTeacherId').textContent = `ID: ${idNumber}`;
            document.getElementById('selectedTeacherPosition').textContent = position;
            document.getElementById('selectedTeacherInfo').classList.remove('hidden');
            document.getElementById('personalInfoSection').classList.add('hidden');
            document.getElementById('createNewEmployee').checked = false;
        }

        function clearSelectedTeacher() {
            document.getElementById('selected_teacher_id').value = '';
            document.getElementById('selectedTeacherInfo').classList.add('hidden');
            const teacherSelect = document.getElementById('teacher_select');
            if (teacherSelect) teacherSelect.value = '';
            document.getElementById('createNewEmployee').checked = false;
        }

        // Table filtering (search and filters combined)
        function applyTableFilters() {
            const searchValue = document.getElementById('searchEmployee')?.value.toLowerCase() || '';
            const typeFilter = document.getElementById('filterType')?.value.toLowerCase() || '';
            const statusFilter = document.getElementById('filterStatus')?.value.toLowerCase() || '';
            const tableRows = document.querySelectorAll('#payrollTable tbody tr');
            
            tableRows.forEach(row => {
                if (row.cells.length <= 1) return;
                
                const rowText = row.textContent.toLowerCase();
                const typeCell = row.cells[2]?.textContent.toLowerCase() || '';
                const statusCell = row.cells[9]?.textContent.toLowerCase() || '';
                
                const searchMatch = !searchValue || rowText.includes(searchValue);
                const typeMatch = !typeFilter || typeCell.includes(typeFilter);
                const statusMatch = !statusFilter || statusCell.includes(statusFilter);
                
                row.style.display = (searchMatch && typeMatch && statusMatch) ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchEmployee').value = '';
            document.getElementById('filterType').value = '';
            document.getElementById('filterStatus').value = '';
            applyTableFilters();
        }

        // Placeholder functions for backend (Laravel will handle)
        function viewEmployee(id) {
            console.log('View employee:', id);
        }

        function editEmployee(id) {
            console.log('Edit employee:', id);
        }

        function deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee from payroll?')) {
                console.log('Delete employee:', id);
            }
        }

        // Initialize all event listeners on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            // Validation error clearing on input
            document.addEventListener('input', function(e) {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT') {
                    e.target.classList.remove('border-red-500', 'ring-red-500');
                }
            });

            // Salary calculation inputs
            const salaryInputs = [
                'base_salary', 'housing_allowance', 'transport_allowance', 'meal_allowance',
                'medical_allowance', 'extra_time_allowance', 'other_allowance', 'tax_deduction', 'insurance_deduction',
                'provident_fund', 'loan_deduction', 'other_deduction'
            ];
            
            salaryInputs.forEach(inputId => {
                const element = document.getElementById(inputId);
                if (element) element.addEventListener('input', calculateNetSalary);
            });

            // Payment method change
            const paymentMethod = document.getElementById('payment_method');
            if (paymentMethod) {
                paymentMethod.addEventListener('change', function() {
                    const bankSection = document.getElementById('bankDetailsSection');
                    bankSection?.classList.toggle('hidden', this.value !== 'bank');
                });
            }

            // Teacher dropdown selection
            const teacherSelect = document.getElementById('teacher_select');
            if (teacherSelect) {
                teacherSelect.addEventListener('change', function() {
                    const opt = this.selectedOptions[0];
                    if (!opt || !this.value) {
                        clearSelectedTeacher();
                        return;
                    }
                    selectTeacher(
                        this.value,
                        opt.dataset.name || '',
                        opt.dataset.idnumber || '',
                        opt.dataset.position || ''
                    );
                });
            }

            // Create new employee toggle
            const createNewCheckbox = document.getElementById('createNewEmployee');
            if (createNewCheckbox) {
                createNewCheckbox.addEventListener('change', function() {
                    const personalInfoSection = document.getElementById('personalInfoSection');
                    if (this.checked) {
                        personalInfoSection?.classList.remove('hidden');
                        clearSelectedTeacher();
                    } else {
                        personalInfoSection?.classList.add('hidden');
                    }
                });
            }

            // Form validation on submit
            const payrollForm = document.getElementById('payrollForm');
            if (payrollForm) {
                payrollForm.addEventListener('submit', function(e) {
                    const selectedTeacherId = document.getElementById('selected_teacher_id')?.value;
                    const createNewEmployee = document.getElementById('createNewEmployee')?.checked;
                    
                    // Validate personal info if creating new employee
                    if (createNewEmployee || (!selectedTeacherId && !createNewEmployee)) {
                        const requiredFields = ['employee_id', 'name', 'phone', 'type', 'position'];
                        let isValid = true;
                        
                        requiredFields.forEach(fieldId => {
                            const field = document.getElementById(fieldId);
                            if (!field?.value.trim()) {
                                field?.classList.add('border-red-500', 'ring-red-500');
                                isValid = false;
                            } else {
                                field?.classList.remove('border-red-500', 'ring-red-500');
                            }
                        });
                        
                        if (!isValid) {
                            e.preventDefault();
                            alert('Please fill in all required personal information fields.');
                            return;
                        }
                    }
                    
                    // Validate financial info (always required)
                    const baseSalary = document.getElementById('base_salary')?.value;
                    const paymentMethod = document.getElementById('payment_method')?.value;
                    
                    if (!baseSalary || baseSalary <= 0) {
                        e.preventDefault();
                        alert('Please enter a valid base salary.');
                        document.getElementById('base_salary')?.focus();
                        return;
                    }
                    
                    if (!paymentMethod) {
                        e.preventDefault();
                        alert('Please select a payment method.');
                        document.getElementById('payment_method')?.focus();
                        return;
                    }
                });
            }

            // Table search
            const searchEmployee = document.getElementById('searchEmployee');
            if (searchEmployee) {
                searchEmployee.addEventListener('input', applyTableFilters);
            }

            // Table filters
            const filterType = document.getElementById('filterType');
            const filterStatus = document.getElementById('filterStatus');
            if (filterType) filterType.addEventListener('change', applyTableFilters);
            if (filterStatus) filterStatus.addEventListener('change', applyTableFilters);

            // Initialize Lucide icons
            initLucideIcons();
        });
    </script>

</x-Account-sidebar>
