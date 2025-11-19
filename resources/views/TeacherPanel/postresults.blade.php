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

            <h2 class="text-lg font-semibold">
              Post Exam Results
            </h2>

            <p class="text-sm text-gray-500">
              Enter marks per student and save results for the selected exam.
            </p>

          </div>

          <form 
            action = "{{ route('teacher.postresultscontroller.submit') }}"
            method="POST"
            id="resultsForm" 
          class="space-y-4">

            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
              <div>

                <label class="text-sm text-gray-600">
                  Subject
                </label>
                
                <!--get the subjects assigned to the logged in teacher-->
                <!--check if the assigned teacher is available-->

                @if (isset($allassigned) && $allassigned->isNotEmpty())

                  <!--loop through the assigned subjects and create options-->
                  <select 
                  name="subject_id"
                  id="resSubject" 
                  class="w-full border rounded px-3 py-2">

                    @foreach ($allassigned as $assigned)

                      <option 
                      value="{{ $assigned->availablesubject->id }}">

                        {{ $assigned->availablesubject->subject_name }}

                      </option>
                      
                    @endforeach

                  </select>
                  
                @endif
              </div>

              <div>
                <label class="text-sm text-gray-600">
                  Grade / Class
                </label>

                <!--get the subjects assigned to the logged in teacher-->
                <!--check if the assigned teacher is available-->

                @if (isset($allassigned) && $allassigned)

                  <!--loop through the assigned subjects and create options-->
                  <select 
                  name = "class_id"
                  id="resGrade" 
                  class="w-full border rounded px-3 py-2">
                    @foreach ($allassigned as $assigned)

                      <option 
                      value="{{ $assigned->classAvailable->id }}">

                        {{ $assigned->classAvailable->name }}

                      </option>
                      
                    @endforeach

                  </select>
                  
                @endif

              </div>
              <div>

                <label class="text-sm text-gray-600">
                  Exam Name
                </label>

                <input id="resName" 
                name="TermName"
                type="text" 
                class="w-full border rounded px-3 py-2" 
                value = "{{ old('TermName') }}"
                placeholder="e.g. Midterm Term 1" />
                
              </div>
              <div>

                <label class="text-sm text-gray-600">
                  Exam Date
                </label>

                <input id="resName" 
                name="exam_date"
                type="date" 
                class="w-full border rounded px-3 py-2" 
                placeholder="e.g. Midterm Term 1" />
                
              </div>
              <div class="flex items-end">

                <label class="sr-only">
                  Submit
                </label>

                <button id="topSubmit" 
                type="submit" 
                class="w-full px-3 h-10 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                  Search
                </button>

              </div>
            </div>
            
          </form>


          <!-- Results Table (kept inside the same Post Exam Results section) -->

          <!--display only if the student is valid(after the search) -->

          @if ( isset($students) && $students->isNotEmpty() &&$studentresults->isEmpty() )
            

          <div class="bg-white mt-6">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold">
                Results Table
              </h2>

              <p class="text-sm text-gray-500">
                View and update student marks (frontend demo).
              </p>

            </div>

            <!--open form tag to collect the datas -->
            <form 
            action="{{ route('teacher.postresults.submit') }}"
            method ="POST"
            >

            @csrf

            <div class="overflow-x-auto rounded-t-lg shadow max-w-full"> 
              <table id="resTable" class="w-full table-auto divide-y divide-gray-200 text-sm mt-3 bg-white min-w-0">
                <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 border-b">
                  <tr class="text-left text-indigo-700 text-xs uppercase tracking-wide">

                    <th class="p-3 sticky top-0 bg-indigo-50">
                      #
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Student
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Admission
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Marks
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Grade
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Remarks
                    </th>
                    <th class="p-3 sticky top-0 bg-indigo-50">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">

                  <!--loop through the students-->
                  @foreach ($students as $student )
                    
                    <tr class="hover:bg-gray-50 transition-colors">

                    <td class="p-2">
                      {{ $tableid = $tableid + 1 }}
                    </td>

                    <td class="p-2">
                      {{ $student->fname }} {{ $student->lname }}
                    </td>

                    <td class="p-2">
                      12345
                    </td>

                    <!--pass the student id as hidden input-->

                    <input type="hidden" 
                    name="student_id[]"
                    value="{{ $student->id }}" />

                    <!--pass the subject id from sesssion as hidden input-->
                    <input type="hidden"
                    name = "subject_id[]"
                    value = "{{ session()->get('subject_id') }}" />

                    <!--pass the class id from session as hidden input-->
                    <input type="hidden"
                    name = "class_id[]"
                    value="{{ session()->get('class_id') }}">

                    <!--pass the TermName from session as hidden input-->

                    <input type="hidden"
                    name = "TermName"
                    value="{{ session()->get('TermName') }}">

                    <!--pass the teacherId to from user id as hidden input -->
                    <input type = "hidden"
                    name = "teacher_id"
                    value = "{{ session('activeTeacher')->id }}">

                    <!--pas the exam-date to form from session as hidden input-->
                    <input type="hidden"
                    name ="exam_date"
                    value="{{ session()->get('exam_date') }}" >

                    <td class="p-2">

                      <!--marks input-->

                      <input class="w-full max-w-full border px-2 py-1 rounded marks" 
                      value="" 
                      name="score[]"
                      type="number" 
                      min="0" max="100">


                    </td>

                    <td class="p-2">

                      <div class="grade text-sm font-medium">

                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                          A
                        </span>

                      </div>

                    </td>

                    <td class="p-2">

                      <!--remarks-->

                      <input 
                      class="w-full border px-2 py-1 rounded remarks"
                      name="remarks[]" 
                      value="Good work">

                    </td>

                    <td class="p-2">

                      <!-- Edit button-->
                      <button type="button" 
                      class="edit-row text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded mr-2">
                        Edit
                      </button>

                    </td>
                  </tr>

                  @endforeach

                  
                </tbody>
              </table>
            </div>

            <!-- Mobile-friendly cards (visible on small screens) -->
            <div id="mobileResList" class="md:hidden mt-3 space-y-2">
              <!-- cards populated by JS for small screens -->
            </div>
           
            <!-- Action buttons placed below the results table -->
            <div class="flex items-center gap-3 mt-4">

               <button id="saveResults" 
               type="submit" 
               class="px-3 py-2 bg-green-600 text-white rounded">
                Save Results
              </button>
               
            </div>
          </div><!--end of post results table -->

          </form><!--end of form tag-->

          @endif

        </section>

        <!--check if the studentresults is available-->
        @if (isset($studentresults) && $studentresults->isNotEmpty())

        <!-- Posted results (client-side demo) -->
        <div id="posted" class="mt-6">
          <div class="bg-white border rounded-lg shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="px-5 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
              <div class="flex items-start gap-3">
                <div class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow">
                  <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <div>

                  <h3 class="text-lg font-semibold text-indigo-800">
                    Posted Results (Demo)
                  </h3>

                  <p class="text-sm text-indigo-600">
                    Snapshot of submitted marks for the selected exam.
                  </p>

                </div>
              </div> 
              <!--End Header -->

              <div class="flex items-center gap-3">

                <button class="flex items-center gap-2 px-3 py-2 bg-white border rounded text-sm text-indigo-700 hover:bg-indigo-50">
                  <i class="bi bi-printer"></i>
                  Print
                </button>

                <button class="flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">
                  <i class="bi bi-download"></i>
                  Export CSV
                </button>

              </div>

            </div>

            <!-- Summary / chips -->
            

            <div class="px-5 pb-4 border-t md:flex md:items-center md:justify-between md:gap-6">

              <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 bg-white/60 px-3 py-2 rounded shadow-sm">

                  <span class="text-xs text-gray-500">
                    Subject
                  </span>

                  <span id="postedSubject" class="text-sm font-medium text-indigo-800">

                    {{ session('activeTeacher')->assignedSubjects->where('availablesubject_id', session('subject_id'))->first()->availablesubject->subject_name ?? 'N/A' }}
                    
                  </span>

                </div>
                <div class="flex items-center gap-2 bg-white/60 px-3 py-2 rounded shadow-sm">
                  <span class="text-xs text-gray-500">
                    Grade / Class
                  </span>

                  <span id="postedGrade" class="text-sm font-medium text-indigo-800">

                    {{ session('activeTeacher')->assignedSubjects->where('availablesubject_id', session('subject_id'))->first()->classAvailable->name ?? 'N/A' }}

                  </span>

                </div>
                <div class="flex items-center gap-2 bg-white/60 px-3 py-2 rounded shadow-sm">
                  <span class="text-xs text-gray-500">
                    Exam
                  </span>

                  <span id="postedExam" class="text-sm font-medium text-indigo-800">
                    {{ session('TermName') }}
                  </span>

                </div>
              </div>

              <div class="mt-3 md:mt-0 flex items-center gap-4">
                <div class="text-sm">

                  <div class="text-xs text-gray-500">
                    Average
                  </div>

                  <!--check if averagescore is available-->
                  @if (isset($averagescore) && $averagescore !== null )
                    
                    <div class="text-indigo-800 font-semibold">
                      {{ $averagescore }}%
                    </div>

                  @endif

                </div>

                <div class="text-sm">
                  <div class="text-xs text-gray-500">
                    Top
                  </div>

                  <!--check if highest score is available-->
                  @if (isset($highestScore) && $highestScore !== null )
                    
                    <div class="text-green-700 font-semibold">
                      {{ $highestScore }}
                    </div>

                  @else

                    <div class="text-gray-500">N/A</div>

                  @endif

                  

                </div>
                <div class="text-sm">

                  <div class="text-xs text-gray-500">
                    Lowest
                  </div>

                  <!--check if lowest score is available-->
                  @if (isset($lowestScore) && $lowestScore !== null)
                    <div class="text-indigo-800 font-semibold">
                      {{ $lowestScore }}
                    </div>
                  @else
                    <div class="text-gray-500">N/A</div>
                  @endif

                </div>
              </div>
            </div>

            <!-- Table area -->
            <div class="p-4">

              <div class="overflow-x-auto rounded-md shadow-sm bg-white">

                <table class="w-full table-auto divide-y divide-gray-200 text-sm">

                  <thead class="bg-indigo-50">

                    <tr class="text-left text-indigo-700 text-xs uppercase tracking-wide">

                      <th class="p-3">#</th>
                      <th class="p-3">Student</th>
                      <th class="p-3">Marks</th>
                      <th class="p-3">Grade</th>
                      <th class="p-3">Remarks</th>
                      <th class="p-3">Action</th>

                    </tr>
                  </thead>

                  <tbody class="bg-white divide-y divide-gray-100">

                    <!-- hardcoded demo rows -->

                    <!--loop through the studentresults-->
                    @foreach ($studentresults as $result )
                      <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-3">
                          {{ $tabledid = $tabledid + 1}}
                        </td>

                        <td class="p-3">
                          {{ $result->students->fname }} 
                          {{ $result->students->lname }}
                        </td>

                        <td class="p-3 font-medium text-indigo-800">
                          {{ $result->score }}
                        </td>

                        <td class="p-3">
                          <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            A
                          </span>
                        </td>

                        <td class="p-3 text-gray-600">
                          Good work
                        </td>

                        <!--action button-->
                        <td class="p-3">
                          <!-- Edit button-->
                          <button type="button" 
                          class="edit-row text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded mr-2">
                            Edit
                          </button>
                        </td>

                      </tr>
                    @endforeach
                      
                    @else
                      <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                          No results posted yet.
                        </td>
                      </tr>
                    @endif

                  </tbody>
                </table>
              </div>

              <!-- Mobile stacked cards -->
              <div class="md:hidden mt-4 space-y-3">
                <div class="p-3 bg-white rounded-lg shadow-sm border">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="text-sm font-medium text-indigo-800">John Doe</div>
                      <div class="text-xs text-gray-500">Adm: 12345</div>
                    </div>
                    <div class="text-right">
                      <div class="text-sm font-semibold text-indigo-800">85</div>
                      <div class="text-xs"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">A</span></div>
                    </div>
                  </div>
                  <div class="mt-2 text-xs text-gray-600">Good work</div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
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
            
            // If no results table on the page, exit early
            if (!resTable) return;
    
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
    
            resTable.querySelectorAll('.edit-row').forEach(btn=> btn.addEventListener('click', function(e){
              e.preventDefault(); // prevent accidental form submit
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