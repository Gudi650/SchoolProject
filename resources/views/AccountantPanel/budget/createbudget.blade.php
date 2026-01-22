<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>

  <main class="p-6 bg-white min-h-screen">
    <div class="max-w-5xl mx-auto">

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

      <!-- Main Form Container -->
      <form id="budgetForm" class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        
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
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                required
              >
              <p class="text-xs text-slate-500 mt-1">A descriptive name for this budget</p>
            </div>

            <!-- Budget Year/Period -->
            <div>
              <label for="budgetPeriod" class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                Budget Period <span class="text-red-600">*</span>
              </label>
              <input 
                type="text" 
                id="budgetPeriod" 
                name="budgetPeriod" 
                placeholder="e.g., January - December 2026"
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white"
                required
              >
              <p class="text-xs text-slate-500 mt-1">Timeline for this budget</p>
            </div>

            <!-- Total Budget Amount -->
            <div class="md:col-span-2">
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
                  class="w-full pl-8 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white font-semibold text-slate-900"
                  required
                >
              </div>
              <p class="text-xs text-slate-500 mt-1">Total amount available for allocation</p>
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
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm resize-none transition-all bg-slate-50 focus:bg-white"
              ></textarea>
            </div>
          </div>
        </div>

        <!-- Section 2: Budget Allocation -->
        <div class="p-6 border-b border-slate-200 bg-white">
          <div class="flex justify-between items-start mb-6">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i data-lucide="layers" class="w-5 h-5 text-purple-600"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-slate-900">Budget Allocation</h3>
                <p class="text-sm text-slate-600 mt-1">Add budget items by specifying department and expense type (e.g., Academic - Teaching Staff, Infrastructure - Maintenance)</p>
              </div>
            </div>
            <!-- Add Category Button -->
            <button 
              type="button" 
              id="addCategoryBtn"
              class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-all shadow-sm hover:shadow-md flex-shrink-0"
              onclick="addBudgetCategory()"
            >
              <i data-lucide="plus-circle" class="w-4 h-4"></i>
              Add Category
            </button>
          </div>

          <!-- Categories Container -->
          <div id="categoriesContainer" class="space-y-4">
            <!-- Initial empty state message -->
            <div id="emptyState" class="p-10 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300 text-center">
              <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="folder-open" class="w-8 h-8 text-slate-400"></i>
              </div>
              <p class="text-slate-700 text-base font-semibold mb-1">No budget items added yet</p>
              <p class="text-slate-500 text-sm">Click "Add Category" to create budget allocations by department and expense type</p>
            </div>
          </div>
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
            <!-- Budget items will be inserted here -->
          </div>

          <!-- Empty State -->
          <div id="noBudgetsMessage" class="hidden text-center py-12">
            <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
              <i data-lucide="inbox" class="w-8 h-8 text-slate-400"></i>
            </div>
            <p class="text-slate-700 text-base font-semibold mb-1">No previous budgets found</p>
            <p class="text-slate-500 text-sm">Create your first budget to get started</p>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="p-4 sm:p-6 border-t border-slate-200 bg-slate-50">
          <button 
            type="button" 
            onclick="closeBudgetModal()"
            class="w-full sm:w-auto px-6 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Track category count for unique IDs
    let categoryCount = 0;

    /**
     * Add a new budget category row
     * Creates input fields for category name and amount allocation
     */
    function addBudgetCategory() {
      const container = document.getElementById('categoriesContainer');
      const emptyState = document.getElementById('emptyState');

      // Remove empty state on first category
      if (categoryCount === 0 && emptyState) {
        emptyState.remove();
      }

      categoryCount++;
      const categoryId = `category_${categoryCount}`;

      // Create category row HTML
      const categoryRow = document.createElement('div');
      categoryRow.id = categoryId;
      categoryRow.className = 'flex gap-3 items-end p-5 bg-white rounded-r-xl rounded-l-none border-l-4 border-indigo-400 shadow-sm hover:shadow transition-all';
      categoryRow.innerHTML = `
        <!-- Category Icon -->
        <div class="flex-shrink-0 pt-6">
          <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
            <i data-lucide="tag" class="w-5 h-5 text-indigo-600"></i>
          </div>
        </div>
        
        <!-- Department Input -->
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="building-2" class="w-3 h-3 text-indigo-600"></i>
            Department
          </label>
          <select 
            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm category-department transition-all bg-slate-50 focus:bg-white"
            required
          >
            <option value="">Select Department...</option>
            <option value="Academic">Academic</option>
            <option value="Infrastructure">Infrastructure</option>
            <option value="Library">Library</option>
            <option value="Sports">Sports</option>
            <option value="Transportation">Transportation</option>
            <option value="Administration">Administration</option>
          </select>
        </div>

        <!-- Expense Type Input -->
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="bookmark" class="w-3 h-3 text-purple-600"></i>
            Expense Type
          </label>
          <input 
            type="text" 
            placeholder="e.g., Teaching Staff, Facilities, Equipment"
            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm category-expense-type transition-all bg-slate-50 focus:bg-white"
          >
        </div>

        <!-- Amount Input -->
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="dollar-sign" class="w-3 h-3 text-green-600"></i>
            Budget Amount
          </label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500 font-medium text-sm">$</span>
            <input 
              type="number" 
              placeholder="0.00"
              step="0.01"
              min="0"
              class="w-full pl-8 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm category-amount transition-all bg-slate-50 focus:bg-white font-semibold text-slate-900"
              oninput="updateBudgetSummary()"
            >
          </div>
        </div>

        <!-- Remove Button -->
        <button 
          type="button" 
          class="px-3 py-2.5 bg-red-50 border border-red-200 hover:bg-red-100 hover:border-red-300 text-red-600 rounded-lg transition-all text-sm font-medium"
          onclick="removeBudgetCategory('${categoryId}')"
          title="Remove item"
        >
          <i data-lucide="x-circle" class="w-5 h-5"></i>
        </button>
      `;

      container.appendChild(categoryRow);

      // Focus on the new department input and reinitialize icons
      categoryRow.querySelector('.category-department').focus();
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    /**
     * Remove a specific budget category
     * @param {string} categoryId - The ID of the category to remove
     */
    function removeBudgetCategory(categoryId) {
      const categoryElement = document.getElementById(categoryId);
      if (categoryElement) {
        categoryElement.remove();
        updateBudgetSummary();

        // Show empty state if no categories left
        const container = document.getElementById('categoriesContainer');
        if (container.children.length === 0) {
          container.innerHTML = '<div id="emptyState" class="p-10 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300 text-center"><div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4"><i data-lucide="folder-open" class="w-8 h-8 text-slate-400"></i></div><p class="text-slate-700 text-base font-semibold mb-1">No budget items added yet</p><p class="text-slate-500 text-sm">Click "Add Category" to create budget allocations by department and expense type</p></div>';
          if (typeof lucide !== 'undefined') {
            lucide.createIcons();
          }
        }
      }
    }

    /**
     * Update budget summary calculations
     * Calculates total allocated, remaining amount, and allocation percentage
     */
    function updateBudgetSummary() {
      const totalBudgetInput = parseFloat(document.getElementById('totalBudget').value) || 0;
      const categoryAmounts = Array.from(document.querySelectorAll('.category-amount'))
        .map(input => parseFloat(input.value) || 0)
        .reduce((sum, amount) => sum + amount, 0);

      const remaining = totalBudgetInput - categoryAmounts;
      const percentage = totalBudgetInput > 0 ? Math.round((categoryAmounts / totalBudgetInput) * 100) : 0;

      // Update summary display
      document.getElementById('totalAllocated').textContent = categoryAmounts.toFixed(2);
      document.getElementById('totalRemaining').textContent = remaining.toFixed(2);
      document.getElementById('allocationPercent').textContent = percentage;
      document.getElementById('progressBar').style.width = percentage + '%';

      // Update status message based on allocation
      let statusText = 'Ready';
      let statusClass = 'bg-slate-100 text-slate-700';
      if (percentage === 100) {
        statusText = 'Fully Allocated';
        statusClass = 'bg-green-100 text-green-700';
      } else if (percentage > 100) {
        statusText = 'Over Budget';
        statusClass = 'bg-red-100 text-red-700';
      } else if (percentage > 0) {
        statusText = 'Partial Allocation';
        statusClass = 'bg-blue-100 text-blue-700';
      }
      
      const statusElement = document.getElementById('statusText');
      statusElement.textContent = statusText;
      statusElement.className = 'px-3 py-1 text-xs font-semibold rounded-full ' + statusClass;

      // Change progress bar color if over budget
      const progressBar = document.getElementById('progressBar');
      if (percentage > 100) {
        progressBar.classList.remove('bg-indigo-600', 'bg-green-600');
        progressBar.classList.add('bg-red-600');
      } else if (percentage === 100) {
        progressBar.classList.remove('bg-indigo-600', 'bg-red-600');
        progressBar.classList.add('bg-green-600');
      } else {
        progressBar.classList.remove('bg-red-600', 'bg-green-600');
        progressBar.classList.add('bg-indigo-600');
      }
    }

    /**
     * Handle form submission
     * Prevents default and logs budget data (backend integration point)
     */
    document.getElementById('budgetForm').addEventListener('submit', function(e) {
      e.preventDefault();

      // Validate form
      const budgetName = document.getElementById('budgetName').value.trim();
      const budgetPeriod = document.getElementById('budgetPeriod').value.trim();
      const totalBudget = parseFloat(document.getElementById('totalBudget').value) || 0;
      const categories = Array.from(document.querySelectorAll('#categoriesContainer > div:not(#emptyState)'))
        .map(row => ({
          department: row.querySelector('.category-department').value.trim(),
          expenseType: row.querySelector('.category-expense-type').value.trim(),
          amount: parseFloat(row.querySelector('.category-amount').value) || 0
        }))
        .filter(cat => cat.department && cat.expenseType && cat.amount > 0);

      // Basic validation
      if (!budgetName || !budgetPeriod || totalBudget <= 0) {
        alert('Please fill in all required fields');
        return;
      }

      if (categories.length === 0) {
        alert('Please add at least one budget item with department, expense type, and amount');
        return;
      }

      // Prepare data for backend
      const budgetData = {
        name: budgetName,
        period: budgetPeriod,
        total: totalBudget,
        description: document.getElementById('description').value.trim(),
        categories: categories
      };

      // Log budget data (replace with actual API call)
      console.log('Budget Data:', budgetData);
      alert('Budget created successfully!'); // Remove after backend integration
    });

    /**
     * Update summary when total budget changes
     */
    document.getElementById('totalBudget').addEventListener('input', updateBudgetSummary);

    /**
     * Open budget selection modal
     */
    function loadLastBudget() {
      // TODO: Replace with actual API call to fetch budgets from last year
      // Example: fetch('/api/budgets/previous-year')
      
      const previousBudgets = [
        {
          id: 1,
          name: 'FY 2025 School Operations',
          period: 'January - December 2025',
          total: 950000,
          description: 'Previous year annual operating budget',
          created_at: '2025-01-15',
          categories: [
            { department: 'Academic', expenseType: 'Teaching Staff', amount: 570000 },
            { department: 'Academic', expenseType: 'Teaching Facilities', amount: 120000 },
            { department: 'Infrastructure', expenseType: 'Maintenance', amount: 110000 },
            { department: 'Library', expenseType: 'Books & Resources', amount: 65000 },
            { department: 'Sports', expenseType: 'Equipment', amount: 45000 },
            { department: 'Transportation', expenseType: 'Bus Operations', amount: 40000 }
          ]
        },
        {
          id: 2,
          name: 'FY 2025 Q4 Supplementary Budget',
          period: 'October - December 2025',
          total: 250000,
          description: 'Fourth quarter supplementary allocation',
          created_at: '2025-10-01',
          categories: [
            { department: 'Academic', expenseType: 'Teaching Staff', amount: 150000 },
            { department: 'Infrastructure', expenseType: 'Renovations', amount: 100000 }
          ]
        },
        {
          id: 3,
          name: 'FY 2025 Special Projects',
          period: 'March - August 2025',
          total: 450000,
          description: 'Special projects and initiatives',
          created_at: '2025-03-10',
          categories: [
            { department: 'Library', expenseType: 'Digital Resources', amount: 120000 },
            { department: 'Sports', expenseType: 'Facilities Upgrade', amount: 200000 },
            { department: 'Administration', expenseType: 'Technology', amount: 130000 }
          ]
        }
      ];

      displayBudgetModal(previousBudgets);
    }

    /**
     * Display budget selection modal
     */
    function displayBudgetModal(budgets) {
      const modal = document.getElementById('budgetModal');
      const budgetsList = document.getElementById('budgetsList');
      const noBudgetsMessage = document.getElementById('noBudgetsMessage');

      if (budgets.length === 0) {
        budgetsList.innerHTML = '';
        noBudgetsMessage.style.display = 'block';
      } else {
        noBudgetsMessage.style.display = 'none';
        budgetsList.innerHTML = budgets.map(budget => `
          <div 
            class="p-4 sm:p-5 border-2 border-slate-200 rounded-xl hover:border-indigo-400 hover:bg-indigo-50 transition-all cursor-pointer group"
            onclick="selectBudget(${budget.id})"
          >
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
              <div class="flex-1 min-w-0">
                <div class="flex items-start gap-3">
                  <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-200 transition-colors">
                    <i data-lucide="file-text" class="w-5 h-5 text-indigo-600"></i>
                  </div>
                  <div class="flex-1 min-w-0">
                    <h3 class="text-sm sm:text-base font-semibold text-slate-900 break-words">${escapeHtml(budget.name)}</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">${escapeHtml(budget.period)}</p>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">${escapeHtml(budget.description || 'No description')}</p>
                  </div>
                </div>
              </div>
              <div class="flex flex-col sm:items-end gap-1 sm:ml-4">
                <span class="text-lg sm:text-xl font-bold text-indigo-600">$${budget.total.toLocaleString()}</span>
                <span class="text-xs text-slate-500">${budget.categories.length} categories</span>
              </div>
            </div>
          </div>
        `).join('');

        // Reinitialize icons
        if (typeof lucide !== 'undefined') {
          lucide.createIcons();
        }
      }

      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    /**
     * Close budget modal
     */
    function closeBudgetModal() {
      const modal = document.getElementById('budgetModal');
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }

    /**
     * Select and load a budget
     */
    function selectBudget(budgetId) {
      // TODO: Replace with actual API call
      // fetch(`/api/budgets/${budgetId}`)
      
      // Find the selected budget from the demo data
      const budgets = [
        {
          id: 1,
          name: 'FY 2025 School Operations',
          period: 'January - December 2025',
          total: 950000,
          description: 'Previous year annual operating budget',
          categories: [
            { department: 'Academic', expenseType: 'Teaching Staff', amount: 570000 },
            { department: 'Academic', expenseType: 'Teaching Facilities', amount: 120000 },
            { department: 'Infrastructure', expenseType: 'Maintenance', amount: 110000 },
            { department: 'Library', expenseType: 'Books & Resources', amount: 65000 },
            { department: 'Sports', expenseType: 'Equipment', amount: 45000 },
            { department: 'Transportation', expenseType: 'Bus Operations', amount: 40000 }
          ]
        },
        {
          id: 2,
          name: 'FY 2025 Q4 Supplementary Budget',
          period: 'October - December 2025',
          total: 250000,
          description: 'Fourth quarter supplementary allocation',
          categories: [
            { department: 'Academic', expenseType: 'Teaching Staff', amount: 150000 },
            { department: 'Infrastructure', expenseType: 'Renovations', amount: 100000 }
          ]
        },
        {
          id: 3,
          name: 'FY 2025 Special Projects',
          period: 'March - August 2025',
          total: 450000,
          description: 'Special projects and initiatives',
          categories: [
            { department: 'Library', expenseType: 'Digital Resources', amount: 120000 },
            { department: 'Sports', expenseType: 'Facilities Upgrade', amount: 200000 },
            { department: 'Administration', expenseType: 'Technology', amount: 130000 }
          ]
        }
      ];

      const lastBudgetData = budgets.find(b => b.id === budgetId);
      if (!lastBudgetData) return;

      // Populate budget overview fields
      document.getElementById('budgetName').value = lastBudgetData.name + ' (Copy)';
      document.getElementById('budgetPeriod').value = lastBudgetData.period;
      document.getElementById('totalBudget').value = lastBudgetData.total;
      document.getElementById('description').value = lastBudgetData.description;

      // Clear existing categories
      const container = document.getElementById('categoriesContainer');
      container.innerHTML = '';
      categoryCount = 0;

      // Add each category from last budget
      lastBudgetData.categories.forEach(category => {
        addBudgetCategory();
        const currentRow = document.getElementById(`category_${categoryCount}`);
        currentRow.querySelector('.category-department').value = category.department;
        currentRow.querySelector('.category-expense-type').value = category.expenseType;
        currentRow.querySelector('.category-amount').value = category.amount;
      });

      // Update summary
      updateBudgetSummary();

      // Reinitialize icons
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }

      // Close modal
      closeBudgetModal();

      // Show success message
      alert('Budget loaded successfully! You can now modify and save as a new budget.');
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text || '';
      return div.innerHTML;
    }

    // Close modal when clicking outside
    document.getElementById('budgetModal')?.addEventListener('click', function(e) {
      if (e.target === this) {
        closeBudgetModal();
      }
    });

    /**
     * Initialize page - reinitialize Lucide icons
     */
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    });
  </script>

</x-Account-sidebar>