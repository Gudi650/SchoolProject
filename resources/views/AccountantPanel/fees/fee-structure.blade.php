<x-Account-sidebar>
  <x-slot name="title">Fee Structure</x-slot>
  
    <!-- Page Header -->
    <div class="mb-6">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between items-start gap-4">
        <div class="sm:flex-1">
          <h1 class="text-2xl font-bold text-slate-900">Fee Structure</h1>
          <p class="text-sm text-slate-600 mt-1">Manage and configure annual fee structure for all classes</p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
          <button class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2 justify-center">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Export</span>
          </button>

          <div class="w-full sm:w-auto">
            <button id="openEditStructureModal" class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center">
              <i data-lucide="edit-3" class="w-4 h-4"></i>
              <span>Edit Structure</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Total Classes</p>
            <p class="text-2xl font-bold text-slate-900">3</p>
          </div>
          <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
            <i data-lucide="book-open" class="w-6 h-6 text-indigo-600"></i>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Fee Components</p>
            <p class="text-2xl font-bold text-slate-900">6</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-lucide="layers" class="w-6 h-6 text-blue-600"></i>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Highest Fee</p>
            <p class="text-2xl font-bold text-slate-900">₹43,500</p>
          </div>
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <i data-lucide="trending-up" class="w-6 h-6 text-green-600"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Fee Structure -->
    <div class="bg-white rounded-xl border border-slate-200">
      <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-slate-900">Annual Fee Structure</h2>
        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-full">6 Components</span>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
              <th class="px-6 py-3 font-semibold text-slate-700">Class</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Tuition</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Transport</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Hostel</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Library</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Exam</th>
              <th class="px-6 py-3 font-semibold text-slate-700 text-right">Total</th>
              <th class="px-6 py-3 font-semibold text-slate-700 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr class="hover:bg-slate-50 transition-colors" data-class="Class 10" data-tuition="15000" data-transport="5000" data-hostel="20000" data-library="1500" data-exam="2000" data-total="43500">
              <td class="px-6 py-4 font-medium text-slate-900">Class 10</td>
              <td class="px-6 py-4 text-slate-700">₹15,000</td>
              <td class="px-6 py-4 text-slate-700">₹5,000</td>
              <td class="px-6 py-4 text-slate-700">₹20,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,500</td>
              <td class="px-6 py-4 text-slate-700">₹2,000</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹43,500</td>
              <td class="px-6 py-4 text-center">
                <button class="edit-fee-btn text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50 transition-colors">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-slate-50 transition-colors" data-class="Class 9" data-tuition="14000" data-transport="5000" data-hostel="20000" data-library="1500" data-exam="2000" data-total="42500">
              <td class="px-6 py-4 font-medium text-slate-900">Class 9</td>
              <td class="px-6 py-4 text-slate-700">₹14,000</td>
              <td class="px-6 py-4 text-slate-700">₹5,000</td>
              <td class="px-6 py-4 text-slate-700">₹20,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,500</td>
              <td class="px-6 py-4 text-slate-700">₹2,000</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹42,500</td>
              <td class="px-6 py-4 text-center">
                <button class="edit-fee-btn text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50 transition-colors">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-slate-50 transition-colors" data-class="Class 8" data-tuition="13000" data-transport="4500" data-hostel="18000" data-library="1200" data-exam="1800" data-total="38500">
              <td class="px-6 py-4 font-medium text-slate-900">Class 8</td>
              <td class="px-6 py-4 text-slate-700">₹13,000</td>
              <td class="px-6 py-4 text-slate-700">₹4,500</td>
              <td class="px-6 py-4 text-slate-700">₹18,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,200</td>
              <td class="px-6 py-4 text-slate-700">₹1,800</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹38,500</td>
              <td class="px-6 py-4 text-center">
                <button class="edit-fee-btn text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50 transition-colors">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</x-Account-sidebar>

<!-- Edit Class Fee Modal -->
<div id="editClassFeeModal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 p-4 overflow-y-auto hidden">
  <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden flex flex-col my-auto" style="max-height: 90vh;">
    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
          <i data-lucide="edit-3" class="w-5 h-5"></i>
        </div>
        <div>
          <h2 class="text-lg font-bold">Edit Fee Structure</h2>
          <p class="text-sm text-white/80" id="editModalClassName">Class Name</p>
        </div>
      </div>
      <button id="closeEditClassModal" type="button" class="text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-6 flex-1 overflow-y-auto">
      <form id="editClassFeeForm" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="editTuition" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
              <i data-lucide="graduation-cap" class="w-4 h-4 text-indigo-600"></i>
              Tuition Fee
            </label>
            <input type="number" id="editTuition" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0">
          </div>

          <div>
            <label for="editTransport" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
              <i data-lucide="bus" class="w-4 h-4 text-sky-600"></i>
              Transport Fee
            </label>
            <input type="number" id="editTransport" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0">
          </div>

          <div>
            <label for="editHostel" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
              <i data-lucide="home" class="w-4 h-4 text-amber-600"></i>
              Hostel Fee
            </label>
            <input type="number" id="editHostel" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0">
          </div>

          <div>
            <label for="editLibrary" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
              <i data-lucide="library" class="w-4 h-4 text-emerald-600"></i>
              Library Fee
            </label>
            <input type="number" id="editLibrary" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0">
          </div>

          <div>
            <label for="editExam" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
              <i data-lucide="file-check" class="w-4 h-4 text-rose-600"></i>
              Exam Fee
            </label>
            <input type="number" id="editExam" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0">
          </div>

          <div class="flex items-end">
            <div class="w-full">
              <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="calculator" class="w-4 h-4 text-slate-600"></i>
                Total Fee
              </label>
              <div class="w-full bg-slate-100 border border-slate-300 rounded-lg px-4 py-2.5 text-lg font-bold text-slate-900" id="editTotalDisplay">₹0</div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-3 bg-slate-50">
      <button id="cancelEditClassModal" type="button" class="px-5 py-2.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 font-medium transition-colors flex items-center gap-2">
        <i data-lucide="x" class="w-4 h-4"></i>
        Cancel
      </button>
      <button id="saveEditClassFee" type="button" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
        <i data-lucide="check" class="w-4 h-4"></i>
        Save Changes
      </button>
    </div>
  </div>
</div>

<script>
  // Wait for the page to fully load before running JavaScript
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons (convert icon tags to SVG)
    if (window.lucide) lucide.createIcons();

    // ===== GET DOM ELEMENTS =====
    // Modal element that shows the edit form
    const editClassModal = document.getElementById('editClassFeeModal');
    
    // All buttons that can close the modal (X button and Cancel button)
    const closeModalButtons = document.querySelectorAll('#closeEditClassModal, #cancelEditClassModal');
    
    // All edit buttons in the table (one for each class row)
    const editButtons = document.querySelectorAll('.edit-fee-btn');
    
    // Save button to submit changes
    const saveButton = document.getElementById('saveEditClassFee');
    
    // Keep track of which table row is being edited
    let currentRow = null;

    // ===== OPEN EDIT MODAL =====
    // Add click event to each edit button in the table
    editButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        // Find the table row that contains this button
        currentRow = this.closest('tr');
        
        // Get all fee data from the row's data attributes
        const className = currentRow.dataset.class;
        const tuition = currentRow.dataset.tuition;
        const transport = currentRow.dataset.transport;
        const hostel = currentRow.dataset.hostel;
        const library = currentRow.dataset.library;
        const exam = currentRow.dataset.exam;

        // Fill the modal form with the current fee values
        document.getElementById('editModalClassName').textContent = className;
        document.getElementById('editTuition').value = tuition;
        document.getElementById('editTransport').value = transport;
        document.getElementById('editHostel').value = hostel;
        document.getElementById('editLibrary').value = library;
        document.getElementById('editExam').value = exam;

        // Calculate and display the total fee
        calculateTotal();
        
        // Show the modal by removing the 'hidden' class
        editClassModal.classList.remove('hidden');
        
        // Re-initialize icons for newly visible modal
        if (window.lucide) lucide.createIcons();
      });
    });

    // ===== CLOSE MODAL =====
    // Add click event to all close buttons (X and Cancel)
    closeModalButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        // Hide the modal
        editClassModal.classList.add('hidden');
        // Reset the current row tracker
        currentRow = null;
      });
    });

    // Close modal when clicking outside of it (on the dark overlay)
    editClassModal.addEventListener('click', function(e) {
      if (e.target === editClassModal) {
        editClassModal.classList.add('hidden');
        currentRow = null;
      }
    });

    // ===== CALCULATE TOTAL FEE =====
    function calculateTotal() {
      // Get values from all fee input fields
      // parseInt() converts text to number, || 0 makes empty fields count as 0
      const tuition = parseInt(document.getElementById('editTuition').value) || 0;
      const transport = parseInt(document.getElementById('editTransport').value) || 0;
      const hostel = parseInt(document.getElementById('editHostel').value) || 0;
      const library = parseInt(document.getElementById('editLibrary').value) || 0;
      const exam = parseInt(document.getElementById('editExam').value) || 0;
      
      // Add all fees together
      const total = tuition + transport + hostel + library + exam;
      
      // Display the total with Indian currency format (₹43,500)
      document.getElementById('editTotalDisplay').textContent = '₹' + total.toLocaleString('en-IN');
    }

    // ===== AUTO-CALCULATE ON INPUT CHANGE =====
    // List of all fee input field IDs
    const feeInputIds = ['editTuition', 'editTransport', 'editHostel', 'editLibrary', 'editExam'];
    
    // Add 'input' event listener to each field to recalculate total when user types
    feeInputIds.forEach(id => {
      document.getElementById(id).addEventListener('input', calculateTotal);
    });

    // ===== SAVE CHANGES =====
    saveButton.addEventListener('click', function() {
      // Safety check: make sure we have a row selected
      if (!currentRow) return;

      // TODO: This will be connected to Laravel backend to save to database
      // For now, we just log the data to console for debugging
      console.log('Form data ready for Laravel:', {
        class: currentRow.dataset.class,
        tuition: document.getElementById('editTuition').value,
        transport: document.getElementById('editTransport').value,
        hostel: document.getElementById('editHostel').value,
        library: document.getElementById('editLibrary').value,
        exam: document.getElementById('editExam').value
      });

      // Close the modal after saving
      editClassModal.classList.add('hidden');
      currentRow = null;
    });
  });
</script>

@include('AccountantPanel.fees.feeStructureModal')
