{{-- 
  Budget Categories Livewire Component
  Handles adding/removing budget allocation categories
  Emits events to parent for real-time summary updates
--}}

<div>
  {{-- Header Section --}}
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
            <!-- Add Category Button - Uses Livewire -->
            <button 
              type="button" 
              wire:click="addCategory"
              class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-all shadow-sm hover:shadow-md flex-shrink-0"
            >
              <i data-lucide="plus-circle" class="w-4 h-4"></i>
              Add Category
            </button>
          </div>
  {{-- Categories Container --}}
  <div class="space-y-4">
    
    {{-- Empty State - Shows when no categories exist --}}
    @if(count($categories) === 0)
      <div class="p-10 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300 text-center">
        <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
          <i data-lucide="folder-open" class="w-8 h-8 text-slate-400"></i>
        </div>
        <p class="text-slate-700 text-base font-semibold mb-1">No budget items added yet</p>
        <p class="text-slate-500 text-sm">Click "Add Category" to create budget allocations by department and expense type</p>
      </div>
    @endif

    {{-- Category Rows - Loop through all categories --}}
    @foreach($categories as $index => $category)
      <div 
        wire:key="category-{{ $index }}" 
        class="flex gap-3 items-end p-5 bg-white rounded-r-xl rounded-l-none border-l-4 border-indigo-400 shadow-sm hover:shadow transition-all"
      >
        {{-- Category Icon --}}
        <div class="flex-shrink-0 pt-6">
          <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
            <i data-lucide="tag" class="w-5 h-5 text-indigo-600"></i>
          </div>
        </div>
        
        {{-- Department Dropdown --}}
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="building-2" class="w-3 h-3 text-indigo-600"></i>
            Department
          </label>
          {{-- Wire:model.live creates two-way binding and triggers updatedCategories() --}}
          <select 
            wire:model.live="categories.{{ $index }}.department"
            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white"
            required
          >
            <option value="">Select Department...</option>
            {{-- Loop through available departments --}}
            @foreach($availableDepartments as $dept)
              <option value="{{ $dept }}">{{ $dept }}</option>
            @endforeach
          </select>
        </div>

        {{-- Expense Type Input --}}
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="bookmark" class="w-3 h-3 text-purple-600"></i>
            Expense Type
          </label>
          {{-- Wire:model.live syncs value with component property in real-time --}}
          <input 
            type="text" 
            wire:model.live="categories.{{ $index }}.expenseType"
            placeholder="e.g., Teaching Staff, Facilities, Equipment"
            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white"
          >
        </div>

        {{-- Amount Input --}}
        <div class="flex-1">
          <label class="block text-xs font-semibold text-slate-700 mb-2 flex items-center gap-1">
            <i data-lucide="dollar-sign" class="w-3 h-3 text-green-600"></i>
            Budget Amount
          </label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500 font-medium text-sm">$</span>
            {{-- Wire:model.number casts value to number automatically --}}
            <input 
              type="number" 
              wire:model.live="categories.{{ $index }}.amount"
              placeholder="0.00"
              step="0.01"
              min="0"
              class="w-full pl-8 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm transition-all bg-slate-50 focus:bg-white font-semibold text-slate-900"
            >
          </div>
        </div>

        {{-- Remove Button --}}
        {{-- Wire:click calls removeCategory method with current index --}}
        <button 
          type="button" 
          wire:click="removeCategory({{ $index }})"
          class="px-3 py-2.5 bg-red-50 border border-red-200 hover:bg-red-100 hover:border-red-300 text-red-600 rounded-lg transition-all text-sm font-medium"
          title="Remove item"
        >
          <i data-lucide="x-circle" class="w-5 h-5"></i>
        </button>
      </div>
    @endforeach

  </div>

  {{-- 
    Reinitialize Lucide icons after Livewire updates
    This ensures icons render properly after adding/removing categories
  --}}
@script
<script>
  // Initial load
  lucide.createIcons();
  
  // Reinitialize after every Livewire DOM update
  $wire.on('categoryUpdated', () => {
    lucide.createIcons();
  });
</script>
@endscript
</div>