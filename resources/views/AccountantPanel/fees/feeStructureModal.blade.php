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
        
        <!-- Livewire Custom Components (All Classes) -->
        <div class="border-t pt-4">
          <h4 class="text-sm font-medium text-slate-700 mb-3">Custom Components</h4>
          @livewire('fee-components-manager', ['type' => 'all'])
        </div>

        <div class="flex items-center gap-2 mt-4">
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
        
        <!-- Livewire Custom Components (Specific Class) -->
        <div class="border-t pt-4">
          <h4 class="text-sm font-medium text-slate-700 mb-3">Custom Components</h4>
          @livewire('fee-components-manager', ['type' => 'specific'])
        </div>
        
        <div class="flex items-center gap-2 mt-4">
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
    // DOM Elements
    const modal = document.getElementById('feeStructureModal');
    const openBtn = document.getElementById('openEditStructureModal');
    const currencySelect = document.getElementById('currencySelect');
    const customCurrencyLabel = document.getElementById('customCurrencyLabel');
    const scopeInput = document.getElementById('scopeInput');
    const tabAllBtn = document.getElementById('tabAllBtn');
    const tabSpecificBtn = document.getElementById('tabSpecificBtn');
    const tabAll = document.getElementById('tabAll');
    const tabSpecific = document.getElementById('tabSpecific');
    const previewPanel = document.getElementById('feePreviewPanel');
    const feePreviewContent = document.getElementById('feePreviewContent');
    const classDropdownBtn = document.getElementById('classDropdownBtn');
    const classDropdownMenu = document.getElementById('classDropdownMenu');
    const selectedClassesDisplay = document.getElementById('selectedClassesDisplay');
    const classCheckboxes = document.querySelectorAll('.class-checkbox');
    const specificSchoolId = document.getElementById('specificSchoolId');
    const feeStructureForm = document.getElementById('feeStructureForm');

    // Currency map for preview
    const currencyMap = {
      'TSH': { label: 'TSh', symbol: 'TSh' },
      'USD': { label: 'USD', symbol: '$' },
      'KSH': { label: 'KSh', symbol: 'KSh' },
      'EUR': { label: 'EUR', symbol: '€' },
      'UGX': { label: 'UGX', symbol: 'USh' },
      'ZMW': { label: 'ZMW', symbol: 'K' }
    };

    // Utility Functions
    function renderIcons() {
      if (window.lucide?.createIcons) window.lucide.createIcons();
    }

    function show(el) { el.style.display = 'flex'; }
    function hide(el) { el.style.display = 'none'; }

    function getCurrencyLabelAndSymbol() {
      const val = currencySelect.value;
      if (val === 'OTHER') {
        const custom = customCurrencyLabel.value.trim() || 'CUR';
        return { label: custom, symbol: custom };
      }
      return currencyMap[val] || currencyMap['TSH'];
    }

    function stripNames(container) {
      container?.querySelectorAll('input[name]').forEach(input => {
        if (!input.dataset.originalName) input.dataset.originalName = input.name;
        input.removeAttribute('name');
      });
    }

    function restoreNames(container) {
      container?.querySelectorAll('input[data-original-name]').forEach(input => {
        input.name = input.dataset.originalName;
      });
    }

    function setPresetVisible(containerId, visible, defaultAmount) {
      const el = document.getElementById(containerId);
      if (!el) return;
      el.classList.toggle('hidden', !visible);
      if (visible) {
        const amountInput = el.querySelector('input[type="number"]');
        if (amountInput) amountInput.value = defaultAmount;
      }
      renderIcons();
    }

    function collectRows(container) {
      return Array.from(container.querySelectorAll('[name*="[name]"]')).map((nameEl, idx) => {
        const amountEl = container.querySelectorAll('[name*="[amount]"]')[idx];
        const name = nameEl?.value.trim();
        const amount = parseFloat(amountEl?.value) || 0;
        return name ? { name, amount } : null;
      }).filter(Boolean);
    }

    function collectPresetRows(containerId) {
      const container = document.getElementById(containerId);
      return container ? Array.from(container.querySelectorAll('.preset-form:not(.hidden)')).map(block => {
        const name = block.querySelector('input[type="text"]')?.value.trim();
        const amount = parseFloat(block.querySelector('input[type="number"]')?.value) || 0;
        return name ? { name, amount } : null;
      }).filter(Boolean) : [];
    }

    function makeRow(type, defaultName = '', defaultAmount = '') {
      const containerSelector = type === 'specific' ? '#specificCustomComponentsList' : '#allCustomComponentsList';
      const container = document.querySelector(containerSelector);
      const index = container.querySelectorAll('.grid').length;
      const prefix = type === 'specific' ? 'specific_components' : 'all_components';
      
      const row = document.createElement('div');
      row.className = 'grid grid-cols-12 gap-2';
      row.innerHTML = `
        <input name="${prefix}[${index}][name]" type="text" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Component name" value="${defaultName}" />
        <input name="${prefix}[${index}][amount]" type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" value="${defaultAmount}" />
        <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
      `;
      row.querySelector('button').addEventListener('click', () => row.remove());
      renderIcons();
      return row;
    }

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

    // Tab Switching
    function switchTab(tab) {
      const isAll = tab === 'all';
      tabAll.classList.toggle('hidden', !isAll);
      tabSpecific.classList.toggle('hidden', isAll);
      tabAllBtn.className = `px-3 py-2 rounded-md text-sm font-medium ${isAll ? 'bg-indigo-600 text-white shadow' : 'text-slate-700 hover:bg-white'}`;
      tabSpecificBtn.className = `px-3 py-2 rounded-md text-sm font-medium ${!isAll ? 'bg-indigo-600 text-white shadow' : 'text-slate-700 hover:bg-white'}`;
      scopeInput.value = isAll ? 'all' : 'specific';
      restoreNames(isAll ? tabAll : tabSpecific);
      stripNames(isAll ? tabSpecific : tabAll);
      setPresetVisible(isAll ? 'preset-all-tuition' : 'preset-specific-tuition', true, 0);
    }

    // Modal Controls
    openBtn?.addEventListener('click', () => { show(modal); switchTab('all'); });
    ['closeFeeStructureModal', 'closeFeeStructureModalBottom'].forEach(id => {
      document.getElementById(id)?.addEventListener('click', () => hide(modal));
    });
    modal.addEventListener('click', e => { if (e.target === modal) hide(modal); });

    // Tab Events
    tabAllBtn.addEventListener('click', () => switchTab('all'));
    tabSpecificBtn.addEventListener('click', () => switchTab('specific'));

    // Currency Events
    currencySelect.addEventListener('change', () => {
      customCurrencyLabel.classList.toggle('hidden', currencySelect.value !== 'OTHER');
    });

    // Add Component Events - Removed (handled by Livewire)
    
    // Load All Classes Structure
    document.getElementById('loadAllClassesStructure')?.addEventListener('click', () => {
      alert('Load All Classes Structure feature will copy preset components from "All Classes" tab.');
    });

    // Preset Buttons
    document.querySelectorAll('.presetBtn, .presetSpecificBtn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const tab = btn.classList.contains('presetBtn') ? 'all' : 'specific';
        const name = btn.dataset.name;
        const id = `preset-${tab}-${name.toLowerCase().replace(/\s+/g, '-')}`;
        const el = document.getElementById(id);
        if (el) {
          el.classList.remove('hidden');
          const amountInput = el.querySelector('input[type="number"]');
          if (amountInput) amountInput.value = btn.dataset.amount;
          const nameInput = el.querySelector('input[type="text"]');
          if (nameInput) nameInput.value = name;
          renderIcons();
        }
      });
    });

    // Remove Preset Buttons
    document.querySelectorAll('.remove-preset').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const el = document.getElementById(btn.dataset.target);
        if (el) {
          el.classList.add('hidden');
          const amountInput = el.querySelector('input[type="number"]');
          if (amountInput) amountInput.value = '';
        }
      });
    });

    // Preview Buttons
    document.getElementById('previewAllBtn').addEventListener('click', () => {
      const allComponents = document.querySelectorAll('input[name*="all_components["][name*="[name]"]');
      const items = Array.from(allComponents).map((nameEl, idx) => {
        const amountEl = document.querySelector(`input[name="all_components[${idx}][amount]"]`);
        const name = nameEl?.value.trim();
        const amount = parseFloat(amountEl?.value) || 0;
        return name ? { name, amount } : null;
      }).filter(Boolean);
      
      const presets = collectPresetRows('allPresetForms');
      feePreviewContent.innerHTML = renderPreview('All Classes Fee Structure', '', [...items, ...presets]);
      show(previewPanel);
      renderIcons();
    });

    document.getElementById('previewSpecificBtn').addEventListener('click', () => {
      const selectedClasses = Array.from(classCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      if (selectedClasses.length === 0) { alert('Please select at least one class'); return; }
      
      const specificComponents = document.querySelectorAll('input[name*="specific_components["][name*="[name]"]');
      const items = Array.from(specificComponents).map((nameEl, idx) => {
        const amountEl = document.querySelector(`input[name="specific_components[${idx}][amount]"]`);
        const name = nameEl?.value.trim();
        const amount = parseFloat(amountEl?.value) || 0;
        return name ? { name, amount } : null;
      }).filter(Boolean);
      
      const presets = collectPresetRows('specificPresetForms');
      const meta = `${specificSchoolId.value ? 'School: ' + specificSchoolId.value + ' • ' : ''}Classes: ${selectedClasses.join(', ')}`;
      feePreviewContent.innerHTML = renderPreview('Specific Class Fee Structure', meta, [...items, ...presets]);
      show(previewPanel);
      renderIcons();
    });

    ['closePreviewPanel', 'backToEditBtn'].forEach(id => {
      document.getElementById(id)?.addEventListener('click', () => hide(previewPanel));
    });

    // Class Dropdown
    classDropdownBtn.addEventListener('click', () => { classDropdownMenu.classList.toggle('hidden'); renderIcons(); });
    classCheckboxes.forEach(cb => cb.addEventListener('change', () => {
      const selected = Array.from(classCheckboxes).filter(c => c.checked).map(c => c.value);
      selectedClassesDisplay.textContent = selected.length ? selected.join(', ') : 'Click to select classes...';
      selectedClassesDisplay.className = selected.length ? 'text-slate-900' : 'text-slate-500';
    }));
    document.addEventListener('click', e => {
      if (!classDropdownBtn.contains(e.target) && !classDropdownMenu.contains(e.target)) {
        classDropdownMenu.classList.add('hidden');
      }
    });

    // Form Validation
    feeStructureForm.addEventListener('submit', function(e) {
      const currencyValue = currencySelect.value.trim();
      
      if (!currencyValue) {
        e.preventDefault();
        currencySelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
        currencySelect.classList.add('border-red-500', 'ring-2', 'ring-red-500');
        
        document.getElementById('currency-error')?.remove();
        const errorDiv = document.createElement('div');
        errorDiv.id = 'currency-error';
        errorDiv.className = 'mt-2 flex items-center gap-2 text-red-600 text-sm font-medium';
        errorDiv.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i> Please select a currency before saving';
        currencySelect.parentElement.appendChild(errorDiv);
        renderIcons();
        
        currencySelect.addEventListener('change', function removeError() {
          currencySelect.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
          document.getElementById('currency-error')?.remove();
          currencySelect.removeEventListener('change', removeError);
        });
        
        hide(previewPanel);
        return false;
      }
      
      if (currencyValue === 'OTHER' && !customCurrencyLabel.value.trim()) {
        e.preventDefault();
        customCurrencyLabel.scrollIntoView({ behavior: 'smooth', block: 'center' });
        customCurrencyLabel.classList.add('border-red-500', 'ring-2', 'ring-red-500');
        
        document.getElementById('custom-currency-error')?.remove();
        const errorDiv = document.createElement('div');
        errorDiv.id = 'custom-currency-error';
        errorDiv.className = 'mt-2 flex items-center gap-2 text-red-600 text-sm font-medium';
        errorDiv.innerHTML = '<i data-lucide="alert-circle" class="w-4 h-4"></i> Please enter a custom currency symbol or code';
        customCurrencyLabel.parentElement.appendChild(errorDiv);
        renderIcons();
        
        customCurrencyLabel.addEventListener('input', function removeError() {
          customCurrencyLabel.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
          document.getElementById('custom-currency-error')?.remove();
          customCurrencyLabel.removeEventListener('input', removeError);
        });
        
        hide(previewPanel);
        return false;
      }
    });

    renderIcons();
  });
</script>
