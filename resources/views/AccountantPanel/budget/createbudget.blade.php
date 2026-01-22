<x-Account-sidebar>
  <x-slot name="title">Budget Management</x-slot>

  <main class="p-6 bg-white min-h-screen">
    <div class="max-w-5xl mx-auto">

      <!-- Page Header with Icon -->
      <div class="mb-8 bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i data-lucide="wallet" class="w-6 h-6 text-indigo-600"></i>
            </div>
            <div>
              <h1 class="text-3xl font-bold text-slate-900">Create Budget</h1>
              <p class="text-slate-600 mt-2">Set up a new budget and allocate funds across departments</p>
            </div>
          </div>
          <button 
            type="button" 
            onclick="loadLastBudget()"
            class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2"
          >
            <i data-lucide="copy" class="w-4 h-4"></i>
            Copy from Last Budget
          </button>
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
          <input 
            type="text" 
            placeholder="e.g., Academic, Infrastructure, Sports"
            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm category-department transition-all bg-slate-50 focus:bg-white"
          >
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
     * Load last budget data and populate the form
     * Fetches the most recent budget and fills all fields
     */
    function loadLastBudget() {
      // TODO: Replace with actual API call to fetch last budget
      // For now, this is a placeholder that shows how it would work
      
      // Example of what the API response would look like:
      const lastBudgetData = {
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
      };

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

      // Show success message
      alert('Last budget loaded successfully! You can now modify and save as a new budget.');
      
      // TODO: When backend is ready, replace above with actual fetch:
      /*
      fetch('/api/budgets/last')
        .then(response => response.json())
        .then(data => {
          // Populate form with data
          document.getElementById('budgetName').value = data.name + ' (Copy)';
          // ... rest of the population logic
        })
        .catch(error => {
          alert('Could not load last budget. Please create a new one.');
        });
      */
    }

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