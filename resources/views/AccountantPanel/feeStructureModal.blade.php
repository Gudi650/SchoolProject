<!-- Fee Structure Modal with Currency Selection -->
<style>
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

    // Safe icon renderer for Lucide (if loaded in layout)
    function renderIcons() {
      try {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
          window.lucide.createIcons();
        }
      } catch (_) {}
    }

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

    function show(el) { el.style.display = 'flex'; }
    function hide(el) { el.style.display = 'none'; }

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

    function makeRow(defaultName = '', defaultAmount = '') {
      const row = document.createElement('div');
      row.className = 'grid grid-cols-12 gap-2';
      row.innerHTML = `
        <input type=\"text\" class=\"col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500\" placeholder=\"Component name\" value=\"${defaultName}\" />
        <input type=\"number\" min=\"0\" step=\"0.01\" class=\"col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500\" placeholder=\"Amount\" value=\"${defaultAmount}\" />
        <button type=\"button\" class=\"col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center\"><i data-lucide=\"trash-2\" class=\"w-4 h-4\"></i></button>
      `;
      const removeBtn = row.querySelector('button');
      removeBtn.addEventListener('click', () => row.remove());
      renderIcons();
      return row;
    }

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

    function renderPreview(title, meta, items) {
      const { symbol, label } = getCurrencyLabelAndSymbol();
      const total = items.reduce((sum, i) => sum + i.amount, 0);
      const rows = items.map(i => `
        <tr class=\"odd:bg-white even:bg-slate-50\">
          <td class=\"border px-3 py-1\">${i.name}</td>
          <td class=\"border px-3 py-1 text-right\">${symbol} ${i.amount.toLocaleString()}</td>
        </tr>
      `).join('');

      return `
        <div class=\"space-y-2\">
          <div class=\"flex items-center justify-between\">
            <h4 class=\"font-medium\">${title}</h4>
            <span class=\"text-sm text-gray-600\">Currency: ${label}</span>
          </div>
          ${meta ? `<div class=\"text-sm text-gray-700\">${meta}</div>` : ''}
          <table class=\"w-full text-sm border-collapse\">
            <thead>
              <tr class=\"bg-slate-100 text-slate-700\">
                <th class=\"border px-3 py-1 text-left\">Component</th>
                <th class=\"border px-3 py-1 text-right\">Amount</th>
              </tr>
            </thead>
            <tbody>${rows || '<tr><td class=\"border px-3 py-2 text-center\" colspan=\"2\">No components added</td></tr>'}</tbody>
            <tfoot>
              <tr class=\"bg-indigo-50 text-indigo-700 font-semibold\">
                <td class=\"border px-3 py-1 text-right\">Total</td>
                <td class=\"border px-3 py-1 text-right\">${symbol} ${total.toLocaleString()}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      `;
    }

    function openPreview(contentHtml) {
      feePreviewContent.innerHTML = contentHtml;
      show(previewPanel);
      renderIcons();
    }

    function closePreview() { hide(previewPanel); }

    // Class dropdown toggle
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

    // Open/close modal
    if (openBtn) openBtn.addEventListener('click', () => show(modal));
    [closeTop, closeBottom].forEach(btn => btn && btn.addEventListener('click', () => hide(modal)));
    modal.addEventListener('click', (e) => { if (e.target === modal) hide(modal); });

    // Tabs
    tabAllBtn.addEventListener('click', () => switchTab('all'));
    tabSpecificBtn.addEventListener('click', () => switchTab('specific'));

    // Add component rows
    addAllComponent.addEventListener('click', () => allComponents.appendChild(makeRow()));
    addSpecificComponent.addEventListener('click', () => specificComponents.appendChild(makeRow()));

    // Load All Classes Structure button
    const loadAllClassesStructureBtn = document.getElementById('loadAllClassesStructure');
    if (loadAllClassesStructureBtn) {
      loadAllClassesStructureBtn.addEventListener('click', () => {
        const allClassItems = collectRows(allComponents);
        if (allClassItems.length === 0) {
          alert('Please add fee components in "All Classes" tab first.');
          return;
        }
        
        // Clear existing specific class components
        specificComponents.innerHTML = '';
        
        // Copy each component from All Classes to Specific Class
        allClassItems.forEach(item => {
          specificComponents.appendChild(makeRow(item.name, item.amount));
        });
        
        renderIcons();
        alert(`Loaded ${allClassItems.length} component(s) from All Classes structure. You can now edit or add adjustments.`);
      });
    }

    // Presets
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

    // Preview buttons
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

    // Preview panel controls
    [closePreviewPanel, backToEditBtn].forEach(btn => btn && btn.addEventListener('click', closePreview));

    confirmSaveBtn.addEventListener('click', () => {
      alert('Fee structure saved (demo). Wire to backend to persist.');
      closePreview();
      hide(modal);
      // Optional: reset inputs
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
</script><!-- Fee Structure Modal -->
<div id="feeStructureModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 items-center justify-center p-4" style="display: none;">
  <div class="bg-white w-full max-w-3xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
    <!-- Header -->
    <div class="flex items-center justify-between gap-4 mb-6">
      <div>
        <h2 class="text-2xl font-bold text-slate-900">Fee Structure</h2>
        <p class="text-sm text-slate-600 mt-1">Manage fee structure for all classes or specific classes</p>
      </div>
      <button id="closeEditStructureModal" type="button" class="text-slate-400 hover:text-slate-600 p-2 rounded-md transition-colors">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-2 mb-6 border-b border-slate-200">
      <button type="button" class="fee-tab active px-4 py-2 font-medium text-indigo-600 border-b-2 border-indigo-600" data-tab="all-classes">
        <i data-lucide="users" class="w-4 h-4 inline mr-2"></i> For All Classes
      </button>
      <button type="button" class="fee-tab px-4 py-2 font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900" data-tab="specific-class">
        <i data-lucide="book" class="w-4 h-4 inline mr-2"></i> For Specific Class
      </button>
    </div>

    <!-- Tab Content -->
    <div class="space-y-6">
      <!-- Tab 1: All Classes -->
      <div id="all-classes-tab" class="fee-tab-content">
        <form id="feeAllClassesForm" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Base Fee Components (Applies to All Classes)</label>
            <div class="mb-3 flex gap-2 flex-wrap">
              <button type="button" class="preset-btn px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Tuition" data-amount="0">Tuition</button>
              <button type="button" class="preset-btn px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Transport" data-amount="0">Transport</button>
              <button type="button" class="preset-btn px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Hostel" data-amount="0">Hostel</button>
              <button type="button" class="preset-btn px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Library" data-amount="0">Library</button>
              <button type="button" class="preset-btn px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Exam" data-amount="0">Exam</button>
            </div>
            <div id="allClassesAttributesContainer" class="space-y-2"></div>
            <button type="button" id="addAllClassesAttribute" class="mt-3 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition-colors flex items-center gap-2">
              <i data-lucide="plus" class="w-4 h-4"></i>
              Add Fee Component
            </button>
          </div>

          <!-- Preview for All Classes -->
          <div class="mt-6 pt-6 border-t border-slate-200">
            <h3 class="text-sm font-semibold text-slate-900 mb-3">Preview - All Classes</h3>
            <div class="bg-slate-50 rounded-lg overflow-x-auto">
              <table class="w-full text-xs">
                <thead>
                  <tr class="border-b border-slate-200">
                    <th class="px-4 py-2 text-left font-medium text-slate-700">Component</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-700">Amount</th>
                  </tr>
                </thead>
                <tbody id="allClassesPreviewTable"></tbody>
              </table>
            </div>
          </div>

          <div class="flex gap-3 pt-6 border-t border-slate-200">
            <button type="button" id="previewAllBtn" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center justify-center gap-2">
              <i data-lucide="eye" class="w-4 h-4"></i> Preview Structure
            </button>
          </div>
        </form>
      </div>

      <!-- Tab 2: Specific Class -->
      <div id="specific-class-tab" class="fee-tab-content hidden">
        <form id="feeSpecificClassForm" class="space-y-4">
          <!-- School ID -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">School ID</label>
            <input type="number" id="specificSchoolId" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
          </div>

          <!-- Class Selection -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1 flex items-center gap-2">
              <i data-lucide="book-open" class="w-4 h-4"></i>
              Select Classes (Multiple)
            </label>
            <select id="specificClassNames" multiple class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white" required>
              <option value="Nursery">Nursery</option>
              <option value="Grade 1">Grade 1</option>
              <option value="Grade 2">Grade 2</option>
              <option value="Grade 3">Grade 3</option>
              <option value="Grade 4">Grade 4</option>
              <option value="Grade 5">Grade 5</option>
              <option value="Grade 6">Grade 6</option>
              <option value="Grade 7">Grade 7</option>
              <option value="Grade 8">Grade 8</option>
              <option value="Grade 9">Grade 9</option>
              <option value="Grade 10">Grade 10</option>
              <option value="Grade 11">Grade 11</option>
              <option value="Grade 12">Grade 12</option>
              <option value="Form 1">Form 1</option>
              <option value="Form 2">Form 2</option>
              <option value="Form 3">Form 3</option>
              <option value="Form 4">Form 4</option>
            </select>
            <p class="text-xs text-slate-500 mt-1">Hold Ctrl/Cmd to select multiple classes</p>
          </div>

          <!-- Fee Components for Specific Class -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Fee Components for This Class</label>
            <div class="mb-3 flex gap-2 flex-wrap">
              <button type="button" class="preset-btn-specific px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Tuition" data-amount="0">Tuition</button>
              <button type="button" class="preset-btn-specific px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Transport" data-amount="0">Transport</button>
              <button type="button" class="preset-btn-specific px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Hostel" data-amount="0">Hostel</button>
              <button type="button" class="preset-btn-specific px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Library" data-amount="0">Library</button>
              <button type="button" class="preset-btn-specific px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg hover:bg-blue-200" data-component="Exam" data-amount="0">Exam</button>
            </div>
            <div id="specificClassAttributesContainer" class="space-y-2"></div>
            <button type="button" id="addSpecificClassAttribute" class="mt-3 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition-colors flex items-center gap-2">
              <i data-lucide="plus" class="w-4 h-4"></i>
              Add Fee Component
            </button>
          </div>

          <!-- Preview for Specific Class -->
          <div class="mt-6 pt-6 border-t border-slate-200">
            <h3 class="text-sm font-semibold text-slate-900 mb-3">Preview - Specific Class</h3>
            <div class="bg-slate-50 rounded-lg overflow-x-auto">
              <table class="w-full text-xs">
                <thead>
                  <tr class="border-b border-slate-200">
                    <th class="px-4 py-2 text-left font-medium text-slate-700">School ID</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-700">Class</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-700">Components</th>
                  </tr>
                </thead>
                <tbody id="specificClassPreviewTable"></tbody>
              </table>
            </div>
          </div>

          <div class="flex gap-3 pt-6 border-t border-slate-200">
            <button type="button" id="previewSpecificBtn" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center justify-center gap-2">
              <i data-lucide="eye" class="w-4 h-4"></i> Preview Structure
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-3 pt-6 border-t border-slate-200 mt-6">
      <button type="button" id="cancelEditStructureModal" class="flex-1 px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors font-medium flex items-center justify-center gap-2">
        <i data-lucide="x" class="w-4 h-4"></i> Close
      </button>
    </div>
  </div>
</div>

<!-- Preview Panel (overlays inside modal content) -->
<div id="feePreviewPanel" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
  <div class="bg-white w-full max-w-3xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-xl font-semibold text-slate-900 flex items-center gap-2">
        <i data-lucide="eye" class="w-5 h-5"></i>
        Review Fee Structure
      </h3>
      <button type="button" id="closePreviewPanel" class="text-slate-400 hover:text-slate-600 p-2 rounded-md">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>

    <div id="previewContent" class="space-y-6">
      <!-- Populated dynamically -->
    </div>

    <div class="flex gap-3 pt-6 border-t border-slate-200 mt-6">
      <button type="button" id="confirmSaveBtn" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium flex items-center justify-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        Confirm & Save
      </button>
      <button type="button" id="backToEditBtn" class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium flex items-center justify-center gap-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Back to Edit
      </button>
    </div>
  </div>
  <style>
    /* Darken backdrop slightly using existing modal backdrop */
  </style>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('feeStructureModal');
    const openBtn = document.getElementById('openEditStructureModal');
    const closeBtn = document.getElementById('closeEditStructureModal');
    const cancelBtn = document.getElementById('cancelEditStructureModal');
    const tabBtns = document.querySelectorAll('.fee-tab');
    const tabContents = document.querySelectorAll('.fee-tab-content');

    // Forms
    const feeAllClassesForm = document.getElementById('feeAllClassesForm');
    const feeSpecificClassForm = document.getElementById('feeSpecificClassForm');

    // All Classes
    const allClassesContainer = document.getElementById('allClassesAttributesContainer');
    const addAllClassesBtn = document.getElementById('addAllClassesAttribute');
    const allClassesPreviewTable = document.getElementById('allClassesPreviewTable');

    // Specific Class
    const specificClassContainer = document.getElementById('specificClassAttributesContainer');
    const addSpecificClassBtn = document.getElementById('addSpecificClassAttribute');
    const specificClassPreviewTable = document.getElementById('specificClassPreviewTable');
    // Preview controls
    const previewPanel = document.getElementById('feePreviewPanel');
    const previewContent = document.getElementById('previewContent');
    const previewAllBtn = document.getElementById('previewAllBtn');
    const previewSpecificBtn = document.getElementById('previewSpecificBtn');
    const confirmSaveBtn = document.getElementById('confirmSaveBtn');
    const backToEditBtn = document.getElementById('backToEditBtn');
    const closePreviewPanel = document.getElementById('closePreviewPanel');
    let activePreview = null; // 'all' | 'specific'

    if (!openBtn || !modal) {
      console.error('❌ Elements not found');
      return;
    }

    // Show modal
    function showModal() {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    // Hide modal
    function hideModal() {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }

    // Show/Hide preview panel
    function showPreview() {
      previewPanel.classList.remove('hidden');
      previewPanel.classList.add('flex');
    }
    function hidePreview() {
      previewPanel.classList.add('hidden');
      previewPanel.classList.remove('flex');
      activePreview = null;
    }

    // Wire button clicks
    openBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showModal();
    });

    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) hideModal();
    });

    // Tab switching
    tabBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const tab = btn.getAttribute('data-tab');
        
        tabBtns.forEach(b => {
          b.classList.remove('active', 'text-indigo-600', 'border-indigo-600');
          b.classList.add('text-slate-600', 'border-transparent');
        });
        btn.classList.add('active', 'text-indigo-600', 'border-indigo-600');
        btn.classList.remove('text-slate-600', 'border-transparent');

        tabContents.forEach(content => content.classList.add('hidden'));
        document.getElementById(tab + '-tab').classList.remove('hidden');
      });
    });

    // Helper: Add attribute row with optional component name and amount
    function addAttributeRow(container, componentName = '', amount = '') {
      const div = document.createElement('div');
      div.className = 'flex gap-2';
      div.innerHTML = `
        <input type="text" placeholder="Component Name (e.g., Tuition, Transport, Hostel)" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg" value="${componentName}" required>
        <input type="number" step="0.01" placeholder="Amount" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg" value="${amount}" required>
        <button type="button" class="px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 removeAttr">Remove</button>
      `;
      container.appendChild(div);

      div.querySelector('.removeAttr').addEventListener('click', (e) => {
        e.preventDefault();
        div.remove();
      });
    }

    // Preset button handlers for All Classes
    const presetBtns = document.querySelectorAll('.preset-btn');
    presetBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const componentName = btn.getAttribute('data-component');
        addAttributeRow(allClassesContainer, componentName, '');
      });
    });

    // Preset button handlers for Specific Class
    const presetBtnsSpecific = document.querySelectorAll('.preset-btn-specific');
    presetBtnsSpecific.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const componentName = btn.getAttribute('data-component');
        addAttributeRow(specificClassContainer, componentName, '');
      });
    });

    // Add attribute buttons
    if (addAllClassesBtn) {
      addAllClassesBtn.addEventListener('click', (e) => {
        e.preventDefault();
        addAttributeRow(allClassesContainer);
      });
    }

    // Collectors
    function collectAllClasses() {
      const attrs = [];
      allClassesContainer.querySelectorAll('div').forEach(div => {
        const inputs = div.querySelectorAll('input');
        if (inputs.length >= 2 && inputs[0].value) {
          attrs.push({ name: inputs[0].value, value: inputs[1].value || 0 });
        }
      });
      return attrs;
    }
    function collectSpecificClass() {
      const schoolIdEl = document.getElementById('specificSchoolId');
      const classEl = document.getElementById('specificClassName');
      const attrs = [];
      specificClassContainer.querySelectorAll('div').forEach(div => {
        const inputs = div.querySelectorAll('input');
        if (inputs.length >= 2 && inputs[0].value) {
          attrs.push({ name: inputs[0].value, value: inputs[1].value || 0 });
        }
      });
      return { schoolId: schoolIdEl?.value || '', className: classEl?.value || '', attrs };
    }

    // Render preview
    function renderAllClassesPreview() {
      const attrs = collectAllClasses();
      const total = attrs.reduce((sum, a) => sum + (parseFloat(a.value) || 0), 0);
      previewContent.innerHTML = `
        <div>
          <h4 class="text-sm font-semibold text-slate-800 mb-2">All Classes</h4>
          <div class="bg-slate-50 rounded-lg overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-slate-200">
                  <th class="px-4 py-2 text-left">Component</th>
                  <th class="px-4 py-2 text-left">Amount</th>
                </tr>
              </thead>
              <tbody>
                ${attrs.map(a => `<tr class="border-b border-slate-100"><td class="px-4 py-2">${a.name}</td><td class="px-4 py-2">₹${Number(a.value||0).toLocaleString()}</td></tr>`).join('') || '<tr><td class="px-4 py-2" colspan="2">No components added</td></tr>'}
                <tr class="bg-slate-100 font-semibold"><td class="px-4 py-2">Total</td><td class="px-4 py-2">₹${total.toLocaleString()}</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      `;
    }

    function renderSpecificClassPreview() {
      const data = collectSpecificClass();
      const total = data.attrs.reduce((sum, a) => sum + (parseFloat(a.value) || 0), 0);
      previewContent.innerHTML = `
        <div>
          <h4 class="text-sm font-semibold text-slate-800 mb-2">Specific Class</h4>
          <div class="mb-2 text-sm text-slate-600">School ID: <span class="font-medium">${data.schoolId || '-'}</span> • Class: <span class="font-medium">${data.className || '-'}</span></div>
          <div class="bg-slate-50 rounded-lg overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-slate-200">
                  <th class="px-4 py-2 text-left">Component</th>
                  <th class="px-4 py-2 text-left">Amount</th>
                </tr>
              </thead>
              <tbody>
                ${data.attrs.map(a => `<tr class="border-b border-slate-100"><td class="px-4 py-2">${a.name}</td><td class="px-4 py-2">₹${Number(a.value||0).toLocaleString()}</td></tr>`).join('') || '<tr><td class="px-4 py-2" colspan="2">No components added</td></tr>'}
                <tr class="bg-slate-100 font-semibold"><td class="px-4 py-2">Total</td><td class="px-4 py-2">₹${total.toLocaleString()}</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      `;
    }

    // Wire preview buttons
    if (previewAllBtn) {
      previewAllBtn.addEventListener('click', (e) => {
        e.preventDefault();
        activePreview = 'all';
        renderAllClassesPreview();
        showPreview();
      });
    }
    if (previewSpecificBtn) {
      previewSpecificBtn.addEventListener('click', (e) => {
        e.preventDefault();
        activePreview = 'specific';
        renderSpecificClassPreview();
        showPreview();
      });
    }

    // Back/Close preview
    if (backToEditBtn) backToEditBtn.addEventListener('click', hidePreview);
    if (closePreviewPanel) closePreviewPanel.addEventListener('click', hidePreview);

    // Confirm & Save (reuse existing submit flows)
    if (confirmSaveBtn) {
      confirmSaveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (activePreview === 'all' && feeAllClassesForm) {
          // replicate submit handling for All Classes
          const attributes = collectAllClasses();
          allClassesPreviewTable.innerHTML = '';
          attributes.forEach(attr => {
            const row = document.createElement('tr');
            row.className = 'border-b border-slate-200 hover:bg-slate-100';
            row.innerHTML = `
              <td class="px-4 py-2 text-slate-900">${attr.name}</td>
              <td class="px-4 py-2 text-slate-900">₹${parseFloat(attr.value||0).toLocaleString()}</td>
            `;
            allClassesPreviewTable.appendChild(row);
          });
          alert('Fee structure for all classes saved successfully!');
          feeAllClassesForm.reset();
          allClassesContainer.innerHTML = '';
          hidePreview();
        } else if (activePreview === 'specific' && feeSpecificClassForm) {
          const data = collectSpecificClass();
          specificClassPreviewTable.innerHTML = '';
          const row = document.createElement('tr');
          row.className = 'border-b border-slate-200 hover:bg-slate-100';
          row.innerHTML = `
            <td class="px-4 py-2 text-slate-900">${data.schoolId}</td>
            <td class="px-4 py-2 text-slate-900">${data.className}</td>
            <td class="px-4 py-2 text-slate-900">${data.attrs.length > 0 ? data.attrs.map(a => `${a.name}: ₹${parseFloat(a.value||0).toLocaleString()}`).join(', ') : 'None'}</td>
          `;
          specificClassPreviewTable.appendChild(row);
          alert('Fee structure for ' + (data.className || 'selected class') + ' saved successfully!');
          feeSpecificClassForm.reset();
          specificClassContainer.innerHTML = '';
          hidePreview();
        }
      });
    }
    if (addSpecificClassBtn) {
      addSpecificClassBtn.addEventListener('click', (e) => {
        e.preventDefault();
        addAttributeRow(specificClassContainer);
      });
    }

    // Form submission - All Classes
    if (feeAllClassesForm) {
      feeAllClassesForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const attributes = [];
        allClassesContainer.querySelectorAll('div').forEach(div => {
          const inputs = div.querySelectorAll('input');
          if (inputs.length >= 2 && inputs[0].value && inputs[1].value) {
            attributes.push({ 
              name: inputs[0].value, 
              value: inputs[1].value 
            });
          }
        });

        allClassesPreviewTable.innerHTML = '';
        attributes.forEach(attr => {
          const row = document.createElement('tr');
          row.className = 'border-b border-slate-200 hover:bg-slate-100';
          row.innerHTML = `
            <td class="px-4 py-2 text-slate-900">${attr.name}</td>
            <td class="px-4 py-2 text-slate-900">₹${parseFloat(attr.value).toLocaleString()}</td>
          `;
          allClassesPreviewTable.appendChild(row);
        });

        alert('Fee structure for all classes saved successfully!');
        feeAllClassesForm.reset();
        allClassesContainer.innerHTML = '';
      });
    }

    // Form submission - Specific Class
    if (feeSpecificClassForm) {
      feeSpecificClassForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const schoolId = document.getElementById('specificSchoolId').value;
        const className = document.getElementById('specificClassName').value;

        const attributes = [];
        specificClassContainer.querySelectorAll('div').forEach(div => {
          const inputs = div.querySelectorAll('input');
          if (inputs.length >= 2 && inputs[0].value && inputs[1].value) {
            attributes.push({ 
              name: inputs[0].value, 
              value: inputs[1].value 
            });
          }
        });

        specificClassPreviewTable.innerHTML = '';
        const row = document.createElement('tr');
        row.className = 'border-b border-slate-200 hover:bg-slate-100';
        row.innerHTML = `
          <td class="px-4 py-2 text-slate-900">${schoolId}</td>
          <td class="px-4 py-2 text-slate-900">${className}</td>
          <td class="px-4 py-2 text-slate-900">${attributes.length > 0 ? attributes.map(a => `${a.name}: ₹${parseFloat(a.value).toLocaleString()}`).join(', ') : 'None'}</td>
        `;
        specificClassPreviewTable.appendChild(row);

        alert('Fee structure for ' + className + ' saved successfully!');
        feeSpecificClassForm.reset();
        specificClassContainer.innerHTML = '';
      });
    }
  });
</script>
