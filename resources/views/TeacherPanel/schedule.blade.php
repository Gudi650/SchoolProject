<x-Teacher-sidebar>

    <!-- Main content will be pasted below after patching -->
      <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <style> .hero-content { position: relative; z-index: 10; } </style>
            <div class="md:flex md:items-center md:justify-between gap-4 relative pl-3 md:pl-4">
              <div class="flex items-center gap-3 hero-content min-w-0">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i>
                </button>
                <div class="min-w-0">
                  <h1 class="text-lg sm:text-xl md:text-2xl font-extrabold text-indigo-800">My Schedule</h1>
                  <p class="mt-1 text-sm text-gray-500 hidden sm:block">View and manage your classes, appointments, and availability. Navigate weeks quickly with the controls on the right.</p>
                </div>
              </div>

              <div class="mt-3 md:mt-0 flex items-center gap-3 hero-content">

                <button id="addAppt" class="inline-flex items-center justify-center gap-2 h-9 w-36 rounded-md bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-50 text-sm">
                    <i class="bi bi-plus-lg"></i>
                     New Appointment
                </button>

                <a href="{{ route('teacher.dashboard') }}" 
                class="inline-flex items-center justify-center gap-2 h-9 w-36 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
                
              </div>
            </div>

            <!-- KPI cards -->
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
              <div class="p-3 bg-indigo-50 rounded-md flex items-center gap-3">
                <div class="p-2 bg-white rounded-full text-indigo-600"><i class="bi bi-calendar-event"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Upcoming Classes</div>
                  <div class="text-lg font-semibold text-indigo-800">4 this week</div>
                </div>
              </div>

              <div class="p-3 bg-white rounded-md flex items-center gap-3 shadow-sm">
                <div class="p-2 bg-indigo-100 rounded-full text-indigo-700"><i class="bi bi-people"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Appointments Today</div>
                  <div class="text-lg font-semibold text-indigo-800">1</div>
                </div>
              </div>

              <div class="p-3 bg-white rounded-md flex items-center gap-3 shadow-sm">
                <div class="p-2 bg-indigo-100 rounded-full text-indigo-700"><i class="bi bi-envelope-fill"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Unread Messages</div>
                  <div class="text-lg font-semibold text-indigo-800">2 unread</div>
                </div>
              </div>
            </div>
          </header>

        <div class="grid grid-cols-1 gap-6">
          <!-- Calendar / timetable (stacked above appointments) -->
          <section class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-3">
                <button id="prevWeek" class="p-2 rounded hover:bg-gray-100"><i class="bi bi-chevron-left"></i></button>
                <div class="text-lg font-semibold">Week of <span id="weekLabel">Oct 20 - Oct 26</span></div>
                <button id="nextWeek" class="p-2 rounded hover:bg-gray-100"><i class="bi bi-chevron-right"></i></button>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-500">
                <div class="inline-flex items-center px-2 py-1 rounded-full bg-indigo-50 text-indigo-600">Class</div>
                <div class="inline-flex items-center px-2 py-1 rounded-full bg-yellow-50 text-yellow-700">Appointment</div>
              </div>
            </div>

            <!-- Modern desktop week grid -->
            <div class="hidden md:grid md:grid-cols-7 md:gap-3 mt-3">
              <!-- Day column template: Day header + events -->
              <div class="min-h-[160px] bg-gray-50 rounded p-3 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                  <div class="text-sm font-medium">Mon</div>
                  <div class="text-xs text-gray-500">20 Oct</div>
                </div>
                <div class="space-y-2">
                  <div class="bg-indigo-100 text-indigo-700 p-2 rounded">
                    <div class="font-medium">Math</div>
                    <div class="text-xs text-gray-600">09:00 · Room 12</div>
                  </div>
                </div>
              </div>

              <div class="min-h-[160px] bg-gray-50 rounded p-3"></div>

              <div class="min-h-[160px] bg-gray-50 rounded p-3 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                  <div class="text-sm font-medium">Wed</div>
                  <div class="text-xs text-gray-500">22 Oct</div>
                </div>
                <div class="space-y-2">
                  <div class="bg-indigo-100 text-indigo-700 p-2 rounded">
                    <div class="font-medium">Physics</div>
                    <div class="text-xs text-gray-600">11:00 · Lab</div>
                  </div>
                </div>
              </div>

              <div class="min-h-[160px] bg-gray-50 rounded p-3"></div>

              <div class="min-h-[160px] bg-gray-50 rounded p-3 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                  <div class="text-sm font-medium">Fri</div>
                  <div class="text-xs text-gray-500">24 Oct</div>
                </div>
                <div class="space-y-2">
                  <div class="bg-indigo-100 text-indigo-700 p-2 rounded">
                    <div class="font-medium">Chemistry</div>
                    <div class="text-xs text-gray-600">10:00 · Room 8</div>
                  </div>
                </div>
              </div>

              <div class="min-h-[160px] bg-gray-50 rounded p-3"></div>
              <div class="min-h-[160px] bg-gray-50 rounded p-3"></div>

              <!-- Appointment example placed on Thu -->
              <div class="min-h-[160px] bg-gray-50 rounded p-3 flex flex-col">
                <div class="flex items-center justify-between mb-2">
                  <div class="text-sm font-medium">Thu</div>
                  <div class="text-xs text-gray-500">23 Oct</div>
                </div>
                <div class="space-y-2">
                  <div class="bg-yellow-100 text-yellow-800 p-2 rounded">
                    <div class="font-medium">Parent Meeting</div>
                    <div class="text-xs text-gray-600">14:00 · Staff Room</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Mobile: horizontally scrollable day strip -->
            <div class="md:hidden mt-3">
              <div class="-mx-4 px-4 overflow-x-auto no-scrollbar">
                <div class="flex gap-3 w-max flex-nowrap">
                  <div class="min-w-[200px] flex-shrink-0 bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex items-center justify-between">
                      <div class="font-medium">Mon — 20 Oct</div>
                      <div class="text-xs text-gray-500">09:00</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Math — Room 12</div>
                  </div>

                  <div class="min-w-[200px] flex-shrink-0 bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex items-center justify-between">
                      <div class="font-medium">Wed — 22 Oct</div>
                      <div class="text-xs text-gray-500">11:00</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Physics — Lab</div>
                  </div>

                  <div class="min-w-[200px] flex-shrink-0 bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex items-center justify-between">
                      <div class="font-medium">Thu — 23 Oct</div>
                      <div class="text-xs text-gray-500">14:00</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Parent Meeting — Staff Room</div>
                  </div>

                  <div class="min-w-[200px] flex-shrink-0 bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex items-center justify-between">
                      <div class="font-medium">Fri — 24 Oct</div>
                      <div class="text-xs text-gray-500">10:00</div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">Chemistry — Room 8</div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Appointments / details: responsive table (desktop) + stacked cards (mobile) -->
          <aside class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-4">
              <h3 class="font-semibold">Appointments</h3>
              <a href="./schedule.html" class="text-sm text-indigo-600">View full calendar</a>
            </div>

            <!-- Desktop table -->
            <div class="hidden md:block bg-white rounded-md shadow-sm overflow-x-auto max-w-full">
              <table class="w-full table-auto text-sm">
                <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                  <tr>
                    <th class="p-3 text-left">Appointment</th>
                    <th class="p-3 text-left">Date &amp; Time</th>
                    <th class="p-3 text-left">Details</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Actions</th>
                  </tr>
                </thead>
                <tbody id="apptTableBody" class="divide-y">
                  <tr class="hover:bg-gray-50" data-apt-id="1">
                    <td class="p-3 align-top">
                      <div class="font-medium appt-title">Parent — John <span class="text-gray-500 text-xs">(10th Grade)</span></div>
                    </td>
                    <td class="p-3 align-top text-gray-600 appt-datetime">Oct 22 · 14:00</td>
                    <td class="p-3 align-top text-sm text-gray-600 appt-notes">Discuss progress and behavior.</td>
                    <td class="p-3 align-top">
                      <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium badge-confirmed">Confirmed</span>
                    </td>
                    <td class="p-3 align-top">
                      <div class="flex items-center gap-2">
                        <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm appt-edit" data-id="1" data-title="Parent — John" data-date="Oct 22" data-time="14:00" data-venue="Staff Room" data-notes="Discuss progress and behavior." data-status="confirmed">Edit</button>
                        <button class="px-3 py-1 border rounded text-sm appt-view" data-id="1" data-title="Parent — John" data-date="Oct 22" data-time="14:00" data-venue="Staff Room" data-notes="Discuss progress and behavior." data-status="confirmed">View</button>
                        <button class="px-3 py-1 text-red-600 rounded text-sm appt-delete" data-id="1">Delete</button>
                      </div>
                    </td>
                  </tr>

                  <tr class="hover:bg-gray-50" data-apt-id="2">
                    <td class="p-3 align-top">
                      <div class="font-medium appt-title">Counselor Meeting</div>
                    </td>
                    <td class="p-3 align-top text-gray-600 appt-datetime">Oct 23 · 10:00</td>
                    <td class="p-3 align-top text-sm text-gray-600 appt-notes">Monthly counselling sync.</td>
                    <td class="p-3 align-top">
                      <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium badge-pending">Pending</span>
                    </td>
                    <td class="p-3 align-top">
                      <div class="flex items-center gap-2">
                        <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm appt-edit" data-id="2" data-title="Counselor Meeting" data-date="Oct 23" data-time="10:00" data-venue="Counseling Office" data-notes="Monthly counselling sync." data-status="pending">Edit</button>
                        <button class="px-3 py-1 border rounded text-sm appt-view" data-id="2" data-title="Counselor Meeting" data-date="Oct 23" data-time="10:00" data-venue="Counseling Office" data-notes="Monthly counselling sync." data-status="pending">View</button>
                        <button class="px-3 py-1 text-red-600 rounded text-sm appt-delete" data-id="2">Delete</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Mobile cards rendered by JS -->
            <div id="apptMobileList" class="md:hidden space-y-3 mt-3">
              <article class="bg-white border rounded-lg p-3 shadow-sm" data-apt-id="1">
                <div class="flex items-start justify-between">
                  <div>
                    <div class="font-medium">Parent — John <span class="text-gray-500 text-xs">(10th Grade)</span></div>
                    <div class="text-sm text-gray-600 mt-1">Oct 22 · 14:00</div>
                    <div class="mt-2 text-sm text-gray-600">Discuss progress and behavior.</div>
                  </div>
                  <div class="text-right">
                    <div><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium badge-confirmed">Confirmed</span></div>
                    <div class="mt-3 flex flex-col items-end gap-2">
                      <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm appt-edit" data-id="1" data-title="Parent — John" data-date="Oct 22" data-time="14:00" data-venue="Staff Room" data-notes="Discuss progress and behavior." data-status="confirmed">Edit</button>
                      <button class="px-3 py-1 border rounded text-sm appt-view" data-id="1" data-title="Parent — John" data-date="Oct 22" data-time="14:00" data-venue="Staff Room" data-notes="Discuss progress and behavior." data-status="confirmed">View</button>
                    </div>
                  </div>
                </div>
              </article>

              <article class="bg-white border rounded-lg p-3 shadow-sm" data-apt-id="2">
                <div class="flex items-start justify-between">
                  <div>
                    <div class="font-medium">Counselor Meeting</div>
                    <div class="text-sm text-gray-600 mt-1">Oct 23 · 10:00</div>
                    <div class="mt-2 text-sm text-gray-600">Monthly counselling sync.</div>
                  </div>
                  <div class="text-right">
                    <div><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium badge-pending">Pending</span></div>
                    <div class="mt-3 flex flex-col items-end gap-2">
                      <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm appt-edit" data-id="2" data-title="Counselor Meeting" data-date="Oct 23" data-time="10:00" data-venue="Counseling Office" data-notes="Monthly counselling sync." data-status="pending">Edit</button>
                      <button class="px-3 py-1 border rounded text-sm appt-view" data-id="2" data-title="Counselor Meeting" data-date="Oct 23" data-time="10:00" data-venue="Counseling Office" data-notes="Monthly counselling sync." data-status="pending">View</button>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          </aside>
          <!-- Modals: View/Edit Appointment -->
          <div id="apptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm" aria-hidden="true">
            <div id="apptModalDialog" role="dialog" aria-modal="true" aria-labelledby="modalMode" class="bg-white rounded-xl max-w-lg sm:max-w-4xl w-full mx-4 sm:mx-6 shadow-2xl transform transition-all scale-95 opacity-0 max-h-[90vh] sm:max-h-[80vh] overflow-y-auto">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-0">
                <!-- Left: Summary panel -->
                <div class="p-6 bg-gradient-to-b from-indigo-50 to-white border-r hidden sm:block">
                  <div class="flex items-start justify-between">
                    <div>
                      <h4 id="summaryTitle" class="text-xl font-bold text-indigo-800">Parent — John</h4>
                      <div id="summaryWhen" class="text-sm text-indigo-600 mt-1">Oct 22 · 14:00</div>
                    </div>
                    <div>
                      <div id="summaryStatus" class="inline-block px-2 py-1 rounded-full text-sm font-medium badge-confirmed">Confirmed</div>
                    </div>
                  </div>

                  <div class="mt-4 text-sm text-gray-700">
                    <div class="font-semibold">Venue</div>
                    <div id="summaryVenue" class="mt-1 text-gray-600">Staff Room</div>
                  </div>

                  <div class="mt-4 text-sm text-gray-700">
                    <div class="font-semibold">Notes</div>
                    <div id="summaryNotes" class="mt-1 text-gray-600">Discuss progress and behavior.</div>
                  </div>

                  <div class="mt-6">
                    <button id="summaryEdit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Edit Appointment</button>
                  </div>
                </div>

                <!-- Right: Form / responsive content -->
                <div class="p-6">
                  <div class="flex items-start justify-between">
                    <div>
                      <h3 id="modalMode" class="text-lg font-semibold text-indigo-800">Appointment</h3>
                      <p id="modalSubtitle" class="text-sm text-indigo-600">View or edit appointment details</p>
                    </div>
                    <div class="ml-auto flex items-center gap-2">
                      <button id="closeApptIcon" type="button" class="text-indigo-400 hover:text-indigo-700 p-2 rounded hover:bg-indigo-50" aria-label="Close dialog">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>

                  <form id="apptForm" class="space-y-4 mt-4">
                    <input type="hidden" id="apptId" />
                    <div>
                      <label class="text-sm font-medium text-gray-700">Title</label>
                      <input id="apptTitle" class="w-full border border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div>
                        <label class="text-sm font-medium text-gray-700">Date</label>
                        <input id="apptDate" type="date" class="w-full border border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700">Time</label>
                        <input id="apptTime" type="time" class="w-full border border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                      </div>
                    </div>

                    <div>
                      <label class="text-sm font-medium text-gray-700">Venue</label>
                      <input id="apptVenue" class="w-full border border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                    </div>

                    <div>
                      <label class="text-sm font-medium text-gray-700">Notes</label>
                      <textarea id="apptNotes" class="w-full border border-gray-200 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-200" rows="4"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                      <button type="button" id="closeAppt" class="px-4 py-2 border rounded-md text-sm text-indigo-700 hover:bg-indigo-50">Close</button>
                      <button type="submit" id="saveAppt" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-md text-sm hover:from-indigo-700 hover:to-indigo-600 shadow">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <script>
            // UI-only JS: populate and open modal from data-* attributes; close modal. No client-side persistence or DOM mutations on save/delete.
            function showModal(){ const modal=document.getElementById('apptModal'); const dlg=document.getElementById('apptModalDialog'); modal.classList.remove('hidden'); modal.setAttribute('aria-hidden','false'); requestAnimationFrame(()=>{ modal.classList.add('opacity-100'); dlg.classList.remove('scale-95','opacity-0'); dlg.classList.add('scale-100','opacity-100'); }); }
            function hideModal(){ const modal=document.getElementById('apptModal'); const dlg=document.getElementById('apptModalDialog'); dlg.classList.remove('scale-100','opacity-100'); dlg.classList.add('scale-95','opacity-0'); modal.classList.remove('opacity-100'); modal.setAttribute('aria-hidden','true'); setTimeout(()=>modal.classList.add('hidden'),200); }

            function openModal(mode, dataset){
              const form=document.getElementById('apptForm');
              const id = dataset && dataset.id ? dataset.id : '';
              document.getElementById('modalMode').innerText = mode==='edit' ? (id? 'Edit Appointment':'New Appointment') : 'View Appointment';
              document.getElementById('apptId').value = id || '';
              document.getElementById('apptTitle').value = (dataset && dataset.title) || '';
              document.getElementById('apptDate').value = (dataset && dataset.date) || '';
              document.getElementById('apptTime').value = (dataset && dataset.time) || '';
              document.getElementById('apptVenue').value = (dataset && dataset.venue) || '';
              document.getElementById('apptNotes').value = (dataset && dataset.notes) || '';
              if(document.getElementById('summaryTitle')) document.getElementById('summaryTitle').innerText = (dataset && dataset.title) || 'New Appointment';
              if(document.getElementById('summaryWhen')) document.getElementById('summaryWhen').innerText = ((dataset && dataset.date)||'') + ((dataset && dataset.time)?(' · '+dataset.time):'');
              if(document.getElementById('summaryVenue')) document.getElementById('summaryVenue').innerText = (dataset && dataset.venue) || '';
              if(document.getElementById('summaryNotes')) document.getElementById('summaryNotes').innerText = (dataset && dataset.notes) || '';
              const readonly = mode==='view';
              Array.from(form.querySelectorAll('input,textarea')).forEach(el=>{ el.disabled = readonly; if(readonly){ el.classList.add('bg-transparent','border-0','p-0','text-gray-700'); el.setAttribute('readonly',''); } else { el.classList.remove('bg-transparent','border-0','p-0','text-gray-700'); el.removeAttribute('readonly'); } });
              document.getElementById('saveAppt').style.display = readonly ? 'none' : 'inline-block';
              if(document.getElementById('summaryEdit')) document.getElementById('summaryEdit').style.display = readonly ? 'block' : 'none';
              showModal(); if(!readonly) setTimeout(()=>document.getElementById('apptTitle').focus(),50);
            }

            // wire buttons to open UI-only modal
            document.querySelectorAll('.appt-view').forEach(btn => btn.addEventListener('click', e=> openModal('view', e.currentTarget.dataset)));
            document.querySelectorAll('.appt-edit').forEach(btn => btn.addEventListener('click', e=> openModal('edit', e.currentTarget.dataset)));

            // Delete should not mutate UI; backend will handle deletion. Keep only a confirmation to avoid accidental clicks.
            document.querySelectorAll('.appt-delete').forEach(btn => btn.addEventListener('click', function(e){
              const id = e.currentTarget.dataset.id;
              if(!confirm('Delete this appointment? This action will be handled by the backend.')) return;
              // no DOM removal here — backend will perform deletion later
            }));

            if(document.getElementById('closeAppt')) document.getElementById('closeAppt').addEventListener('click', hideModal);
            if(document.getElementById('closeApptIcon')) document.getElementById('closeApptIcon').addEventListener('click', hideModal);
            document.getElementById('apptModal').addEventListener('click', function(e){ if(e.target===this) hideModal(); });
            document.addEventListener('keydown', function(e){ if(e.key==='Escape'){ const modal=document.getElementById('apptModal'); if(modal && !modal.classList.contains('hidden')) hideModal(); }});

            if(document.getElementById('addAppt')) document.getElementById('addAppt').addEventListener('click', ()=> openModal('edit', {}));

            // Save: UI-only. Prevent default submission and close modal. No client-side persistence or DOM mutation.
            document.getElementById('apptForm').addEventListener('submit', function(e){ e.preventDefault(); hideModal(); });
          </script>
        </div>
      </main>

</x-Teacher-sidebar>