<!-- Loan Application Modal -->
<div id="applyLoanModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-2 sm:mx-4 md:mx-0 p-2 sm:p-6 relative animate-fade-in overflow-y-auto max-h-[95vh]">

    <!-- Close Button -->
    <button type="button" class="absolute top-4 right-4 text-slate-400 hover:text-red-500" onclick="document.getElementById('applyLoanModal').classList.add('hidden')">
      <i data-lucide="x" class="w-6 h-6"></i>
    </button>

    <h2 class="text-2xl font-bold text-slate-900 mb-2 flex items-center gap-2">
      <i data-lucide="file-text" class="w-6 h-6 text-indigo-600"></i>
      Apply for a Loan
    </h2>

    <p class="text-sm text-slate-600 mb-4">
        Fill in the details below to submit your loan application. All fields marked with 
        <span class="text-red-500">*</span> are required.
    </p>

    <form id="loanApplicationForm" action="{{ route('teacher.loans.apply.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <!-- Loan Type -->
      <div>
        <!--look if there are loan types-->

        <label class="block text-sm font-medium text-slate-700 mb-1">Loan Type <span class="text-red-500">*</span></label>

        <select name="loan_type_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Select Loan Type</option>
        @if ($loanTypes->isNotEmpty())

            <!--if not empty then display the loan types-->
            @foreach ($loanTypes as $loanType)
                <option value="{{ $loanType->id }}">{{ $loanType->name }}</option>
            @endforeach

        @else

            <!--if empty then display a message-->
            <option value="">No active loan types available</option>
            
        @endif
        </select>

        <!--

        <select name="loan_type_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <option value="">Select Loan Type</option>
          <option value="1">Personal Loan</option>
          <option value="2">Education Loan</option>
          <option value="3">Emergency Loan</option>
        </select>

        -->
      </div>
      <!-- Amount Requested -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Amount Requested <span class="text-red-500">*</span></label>
        <input type="number" name="amount" min="0" step="0.01" required placeholder="Enter amount" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>
      <!-- Duration -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Duration (months) <span class="text-red-500">*</span></label>
        <input type="number" name="duration" min="1" max="60" required placeholder="e.g. 12" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>
      <!-- Purpose/Reason -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Purpose / Reason <span class="text-red-500">*</span></label>
        <textarea name="purpose" rows="2" required placeholder="Describe the purpose of the loan..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
      </div>
      <!-- Attachments -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Supporting Document (optional)</label>
        
        <!-- File Input -->
        <input 
          type="file" 
          name="attachment" 
          id="attachmentInput"
          accept=".pdf,.jpg,.jpeg,.png" 
          class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
        />
        
        <!-- File Display Container (Hidden by default) -->
        <div 
          id="attachmentDisplay" 
          class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between hidden"
        >
          <!-- File Name Display -->
          <div class="flex items-center gap-2">
            <i data-lucide="file" class="w-5 h-5 text-indigo-600"></i>
            <span id="fileName" class="text-sm text-slate-700 font-medium">filename.pdf</span>
          </div>
          
          <!-- Remove Button -->
          <button 
            type="button" 
            id="removeAttachmentBtn"
            class="p-1 text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg transition-colors"
            title="Remove file"
          >
            <i data-lucide="trash-2" class="w-5 h-5"></i>
          </button>
        </div>
      </div>
      <!-- Preview Panel -->
      <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mt-2">
        <h4 class="text-base font-semibold text-slate-900 mb-2 flex items-center gap-2"><i data-lucide="eye" class="w-4 h-4 text-indigo-600"></i>Preview</h4>
        <div class="text-sm text-slate-700" id="loanPreview">
          <span class="text-slate-500">Fill in the form to see a summary and calculation preview here.</span>
        </div>
      </div>
      <!-- Actions -->
      <div class="flex justify-end gap-2 pt-2">

        <button type="button" class="px-4 py-2 bg-red-200 text-slate-700 rounded-lg hover:bg-red-300" onclick="document.getElementById('applyLoanModal').classList.add('hidden')">
            Cancel
        </button>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center gap-2">
          <i data-lucide="send" class="w-4 h-4"></i>
          Submit Application
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Animation & Preview Script -->
<script>
  // Animate modal in
  document.addEventListener('DOMContentLoaded', function() {
    if (window.lucide) lucide.createIcons();
  });

  // ========== FILE ATTACHMENT HANDLING ==========
  
  // Get the file input element
  const attachmentInput = document.getElementById('attachmentInput');
  
  // Get the file display container and elements
  const attachmentDisplay = document.getElementById('attachmentDisplay');
  const fileNameDisplay = document.getElementById('fileName');
  const removeBtn = document.getElementById('removeAttachmentBtn');

  // Listen for file selection changes
  attachmentInput.addEventListener('change', function() {
    // Check if a file was selected
    if (this.files && this.files.length > 0) {
      // Get the selected file object
      const selectedFile = this.files[0];
      
      // Display the file name in the display container
      fileNameDisplay.textContent = selectedFile.name;
      
      // Show the file display container
      attachmentDisplay.classList.remove('hidden');
    } else {
      // Hide the file display container if no file selected
      attachmentDisplay.classList.add('hidden');
    }
  });

  // Listen for remove button click
  removeBtn.addEventListener('click', function(e) {
    // Prevent form submission
    e.preventDefault();
    
    // Clear the file input value (remove the selected file)
    attachmentInput.value = '';
    
    // Hide the file display container
    attachmentDisplay.classList.add('hidden');
  });

  // ========== LOAN PREVIEW ==========

  // Live preview (basic example, expand as needed)
  document.getElementById('loanApplicationForm')?.addEventListener('input', function() {
    const type = this.loan_type_id?.selectedOptions[0]?.text || '-';
    const amount = this.amount?.value || '-';
    const duration = this.duration?.value || '-';
    const purpose = this.purpose?.value || '-';
    document.getElementById('loanPreview').innerHTML =
      `<div><strong>Type:</strong> ${type}</div>` +
      `<div><strong>Amount:</strong> ${amount}</div>` +
      `<div><strong>Duration:</strong> ${duration} months</div>` +
      `<div><strong>Purpose:</strong> ${purpose}</div>`;
  });
</script>

<style>
  /* Modal fade-in animation */
  .animate-fade-in { animation: fadeIn 0.2s ease; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
</style>
