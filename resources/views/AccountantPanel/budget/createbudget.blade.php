<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>

  <main class="p-6 bg-white min-h-screen">
    <div class="max-w-5xl mx-auto">

      <!-- Success Message -->
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3 animate-pulse" id="successMessage">
          <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
            <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
          </div>
          <div class="flex-1">
            <p class="text-sm font-semibold text-green-800">Success</p>
            <p class="text-sm text-green-700 mt-0.5">{{ session('success') }}</p>
          </div>
          <button type="button" onclick="document.getElementById('successMessage').remove()" class="text-green-500 hover:text-green-700 transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
      @endif

      <!-- Error Message -->
      @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3" id="errorMessage">
          <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600"></i>
          </div>
          <div class="flex-1">
            <p class="text-sm font-semibold text-red-800">Error</p>
            <p class="text-sm text-red-700 mt-0.5">{{ session('error') }}</p>
          </div>
          <button type="button" onclick="document.getElementById('errorMessage').remove()" class="text-red-500 hover:text-red-700 transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>
      @endif

      <!-- Page Header with Icon -->
      <div class="mb-8 bg-white rounded-xl p-4 sm:p-6 border border-slate-200 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="flex items-start gap-3 sm:gap-4 min-w-0">
            <div class="w-10 sm:w-12 h-10 sm:h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-lucide="wallet" class="w-5 sm:w-6 h-5 sm:h-6 text-indigo-600"></i>
            </div>
            <div class="min-w-0">
              <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Create Budget</h1>
              <p class="text-xs sm:text-sm text-slate-600 mt-1 sm:mt-2">Set up a new budget and allocate funds across departments</p>
            </div>
          </div>
          <div class="flex flex-col xs:flex-row gap-2 w-full sm:w-auto">
            <a 
              href="{{ route('accounting.departmentManagement') }}"
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors inline-flex items-center justify-center sm:justify-start gap-2 whitespace-nowrap"
            >
              <i data-lucide="building-2" class="w-4 h-4 flex-shrink-0"></i>
              <span class="hidden sm:inline">Manage Departments</span>
              <span class="sm:hidden">Departments</span>
            </a>
            <button 
              type="button" 
              onclick="loadLastBudget()"
              class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors inline-flex items-center justify-center sm:justify-start gap-2 whitespace-nowrap"
            >
              <i data-lucide="copy" class="w-4 h-4 flex-shrink-0"></i>
              <span class="hidden sm:inline">Copy from Last Budget</span>
              <span class="sm:hidden">Copy</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Main Form Container - Wrapped in Livewire -->
      
      <form id="budgetForm" 
      action="{{ route('accounting.storeBudget') }}"
      method="POST"
      class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">

      @csrf
        
        <!-- Section 1: Budget Overview -->
        <div class="p-6 border-b border-slate-200 bg-slate-50">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
              <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-slate-900">Budget Overview</h3>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg">
            <!-- Budget Name -->
            <div>
              <label for="budgetName" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="tag" class="w-4 h-4 text-indigo-600"></i>
                Budget Name <span class="text-red-600">*</span>
              </label>
              <input 
                type="text" 
                id="budgetName" 
                name="budgetName" 
                placeholder="e.g., FY 2026 School Operations"
                value="{{ old('budgetName') }}"
                class="w-full px-4 py-2.5 border @error('budgetName') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 @error('budgetName') focus:ring-red-500 focus:border-red-500 @else focus:ring-indigo-500 focus:border-indigo-500 @enderror outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                required
              >
              @error('budgetName')
                <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                  <i data-lucide="alert-circle" class="w-3 h-3"></i>
                  {{ $message }}
                </p>
              @enderror
              <p class="text-xs text-slate-500 mt-1">A descriptive name for this budget</p>
            </div>

            <!-- Total Budget Amount -->
            <div>
              <label for="totalBudget" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="dollar-sign" class="w-4 h-4 text-green-600"></i>
                Total Budget Amount <span class="text-red-600">*</span>
              </label>
              <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 font-medium">$</span>
                <input 
                  type="number" 
                  id="totalBudget" 
                  name="totalBudget" 
                  placeholder="0.00"
                  step="0.01"
                  min="0"
                  value="{{ old('totalBudget') }}"
                  class="w-full pl-8 pr-4 py-2.5 border @error('totalBudget') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 @error('totalBudget') focus:ring-red-500 focus:border-red-500 @else focus:ring-indigo-500 focus:border-indigo-500 @enderror outline-none text-sm transition-all bg-slate-50 focus:bg-white font-semibold text-slate-900"
                  required
                >
              </div>
              @error('totalBudget')
                <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                  <i data-lucide="alert-circle" class="w-3 h-3"></i>
                  {{ $message }}
                </p>
              @enderror
              <p class="text-xs text-slate-500 mt-1">Total amount available for allocation</p>
            </div>

            <!-- Budget Start Date -->
            <div>
              <label for="budgetStartDate" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                Start Date <span class="text-red-600">*</span>
              </label>
              <input 
                type="date" 
                id="budgetStartDate" 
                name="budgetStartDate" 
                value="{{ old('budgetStartDate') }}"
                class="w-full px-4 py-2.5 border @error('budgetStartDate') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 @error('budgetStartDate') focus:ring-red-500 focus:border-red-500 @else focus:ring-indigo-500 focus:border-indigo-500 @enderror outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                required
              >
              @error('budgetStartDate')
                <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                  <i data-lucide="alert-circle" class="w-3 h-3"></i>
                  {{ $message }}
                </p>
              @enderror
              <p class="text-xs text-slate-500 mt-1">Budget period start date</p>
            </div>

            <!-- Budget End Date -->
            <div>
              <label for="budgetEndDate" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                End Date <span class="text-red-600">*</span>
              </label>
              <input 
                type="date" 
                id="budgetEndDate" 
                name="budgetEndDate" 
                value="{{ old('budgetEndDate') }}"
                class="w-full px-4 py-2.5 border @error('budgetEndDate') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 @error('budgetEndDate') focus:ring-red-500 focus:border-red-500 @else focus:ring-indigo-500 focus:border-indigo-500 @enderror outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                required
              >
              @error('budgetEndDate')
                <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                  <i data-lucide="alert-circle" class="w-3 h-3"></i>
                  {{ $message }}
                </p>
              @enderror
              <p class="text-xs text-slate-500 mt-1">Budget period end date</p>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
              <label for="description" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="align-left" class="w-4 h-4 text-slate-600"></i>
                Description
              </label>
              <textarea 
                id="description" 
                name="description" 
                rows="3"
                placeholder="Add notes or details about this budget..."
                class="w-full px-4 py-2.5 border @error('description') border-red-500 @else border-slate-300 @enderror rounded-lg focus:ring-2 @error('description') focus:ring-red-500 focus:border-red-500 @else focus:ring-indigo-500 focus:border-indigo-500 @enderror outline-none text-sm resize-none transition-all bg-slate-50 focus:bg-white"
              >{{ old('description') }}</textarea>
              @error('description')
                <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                  <i data-lucide="alert-circle" class="w-3 h-3"></i>
                  {{ $message }}
                </p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Section 2: Budget Allocation -->
        <div class="p-6 border-b border-slate-200 bg-white">

            {{-- Livewire component renders categories dynamically --}}
            @livewire('create-budget', ['departments' => $departments])

        </div>

        <!-- Section 3: Summary -->
        <div class="p-6 bg-slate-50 border-t border-slate-200">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
              <i data-lucide="pie-chart" class="w-5 h-5 text-emerald-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-slate-900">Budget Summary</h3>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Total Allocated -->
            <div class="bg-white rounded-r-xl rounded-l-none p-5 border-l-4 border-blue-500 shadow-sm">
              <div class="flex items-center justify-between mb-2">
                <p class="text-xs font-medium text-slate-600 uppercase tracking-wide">Total Allocated</p>
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                  <i data-lucide="trending-up" class="w-4 h-4 text-blue-600"></i>
                </div>
              </div>
              <p class="text-2xl font-bold text-slate-900">$<span id="totalAllocated">0.00</span></p>
            </div>

            <!-- Remaining -->
            <div class="bg-white rounded-r-xl rounded-l-none p-5 border-l-4 border-green-500 shadow-sm">
              <div class="flex items-center justify-between mb-2">
                <p class="text-xs font-medium text-slate-600 uppercase tracking-wide">Remaining Balance</p>
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                  <i data-lucide="wallet" class="w-4 h-4 text-green-600"></i>
                </div>
              </div>
              <p class="text-2xl font-bold text-green-600">$<span id="totalRemaining">0.00</span></p>
            </div>

            <!-- Allocation % -->
            <div class="bg-white rounded-r-xl rounded-l-none p-5 border-l-4 border-indigo-500 shadow-sm">
              <div class="flex items-center justify-between mb-2">
                <p class="text-xs font-medium text-slate-600 uppercase tracking-wide">Utilization</p>
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                  <i data-lucide="percent" class="w-4 h-4 text-indigo-600"></i>
                </div>
              </div>
              <p class="text-2xl font-bold text-indigo-600"><span id="allocationPercent">0</span>%</p>
            </div>
          </div>

          <!-- Budget Status Bar -->
          <div class="bg-white rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-center mb-3">
              <div class="flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4 text-slate-600"></i>
                <p class="text-sm font-medium text-slate-700">Budget Allocation Progress</p>
              </div>
              <span class="px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700" id="statusText">Ready</span>
            </div>
            <div class="w-full h-4 bg-slate-200 rounded-full overflow-hidden">
              <div id="progressBar" class="h-full bg-indigo-600 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="px-6 py-5 bg-white border-t border-slate-200 flex justify-end gap-3">
          <button type="reset" class="px-6 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2">
            <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
            Reset Form
          </button>
          <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2 shadow-sm">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            Create Budget
          </button>
        </div>
      </form>

    </div>

    <!-- Budget Selection Modal -->
    <div id="budgetModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4 md:pl-72" style="display: none;">
      <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden flex flex-col mx-auto">
        <!-- Modal Header -->
        <div class="p-4 sm:p-6 border-b border-slate-200 bg-indigo-50">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                <i data-lucide="copy" class="w-5 h-5 text-indigo-600"></i>
              </div>
              <div>
                <h2 class="text-lg sm:text-xl font-bold text-slate-900">Select Budget to Copy</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">Choose a previous budget to use as template</p>
              </div>
            </div>
            <button 
              type="button" 
              onclick="closeBudgetModal()"
              class="text-slate-400 hover:text-slate-600 transition-colors p-1"
            >
              <i data-lucide="x" class="w-6 h-6"></i>
            </button>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6">
          <div id="budgetsList" class="space-y-3">
            <!-- Budget Items - Hardcoded for Backend Integration -->
            @forelse($previousBudgets ?? [] as $budget)
              <div 
                class="p-4 sm:p-5 border-2 border-slate-200 rounded-xl hover:border-indigo-400 hover:bg-indigo-50 transition-all cursor-pointer group"
                onclick="selectBudget({{ $budget->id }})"
              >
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                  <div class="flex-1 min-w-0">
                    <div class="flex items-start gap-3">
                      <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-200 transition-colors">
                        <i data-lucide="file-text" class="w-5 h-5 text-indigo-600"></i>
                      </div>
                      <div class="flex-1 min-w-0">
                        <h3 class="text-sm sm:text-base font-semibold text-slate-900 break-words">{{ $budget->budget_name }}</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1">{{ \Carbon\Carbon::parse($budget->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($budget->end_date)->format('M d, Y') }}</p>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $budget->description ?? 'No description' }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col sm:items-end gap-1 sm:ml-4">
                    <span class="text-lg sm:text-xl font-bold text-indigo-600">${{ number_format($budget->total_amount, 2) }}</span>
                    <span class="text-xs text-slate-500">{{ $budget->categories->count() }} categories</span>
                  </div>
                </div>
              </div>
            @empty
              <!-- Empty State -->
              <div class="text-center py-12">
                <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i data-lucide="inbox" class="w-8 h-8 text-slate-400"></i>
                </div>
                <p class="text-slate-700 text-base font-semibold mb-1">No previous budgets found</p>
                <p class="text-slate-500 text-sm">Create your first budget to get started</p>
              </div>
            @endforelse
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="p-4 sm:p-6 border-t border-slate-200 bg-slate-50">
          <button 
            type="button" 
            onclick="closeBudgetModal()"
            class="w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-slate-700 bg-red-200 border border-slate-300 rounded-lg hover:bg-red-300 transition-colors flex items-center justify-center sm:justify-start gap-2"
          >
            <i data-lucide="x-circle" class="w-4 h-4"></i>
            Cancel
          </button>
        </div>
      </div>
    </div>
  </main>

  <script>
    // ===== HELPERS =====
    
    function reinitIcons() {
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    function getLivewireComponent() {
      const el = document.querySelector('[wire\\:id]');
      return el ? Livewire.find(el.getAttribute('wire:id')) : null;
    }

    const getStatusStyle = (percentage) => {
      const statusMap = {
        text: percentage > 100 ? 'Over Budget' : percentage === 100 ? 'Fully Allocated' : percentage > 0 ? 'Partial Allocation' : 'Ready',
        class: percentage > 100 ? 'bg-red-100 text-red-700' : percentage === 100 ? 'bg-green-100 text-green-700' : percentage > 0 ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700',
        barColor: percentage > 100 ? 'bg-red-600' : percentage === 100 ? 'bg-green-600' : 'bg-indigo-600'
      };
      return statusMap;
    };

    // ===== EVENT LISTENERS =====

    window.addEventListener('categoryUpdated', event => updateBudgetSummaryFromLivewire(event.detail[0]));
    window.addEventListener('categoryError', event => alert(event.detail[0]));

    // ===== BUDGET SUMMARY =====

    function updateBudgetSummaryFromLivewire(categories) {
      const totalBudgetInput = parseFloat(document.getElementById('totalBudget').value) || 0;
      const categoryAmounts = categories.reduce((sum, cat) => sum + (parseFloat(cat.amount) || 0), 0);
      const remaining = totalBudgetInput - categoryAmounts;
      const percentage = totalBudgetInput > 0 ? Math.round((categoryAmounts / totalBudgetInput) * 100) : 0;

      document.getElementById('totalAllocated').textContent = categoryAmounts.toFixed(2);
      document.getElementById('totalRemaining').textContent = remaining.toFixed(2);
      document.getElementById('allocationPercent').textContent = percentage;
      document.getElementById('progressBar').style.width = percentage + '%';

      const styles = getStatusStyle(percentage);
      const statusElement = document.getElementById('statusText');
      statusElement.textContent = styles.text;
      statusElement.className = `px-3 py-1 text-xs font-semibold rounded-full ${styles.class}`;

      const progressBar = document.getElementById('progressBar');
      progressBar.className = `h-full ${styles.barColor} rounded-full transition-all duration-300`;
    }

    // ===== MODAL MANAGEMENT =====

    function closeBudgetModal() {
      document.getElementById('budgetModal').style.display = 'none';
      document.body.style.overflow = '';
    }

    function openBudgetModal() {
      document.getElementById('budgetModal').style.display = 'flex';
      document.body.style.overflow = 'hidden';
      reinitIcons();
    }

    function loadLastBudget() {
      openBudgetModal();
    }

    function selectBudget(budgetId) {
      const budgetElement = document.querySelector(`[onclick="selectBudget(${budgetId})"]`);
      if (!budgetElement) {
        alert('Error: Could not find budget. Please try again.');
        return;
      }

      const budgetName = budgetElement.querySelector('.font-semibold.text-slate-900')?.textContent || '';
      const budgetTotal = budgetElement.querySelector('.font-bold.text-indigo-600')?.textContent?.replace('$', '').replace(/,/g, '') || '0';
      const budgetDescription = budgetElement.querySelector('.line-clamp-2')?.textContent || '';

      document.getElementById('budgetName').value = budgetName + ' (Copy)';
      document.getElementById('totalBudget').value = budgetTotal;
      document.getElementById('description').value = budgetDescription;

      const today = new Date().toISOString().split('T')[0];
      document.getElementById('budgetStartDate').value = today;
      
      const endDate = new Date();
      endDate.setDate(endDate.getDate() + 365);
      document.getElementById('budgetEndDate').value = endDate.toISOString().split('T')[0];

      closeBudgetModal();
      alert('Budget loaded successfully! You can now modify and save as a new budget.\n\nNote: Category data will be loaded from the backend.');
    }

    // ===== AUTO-DISMISS MESSAGE HELPER =====

    function autoDismissMessage(elementId, duration) {
      const element = document.getElementById(elementId);
      if (!element) return;
      
      window.scrollTo({ top: 0, behavior: 'smooth' });
      setTimeout(() => {
        element.style.opacity = '0';
        element.style.transition = 'opacity 0.3s ease-out';
        setTimeout(() => element.remove(), 300);
      }, duration);
    }

    // ===== FORM INITIALIZATION & HANDLERS =====

    document.addEventListener('DOMContentLoaded', () => {
      reinitIcons();
      autoDismissMessage('successMessage', 5000);
      autoDismissMessage('errorMessage', 7000);

      document.getElementById('budgetForm').addEventListener('submit', function(e) {
        const livewireComponent = getLivewireComponent();
        if (livewireComponent?.validateCategories && !livewireComponent.validateCategories()) {
          e.preventDefault();
          return false;
        }
      });

      document.getElementById('totalBudget').addEventListener('input', function() {
        const livewireComponent = getLivewireComponent();
        if (livewireComponent) {
          const cats = typeof livewireComponent.getCategories === 'function'
            ? livewireComponent.getCategories()
            : livewireComponent.categories || [];
          updateBudgetSummaryFromLivewire(cats);
        }
      });

      const budgetModal = document.getElementById('budgetModal');
      budgetModal?.addEventListener('click', (e) => {
        if (e.target === budgetModal) closeBudgetModal();
      });

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && budgetModal?.style.display === 'flex') {
          closeBudgetModal();
        }
      });
    });
  </script>

</x-Account-sidebar>