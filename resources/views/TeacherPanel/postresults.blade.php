<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">

              <style> .hero-content { position: relative; z-index: 10; } </style>

              <div class="flex items-center gap-3 hero-content">

                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i>
                </button>

                <div>
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">
                    Post Exam Results
                  </h1>
                </div>
              </div>

              <div class="flex-1 text-center">
                <!-- homepage-only snapshot removed on other pages -->
              </div>

              <div class="flex items-center gap-3 hero-content">
                <a href="{{ route('teacher.dashboard') }}" 
                class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                    <i class="bi bi-house-door"></i>
                    Dashboard
                </a>
              </div>

            </div>
          </header>

        <!-- Post Exam Results section copied from exam.html -->
        <section class="bg-white p-6 rounded-lg shadow-sm mt-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Post Exam Results</h2>
            <p class="text-sm text-gray-500">Enter marks per student and save results for the selected exam.</p>
          </div>

          <form id="resultsForm" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <div>
                <label class="text-sm text-gray-600">Subject</label>
                <select id="resSubject" class="w-full border rounded px-3 py-2">
                  <option>Mathematics</option>
                  <option>Science</option>
                  <option>English</option>
                </select>
              </div>
              <div>
                <label class="text-sm text-gray-600">Grade / Class</label>
                <select id="resGrade" class="w-full border rounded px-3 py-2">
                  <option>Grade 9</option>
                  <option>Grade 10</option>
                  <option>Grade 11</option>
                </select>
              </div>
              <div>
                <label class="text-sm text-gray-600">Exam Date</label>
                <input id="resDate" type="date" class="w-full border rounded px-3 py-2" />
              </div>
            </div>

    <div class="overflow-x-auto rounded-t-lg shadow max-w-full"> 
      <table id="resTable" class="w-full table-auto divide-y divide-gray-200 text-sm mt-3 bg-white min-w-0">
                    <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 border-b">
                      <tr class="text-left text-indigo-700 text-xs uppercase tracking-wide">
                        <th class="p-3 sticky top-0 bg-indigo-50">#</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Student</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Admission</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Marks</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Grade</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Remarks</th>
                        <th class="p-3 sticky top-0 bg-indigo-50">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
      <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-2">1</td>
                        <td class="p-2">John Doe</td>
                        <td class="p-2">12345</td>
                        <td class="p-2"><input class="w-full max-w-full border px-2 py-1 rounded marks" value="85" type="number" min="0" max="100"></td>
                        <td class="p-2"><div class="grade text-sm font-medium"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">A</span></div></td>
                        <td class="p-2"><input class="w-full border px-2 py-1 rounded remarks" value="Good work"></td>
                        <td class="p-2">

                          <button type="button" 
                            class="edit-row text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded mr-2">
                                Edit
                          </button>
                        
                          <button type="button" 
                          class="remove-row text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded transition">
                                Remove
                          </button>

                        </td>
                  </tr>
      <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-2">2</td>
                        <td class="p-2">Jane Smith</td>
                        <td class="p-2">12346</td>
                        <td class="p-2"><input class="w-full max-w-full border px-2 py-1 rounded marks" value="72" type="number" min="0" max="100"></td>
                        <td class="p-2"><div class="grade text-sm font-medium"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">B</span></div></td>
                        <td class="p-2"><input class="w-full border px-2 py-1 rounded remarks" value="Needs improvement"></td>
                        <td class="p-2">
                          <button type="button" class="edit-row text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded mr-2">Edit</button>
                          <button type="button" class="remove-row text-red-600 bg-red-50 hover:bg-red-100 px-2 py-1 rounded transition">Remove</button>
                        </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Mobile-friendly cards (visible on small screens) -->
            <div id="mobileResList" class="md:hidden mt-3 space-y-2">
              <!-- cards populated by JS for small screens -->
            </div>

            <div class="flex items-center gap-3">
              <button id="addRow" type="button" class="px-3 py-2 bg-indigo-600 text-white rounded">Add Student Row</button>
              <button id="saveResults" type="submit" class="px-3 py-2 bg-green-600 text-white rounded">Save Results</button>
              <button id="clearResults" type="button" class="px-3 py-2 border rounded">Clear</button>
            </div>
          </form>

          <!-- Posted results (client-side demo) -->
          <div id="posted" class="mt-6">
            <h3 class="font-semibold mb-3">Posted Results (Demo)</h3>
            <div id="postedList" class="space-y-3 text-sm text-gray-700">
              <!-- appended results will appear here -->
            </div>
          </div>
          
        </section>

        <!-- Edit Row Modal -->
        <div id="editRowModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-40">
          <div class="bg-white w-full max-w-md rounded-lg p-6 shadow-xl transform transition-all">
            <div class="flex items-start justify-between gap-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-indigo-700 flex items-center justify-center text-white shadow">
                  <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                  <h2 class="text-lg font-semibold text-indigo-800">Edit Student Result</h2>
                  <p class="text-sm text-gray-500">Update marks and remarks for the selected student.</p>
                </div>
              </div>
              <button id="closeEditBtn" aria-label="Close edit" class="text-gray-400 hover:text-gray-700 p-2 rounded-md">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>

            <form id="editRowForm" class="space-y-4 mt-4">
              <div>
                <label class="text-sm text-gray-600">Student</label>
                <input id="editStudent" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              </div>
              <div>
                <label class="text-sm text-gray-600">Admission</label>
                <input id="editAdm" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              </div>
              <div>
                <label class="text-sm text-gray-600">Marks</label>
                <input id="editMarks" type="number" min="0" max="100" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              </div>
              <div>
                <label class="text-sm text-gray-600">Remarks</label>
                <input id="editRemarks" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
              </div>
              <div class="flex justify-end gap-3">
                <button type="button" id="cancelEditBtn" class="px-4 py-2 border rounded-md bg-white hover:bg-red-50 text-red-600 hover:text-red-700 transition-colors duration-150">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Save</button>
              </div>
            </form>
          </div>
        </div>
    </main>

    <script>
    
        // Page-specific exam/results script (kept intact)
        (function(){
            const resTable = document.getElementById('resTable');
            const addRow = document.getElementById('addRow');
            const resultsForm = document.getElementById('resultsForm');
            const subjectSelect = document.getElementById('resSubject');
            const gradeSelect = document.getElementById('resGrade');
    
            function calcGrade(mark){
              const m = Number(mark);
              if(isNaN(m) || m==='') return '';
              if(m>=85) return 'A';
              if(m>=70) return 'B';
              if(m>=55) return 'C';
              if(m>=40) return 'D';
              return 'F';
            }
    
            function updateGrades(){
              resTable.querySelectorAll('tbody tr').forEach(row=>{
                const markEl = row.querySelector('.marks');
                const gradeEl = row.querySelector('.grade');
                if(markEl && gradeEl){
                  const g = calcGrade(markEl.value);
                  const span = gradeEl.querySelector('span') || document.createElement('span');
                  span.textContent = g;
                  span.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ' +
                    (g==='A' ? 'bg-green-100 text-green-800' : g==='B' ? 'bg-yellow-100 text-yellow-800' : g==='C' ? 'bg-orange-100 text-orange-800' : g==='D' ? 'bg-indigo-100 text-indigo-800' : g==='F' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-600');
                  if(!gradeEl.contains(span)) gradeEl.innerHTML = ''; gradeEl.appendChild(span);
                }
              });
              renderMobileRows();
            }
    
            // attach listeners to existing static rows/controls
            resTable.querySelectorAll('.marks').forEach(inp=> inp.addEventListener('input', updateGrades));
    
            // disable remove action: keep button but do not remove rows
            resTable.querySelectorAll('.remove-row').forEach(btn=> btn.addEventListener('click', function(){
              // intentional no-op to prevent row removal
              console.log('Remove disabled in frontend demo');
            }));
    
            resTable.querySelectorAll('.edit-row').forEach(btn=> btn.addEventListener('click', function(){
              const tr = this.closest('tr'); if(tr) openEditModal(tr);
            }));
    
            const editRowModal = document.getElementById('editRowModal');
            const editRowForm = document.getElementById('editRowForm');
            const editStudent = document.getElementById('editStudent');
            const editAdm = document.getElementById('editAdm');
            const editMarks = document.getElementById('editMarks');
            const editRemarks = document.getElementById('editRemarks');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            let currentEditingRow = null;
    
            function openEditModal(row){
              currentEditingRow = row;
              const cols = row.querySelectorAll('td');
              const student = cols[1].querySelector('input') ? cols[1].querySelector('input').value : (cols[1].textContent||'').trim();
              const adm = cols[2].querySelector('input') ? cols[2].querySelector('input').value : (cols[2].textContent||'').trim();
              const marks = (cols[3].querySelector('input')||{value:''}).value;
              const remarks = (cols[5].querySelector('input')||{value:''}).value;
              editStudent.value = student;
              editAdm.value = adm;
              editMarks.value = marks;
              editRemarks.value = remarks;
              editRowModal.classList.remove('hidden');
              editRowModal.classList.add('flex');
            }
    
            function closeEditModal(){
              editRowModal.classList.add('hidden');
              editRowModal.classList.remove('flex');
              currentEditingRow = null;
            }
    
  // re-enable modal close handlers so Cancel and X work again
  if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);
  const closeEditBtn = document.getElementById('closeEditBtn');
  if (closeEditBtn) closeEditBtn.addEventListener('click', closeEditModal);
    
            editRowForm.addEventListener('submit', function(e){
              e.preventDefault();
              // In this frontend-only mode we DO NOT write changes back to the table.
              // Show a brief confirmation inside the modal instead.
              // intentionally do not show any frontend messages; backend will handle notifications later
              // still update the grade visuals in the table just in case (non-persistent)
              updateGrades();
              renderMobileRows();
            });
    
            // Minimal frontend-only save: prevent form from doing any backend action.
            if (resultsForm) {
              resultsForm.addEventListener('submit', function (e) {
                e.preventDefault();
                // intentionally silent — no frontend message shown
              });
            }

            // Safe stub: if mobile rendering was removed earlier, avoid runtime errors.
            function renderMobileRows(){
              const container = document.getElementById('mobileResList');
              if(!container || !resTable) return;
              // keep empty — mobile cards are optional and populated elsewhere when needed
              container.innerHTML = '';
            }
        })();
        
    </script>
</x-Teacher-sidebar>