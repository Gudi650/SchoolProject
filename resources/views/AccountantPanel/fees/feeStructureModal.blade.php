<!-- Fee Structure Modal with Currency Selection -->
<style>
  /* Hide scrollbars while keeping scroll functionality */
  .hide-scrollbar {
    scrollbar-width: none;
    -ms-overflow-style: none;
  }
  .hide-scrollbar::-webkit-scrollbar {
    display: none;
  }
</style>

<div id="feeStructureModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50" style="display: none;">

  <form id="feeStructureForm" 
    method="POST" 
    action="{{ route('accounting.feeStructure.save') }}" 
    class="bg-white w-full max-w-4xl mx-4 rounded-lg shadow-2xl overflow-hidden flex flex-col" style="max-height: 90vh;">

    @csrf
    <!-- Header -->
    <div class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
      <h2 class="text-lg font-semibold tracking-wide flex items-center gap-2">
        <i data-lucide="receipt" class="w-5 h-5"></i>
        Edit Fee Structure
      </h2>
      <button id="closeFeeStructureModal" type="button" class="text-white/80 hover:text-white p-2 rounded-md" aria-label="Close">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>

    <!-- Currency Selector -->
    <div class="px-4 pt-4">
      <label for="currencySelect" class="block text-sm font-medium text-gray-700 mb-1">
        <i data-lucide="coins" class="w-4 h-4 inline mr-1 align-text-bottom"></i>
        Currency
      </label>
      <div class="flex gap-3 items-center">
        <select id="currencySelect" name="currency" class="border rounded px-3 py-2 w-56 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="" selected>Choose the currency</option>
          <option value="TSH">TSh (TZS)</option>
          <option value="USD">USD ($)</option>
          <option value="KSH">KSh (KES)</option>
          <option value="EUR">EUR (€)</option>
          <option value="UGX">UGX (USh)</option>
          <option value="ZMW">ZMW (K)</option>
          <option value="OTHER">Other…</option>
        </select>
        <input id="customCurrencyLabel" name="currency_custom_label" type="text" class="border rounded px-3 py-2 w-40 hidden focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Symbol or code" />
      </div>
    </div>

    <!-- Tabs -->
    <div class="px-4 pt-4">
      <div class="inline-flex bg-slate-100 p-1 rounded-lg shadow-inner">
        <button type="button" id="tabAllBtn" class="px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow flex items-center gap-2">
          <i data-lucide="users" class="w-4 h-4"></i>
          For All Classes
        </button>
        <button type="button" id="tabSpecificBtn" class="px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white flex items-center gap-2">
          <i data-lucide="book" class="w-4 h-4"></i>
          For Specific Class
        </button>
      </div>
      <input type="hidden" name="scope" id="scopeInput" value="all" />
    </div>

    <!-- Body -->
    <div class="px-4 py-4 flex-1 overflow-y-auto hide-scrollbar">
      <!-- All Classes Tab Content -->
      <div id="tabAll" class="space-y-3">
        <div class="flex items-center justify-between">
          <h3 class="font-medium text-indigo-700">Fee Components (All Classes)</h3>
          <div class="flex gap-2">
            <button type="button" class="presetBtn px-2 py-1 text-xs rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 flex items-center gap-1" data-name="Tuition" data-amount="0">
              <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i> Tuition
            </button>
            <button type="button" class="presetBtn px-2 py-1 text-xs rounded bg-sky-50 text-sky-700 hover:bg-sky-100 flex items-center gap-1" data-name="Transport" data-amount="0">
              <i data-lucide="bus" class="w-3.5 h-3.5"></i> Transport
            </button>
            <button type="button" class="presetBtn px-2 py-1 text-xs rounded bg-amber-50 text-amber-800 hover:bg-amber-100 flex items-center gap-1" data-name="Hostel" data-amount="0">
              <i data-lucide="home" class="w-3.5 h-3.5"></i> Hostel
            </button>
            <button type="button" class="presetBtn px-2 py-1 text-xs rounded bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center gap-1" data-name="Library" data-amount="0">
              <i data-lucide="library" class="w-3.5 h-3.5"></i> Library
            </button>
            <button type="button" class="presetBtn px-2 py-1 text-xs rounded bg-rose-50 text-rose-700 hover:bg-rose-100 flex items-center gap-1" data-name="Exam" data-amount="0">
              <i data-lucide="file-check" class="w-3.5 h-3.5"></i> Exam
            </button>
          </div>
        </div>
        
        <!-- Preset Forms (All Classes) -->
        <div id="allPresetForms" class="space-y-2">
          <!-- Tuition -->
          <div id="preset-all-tuition" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="all_component_names[]" type="text" value="Tuition" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="tuition_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-all-tuition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Transport -->
          <div id="preset-all-transport" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="all_component_names[]" type="text" value="Transport" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="transport_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-all-transport"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Hostel -->
          <div id="preset-all-hostel" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="all_component_names[]" type="text" value="Hostel" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="hostel_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-all-hostel"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Library -->
          <div id="preset-all-library" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="all_component_names[]" type="text" value="Library" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="library_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-all-library"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Exam -->
          <div id="preset-all-exam" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="all_component_names[]" type="text" value="Exam" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="exam_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-all-exam"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
        </div>
        
        <!-- Dynamic Custom Component Container (All Classes) -->
        <div class="space-y-2 border-t pt-4 hidden" id="allCustomComponentsContainer">
          <h4 class="text-sm font-medium text-slate-700">Custom Components</h4>
          <div id="allCustomComponentsList" class="space-y-2"></div>
        </div>
        
        <div id="allComponents" class="space-y-2"></div>
        <div class="flex items-center gap-2">
          <button id="addAllComponent" type="button" class="px-3 py-2 rounded text-sm border-2 border-dashed border-slate-300 hover:border-indigo-400 text-slate-700 hover:text-indigo-700 bg-white flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Component
          </button>
          <button id="previewAllBtn" type="button" class="ml-auto px-4 py-2 rounded bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm shadow flex items-center gap-2">
            <i data-lucide="eye" class="w-4 h-4"></i>
            Preview Structure
          </button>
        </div>
      </div>

      <!-- Specific Class Tab Content -->
      <div id="tabSpecific" class="space-y-3 hidden">
        <div class="space-y-3">
          <div>
            <label class="block text-sm font-medium mb-1">School ID (optional)</label>
            <input id="specificSchoolId" name="school_id" type="text" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., SCH-001" />
          </div>
          <div class="relative">
            <label class="block text-sm font-medium mb-1 flex items-center gap-2">
              <i data-lucide="book-open" class="w-4 h-4"></i>
              Select Classes (Multiple)
            </label>
            <div id="classDropdownBtn" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer flex items-center justify-between">
              <span id="selectedClassesDisplay" class="text-slate-500">Click to select classes...</span>
              <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </div>
            <div id="classDropdownMenu" class="hidden absolute z-10 w-full mt-1 bg-white border border-slate-200 rounded-lg shadow-lg max-h-60 overflow-y-auto">
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Nursery"> Nursery
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 1"> Grade 1
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 2"> Grade 2
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 3"> Grade 3
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 4"> Grade 4
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 5"> Grade 5
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 6"> Grade 6
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 7"> Grade 7
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 8"> Grade 8
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 9"> Grade 9
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 10"> Grade 10
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 11"> Grade 11
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Grade 12"> Grade 12
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Form 1"> Form 1
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Form 2"> Form 2
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Form 3"> Form 3
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" name="classes[]" class="class-checkbox mr-2 rounded" value="Form 4"> Form 4
              </label>
            </div>
          </div>
        </div>
        
        <!-- Load All Classes Structure Button -->
        <div class="flex justify-end mb-3">
          <button type="button" id="loadAllClassesStructure" class="px-4 py-2 text-sm rounded bg-violet-100 text-violet-700 hover:bg-violet-200 flex items-center gap-2 font-medium border border-violet-300">
            <i data-lucide="copy" class="w-4 h-4"></i> 
            Load All Classes Structure
          </button>
        </div>

        <div class="flex items-center justify-between">
          <h3 class="font-medium text-indigo-700">Fee Components (Specific Class)</h3>
          <div class="flex gap-2">
            <button type="button" class="presetSpecificBtn px-2 py-1 text-xs rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100 flex items-center gap-1" data-name="Tuition" data-amount="0">
              <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i> Tuition
            </button>
            <button type="button" class="presetSpecificBtn px-2 py-1 text-xs rounded bg-sky-50 text-sky-700 hover:bg-sky-100 flex items-center gap-1" data-name="Transport" data-amount="0">
              <i data-lucide="bus" class="w-3.5 h-3.5"></i> Transport
            </button>
            <button type="button" class="presetSpecificBtn px-2 py-1 text-xs rounded bg-amber-50 text-amber-800 hover:bg-amber-100 flex items-center gap-1" data-name="Hostel" data-amount="0">
              <i data-lucide="home" class="w-3.5 h-3.5"></i> Hostel
            </button>
            <button type="button" class="presetSpecificBtn px-2 py-1 text-xs rounded bg-emerald-50 text-emerald-700 hover:bg-emerald-100 flex items-center gap-1" data-name="Library" data-amount="0">
              <i data-lucide="library" class="w-3.5 h-3.5"></i> Library
            </button>
            <button type="button" class="presetSpecificBtn px-2 py-1 text-xs rounded bg-rose-50 text-rose-700 hover:bg-rose-100 flex items-center gap-1" data-name="Exam" data-amount="0">
              <i data-lucide="file-check" class="w-3.5 h-3.5"></i> Exam
            </button>
          </div>
        </div>
        <!-- Preset Forms (Specific Class) -->
        <div id="specificPresetForms" class="space-y-2">
          <!-- Tuition -->
          <div id="preset-specific-tuition" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="specific_component_names[]" type="text" value="Tuition" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="tuition_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-specific-tuition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Transport -->
          <div id="preset-specific-transport" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="specific_component_names[]" type="text" value="Transport" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="transport_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-specific-transport"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Hostel -->
          <div id="preset-specific-hostel" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="specific_component_names[]" type="text" value="Hostel" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="hostel_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-specific-hostel"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Library -->
          <div id="preset-specific-library" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="specific_component_names[]" type="text" value="Library" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="library_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-specific-library"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
          <!-- Exam -->
          <div id="preset-specific-exam" class="preset-form hidden">
            <div class="grid grid-cols-12 gap-2">
              <input name="specific_component_names[]" type="text" value="Exam" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" readonly />
              <input name="exam_fee" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" />
              <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center remove-preset" data-target="preset-specific-exam"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>
          </div>
        </div>
        
        <!-- Dynamic Custom Component Container (Specific Class) -->
        <div class="space-y-2 border-t pt-4 hidden" id="specificCustomComponentsContainer">
          <h4 class="text-sm font-medium text-slate-700">Custom Components</h4>
          <div id="specificCustomComponentsList" class="space-y-2"></div>
        </div>
        
        <div id="specificComponents" class="space-y-2"></div>
        <div class="flex items-center gap-2">
          <button id="addSpecificComponent" type="button" class="px-3 py-2 rounded text-sm border-2 border-dashed border-slate-300 hover:border-indigo-400 text-slate-700 hover:text-indigo-700 bg-white flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Component
          </button>
          <button id="previewSpecificBtn" type="button" class="ml-auto px-4 py-2 rounded bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm shadow flex items-center gap-2">
            <i data-lucide="eye" class="w-4 h-4"></i>
            Preview Structure
          </button>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="px-4 py-3 border-t flex justify-end bg-slate-50">
      <button id="closeFeeStructureModalBottom" type="button" class="px-4 py-2 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center gap-2">
        <i data-lucide="x-circle" class="w-4 h-4"></i>
        Close
      </button>
    </div>
  </form>

  <!-- Full-screen Preview Overlay -->
  <div id="feePreviewPanel" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">
    <div class="bg-white w-full max-w-3xl mx-4 rounded-lg shadow-2xl overflow-hidden">
      <div class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <h3 class="font-semibold flex items-center gap-2">
          <i data-lucide="eye" class="w-5 h-5"></i>
          Review Fee Structure
        </h3>
        <button id="closePreviewPanel" class="text-white/80 hover:text-white p-2 rounded-md" aria-label="Close">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>
      <div id="feePreviewContent" class="px-4 py-4 space-y-3"></div>
      <div class="px-4 py-3 border-t flex gap-2 justify-end bg-slate-50">
        <button id="backToEditBtn" class="px-4 py-2 rounded bg-slate-100 hover:bg-slate-200 flex items-center gap-2">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to Edit
        </button>
        <button id="confirmSaveBtn" type="submit" form="feeStructureForm" class="px-4 py-2 rounded bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white shadow flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4"></i>
          Confirm & Save
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Elements: modal, tabs, form areas, and preview
    const modal = document.getElementById('feeStructureModal');
    const openBtn = document.getElementById('openEditStructureModal');
    const closeTop = document.getElementById('closeFeeStructureModal');
    const closeBottom = document.getElementById('closeFeeStructureModalBottom');
    const tabAllBtn = document.getElementById('tabAllBtn');
    const tabSpecificBtn = document.getElementById('tabSpecificBtn');
    const tabAll = document.getElementById('tabAll');
    const tabSpecific = document.getElementById('tabSpecific');

    const currencySelect = document.getElementById('currencySelect');
    const customCurrencyLabel = document.getElementById('customCurrencyLabel');
    const scopeInput = document.getElementById('scopeInput');

    const allComponents = document.getElementById('allComponents');
    const specificComponents = document.getElementById('specificComponents');
    const addAllComponent = document.getElementById('addAllComponent');
    const addSpecificComponent = document.getElementById('addSpecificComponent');
    const previewAllBtn = document.getElementById('previewAllBtn');
    const previewSpecificBtn = document.getElementById('previewSpecificBtn');

    const previewPanel = document.getElementById('feePreviewPanel');
    const feePreviewContent = document.getElementById('feePreviewContent');
    const closePreviewPanel = document.getElementById('closePreviewPanel');
    const backToEditBtn = document.getElementById('backToEditBtn');
    const confirmSaveBtn = document.getElementById('confirmSaveBtn');

    const specificSchoolId = document.getElementById('specificSchoolId');
    
    // Class dropdown elements
    const classDropdownBtn = document.getElementById('classDropdownBtn');
    const classDropdownMenu = document.getElementById('classDropdownMenu');
    const selectedClassesDisplay = document.getElementById('selectedClassesDisplay');
    const classCheckboxes = document.querySelectorAll('.class-checkbox');

    // Utilities: icon render, preset helpers
    function renderIcons() {
      try {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
          window.lucide.createIcons();
        }
      } catch (_) {}
    }

    function slugify(name) {
      return (name || '').toLowerCase().replace(/\s+/g, '-');
    }

    function presetId(tab, slug) {
      return `preset-${tab}-${slug}`;
    }

    // Show/hide preset block and set a default amount when revealing
    function setPresetVisible(containerId, visible, defaultAmount) {
      const el = document.getElementById(containerId);
      if (!el) return;
      el.classList.toggle('hidden', !visible);
      if (visible) {
        const amountInput = el.querySelector('input[type="number"]');
        if (amountInput && typeof defaultAmount !== 'undefined') {
          amountInput.value = defaultAmount;
        }
      }
      renderIcons();
    }

    // Preserve original names so we can strip/restore when toggling tabs
    function stripNames(container) {
      if (!container) return;
      container.querySelectorAll('input[name]').forEach(input => {
        if (!input.dataset.originalName) {
          input.dataset.originalName = input.name;
        }
        input.removeAttribute('name');
      });
    }

    function restoreNames(container) {
      if (!container) return;
      container.querySelectorAll('input').forEach(input => {
        if (input.dataset.originalName) {
          input.name = input.dataset.originalName;
        }
      });
    }
    // Currency display for preview
    const currencyMap = {
      'TSH': { label: 'TSh', symbol: 'TSh' },
      'USD': { label: 'USD', symbol: '$' },
      'KSH': { label: 'KSh', symbol: 'KSh' },
      'EUR': { label: 'EUR', symbol: '€' },
      'UGX': { label: 'UGX', symbol: 'USh' },
      'ZMW': { label: 'ZMW', symbol: 'K' },
    };

    function getCurrencyLabelAndSymbol() {
      const val = currencySelect.value;
      if (val === 'OTHER') {
        const custom = (customCurrencyLabel.value || '').trim();
        const label = custom || 'CUR';
        return { label, symbol: label };
      }
      return currencyMap[val] || currencyMap['TSH'];
    }

    // Simple show/hide helpers for overlays
    function show(el) { el.style.display = 'flex'; }
    function hide(el) { el.style.display = 'none'; }

    // Tabs: switch between All vs Specific; restore names only on the active tab to avoid duplicate submissions
    function switchTab(tab) {
      if (tab === 'all') {
        tabAll.classList.remove('hidden');
        tabSpecific.classList.add('hidden');
        tabAllBtn.className = 'px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow';
        tabSpecificBtn.className = 'px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white';
        if (scopeInput) scopeInput.value = 'all';
        restoreNames(tabAll);
        stripNames(tabSpecific);
        setPresetVisible('preset-all-tuition', true, 0);
      } else {
        tabAll.classList.add('hidden');
        tabSpecific.classList.remove('hidden');
        tabSpecificBtn.className = 'px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow';
        tabAllBtn.className = 'px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white';
        if (scopeInput) scopeInput.value = 'specific';
        restoreNames(tabSpecific);
        stripNames(tabAll);
        setPresetVisible('preset-specific-tuition', true, 0);
      }
    }

    // Dynamic rows: add arbitrary components with nested array syntax for Laravel
    function makeRow(type, defaultName = '', defaultAmount = '') {
      const row = document.createElement('div');
      row.className = 'grid grid-cols-12 gap-2';
      
      // Get container and count existing rows to auto-increment index
      const containerSelector = type === 'specific' ? '#specificCustomComponentsList' : '#allCustomComponentsList';
      const container = document.querySelector(containerSelector);
      const index = container.querySelectorAll('.grid').length;
      
      // Use nested array syntax: all_components[0][name], all_components[0][amount], etc.
      const prefix = type === 'specific' ? 'specific_components' : 'all_components';
      
      row.innerHTML = `
        <input name="${prefix}[${index}][name]" type="text" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Component name" value="${defaultName}" />
        <input name="${prefix}[${index}][amount]" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" value="${defaultAmount}" />
        <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
      `;
      const removeBtn = row.querySelector('button');
      removeBtn.addEventListener('click', () => row.remove());
      renderIcons();
      return row;
    }

    // Collect dynamic rows into [{name, amount}]
    function collectRows(container) {
      const rows = Array.from(container.children);
      const items = [];
      rows.forEach(r => {
        const [nameEl, amountEl] = r.querySelectorAll('input');
        const name = (nameEl?.value || '').trim();
        const amount = parseFloat(amountEl?.value || '0') || 0;
        if (name) items.push({ name, amount });
      });
      return items;
    }

    // Collect visible preset blocks within a container id
    function collectPresetRows(containerId) {
      const container = document.getElementById(containerId);
      if (!container) return [];
      const blocks = Array.from(container.querySelectorAll('.preset-form'))
        .filter(b => !b.classList.contains('hidden'));
      return blocks.map(b => {
        const nameEl = b.querySelector('input[type="text"]');
        const amountEl = b.querySelector('input[type="number"]');
        const name = (nameEl?.value || '').trim();
        const amount = parseFloat(amountEl?.value || '0') || 0;
        return name ? { name, amount } : null;
      }).filter(Boolean);
    }

    // Build the HTML snippet for the preview panel
    function renderPreview(title, meta, items) {
      const { symbol, label } = getCurrencyLabelAndSymbol();
      const total = items.reduce((sum, i) => sum + i.amount, 0);
      const rows = items.map(i => `
        <tr class="odd:bg-white even:bg-slate-50">
          <td class="border px-3 py-1">${i.name}</td>
          <td class="border px-3 py-1 text-right">${symbol} ${i.amount.toLocaleString()}</td>
        </tr>
      `).join('');

      return `
        <div class="space-y-2">
          <div class="flex items-center justify-between">
            <h4 class="font-medium">${title}</h4>
            <span class="text-sm text-gray-600">Currency: ${label}</span>
          </div>
          ${meta ? `<div class="text-sm text-gray-700">${meta}</div>` : ''}
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="bg-slate-100 text-slate-700">
                <th class="border px-3 py-1 text-left">Component</th>
                <th class="border px-3 py-1 text-right">Amount</th>
              </tr>
            </thead>
            <tbody>${rows || '<tr><td class="border px-3 py-2 text-center" colspan="2">No components added</td></tr>'}</tbody>
            <tfoot>
              <tr class="bg-indigo-50 text-indigo-700 font-semibold">
                <td class="border px-3 py-1 text-right">Total</td>
                <td class="border px-3 py-1 text-right">${symbol} ${total.toLocaleString()}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      `;
    }

    // Preview overlay
    function openPreview(contentHtml) {
      feePreviewContent.innerHTML = contentHtml;
      show(previewPanel);
      renderIcons();
    }

    function closePreview() { hide(previewPanel); }

    // Class dropdown: open/close and selection display
    function updateClassDisplay() {
      const selected = Array.from(classCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      if (selected.length === 0) {
        selectedClassesDisplay.textContent = 'Click to select classes...';
        selectedClassesDisplay.className = 'text-slate-500';
      } else {
        selectedClassesDisplay.textContent = selected.join(', ');
        selectedClassesDisplay.className = 'text-slate-900';
      }
    }

    classDropdownBtn.addEventListener('click', () => {
      classDropdownMenu.classList.toggle('hidden');
      renderIcons();
    });

    classCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateClassDisplay);
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!classDropdownBtn.contains(e.target) && !classDropdownMenu.contains(e.target)) {
        classDropdownMenu.classList.add('hidden');
      }
    });

    // Currency: show/hide custom label for OTHER
    currencySelect.addEventListener('change', () => {
      customCurrencyLabel.classList.toggle('hidden', currencySelect.value !== 'OTHER');
    });

    // --- Open/close modal ---
    if (openBtn) openBtn.addEventListener('click', () => {
      show(modal);
      switchTab('all'); // default to All tab and ensure tuition is available
    });
    [closeTop, closeBottom].forEach(btn => btn && btn.addEventListener('click', () => hide(modal)));
    modal.addEventListener('click', (e) => { if (e.target === modal) hide(modal); });

    // Tabs events
    tabAllBtn.addEventListener('click', () => switchTab('all'));
    tabSpecificBtn.addEventListener('click', () => switchTab('specific'));

    // Add dynamic component rows
    addAllComponent.addEventListener('click', () => {
      const container = document.getElementById('allCustomComponentsContainer');
      const listContainer = document.getElementById('allCustomComponentsList');
      container.classList.remove('hidden');
      listContainer.appendChild(makeRow('all'));
    });
    
    addSpecificComponent.addEventListener('click', () => {
      const container = document.getElementById('specificCustomComponentsContainer');
      const listContainer = document.getElementById('specificCustomComponentsList');
      container.classList.remove('hidden');
      listContainer.appendChild(makeRow('specific'));
    });

    // --- Copy "All Classes" rows into "Specific Class" ---
    const loadAllClassesStructureBtn = document.getElementById('loadAllClassesStructure');
    if (loadAllClassesStructureBtn) {
      loadAllClassesStructureBtn.addEventListener('click', () => {
        const allClassItems = collectRows(allComponents);
        if (allClassItems.length === 0) {
          alert('Please add fee components in "All Classes" tab first.');
          return;
        }
        specificComponents.innerHTML = '';
        allClassItems.forEach(item => {
          specificComponents.appendChild(makeRow('specific', item.name, item.amount));
        });
        renderIcons();
        alert(`Loaded ${allClassItems.length} component(s) from All Classes structure. You can now edit or add adjustments.`);
      });
    }

    // Preset buttons: reveal hardcoded blocks and set amount
    Array.from(document.querySelectorAll('.presetBtn')).forEach(btn => {
      btn.addEventListener('click', () => {
        const name = btn.dataset.name || '';
        const amount = btn.dataset.amount || '';
        const id = presetId('all', slugify(name));
        setPresetVisible(id, true, amount);
        const el = document.getElementById(id);
        const nameInput = el?.querySelector('input[type="text"]');
        if (nameInput) nameInput.value = name;
      });
    });
    Array.from(document.querySelectorAll('.presetSpecificBtn')).forEach(btn => {
      btn.addEventListener('click', () => {
        const name = btn.dataset.name || '';
        const amount = btn.dataset.amount || '';
        const id = presetId('specific', slugify(name));
        setPresetVisible(id, true, amount);
        const el = document.getElementById(id);
        const nameInput = el?.querySelector('input[type="text"]');
        if (nameInput) nameInput.value = name;
      });
    });

    // Remove preset block: hide and clear amount
    Array.from(document.querySelectorAll('.remove-preset')).forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-target');
        setPresetVisible(targetId, false);
        const el = document.getElementById(targetId);
        if (el) {
          const amountInput = el.querySelector('input[type="number"]');
          if (amountInput) amountInput.value = '';
        }
      });
    });

    // Preview buttons: include both dynamic rows and visible preset blocks
    previewAllBtn.addEventListener('click', () => {
      const items = [
        ...collectRows(allComponents),
        ...collectPresetRows('allPresetForms')
      ];
      const html = renderPreview('All Classes Fee Structure', '', items);
      openPreview(html);
    });

    previewSpecificBtn.addEventListener('click', () => {
      const selectedClasses = Array.from(classCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      if (selectedClasses.length === 0) {
        alert('Please select at least one class');
        return;
      }
      const items = [
        ...collectRows(specificComponents),
        ...collectPresetRows('specificPresetForms')
      ];
      const classesStr = selectedClasses.join(', ');
      const meta = `${specificSchoolId.value ? 'School: ' + specificSchoolId.value + ' • ' : ''}Classes: ${classesStr}`;
      const html = renderPreview('Specific Class Fee Structure', meta, items);
      openPreview(html);
    });

    // --- Preview panel controls ---
    [closePreviewPanel, backToEditBtn].forEach(btn => btn && btn.addEventListener('click', closePreview));

    // Saving: handled by regular form submission via the Confirm & Save button.
    
    // ===== FORM VALIDATION =====
    const feeStructureForm = document.getElementById('feeStructureForm');
    
    feeStructureForm.addEventListener('submit', function(e) {
      // Check if currency is selected
      const currencyValue = currencySelect.value.trim();
      
      if (!currencyValue) {
        e.preventDefault(); // Stop form submission
        
        // Scroll to currency field
        currencySelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Add error styling to currency select
        currencySelect.classList.add('border-red-500', 'ring-2', 'ring-red-500');
        
        // Create error message element
        const existingError = document.getElementById('currency-error');
        if (existingError) existingError.remove();
        
        const errorDiv = document.createElement('div');
        errorDiv.id = 'currency-error';
        errorDiv.className = 'mt-2 flex items-center gap-2 text-red-600 text-sm font-medium';
        errorDiv.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i> Please select a currency before saving';
        
        currencySelect.parentElement.appendChild(errorDiv);
        renderIcons();
        
        // Remove error styling and message after user selects currency
        const removeError = () => {
          currencySelect.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
          const errEl = document.getElementById('currency-error');
          if (errEl) errEl.remove();
          currencySelect.removeEventListener('change', removeError);
        };
        
        currencySelect.addEventListener('change', removeError);
        
        // Close preview panel to show the error
        closePreview();
        
        return false;
      }
      
      // If currency is "OTHER", check if custom label is provided
      if (currencyValue === 'OTHER') {
        const customValue = customCurrencyLabel.value.trim();
        if (!customValue) {
          e.preventDefault();
          
          customCurrencyLabel.scrollIntoView({ behavior: 'smooth', block: 'center' });
          customCurrencyLabel.classList.add('border-red-500', 'ring-2', 'ring-red-500');
          
          const existingError = document.getElementById('custom-currency-error');
          if (existingError) existingError.remove();
          
          const errorDiv = document.createElement('div');
          errorDiv.id = 'custom-currency-error';
          errorDiv.className = 'mt-2 flex items-center gap-2 text-red-600 text-sm font-medium';
          errorDiv.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i> Please enter a custom currency symbol or code';
          
          customCurrencyLabel.parentElement.appendChild(errorDiv);
          renderIcons();
          
          const removeError = () => {
            customCurrencyLabel.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
            const errEl = document.getElementById('custom-currency-error');
            if (errEl) errEl.remove();
            customCurrencyLabel.removeEventListener('input', removeError);
          };
          
          customCurrencyLabel.addEventListener('input', removeError);
          
          closePreview();
          return false;
        }
      }
    });

    // Initial icon render
    renderIcons();
  });
</script>
