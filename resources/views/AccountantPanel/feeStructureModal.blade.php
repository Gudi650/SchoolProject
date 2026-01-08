<!-- Fee Structure Modal -->
<div id="feeStructureModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 items-center justify-center p-4" style="display: none;">
  <div class="bg-white w-full max-w-2xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
    <!-- Header -->
    <div class="flex items-center justify-between gap-4 mb-6">
      <div>
        <h2 class="text-2xl font-bold text-slate-900">Fee Structure Form</h2>
        <p class="text-sm text-slate-600 mt-1">Create and manage fee structure for different classes</p>
      </div>
      <button id="closeEditStructureModal" type="button" class="text-slate-400 hover:text-slate-600 p-2 rounded-md transition-colors">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>

    <!-- Form -->
    <form id="feeStructureForm" class="space-y-4">
      <!-- School ID -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">School ID</label>
        <input type="number" id="schoolId" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Class Name -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Class</label>
        <input type="text" id="className" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g., Class 10" required>
      </div>

      <!-- Tuition Fee -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tuition Fee</label>
        <input type="number" step="0.01" id="tuitionFee" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
      </div>

      <!-- Dynamic Attributes -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Additional Fee Components</label>
        <div id="attributesContainer" class="space-y-2"></div>
        <button type="button" id="addAttribute" class="mt-3 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition-colors flex items-center gap-2">
          <i data-lucide="plus" class="w-4 h-4"></i>
          Add Fee Component
        </button>
      </div>

      <!-- Preview Table -->
      <div class="mt-6 pt-6 border-t border-slate-200">
        <h3 class="text-lg font-semibold text-slate-900 mb-3">Preview</h3>
        <div class="bg-slate-50 rounded-lg overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-200">
                <th class="px-4 py-2 text-left font-medium text-slate-700">School ID</th>
                <th class="px-4 py-2 text-left font-medium text-slate-700">Class</th>
                <th class="px-4 py-2 text-left font-medium text-slate-700">Tuition</th>
                <th class="px-4 py-2 text-left font-medium text-slate-700">Components</th>
              </tr>
            </thead>
            <tbody id="previewTable"></tbody>
          </table>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex gap-3 pt-6 border-t border-slate-200">
        <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Save Structure</button>
        <button type="button" id="cancelEditStructureModal" class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('feeStructureModal');
    const openBtn = document.getElementById('openEditStructureModal');
    const closeBtn = document.getElementById('closeEditStructureModal');
    const cancelBtn = document.getElementById('cancelEditStructureModal');
    const feeForm = document.getElementById('feeStructureForm');
    const attributesContainer = document.getElementById('attributesContainer');
    const addAttributeBtn = document.getElementById('addAttribute');
    const previewTable = document.getElementById('previewTable');

    console.log('✅ Script loaded, elements:', { modal, openBtn });

    if (!openBtn || !modal) {
      console.error('❌ Elements not found');
      return;
    }

    // Show modal
    function showModal() {
      console.log('Opening modal');
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }

    // Hide modal
    function hideModal() {
      console.log('Closing modal');
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }

    // Wire button click
    openBtn.addEventListener('click', function(e) {
      e.preventDefault();
      console.log('Button clicked!');
      showModal();
    });

    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);

    // Close on background click
    modal.addEventListener('click', (e) => {
      if (e.target === modal) hideModal();
    });

    // Add attribute button
    if (addAttributeBtn) {
      addAttributeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
          <input type="text" placeholder="Component Name (e.g., Transport, Hostel)" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg" required>
          <input type="number" step="0.01" placeholder="Amount" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg" required>
          <button type="button" class="px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 removeAttr">Remove</button>
        `;
        attributesContainer.appendChild(div);

        div.querySelector('.removeAttr').addEventListener('click', (e) => {
          e.preventDefault();
          div.remove();
        });
      });
    }

    // Form submission
    if (feeForm) {
      feeForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const schoolId = document.getElementById('schoolId').value;
        const className = document.getElementById('className').value;
        const tuitionFee = document.getElementById('tuitionFee').value;

        const attributes = [];
        attributesContainer.querySelectorAll('div').forEach(div => {
          const inputs = div.querySelectorAll('input');
          if (inputs.length >= 2 && inputs[0].value && inputs[1].value) {
            attributes.push({ 
              name: inputs[0].value, 
              value: inputs[1].value 
            });
          }
        });

        const row = document.createElement('tr');
        row.className = 'border-b border-slate-200 hover:bg-slate-50';
        row.innerHTML = `
          <td class="px-4 py-2 text-slate-900">${schoolId}</td>
          <td class="px-4 py-2 text-slate-900">${className}</td>
          <td class="px-4 py-2 text-slate-900">₹${parseFloat(tuitionFee).toLocaleString()}</td>
          <td class="px-4 py-2 text-slate-900">${attributes.length > 0 ? attributes.map(a => `${a.name}: ₹${parseFloat(a.value).toLocaleString()}`).join(', ') : 'None'}</td>
        `;
        previewTable.appendChild(row);

        feeForm.reset();
        attributesContainer.innerHTML = '';
      });
    }
  });
</script>
