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

  {{-- Flash & validation messages (insert after header, before main content) --}}
  <style>
  .flash {
    display:flex; align-items:flex-start; gap:0.75rem;
    padding:12px 14px; border-radius:12px; margin-bottom:12px;
    box-shadow:0 8px 24px rgba(2,6,23,0.06); position:relative; overflow:hidden;
    transform-origin:top; transition:opacity .3s ease, transform .3s ease;
  }
  .flash--success{ background:linear-gradient(90deg,#ecfdf5,#f0fdf4); border:1px solid #bbf7d0; color:#065f46; }
  .flash--error{ background:linear-gradient(90deg,#fff1f2,#fff7f7); border:1px solid #fecaca; color:#7f1d1d; }
  .flash--info{ background:linear-gradient(90deg,#eff6ff,#f8fbff); border:1px solid #bfdbfe; color:#1e3a8a; }
  .flash__icon{ width:36px; height:36px; flex:0 0 36px; display:flex; align-items:center; justify-content:center; border-radius:8px; background:rgba(255,255,255,0.6); }
  .flash__content{ flex:1 1 auto; min-width:0; }
  .flash__title{ font-weight:700; margin-bottom:2px; font-size:14px; }
  .flash__msg{ font-size:13px; color:inherit; opacity:.95; line-height:1.2; }
  .flash__close{ background:transparent; border:0; color:inherit; font-size:18px; cursor:pointer; padding:6px; margin-left:8px; }
  .flash__bar{ position:absolute; left:0; right:0; bottom:0; height:4px; background:linear-gradient(90deg, rgba(0,0,0,0.06), rgba(0,0,0,0.02)); }
  .flash__bar > i{ display:block; height:100%; background:currentColor; width:100%; transform-origin:left; transition:transform linear; }
  .flash-hidden{ opacity:0; transform:translateY(-8px) scale(.99); pointer-events:none; }
</style>

<div id="flash-messages">
  @if(session('success'))
    <div class="flash flash--success" role="status" aria-live="polite" data-timeout="5000">
      <div class="flash__icon" aria-hidden="true">
        <!-- check icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
      </div>
      <div class="flash__content">
        <div class="flash__title">Success</div>
        <div class="flash__msg">{{ session('success') }}</div>
      </div>
      <button type="button" class="flash__close" aria-label="Close">&times;</button>
      <div class="flash__bar" aria-hidden="true"><i style="background:#10b981"></i></div>
    </div>
  @endif

  @if(session('error'))
    <div class="flash flash--error" role="alert" data-timeout="7000">
      <div class="flash__icon" aria-hidden="true">
        <!-- x icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
      <div class="flash__content">
        <div class="flash__title">Error</div>
        <div class="flash__msg">{{ session('error') }}</div>
      </div>
      <button type="button" class="flash__close" aria-label="Close">&times;</button>
      <div class="flash__bar" aria-hidden="true"><i style="background:#ef4444"></i></div>
    </div>
  @endif

  @if(session('info'))
    <div class="flash flash--info" role="status" data-timeout="5000">
      <div class="flash__icon" aria-hidden="true">
        <!-- info icon -->
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      </div>
      <div class="flash__content">
        <div class="flash__title">Info</div>
        <div class="flash__msg">{{ session('info') }}</div>
      </div>
      <button type="button" class="flash__close" aria-label="Close">&times;</button>
      <div class="flash__bar" aria-hidden="true"><i style="background:#3b82f6"></i></div>
    </div>
  @endif

  @if($errors->any())
    <div class="flash flash--error" role="alert" data-timeout="9000">
      <div class="flash__icon" aria-hidden="true">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </div>
      <div class="flash__content">
        <div class="flash__title">Please fix the following</div>
        <div class="flash__msg">
          <ul style="margin:6px 0 0 16px; padding:0;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      <button type="button" class="flash__close" aria-label="Close">&times;</button>
      <div class="flash__bar" aria-hidden="true"><i style="background:#ef4444"></i></div>
    </div>
  @endif
</div>

<script>
  (function(){
    const flashes = document.querySelectorAll('#flash-messages .flash');
    flashes.forEach(el => {
      const timeout = parseInt(el.getAttribute('data-timeout') || 5000, 10);
      const bar = el.querySelector('.flash__bar > i');
      // animate progress by scaling X
      if(bar){
        bar.style.transform = 'scaleX(1)';
        bar.style.transition = `transform ${timeout}ms linear`;
        // start from full width then shrink to zero for visual countdown
        requestAnimationFrame(()=> {
          bar.style.transform = 'scaleX(0)';
        });
      }

      const hide = () => {
        el.classList.add('flash-hidden');
        setTimeout(()=> el.remove(), 350);
      };

      const t = setTimeout(hide, timeout);

      const closeBtn = el.querySelector('.flash__close');
      if (closeBtn) {
        closeBtn.addEventListener('click', () => {
          clearTimeout(t);
          hide();
        });
      }
    });
  })();
</script>

  <!-- CONTROLS & TABLE SECTION: grade/date controls, action buttons, attendance table -->
  <section class="bg-white p-6 rounded-md shadow-lg">

          <form id="registerForm" 
            class="space-y-4 form-compact"
            action = ""
            method="POST">

            @csrf

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
                <label class="text-sm">
                  Date
                </label>

                <input 
                name = "date"
                type="date" 
                id="attDate" 
                class="border px-3 py-2 rounded-sm" />

              </div>
              <div class="ml-auto flex items-center gap-2">
                <!-- Desktop actions -->

                <div class="hidden md:flex items-center gap-2">

                  <!-- add id to desktop button for easier JS hook -->
                  <button id="allPresentBtnDesktop" type="button"
                  data-formaction="{{ route('registerstudentattendance.allpresent') }}"
                   class="px-3 py-2 btn-success text-white rounded-sm text-sm">
                     All present
                   </button>
                  

                  <button id="allPresentExceptBtn" type="button" class="px-3 py-2 btn-primary text-white rounded-sm text-sm">
                    All present except…
                  </button>

                </div>
                <!-- Mobile actions: stack full-width buttons -->
                <div class="flex md:hidden flex-col w-full gap-2">
                  
                  <button id="allPresentExceptBtnMobile" type="button" class="inline-flex items-center justify-center w-full btn-primary text-white rounded-sm text-sm px-3 py-2" aria-label="All present except">
                    <i class="bi bi-person-check mr-2"></i>
                    <span>All present except…</span>
                  </button>

                  <!-- make mobile "All present" submit the form too and give it an id -->
                  <button id="allPresentBtnMobile" type="button"
                    data-formaction="{{ route('registerstudentattendance.allpresent') }}"
                     class="inline-flex items-center justify-center w-full btn-success text-white rounded-sm text-sm px-3 py-2" aria-label="All present">
                     <i class="bi bi-people-fill mr-2"></i>
                     <span>All present</span>
                   </button>

                </div>
              </div>
            </div>
          </form>

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
                          <input type="radio" 
                          name= "attendance_{{ $student->id }}"  value="present" checked> 
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

            <livewire:search :students="$students" :class_id="$classId" :schoolId="$schoolId" />
            
            <div class="flex items-center justify-end gap-2">
              
              <button id="exceptionsCancel" type="button" class="px-3 py-2 border rounded-sm hover:bg-red-100">
                Cancel
              </button>

              <!-- submit the modal form to server -->
              <button id="exceptionsApply" form="exceptionsForm" type="submit" class="px-3 py-2 btn-primary text-white rounded-sm">
                Apply
              </button>
            </div>

          </div>
        </div>

        <!-- Confirm "All present" modal -->
<div id="confirmAllPresentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="absolute inset-0 bg-black bg-opacity-40"></div>
  <div class="relative w-full max-w-sm bg-white rounded-md shadow-lg p-5">
    <div class="flex items-start gap-3">
      <div class="flex-shrink-0">
        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
          <!-- icon -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        </div>
      </div>
      <div class="min-w-0">

        <h4 class="text-lg font-semibold text-gray-800">
          Confirm action
        </h4>

        <p class="text-sm text-gray-600 mt-1">
          Mark ALL students as Present?
        </p>
        
      </div>
    </div>

    <div class="mt-4 flex justify-end gap-3">

      <button id="confirmAllPresentCancel" type="button" class="px-3 py-2 border rounded-sm hover:bg-red-100">
        Cancel
      </button>

      <button id="confirmAllPresentConfirm" type="button" class="px-3 py-2 btn-success text-white rounded-sm">Confirm</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const form = document.getElementById('registerForm');
  const modal = document.getElementById('confirmAllPresentModal');
  const cancelBtn = document.getElementById('confirmAllPresentCancel');
  const confirmBtn = document.getElementById('confirmAllPresentConfirm');

  let targetAction = null;
  let targetMethod = 'POST';

  function openModal(action, method = 'POST'){
    targetAction = action;
    targetMethod = method || 'POST';
    modal.classList.remove('hidden');
  }
  function closeModal(){
    modal.classList.add('hidden');
    targetAction = null;
  }

  ['allPresentBtnDesktop','allPresentBtnMobile'].forEach(id=>{
    const btn = document.getElementById(id);
    if(!btn) return;
    btn.addEventListener('click', function(e){
      e.preventDefault();
      const action = btn.dataset.formaction || btn.getAttribute('formaction');
      const method = btn.dataset.formmethod || btn.getAttribute('formmethod') || 'POST';
      if(!action){
        // fallback: native confirm then submit
        if(confirm('Mark ALL students as Present?')) form.submit();
        return;
      }
      openModal(action, method);
    });
  });

  cancelBtn && cancelBtn.addEventListener('click', closeModal);

  confirmBtn && confirmBtn.addEventListener('click', function(){
    if(!targetAction) return closeModal();
    form.action = targetAction;
    form.method = (targetMethod || 'POST').toUpperCase();
    closeModal();
    form.submit();
  });
});
</script>
      
      </main>
      </main>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Exceptions modal: only open/close (no DOM population)
        const btn = document.getElementById('allPresentExceptBtn');
        const btnM = document.getElementById('allPresentExceptBtnMobile');
        const modal = document.getElementById('exceptionsModal');
        const close = document.getElementById('exceptionsClose');
        const cancel = document.getElementById('exceptionsCancel');

        function open(){ if(modal) modal.classList.remove('hidden'); }
        function closeModal(){ if(modal) modal.classList.add('hidden'); }

        if(btn) btn.addEventListener('click', open);
        if(btnM) btnM.addEventListener('click', open);
        if(close) close.addEventListener('click', closeModal);
        if(cancel) cancel.addEventListener('click', closeModal);
      });
    </script>

</x-Teacher-sidebar>