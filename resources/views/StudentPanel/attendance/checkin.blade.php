<x-Student-sidebar>

    
    <!-- Mobile toggle -->
    <div class="md:hidden fixed top-4 left-4 z-40">
      <button id="sidebarToggle" class="p-2 bg-white rounded-md shadow text-gray-700"><i class="bi bi-list"></i></button>
    </div>

    <!-- Overlay -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="flex items-center justify-between bg-white p-4 rounded shadow mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggleMobile" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <h1 class="text-2xl font-semibold">Attendance — Check In</h1>
        </div>
        <div class="flex items-center gap-3">
          <div class="hidden sm:flex items-center gap-3 bg-gray-50 px-3 py-1 rounded">
            <div id="headerAvatar" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center ring-1 ring-white text-sm sm:text-base overflow-hidden">
              <i class="bi bi-person" aria-hidden="true"></i>
            </div>
            <div class="text-sm">
              <div class="font-medium">Student Name</div>
              <div class="text-xs text-gray-500">Grade 10 • 123456</div>
            </div>
          </div>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
          <div class="bg-gradient-to-r from-indigo-50 to-white rounded-xl shadow p-6">
            <div class="flex items-center gap-4 mb-4">
              <div id="profileAvatar" class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full ring-2 ring-white shadow-sm bg-indigo-600 text-white flex items-center justify-center text-xl sm:text-2xl md:text-3xl overflow-hidden">
                <i class="bi bi-person-fill" aria-hidden="true"></i>
              </div>
              <div>
                <div id="profileName" class="text-lg font-semibold text-gray-800">Student Name</div>
                <div id="profileMeta" class="text-sm text-gray-500">Grade • Admission</div>
              </div>
              <div class="ml-auto text-sm text-gray-500">Auto-checkin — click a button below</div>
            </div>

            <p class="text-sm text-gray-600 mb-4">Quickly register your attendance — the system will attach your profile automatically. Only add a note if you want.</p>

            <div class="space-y-4">
              <div class="flex flex-col sm:flex-row gap-3">
                <button id="btnPresent" class="flex-1 inline-flex items-center justify-center gap-2 bg-indigo-600 text-white px-4 py-3 rounded-lg shadow hover:bg-indigo-700 transition"> <i class="bi bi-person-check-fill text-lg"></i> Check In — Present</button>
                <button id="btnLate" class="flex-1 inline-flex items-center justify-center gap-2 bg-yellow-500 text-white px-4 py-3 rounded-lg shadow hover:bg-yellow-600 transition"> <i class="bi bi-clock-history text-lg"></i> Mark Late</button>
                <button id="btnExcused" class="flex-1 inline-flex items-center justify-center gap-2 bg-green-600 text-white px-4 py-3 rounded-lg shadow hover:bg-green-700 transition"> <i class="bi bi-patch-check-fill text-lg"></i> Mark Excused</button>
              </div>

              <div>
                <label class="text-sm font-medium text-gray-700">Note (optional)</label>
                <textarea id="note" rows="3" class="mt-2 block w-full border border-gray-200 rounded-md p-3 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Optional comment... e.g. 'Arrived late due to traffic'"></textarea>
              </div>

              <div class="flex items-center gap-3">
                <button id="manualCheckin" class="inline-flex items-center gap-2 bg-indigo-700 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-800"> <i class="bi bi-person-plus"></i> Check In Now</button>
                <button id="clearNote" type="button" class="inline-flex items-center gap-2 border border-gray-200 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-50">Clear Note</button>
                <div id="statusBadge" class="ml-auto text-sm text-gray-500"></div>
              </div>
            </div>

            <div id="toast" class="mt-6 hidden p-3 rounded border border-indigo-100 bg-indigo-50 text-indigo-700"></div>
          </div>

          <div class="bg-white rounded shadow p-6 mt-6">
            <h3 class="text-lg font-semibold mb-3">Recent Check-ins</h3>
            <div class="overflow-x-auto">
              <table class="w-full text-left">
                <thead class="bg-gray-100"><tr><th class="p-2">Date</th><th class="p-2">Time</th><th class="p-2">Name</th><th class="p-2">Status</th><th class="p-2">Note</th></tr></thead>
                <tbody id="recordsTbody">
                </tbody>
              </table>
            </div>
            <div class="mt-4 text-sm text-gray-500">Entries are stored locally in your browser (demo). Replace client-storage with an API call for real persistence.</div>
          </div>
        </div>

        <aside class="bg-white rounded shadow p-6">
          <h3 class="text-lg font-semibold mb-3">Quick Actions</h3>
          <div class="space-y-3">
            <button id="quickPresent" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 hover:bg-indigo-100"> <i class="bi bi-check2-circle text-indigo-600"></i> Mark Present</button>
            <button id="quickLate" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg bg-yellow-50 hover:bg-yellow-100"> <i class="bi bi-clock-history text-yellow-600"></i> Mark Late</button>
            <button id="quickExcused" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 hover:bg-green-100"> <i class="bi bi-patch-check text-green-600"></i> Mark Excused</button>
          </div>
        </aside>
      </div>

    </main>
  
  <script>
    // Sidebar toggle functionality (desktop/mobile)
    (function(){
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
      const sidebarOverlay = document.getElementById('sidebarOverlay');

      function openSidebar(){ sidebar.classList.remove('hidden'); sidebarOverlay.classList.remove('hidden'); }
      function closeSidebar(){ sidebar.classList.add('hidden'); sidebarOverlay.classList.add('hidden'); }

      if(sidebarToggle) sidebarToggle.addEventListener('click', function(e){ e.preventDefault(); if(sidebar.classList.contains('hidden')) openSidebar(); else closeSidebar(); });
      if(sidebarToggleMobile) sidebarToggleMobile.addEventListener('click', function(e){ e.preventDefault(); if(sidebar.classList.contains('hidden')) openSidebar(); else closeSidebar(); });
      if(sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
    })();

    // Auto-checkin UI logic: button-only flow with simulated backend profile
    (function(){
      const STORAGE_KEY = 'attendance_records_demo_v1';

      // UI elements
      const profileNameEl = document.getElementById('profileName');
      const profileMetaEl = document.getElementById('profileMeta');
      const profileAvatarEl = document.getElementById('profileAvatar');
      const noteEl = document.getElementById('note');
      const recordsTbody = document.getElementById('recordsTbody');
      const toast = document.getElementById('toast');
      const statusBadge = document.getElementById('statusBadge');

      const btnPresent = document.getElementById('btnPresent');
      const btnLate = document.getElementById('btnLate');
      const btnExcused = document.getElementById('btnExcused');
      const manualCheckin = document.getElementById('manualCheckin');
      const clearNote = document.getElementById('clearNote');

      const quickPresent = document.getElementById('quickPresent');
      const quickLate = document.getElementById('quickLate');
      const quickExcused = document.getElementById('quickExcused');

      // helpers
      function pad(n){ return n.toString().padStart(2,'0'); }
      function nowISO(){ return new Date().toISOString(); }
      function todayDate(){ const d=new Date(); return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`; }
      function nowTime(){ const d=new Date(); return `${pad(d.getHours())}:${pad(d.getMinutes())}`; }

      function showToast(msg, variant='info'){
        toast.textContent = msg;
        toast.classList.remove('hidden','opacity-0');
        // style variants
        toast.className = 'mt-6 p-3 rounded border text-sm';
        if(variant==='success') toast.classList.add('border-green-100','bg-green-50','text-green-700');
        else if(variant==='error') toast.classList.add('border-red-100','bg-red-50','text-red-700');
        else toast.classList.add('border-indigo-100','bg-indigo-50','text-indigo-700');
        setTimeout(()=>{ toast.classList.add('hidden'); }, 2500);
      }

      function loadRecords(){ try{ const raw = localStorage.getItem(STORAGE_KEY); return raw ? JSON.parse(raw) : []; }catch(e){ return []; } }
      function saveRecords(list){ localStorage.setItem(STORAGE_KEY, JSON.stringify(list)); }

      function renderRecords(){
        const list = loadRecords();
        recordsTbody.innerHTML = '';
        list.slice().reverse().forEach(r=>{
          const tr = document.createElement('tr');
          tr.className = 'border-b';
          tr.innerHTML = `<td class="p-2">${r.date}</td><td class="p-2">${r.time}</td><td class="p-2">${r.name} (${r.adm})</td><td class="p-2">${r.status}</td><td class="p-2">${r.note||''}</td>`;
          recordsTbody.appendChild(tr);
        });
      }

      // Simulate backend profile fetch (replace with real API call)
      function fetchProfile(){
        return new Promise(resolve=>{
          setTimeout(()=> resolve({ name: 'Student Name', adm: '123456', grade: 'Grade 10', avatar: '../StudentPanel/image.png' }), 150);
        });
      }

      // Create and persist record
      function createRecord(status, note){
        fetchProfile().then(profile=>{
          const date = todayDate();
          const time = nowTime();
          const rec = { name: profile.name, adm: profile.adm, date, time, status, note: note||'', created: nowISO() };
          const list = loadRecords(); list.push(rec); saveRecords(list); renderRecords();
          showToast(`${status.charAt(0).toUpperCase()+status.slice(1)} recorded`, 'success');
          statusBadge.textContent = `${status.charAt(0).toUpperCase()+status.slice(1)} — ${time}`;
        }).catch(()=> showToast('Unable to fetch profile', 'error'));
      }

      // Wire UI
      btnPresent.addEventListener('click', ()=> createRecord('present', noteEl.value.trim()));
      btnLate.addEventListener('click', ()=> createRecord('late', noteEl.value.trim()));
      btnExcused.addEventListener('click', ()=> createRecord('excused', noteEl.value.trim()));
      manualCheckin.addEventListener('click', ()=> createRecord('present', noteEl.value.trim()));

      clearNote.addEventListener('click', ()=>{ noteEl.value = ''; showToast('Note cleared'); });

      quickPresent.addEventListener('click', ()=> createRecord('present', ''));
      quickLate.addEventListener('click', ()=> createRecord('late', ''));
      quickExcused.addEventListener('click', ()=> createRecord('excused', ''));

      // initialize
      fetchProfile().then(p=>{
        profileNameEl.textContent = p.name;
        profileMetaEl.textContent = `${p.grade} • ${p.adm}`;
        const headerAvatar = document.getElementById('headerAvatar');

        // helper to set initials fallback
        function initials(name){
          if(!name) return '';
          const parts = name.trim().split(/\s+/).filter(Boolean);
          if(parts.length === 1) return parts[0].slice(0,2).toUpperCase();
          return (parts[0][0] + parts[parts.length-1][0]).toUpperCase();
        }

        // If avatar url exists, preload it. On success use as background; on error show initials.
        if(p.avatar){
          const img = new Image();
          img.onload = function(){
            profileAvatarEl.style.backgroundImage = `url('${p.avatar}')`;
            profileAvatarEl.style.backgroundSize = 'cover';
            profileAvatarEl.style.backgroundPosition = 'center';
            profileAvatarEl.innerHTML = '';
            if(headerAvatar){ headerAvatar.style.backgroundImage = `url('${p.avatar}')`; headerAvatar.style.backgroundSize = 'cover'; headerAvatar.style.backgroundPosition = 'center'; headerAvatar.innerHTML = ''; headerAvatar.setAttribute('aria-label', p.name); }
          };
          img.onerror = function(){
            const sig = initials(p.name) || '';
            profileAvatarEl.textContent = sig;
            profileAvatarEl.classList.add('text-white','bg-indigo-600');
            profileAvatarEl.style.backgroundImage = '';
            if(headerAvatar){ headerAvatar.textContent = sig.slice(0,1); headerAvatar.classList.add('text-white','bg-indigo-600'); headerAvatar.setAttribute('aria-label', p.name); }
          };
          img.src = p.avatar;
        } else {
          const sig = initials(p.name) || '';
          profileAvatarEl.textContent = sig;
          profileAvatarEl.classList.add('text-white','bg-indigo-600');
          if(headerAvatar){ headerAvatar.textContent = sig.slice(0,1); headerAvatar.classList.add('text-white','bg-indigo-600'); headerAvatar.setAttribute('aria-label', p.name); }
        }
      });

      renderRecords();
    })();
  </script>

</x-Student-sidebar>