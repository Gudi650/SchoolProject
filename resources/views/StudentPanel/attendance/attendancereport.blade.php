<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10" id="report">
      <header class="flex items-center justify-between bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <h1 class="text-xl font-medium">Attendance Report</h1>
        </div>
        <div class="flex items-center gap-3">
          <!-- static CSV download using data URI (hardcoded sample data) -->
          <a id="exportCsv" href="data:text/csv;charset=utf-8,date,time,name,adm,status,note\n2025-10-08,07:45,Student Name,123456,present,On time\n2025-10-07,07:58,Student Name,123456,late,Traffic" download="attendance.csv" class="bg-indigo-600 text-white px-4 py-2 rounded inline-flex items-center gap-2"><i class="bi bi-download"></i> Export CSV</a>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <section class="lg:col-span-2 space-y-6">
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start gap-4">
              <div class="w-16 h-16 rounded-full bg-indigo-600 text-white flex items-center justify-center text-2xl">S</div>
              <div>
                <h2 id="studentName" class="text-lg font-semibold">Student Name</h2>
                <p id="studentMeta" class="text-sm text-gray-500">Grade • Admission</p>
              </div>
              <div class="ml-auto text-sm text-gray-500" id="lastSync">Last sync: --</div>
            </div>
            <p class="mt-4 text-sm text-gray-600">Overview of attendance — percentage, trends and recent activity. Use the date selectors to narrow the range.</p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4">
              <p class="text-sm text-gray-500">Total Records</p>
              <div id="totalRecords" class="text-2xl font-semibold mt-2">42</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
              <p class="text-sm text-gray-500">Present</p>
              <div id="presentCount" class="text-2xl font-semibold mt-2">30</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
              <p class="text-sm text-gray-500">Attendance %</p>
              <div id="attendancePct" class="text-2xl font-semibold mt-2">71%</div>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between mb-3">
              <h3 class="font-semibold">Trend (last 30 entries)</h3>
              <div class="text-sm text-gray-500">Sparkline</div>
            </div>
            <div id="sparklineWrap" class="w-full h-24">
              <!-- static sparkline -->
              <svg viewBox="0 0 600 60" preserveAspectRatio="none" class="w-full h-24"><path d="M0 50 L50 30 L100 20 L150 25 L200 15 L250 30 L300 10 L350 20 L400 18 L450 28 L500 12 L550 24 L600 10" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-3">Monthly Summary (last 6 months)</h3>
            <div id="bars" class="flex items-end gap-3 h-40">
              <!-- static bars for last 6 months -->
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:40%"></div><div class="text-xs mt-2 text-gray-600">May</div></div>
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:60%"></div><div class="text-xs mt-2 text-gray-600">Jun</div></div>
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:80%"></div><div class="text-xs mt-2 text-gray-600">Jul</div></div>
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:50%"></div><div class="text-xs mt-2 text-gray-600">Aug</div></div>
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:70%"></div><div class="text-xs mt-2 text-gray-600">Sep</div></div>
              <div class="flex-1 flex flex-col items-center"><div class="w-full bg-indigo-100 rounded-t" style="height:30%"></div><div class="text-xs mt-2 text-gray-600">Oct</div></div>
            </div>
          </div>

          <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center gap-3 mb-4">
              <label class="text-sm text-gray-600">From</label>
              <input id="fromDate" type="date" class="border border-gray-200 rounded p-2" />
              <label class="text-sm text-gray-600">To</label>
              <input id="toDate" type="date" class="border border-gray-200 rounded p-2" />
              <button id="applyFilter" class="ml-auto bg-indigo-600 text-white px-3 py-2 rounded">Apply</button>
              <button id="clearFilter" class="ml-2 border px-3 py-2 rounded">Clear</button>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full text-left">
                <thead class="bg-gray-100"><tr><th class="p-2">Date</th><th class="p-2">Time</th><th class="p-2">Status</th><th class="p-2">Note</th></tr></thead>
                <tbody>
                  <tr class="border-b"><td class="p-2">2025-10-08</td><td class="p-2">07:45</td><td class="p-2">present</td><td class="p-2">On time</td></tr>
                  <tr class="border-b"><td class="p-2">2025-10-07</td><td class="p-2">07:58</td><td class="p-2">late</td><td class="p-2">Traffic</td></tr>
                  <tr class="border-b"><td class="p-2">2025-10-06</td><td class="p-2">07:50</td><td class="p-2">present</td><td class="p-2">-</td></tr>
                  <tr class="border-b"><td class="p-2">2025-10-05</td><td class="p-2">08:05</td><td class="p-2">late</td><td class="p-2">Appointment</td></tr>
                  <tr class="border-b"><td class="p-2">2025-10-04</td><td class="p-2">07:46</td><td class="p-2">present</td><td class="p-2">-</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <aside class="space-y-6">
          <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold mb-2">Quick Stats</h4>
            <div class="text-sm text-gray-600">Late: <span id="lateCount">0</span></div>
            <div class="text-sm text-gray-600">Excused: <span id="excusedCount">0</span></div>
            <div class="text-sm text-gray-600 mt-2">Last Check-in: <div id="lastCheckin" class="font-medium">--</div></div>
          </div>

          <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold mb-2">Actions</h4>
            <div class="flex flex-col gap-2">

              <a href="{{ route('student.attendance.checkin') }}" class="inline-flex items-center gap-2 justify-center bg-indigo-600 text-white px-3 py-2 rounded">
                <i class="bi bi-person-check-fill"></i>
                 Quick Check In</a>

              <button id="refreshBtn" class="inline-flex items-center gap-2 justify-center border px-3 py-2 rounded"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
            </div>
          </div>
        </aside>
      </div>
    </main>
  </div>

  <!-- Overlay for mobile sidebar -->
  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

</body>

</x-Student-sidebar>