<x-Teacher-sidebar>

  <style>
      /* small visual helpers to lift the design */
      :root{ --brand: #4f46e5; }
      .card-accent{ background: linear-gradient(180deg, #ffffff 0%, rgba(79,70,229,0.02) 100%); border-left:4px solid rgba(79,70,229,0.08); }
      .btn-primary{ background: linear-gradient(90deg,var(--brand),#4338ca); }
    .btn-success{ background: linear-gradient(90deg,#10b981,#059669); }
      .student-chip{ display:inline-flex; align-items:center; gap:.5rem; padding:.25rem .5rem; background:rgba(79,70,229,0.08); color:#0f172a; border-radius:.5rem; font-size:12px; }
      /* status chip styles */
      .status-chip{ display:inline-block; padding:.18rem .5rem; border-radius:.375rem; font-size:0.85rem; font-weight:600; }
      .status-present{ color:#065f46; background:rgba(16,185,129,0.08); }
      .status-absent{ color:#7f1d1d; background:rgba(239,68,68,0.08); }
      @media (max-width: 640px){
        /* stack form controls on small screens */
        .form-compact .form-row{ flex-direction: column; align-items: stretch; }
        .form-compact .form-row > *{ width:100%; }
        /* ensure the first two form controls (grade/date) stack vertically and align equally */
        .form-compact .form-row > .w-full { display:flex; flex-direction:column; align-items:stretch; }
        .form-compact .form-row > .w-full label { width:100%; margin-bottom:.25rem; }
        .form-compact .form-row > .w-full select, .form-compact .form-row > .w-full input { width:100%; }
      /* mobile: present rows as two-column cards for clarity
        left column: index, name + grade, admission badge
        right column: status controls and note input */
      .table-responsive thead{ display:none; }
  .table-responsive tbody tr{ display:grid; grid-template-columns: 1fr auto; gap:0.75rem; border-bottom:none; padding:.75rem; margin-bottom:.6rem; background:#ffffff; border-radius:.375rem; box-shadow:0 8px 16px rgba(15,23,42,0.04); align-items:center; }
  /* disable hover background on mobile to avoid visual flicker when tapping */
  .table-responsive tbody tr:hover{ background-color: transparent; }
  .table-responsive tbody tr{ transition: none; }
      .table-responsive tbody tr > td{ display:block; padding:0; }
      .table-responsive tbody tr > td:nth-child(1){ font-weight:700; color:#0f172a; width:2.2rem; }
      .table-responsive tbody tr > td:nth-child(2){ display:flex; flex-direction:column; gap:0.15rem; }
      .table-responsive tbody tr > td:nth-child(2) .text-xs{ color:#64748b; }
      .table-responsive tbody tr > td:nth-child(3){ margin-top:4px; }
      .table-responsive tbody tr > td:nth-child(3){ display:inline-block; font-size:0.9rem; color:#475569; background:rgba(15,23,42,0.03); padding:.15rem .5rem; border-radius:.375rem; }
      .table-responsive tbody tr > td:nth-child(4){ display:flex; gap:0.5rem; align-items:center; justify-content:flex-end; }
      .table-responsive tbody tr > td:nth-child(4) .status-chip{ padding:.25rem .6rem; font-size:0.95rem; }
      .table-responsive tbody tr > td:nth-child(5){ width:100%; }
      .table-responsive tbody tr > td:nth-child(5) input{ width:100%; }
        .btn-primary{ padding:.55rem .75rem; }
      }
    </style>

    <!-- MAIN: primary page content area -->
  <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-md shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
              <style> .hero-content { position: relative; z-index: 10; } </style>
              <div class="flex items-center gap-3 hero-content">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>
                <div>
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">Attendance — Register</h1>
                </div>
              </div>
            </div>
          </header>

  <!-- CONTROLS & TABLE SECTION: grade/date controls, action buttons, attendance table -->
  <section class="bg-white p-6 rounded-md shadow-lg">
          <form id="registerForm" class="space-y-4 form-compact">
            <div class="flex items-center gap-3 form-row">
              <div class="flex items-center gap-3 w-full md:w-auto">

                <label class="text-sm w-28 md:w-32">Grade / Class</label>
                <select id="gradeSelect" class="border px-3 py-2 rounded-sm w-40 md:w-48">

                  <option selected>
                    {{ $className }}
                  </option>

                </select>

              </div>
              <div class="flex items-center gap-3 w-full md:w-auto">
                <label class="text-sm">Date</label>
                <input type="date" id="attDate" class="border px-3 py-2 rounded-sm" />
              </div>
              <div class="ml-auto flex items-center gap-2">
                <!-- Desktop actions -->
                <div class="hidden md:flex items-center gap-2">
                  <button id="allPresentBtn" type="button" class="px-3 py-2 btn-success text-white rounded-sm text-sm">All present</button>
                  <button id="allPresentExceptBtn" type="button" class="px-3 py-2 btn-primary text-white rounded-sm text-sm">All present except…</button>
                </div>
                <!-- Mobile actions: stack full-width buttons -->
                <div class="flex md:hidden flex-col w-full gap-2">
                  
                  <button id="allPresentExceptBtnMobile" type="button" class="inline-flex items-center justify-center w-full btn-primary text-white rounded-sm text-sm px-3 py-2" aria-label="All present except">
                    <i class="bi bi-person-check mr-2"></i>
                    <span>All present except…</span>
                  </button>

                  <button id="allPresentBtnMobile" type="button" class="inline-flex items-center justify-center w-full btn-success text-white rounded-sm text-sm px-3 py-2" aria-label="All present">
                    <i class="bi bi-people-fill mr-2"></i>
                    <span>All present</span>
                  </button>

                </div>
              </div>
            </div>

            <!-- ATTENDANCE TABLE: responsive table (desktop) / card grid (mobile) -->
            <div class="overflow-x-auto max-w-full table-responsive">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">

                  
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                      #
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                      Student
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                      Admission
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                      Status
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                      Note</th>
                    </th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">

                  <!--loop through the student array-->
                  @foreach ($students as $student)
                    
                    <tr class="hover:bg-gray-50 transition-colors even:bg-gray-50">
                    <td class="px-4 py-3 font-medium">
                      {{ $Tablenumber++ }}
                    </td>

                    <td class="px-4 py-3 text-gray-800">
                      {{ $student->fname }}
                      {{ $student->lname }}
                      <div class="text-xs text-gray-400">
                        {{ $className }}
                      </div>
                    </td>

                    <td class="px-4 py-3 text-sm text-gray-500">
                      12345
                    </td>

                    <td class="px-4 py-3">
                      <div class="flex items-center gap-3">
                        <label class="inline-flex items-center gap-2">
                          <input type="radio" name= "attendance_{{ $student->id }}"  value="present" checked> 
                          <span class="status-chip status-present">
                            Present
                          </span>
                        </label>

                        <label class="inline-flex items-center gap-2 md:ml-3">
                          <input type="radio" name= "attendance_{{ $student->id }}"  value="absent">
                           <span class="status-chip status-absent">
                            Absent
                          </span>
                        </label>

                      </div>

                    </td>
                    <td class="px-4 py-3"><input class="border px-2 py-1 rounded-sm w-full text-sm" placeholder="note" /></td>

                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>

            <div class="flex justify-end gap-2">
              <button type="reset" class="px-4 py-2 border rounded-sm">Reset</button>
              <button type="submit" class="px-4 py-2 btn-primary text-white rounded-sm">Save Attendance</button>
            </div>
          </form>
        </section>

        <!-- Static modal for "All present except" kept in HTML for simpler styling and accessibility -->

        <div id="exceptionsModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">

          <div class="absolute inset-0 bg-black bg-opacity-40"></div>

          <div class="relative w-full max-w-md bg-white rounded-md shadow-lg p-4">

            <div class="flex items-center justify-between mb-3">
              <h3 class="text-lg font-semibold">
                Mark absent — search students
              </h3>
              <button id="exceptionsClose" class="text-gray-600 hover:text-gray-800">
                ✕
              </button>
            </div>

            <div class="mb-3">

              <input id="exceptionsSearch" class="w-full border px-3 py-2 rounded-sm" placeholder="Search student name or admission" />

            </div>
            <!--
              exceptionsList: populated from the attendance table rows when the
              modal opens. Client-side real-time filtering has been removed so
              server-side (PHP) search should be implemented later. The search
              input remains in the UI for parity but it no longer performs
              live filtering in JavaScript.
            -->

            <div id="exceptionsList" class="max-h-56 overflow-auto space-y-1 mb-3"></div>
            
            <div class="flex items-center justify-end gap-2">
              <!-- Cancel: subtle red hover to indicate cancelling action (keeps default look otherwise) -->
              <button id="exceptionsCancel" class="px-3 py-2 border rounded-sm hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-100 transition-colors duration-150">
                Cancel
              </button>

              <button id="exceptionsApply" class="px-3 py-2 btn-primary text-white rounded-sm">
                Apply
              </button>

            </div>

          </div>
        </div>
      
      </main>
      </main>
    </div>

    <script>
    // Shared JS (inlined)
    document.addEventListener('DOMContentLoaded', function () {


  // ---------- All present except... (static modal + minimal JS) ----------
  // The modal provides a simple, client-side way to mark a small set of
  // students as absent while marking everyone else present. The implementation
  // follows three small responsibilities:
  //  1) populate() - read the current table rows and build a searchable list
  //     of checkboxes. Each label gets a `data-search` value that's the
  //     lowercased concatenation of student name + admission number so we can
  //     filter quickly without querying the table repeatedly.
  //  2) search input - listens for 'input' events and hides/shows labels by
  //     checking substring membership against label.dataset.search (real-time
  //     filtering / instant feedback).
  //  3) apply() - reads checked items and updates the underlying radio
  //     inputs in the attendance table (mark checked as Absent, others Present).
  // Keeping this logic tiny and DOM-driven makes it easy to port to server
  // integration later (match by admission number or student id when available).
  (function(){
    const btn = document.getElementById('allPresentExceptBtn');
    const btnM = document.getElementById('allPresentExceptBtnMobile');
    const modal = document.getElementById('exceptionsModal');
    const search = document.getElementById('exceptionsSearch');
    const list = document.getElementById('exceptionsList');
    const close = document.getElementById('exceptionsClose');
    const cancel = document.getElementById('exceptionsCancel');
    const apply = document.getElementById('exceptionsApply');

    // Build the checkbox list from current table rows.
    // Each label stores a `data-search` string for fast client-side filtering.
    // Note: the checkbox carries data-idx (row index) for the current simple
    // mapping. For robustness later, replace data-idx with the admission number
    // (or stable student id) and match rows by that key on Apply.
    function populate(){
      list.innerHTML = '';
      document.querySelectorAll('table tbody tr').forEach((tr,i)=>{
        // Name shown in the second cell and admission in the third cell
        const name = (tr.cells[1] && tr.cells[1].textContent.trim()) || ('Student '+(i+1));
        const adm = tr.cells[2] ? tr.cells[2].textContent.trim() : '';
        const label = document.createElement('label');
        label.className = 'flex items-center gap-2 p-1';
        // For now we attach a simple row index so Apply can map to rows.
        // When moving search to the server, prefer embedding a stable key
        // (e.g. data-adm) and matching rows by that value server-side.
        label.innerHTML = `<input type="checkbox" data-idx="${i}"><span class="text-sm">${name}${adm?(' ('+adm+')'):''}</span>`;
        list.appendChild(label);
      });
    }

    // Open modal: populate list, clear previous search, show modal and focus
    // search so users can type immediately (improves accessibility/UX).
    function open(){ if(modal){ populate(); search.value = ''; modal.classList.remove('hidden'); search.focus(); } }

    // Close/hide the modal
    function closeModal(){ if(modal) modal.classList.add('hidden'); }

    // NOTE: Client-side real-time filtering has been removed. The search
    // input remains in the markup for future server-side (PHP) handling.
    // If you need a temporary local filter during development, re-add an
    // 'input' listener that checks label.dataset.search and toggles display.

    // Apply selection: determine which checkboxes are checked and then mark
    // the corresponding table rows as Absent. All other rows become Present.
    // Implementation detail: we currently use the row index (data-idx) to map
    // checkboxes to table rows. If you switch to matching by admission number
    // (recommended for robustness), update populate() to set data-adm and
    // then look up tr based on tr.cells[2].textContent.
    if(apply){ apply.addEventListener('click', function(){
      // collect checked row indices
      const checkedIdx = Array.from(list.querySelectorAll('input[type=checkbox]:checked')).map(cb=>parseInt(cb.dataset.idx,10));
      // update radios in the table directly (keeps form structure intact)
      document.querySelectorAll('table tbody tr').forEach((tr,i)=>{
        const p = tr.querySelector('input[type="radio"][value="present"]');
        const a = tr.querySelector('input[type="radio"][value="absent"]');
        if(checkedIdx.includes(i)){ if(a) a.checked = true; } else { if(p) p.checked = true; }
      });
      closeModal();
    }); }

    // hookup buttons that open/close the modal
    if(btn) btn.addEventListener('click', open);
    if(btnM) btnM.addEventListener('click', open);
    if(close) close.addEventListener('click', closeModal);
    if(cancel) cancel.addEventListener('click', closeModal);
  })();
  
  // ---------- All present buttons (set everyone present) ----------
  (function(){
    // Small helper to quickly set every student's attendance to Present.
    // We prefer marking radios directly to keep the UI simple and server-friendly.
    function setAllPresent(){
      document.querySelectorAll('table tbody tr').forEach(tr=>{
        const p = tr.querySelector('input[type="radio"][value="present"]');
        if(p) p.checked = true;
      });
    }
    const ap = document.getElementById('allPresentBtn');
    const apm = document.getElementById('allPresentBtnMobile');
    if(ap) ap.addEventListener('click', setAllPresent);
    if(apm) apm.addEventListener('click', setAllPresent);
  })();
    });
    </script>
    <script>
      // Simple form handler (demo)
      // FORM SUBMIT: demo-only handler. Replace with server integration (PHP) later.
      document.getElementById('registerForm').addEventListener('submit', function(e){
        e.preventDefault();
        // In production, collect form data and POST to server here.
        alert('Attendance saved (demo)');
      });
    </script>

</x-Teacher-sidebar>