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
  <div class="bg-white w-full max-w-4xl mx-4 rounded-lg shadow-2xl overflow-hidden flex flex-col" style="max-height: 90vh;">
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
        <select id="currencySelect" class="border rounded px-3 py-2 w-56 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="TSH" selected>TSh (TZS)</option>
          <option value="USD">USD ($)</option>
          <option value="KSH">KSh (KES)</option>
          <option value="EUR">EUR (€)</option>
          <option value="UGX">UGX (USh)</option>
          <option value="ZMW">ZMW (K)</option>
          <option value="OTHER">Other…</option>
        </select>
        <input id="customCurrencyLabel" type="text" class="border rounded px-3 py-2 w-40 hidden focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Symbol or code" />
      </div>
    </div>

    <!-- Tabs -->
    <div class="px-4 pt-4">
      <div class="inline-flex bg-slate-100 p-1 rounded-lg shadow-inner">
        <button id="tabAllBtn" class="px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow flex items-center gap-2">
          <i data-lucide="users" class="w-4 h-4"></i>
          For All Classes
        </button>
        <button id="tabSpecificBtn" class="px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white flex items-center gap-2">
          <i data-lucide="book" class="w-4 h-4"></i>
          For Specific Class
        </button>
      </div>
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
            <input id="specificSchoolId" type="text" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., SCH-001" />
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
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Nursery"> Nursery
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 1"> Grade 1
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 2"> Grade 2
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 3"> Grade 3
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 4"> Grade 4
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 5"> Grade 5
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 6"> Grade 6
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 7"> Grade 7
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 8"> Grade 8
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 9"> Grade 9
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 10"> Grade 10
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 11"> Grade 11
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Grade 12"> Grade 12
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Form 1"> Form 1
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Form 2"> Form 2
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Form 3"> Form 3
              </label>
              <label class="flex items-center px-3 py-2 hover:bg-slate-50 cursor-pointer">
                <input type="checkbox" class="class-checkbox mr-2 rounded" value="Form 4"> Form 4
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
  </div>

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
        <button id="confirmSaveBtn" class="px-4 py-2 rounded bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white shadow flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4"></i>
          Confirm & Save
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // --- Grab all DOM elements we'll interact with ---
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

    // --- Helpers ---
    // Safe icon renderer for Lucide (if loaded in layout)
    function renderIcons() {
      try {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
          window.lucide.createIcons();
        }
      } catch (_) {}
    }

    // Common currencies we show in the dropdown
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

    // Simple show/hide helpers for flex layouts
    function show(el) { el.style.display = 'flex'; }
    function hide(el) { el.style.display = 'none'; }

    // Toggle the active tab
    function switchTab(tab) {
      if (tab === 'all') {
        tabAll.classList.remove('hidden');
        tabSpecific.classList.add('hidden');
        tabAllBtn.className = 'px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow';
        tabSpecificBtn.className = 'px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white';
      } else {
        tabAll.classList.add('hidden');
        tabSpecific.classList.remove('hidden');
        tabSpecificBtn.className = 'px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white shadow';
        tabAllBtn.className = 'px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:bg-white';
      }
    }

    // Create a new fee component row
    function makeRow(defaultName = '', defaultAmount = '') {
      const row = document.createElement('div');
      row.className = 'grid grid-cols-12 gap-2';
      row.innerHTML = `
        <input type="text" class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Component name" value="${defaultName}" />
        <input type="number" min="0" step="0.01" class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Amount" value="${defaultAmount}" />
        <button type="button" class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
      `;
      const removeBtn = row.querySelector('button');
      removeBtn.addEventListener('click', () => row.remove());
      renderIcons();
      return row;
    }

    // Turn all rows in a container into an array of {name, amount}
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

    // Show preview overlay with provided HTML
    function openPreview(contentHtml) {
      feePreviewContent.innerHTML = contentHtml;
      show(previewPanel);
      renderIcons();
    }

    function closePreview() { hide(previewPanel); }

    // --- Class dropdown toggle ---
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

    // Currency: show/hide custom input
    currencySelect.addEventListener('change', () => {
      customCurrencyLabel.classList.toggle('hidden', currencySelect.value !== 'OTHER');
    });

    // --- Open/close modal ---
    if (openBtn) openBtn.addEventListener('click', () => show(modal));
    [closeTop, closeBottom].forEach(btn => btn && btn.addEventListener('click', () => hide(modal)));
    modal.addEventListener('click', (e) => { if (e.target === modal) hide(modal); });

    // --- Tabs ---
    tabAllBtn.addEventListener('click', () => switchTab('all'));
    tabSpecificBtn.addEventListener('click', () => switchTab('specific'));

    // --- Add component rows ---
    addAllComponent.addEventListener('click', () => allComponents.appendChild(makeRow()));
    addSpecificComponent.addEventListener('click', () => specificComponents.appendChild(makeRow()));

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
          specificComponents.appendChild(makeRow(item.name, item.amount));
        });
        renderIcons();
        alert(`Loaded ${allClassItems.length} component(s) from All Classes structure. You can now edit or add adjustments.`);
      });
    }

    // --- Preset buttons: drop in a ready-made row ---
    Array.from(document.querySelectorAll('.presetBtn')).forEach(btn => {
      btn.addEventListener('click', () => {
        allComponents.appendChild(makeRow(btn.dataset.name || '', btn.dataset.amount || ''));
      });
    });
    Array.from(document.querySelectorAll('.presetSpecificBtn')).forEach(btn => {
      btn.addEventListener('click', () => {
        specificComponents.appendChild(makeRow(btn.dataset.name || '', btn.dataset.amount || ''));
      });
    });

    // --- Preview buttons ---
    previewAllBtn.addEventListener('click', () => {
      const items = collectRows(allComponents);
      const html = renderPreview('All Classes Fee Structure', '', items);
      openPreview(html);
    });

    previewSpecificBtn.addEventListener('click', () => {
      const selectedClasses = Array.from(classCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      if (selectedClasses.length === 0) {
        alert('Please select at least one class');
        return;
      }
      const items = collectRows(specificComponents);
      const classesStr = selectedClasses.join(', ');
      const meta = `${specificSchoolId.value ? 'School: ' + specificSchoolId.value + ' • ' : ''}Classes: ${classesStr}`;
      const html = renderPreview('Specific Class Fee Structure', meta, items);
      openPreview(html);
    });

    // --- Preview panel controls ---
    [closePreviewPanel, backToEditBtn].forEach(btn => btn && btn.addEventListener('click', closePreview));

    // Demo save/reset
    confirmSaveBtn.addEventListener('click', () => {
      alert('Fee structure saved (demo). Wire to backend to persist.');
      closePreview();
      hide(modal);
      allComponents.innerHTML = '';
      specificComponents.innerHTML = '';
      specificSchoolId.value = '';
      classCheckboxes.forEach(cb => cb.checked = false);
      updateClassDisplay();
      currencySelect.value = 'TSH';
      customCurrencyLabel.value = '';
      customCurrencyLabel.classList.add('hidden');
    });

    // Initial icon render
    renderIcons();
  });
</script>
