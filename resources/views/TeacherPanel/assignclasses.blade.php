<x-Teacher-sidebar>

    <style>
      /* Small helper styles for avatar chips and subtle table accents */
      .tc-avatar{ width:28px; height:28px; border-radius:9999px; display:inline-flex; align-items:center; justify-content:center; font-weight:600; background:#eef2ff; color:#3730a3; border:1px solid #e6e9f8; font-size:12px; }
      .tc-chip{ display:inline-flex; align-items:center; gap:.5rem; padding:.25rem .5rem; background:#f8fafc; border:1px solid #eef2ff; border-radius:9999px; font-size:13px; color:#0f172a; }
      .table-card{ background:linear-gradient(180deg, #ffffff 0%, #fbfdff 100%); border:1px solid #eef2ff; border-radius:.75rem; box-shadow:0 6px 18px rgba(15,23,42,0.06); }
      @media (min-width:768px){
        /* tighten up spacing on larger screens */
        .table-card table td, .table-card table th{ padding:1rem 1.25rem; }
      }
    </style>


    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">

              <style> 
                .hero-content { position: relative; z-index: 10; } 
              </style>

              <div class="flex items-center gap-3 hero-content">

                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded shadow"> 
                  <i class="bi bi-list"></i> 
                </button>

                <div>

                  <h1 class="text-lg md:text-2xl font-bold text-indigo-800">
                    Assign Class Teachers
                  </h1>

                  <p class="hidden sm:block text-sm text-gray-500 mt-1">
                    Easily assign or update class teachers. All changes are instant and editable.
                  </p>

                </div>
              </div>
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <!-- right-side greeting and avatar -->
              <div class="flex items-center gap-3">

                <div class=" text-sm text-gray-500 text-right">
                  Good morning, Teacher
                </div>

                <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 shadow-sm">
                  <i class="bi bi-person-fill"></i>
                </div>
              </div>
            </div>
          </header>

        <!-- Assign Class to Teacher Form -->
        <section class="mb-6 max-w-full mx-auto">

          <form id="assignClassForm" 
          action = "{{ route('teacher.assignclasses.submit') }}"
          method = "POST"
          class="flex flex-col md:flex-row md:items-end gap-4 bg-white p-4 rounded shadow">

          @csrf

            <div class="flex-1">

              <label for="assignClassSelect" 
                class="block text-sm font-medium text-gray-700 mb-1">
                Class
              </label>

              <select id="assignClassSelect" 
              name = "class-available_id"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

                <option value="">Select Class</option>
                <!--displaying the classes available in this school-->

                @foreach ($classes as $class )
                  
                  <option value="{{ $class->id }}">
                    {{ $class->name }}
                  </option>

                @endforeach
                
              </select>
            </div>

            <div class="flex-1">

              <label for="assignTeacherSelect" 
                class="block text-sm font-medium text-gray-700 mb-1">
                Teacher
              </label>

              <select id="assignTeacherSelect" 
              name="teacher_id"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

                <option value="">Select Teacher</option>

                  <!--displaying teachers of this school-->

                  @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">
                      {{ $teacher->fname }} {{ $teacher->lname }}
                    </option>
                  @endforeach

                
              </select>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow transition">
              Assign
            </button>

          <div id="assignClassMessage" class="mt-2 text-green-600 font-medium hidden"
          >Class assigned successfully!
          </div>

        </section>

        <!-- Table (desktop) -->
        <section class="bg-white p-4 rounded shadow-sm">
          <div class="overflow-x-auto hidden md:block">
            <div class="table-card overflow-hidden">
              <table id="classesTable" class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                      Class
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                      Room
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                      Class Teacher
                    </th>

                    <th class="px-6 py-3 text-center text-xs font-medium text-indigo-700 uppercase tracking-wider">
                      Actions
                    </th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">

                  <!--check if theree are assignedTeachers-->
                  @if (isset($assignedTeachers) && $assignedTeachers->isEmpty())
                  
                    <tr>
                      <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No classes have been assigned to teachers yet.
                      </td>
                    </tr>

                  @else
                  <!--forloop to display assigned classes and their teachers-->

                    @foreach ($assignedTeachers as $assignedTeacher)

    <tr data-class-id="{{ optional($assignedTeacher->classAvailable)->id ?? $assignedTeacher->class_id }}" data-class-name="{{ optional($assignedTeacher->classAvailable)->name ?? 'Class' }}" class="hover:bg-gray-50 transition-colors">
      <td class="px-6 py-4 font-medium">
        {{ optional($assignedTeacher->classAvailable)->name ?? 'Class' }}
      </td>
      <td class="px-6 py-4 text-gray-600">
        Room 202
      </td>
      <td class="px-6 py-4">
        <div class="flex items-center gap-3">
          <div class="tc-avatar">AM</div>
          <div class="text-sm font-medium">

            {{ $assignedTeacher->teacher->fname }} 

            {{$assignedTeacher->teacher->lname }}

          </div>
        </div>
      </td>
      <td class="px-6 py-4 text-center">
        <button class="edit-btn inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50" data-class="{{ optional($assignedTeacher->classAvailable)->id ?? $assignedTeacher->class_id }}"><i class="bi bi-pencil-fill"></i><span class="hidden md:inline">Edit</span></button>
     </td>
    </tr>
                      
                    @endforeach

                  @endif
                  
                </tbody>
              </table>
            </div>
          </div>

          <!-- Mobile cards -->
          <div id="cardsWrap" class="md:hidden space-y-3">
            
            <!--check if theree are assignedTeachers-->
                  @if (isset($assignedTeachers) && $assignedTeachers->isEmpty())
                  
                    <tr>
                      <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No classes have been assigned to teachers yet.
                      </td>
                    </tr>

                  @else
                  <!--forloop to display assigned classes and their teachers-->

                  @foreach ($assignedTeachers as $assignedTeacher)
    <article data-class-id="{{ optional($assignedTeacher->classAvailable)->id ?? $assignedTeacher->class_id }}" data-class-name="{{ optional($assignedTeacher->classAvailable)->name ?? 'Class' }}" class="p-3 border rounded-md bg-white shadow-sm">
      <div class="flex items-center justify-between gap-4">
        <div>
          <div class="font-medium">
            {{ optional($assignedTeacher->classAvailable)->name ?? 'Class' }}
          </div>

          <div class="text-xs text-gray-500">
            Room 102
          </div>
        </div>

        <div class="text-right">
          <div class="text-sm font-medium">
            <div class="flex items-center gap-2 justify-end">
              <span class="tc-chip">
                <span class="tc-avatar">
                  GN
                </span>
                <span>
                  {{ $assignedTeacher->teacher->fname }} 
                  {{ $assignedTeacher->teacher->lname }}
                </span>
              </span>
            </div>
          </div>
          <button class="mt-2 edit-btn inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50" data-class="{{ optional($assignedTeacher->classAvailable)->id ?? $assignedTeacher->class_id }}"><i class="bi bi-pencil-fill"></i><span class="ml-1">Edit</span></button>
       </div>
     </div>
   </article>
 
                   @endforeach

                  @endif

            
          </div>

          <!-- Edit modal (redesigned, UI-only) -->
          <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center z-50 px-4 py-6" aria-hidden="true" role="dialog" aria-modal="true">

            <div class="max-w-xl w-full bg-white rounded-lg shadow-xl overflow-visible">

              <!--head of model-->
              <div class="flex items-center justify-between px-5 py-4 bg-indigo-600">
                <div class="flex items-center gap-3">
                  <div class="h-9 w-9 rounded-full bg-white flex items-center justify-center text-indigo-600">
                    <i class="bi bi-pencil-fill"></i>
                  </div>
                  <div>
                    <h3 id="modalTitle" class="text-lg font-semibold text-white">
                      Edit Class Assignment
                    </h3>

                    <div id="modalSubtitle" class="text-xs text-indigo-100">
                      Update class teachers
                    </div>

                  </div>
                </div>

                <div class="flex items-center gap-2">
                  
                  <button id="closeModal" class="text-indigo-100 hover:text-white p-2 rounded-md" aria-label="Close modal">
                    <i class="bi bi-x-lg"></i>
                  </button><!--close button-->
                </div>

              </div><!--end of modal-header--> 

              <div class="px-5 py-4"><!--body of modal-->
                <label class="block text-sm text-gray-700 mb-1">
                  Class
                </label>

                <!-- inside modal body: remove blade variable output and leave placeholder -->
                <div id="modalClass" class="mb-3 text-sm font-medium text-gray-800">
                  <!-- JS will set this -->
                </div>

                <label class="block text-sm text-gray-700 mb-1">
                  Assigned Teachers
                </label>

                <div id="modalTeacherPreview" class="mb-3 flex flex-wrap gap-2">
                  <!-- chips render here (JS) -->
                </div>

                <label class="block text-sm text-gray-700 mb-1">
                  Add / Change Teachers
                </label>
                <!-- Custom dropdown for selecting multiple teachers (checkbox list) -->
                <div id="teacherDropdown" class="relative">

                  <button id="teacherDropdownToggle" type="button" class="w-full text-left border border-gray-200 rounded-md px-3 py-2 flex items-center justify-between focus:outline-none focus:ring-2 focus:ring-indigo-400" aria-haspopup="listbox" aria-expanded="false">

                    <span id="teacherDropdownLabel" class="text-sm text-gray-700">
                      Select teachers
                    </span>
                    <i class="bi bi-chevron-down text-gray-400"></i>
                  </button>

                  <div id="teacherDropdownMenu" class="hidden absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-md shadow max-h-56 overflow-auto z-50">

                    <!--dropdown to choose the teacher to set as class teacher-->

                    @foreach ($teachers as $teacher)
                    <label class="flex items-center gap-2 p-2 hover:bg-indigo-50 cursor-pointer">

                      <input type="checkbox" class="teacher-option" value="{{ $teacher->id }}" />
                      <span class="text-sm">
                        {{ $teacher->fname }} {{ $teacher->lname }}
                      </span>

                    </label>
                    @endforeach
                  
                  </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Tip: Click the dropdown and tick the teachers to select multiple.</p>
              </div><!--end of modal-body-->

              <div class="px-5 py-4 bg-gray-50 flex items-center justify-end gap-3">
                <button id="cancelEdit" type="button" 
                class="px-4 py-2 bg-white hover:bg-red-50 border border-red-100 rounded-md text-gray-700 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-100">
                  Cancel
                </button><!--cancel button-->

                <button id="saveEdit" type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                  Save
                </button><!--save button-->

              </div>

            </div>
          </div><!-- End of Edit Modal -->

          </form><!--end of form to collect all the data from the page -->

        </section>
      </main>
    </div>

    <script>
    // Sidebar, dropdown and modal UI logic (minimal)
    document.addEventListener('DOMContentLoaded', function(){
      
      // ---------- Edit modal behavior (minimal, UI-only) ----------
      const editModal = document.getElementById('editModal');
      const modalClassEl = document.getElementById('modalClass');
      const modalTeacherPreview = document.getElementById('modalTeacherPreview');
      const teacherDropdownToggle = document.getElementById('teacherDropdownToggle');
      const teacherDropdownMenu = document.getElementById('teacherDropdownMenu');
      const teacherDropdownLabel = document.getElementById('teacherDropdownLabel');
      const closeModalBtn = document.getElementById('closeModal');
      const cancelBtns = document.querySelectorAll('#cancelEdit');
      const saveBtn = document.getElementById('saveEdit');

      function getSelectedTeachersFromDropdown(){
        return Array.from(teacherDropdownMenu.querySelectorAll('input.teacher-option:checked')).map(i=>i.value);
      }

      function updateDropdownLabel(){
        const selected = getSelectedTeachersFromDropdown();
        if(selected.length === 0) teacherDropdownLabel.textContent = 'Select teachers';
        else if(selected.length === 1) teacherDropdownLabel.textContent = selected[0];
        else teacherDropdownLabel.textContent = selected.length + ' teachers selected';
      }

      function renderModalPreview(){
        modalTeacherPreview.innerHTML = '';
        const selected = getSelectedTeachersFromDropdown();
        if(selected.length === 0){
          modalTeacherPreview.innerHTML = '<div class="text-xs text-gray-500">No teachers selected</div>';
          return;
        }
        selected.forEach(name => {
          const chip = document.createElement('span');
          chip.className = 'tc-chip';
          const initials = name.split(' ').map(s=>s[0]||'').slice(0,2).join('').toUpperCase();
          const avatar = document.createElement('span'); avatar.className = 'tc-avatar'; avatar.textContent = initials;
          const label = document.createElement('span'); label.textContent = name;
          chip.appendChild(avatar); chip.appendChild(label);
          modalTeacherPreview.appendChild(chip);
        });
      }

      // Open modal and populate with class info and current teachers
      function openModalForRow(row){
        // prefer explicit data attribute set by Blade, then visible text
        const classLabel = (row.dataset && row.dataset.className) ||
                           (row.querySelector('td') && row.querySelector('td').textContent.trim()) ||
                           (row.querySelector('.font-medium') && row.querySelector('.font-medium').textContent.trim()) ||
                           row.getAttribute('data-class-id') ||
                           'Class';
        modalClassEl.textContent = classLabel;

        // find current teachers in the row (handle chip or simple text variants)
        let teachers = [];
        const list = row.querySelector('[data-teacher-list]');
        if(list){
          const chipEls = list.querySelectorAll('.tc-chip');
          if(chipEls.length){
            teachers = Array.from(chipEls).map(ch => { const nameSpan = ch.querySelector('span:nth-child(2)'); return nameSpan ? nameSpan.textContent.trim() : ch.textContent.trim(); });
          } else {
            // fallback: look for text nodes inside row (e.g., div.text-sm)
            const txtEls = list.querySelectorAll('.text-sm, .text-sm.font-medium, .font-medium');
            teachers = Array.from(txtEls).map(el => el.textContent.trim()).filter(Boolean);
          }
        }

        // clear and preselect checkboxes that match
        // teachers[] contains names. The inputs values are ids — if you want to preselect by id,
        // ensure 'teachers' contains ids. If you rely on names, convert accordingly.
        Array.from(teacherDropdownMenu.querySelectorAll('input.teacher-option')).forEach(cb => {
          // try matching by data attribute or by name fallback
          const matchByName = teachers.includes(cb.nextElementSibling ? cb.nextElementSibling.textContent.trim() : '');
          const matchById = teachers.includes(cb.value);
          cb.checked = matchById || matchByName;
        });
        updateDropdownLabel();
        renderModalPreview();
        if(editModal) editModal.classList.remove('hidden');
      }

      // wire edit buttons
      const editButtons = document.querySelectorAll('.edit-btn');
      editButtons.forEach(btn => {
        btn.addEventListener('click', function(e){
          e.preventDefault();
          const classId = btn.dataset.class || (btn.closest('[data-class-id]') && btn.closest('[data-class-id]').getAttribute('data-class-id'));
          const row = document.querySelector(`[data-class-id="${classId}"]`);
          if(row) openModalForRow(row);
          else {
            // fallback: open modal with minimal info
            modalClassEl.textContent = classId || 'Class';
            Array.from(teacherSelect.options).forEach(opt => opt.selected = false);
            renderModalPreview();
            if(editModal) editModal.classList.remove('hidden');
          }
        });
      });

      // close modal helpers
      function closeModal(){ if(editModal) editModal.classList.add('hidden'); }
      if(closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
      cancelBtns.forEach(b => b.addEventListener('click', closeModal));
      if(editModal) editModal.addEventListener('click', function(e){ if(e.target === editModal) closeModal(); });

      // dropdown toggle and checkbox wiring
      teacherDropdownToggle.addEventListener('click', function(e){
        e.preventDefault(); teacherDropdownMenu.classList.toggle('hidden');
        const expanded = teacherDropdownToggle.getAttribute('aria-expanded') === 'true';
        teacherDropdownToggle.setAttribute('aria-expanded', (!expanded).toString());
      });
      // close dropdown when clicking outside
      document.addEventListener('click', function(e){ if(!document.getElementById('teacherDropdown').contains(e.target)){ teacherDropdownMenu.classList.add('hidden'); teacherDropdownToggle.setAttribute('aria-expanded','false'); } });
      // checkbox change to update preview and label
      Array.from(teacherDropdownMenu.querySelectorAll('input.teacher-option')).forEach(cb => cb.addEventListener('change', function(){ updateDropdownLabel(); renderModalPreview(); }));
      
    });
    </script>

</x-Teacher-sidebar>