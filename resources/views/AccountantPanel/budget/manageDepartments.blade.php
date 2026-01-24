<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>

  <main class="p-6 bg-white min-h-screen">
    <div class="max-w-5xl mx-auto">

      <!-- Page Header with Icon -->
      <div class="mb-8 bg-white rounded-xl p-4 sm:p-6 border border-slate-200 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="flex items-start gap-3 sm:gap-4 min-w-0">
            <div class="w-10 sm:w-12 h-10 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-lucide="building-2" class="w-5 sm:w-6 h-5 sm:h-6 text-purple-600"></i>
            </div>
            <div class="min-w-0">
              <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Manage Departments</h1>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 sm:mt-2">Create and manage departments for your school budget</p>
            </div>
          </div>
          <a 
            href="{{ route('accounting.createBudget') }}"
            class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors inline-flex items-center justify-center sm:justify-start gap-2 whitespace-nowrap w-full sm:w-auto"
          >
            <i data-lucide="arrow-left" class="w-4 h-4 flex-shrink-0"></i>
            <span class="hidden sm:inline">Back to Budget</span>
            <span class="sm:hidden">Back</span>
          </a>
        </div>
      </div>

      <!-- Success/Error Messages -->
      @if(session('success'))
        <div id="successMessage" class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
          <div class="flex items-start justify-between">
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
              </div>
              <div class="flex-1">
                <h4 class="text-sm font-semibold text-green-900">Success!</h4>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
              </div>
            </div>
            <button 
              type="button" 
              onclick="this.parentElement.parentElement.remove()"
              class="text-green-600 hover:text-green-800 transition-colors"
            >
              <i data-lucide="x" class="w-5 h-5"></i>
            </button>
          </div>
        </div>
      @endif

      @if(session('error'))
        <div id="errorMessage" class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
          <div class="flex items-start justify-between">
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
              </div>
              <div class="flex-1">
                <h4 class="text-sm font-semibold text-red-900">Error!</h4>
                <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
              </div>
            </div>
            <button 
              type="button" 
              onclick="this.parentElement.parentElement.remove()"
              class="text-red-600 hover:text-red-800 transition-colors"
            >
              <i data-lucide="x" class="w-5 h-5"></i>
            </button>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div id="validationErrors" class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
          <div class="flex items-start justify-between">
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
              </div>
              <div class="flex-1">
                <h4 class="text-sm font-semibold text-red-900">Validation Errors</h4>
                <ul class="mt-2 space-y-1">
                  @foreach($errors->all() as $error)
                    <li class="text-sm text-red-700 flex items-start gap-2">
                      <i data-lucide="minus" class="w-3 h-3 mt-0.5 flex-shrink-0"></i>
                      <span>{{ $error }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <button 
              type="button" 
              onclick="this.parentElement.parentElement.remove()"
              class="text-red-600 hover:text-red-800 transition-colors"
            >
              <i data-lucide="x" class="w-5 h-5"></i>
            </button>
          </div>
        </div>
      @endif

      <!-- Main Container -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Add Department Form (Left Column) -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <!-- Form Header -->
            <div class="p-6 bg-blue-50 border-b border-slate-200">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                  <i data-lucide="plus-circle" class="w-5 h-5 text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-900">Add Department</h3>
              </div>
            </div>

            <!-- Form Body -->
            <div class="p-6">
              <form action="{{ route('accounting.departmentManagement.create') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Department Name Input -->
                <div>
                  <label for="departmentName" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                    <i data-lucide="briefcase" class="w-4 h-4 text-slate-600"></i>
                    Department Name <span class="text-red-600">*</span>
                  </label>
                  <input 
                    type="text" 
                    id="departmentName" 
                    name="department_name" 
                    placeholder="e.g., Academic"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                    required
                  >
                  <p class="text-xs text-slate-500 mt-1">Unique department name</p>
                </div>

                <!-- Description Input -->
                <div>
                  <label for="departmentDescription" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                    <i data-lucide="align-left" class="w-4 h-4 text-slate-600"></i>
                    Description
                  </label>
                  <textarea 
                    id="departmentDescription" 
                    name="description" 
                    rows="3"
                    placeholder="Optional description..."
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm resize-none transition-all bg-slate-50 focus:bg-white"
                  ></textarea>
                </div>

                <!-- Submit Button -->
                <button 
                  type="submit" 
                  class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-all shadow-sm hover:shadow flex items-center justify-center gap-2"
                >
                  <i data-lucide="check-circle" class="w-4 h-4"></i>
                  Add Department
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Departments List (Right Column) -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <!-- List Header -->
            <div class="p-6 bg-emerald-50 border-b border-slate-200">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                  <i data-lucide="layers" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-slate-900">Departments</h3>
                  <p class="text-sm text-slate-600 mt-1">Total: <span id="departmentCount" class="font-semibold text-emerald-600">0</span></p>
                </div>
              </div>
            </div>

            <!-- Departments List Container -->
            <div class="divide-y divide-slate-200">

                {{-- 
                    check if the departments is not empty then display the departments
                    if empty then display no departments found
                --}}
                
                @if ($departments && $departments->count()>0)

                    {{-- loop through the departments --}}
                    @foreach ( $departments as $department )
                    
                      <!-- Department rows -->
                      <div class="p-5 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start justify-between">
                          <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                              <i data-lucide="briefcase" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                              <h4 class="text-sm font-semibold text-slate-900">{{ $department->department_name }}</h4>
                              <p class="text-xs text-slate-500 mt-1">{{ $department->description }}</p>
                            </div>
                          </div>
                          <div class="flex gap-2 ml-4">
                            <button 
                              type="button"
                              class="px-3 py-2 text-xs font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 hover:bg-indigo-100 rounded-lg transition-colors"
                              title="Edit"
                            >
                              <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </button>
                            <button 
                              type="button"
                              class="px-3 py-2 text-xs font-medium text-red-600 bg-red-50 border border-red-200 hover:bg-red-100 rounded-lg transition-colors"
                              title="Delete"
                            >
                              <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    
                    @endforeach

                @else

                    <div id="emptyState" class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="inbox" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <p class="text-slate-700 text-base font-semibold mb-1">No departments added yet</p>
                        <p class="text-slate-500 text-sm">Add your first department to get started</p>
                    </div>

                    
                @endif

            </div>
          </div>
        </div>

      </div>

    </div>
  </main>

  <script>
    /**
     * Initialize lucide icons on page
     */
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }

      // Auto-dismiss success/error messages after 5 seconds
      const successMessage = document.getElementById('successMessage');
      const errorMessage = document.getElementById('errorMessage');
      const validationErrors = document.getElementById('validationErrors');

      if (successMessage) {
        setTimeout(() => {
          successMessage.style.transition = 'opacity 0.5s ease-out';
          successMessage.style.opacity = '0';
          setTimeout(() => successMessage.remove(), 500);
        }, 5000);
      }

      if (errorMessage) {
        setTimeout(() => {
          errorMessage.style.transition = 'opacity 0.5s ease-out';
          errorMessage.style.opacity = '0';
          setTimeout(() => errorMessage.remove(), 500);
        }, 7000);
      }

      if (validationErrors) {
        setTimeout(() => {
          validationErrors.style.transition = 'opacity 0.5s ease-out';
          validationErrors.style.opacity = '0';
          setTimeout(() => validationErrors.remove(), 500);
        }, 8000);
      }
    });
  </script>

</x-Account-sidebar>
