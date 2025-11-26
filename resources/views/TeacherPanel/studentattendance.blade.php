<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
              <style> .hero-content { position: relative; z-index: 10; } </style>
              <div class="flex items-center gap-3 hero-content">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>
                <div>
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">Attendance — Records</h1>
                </div>
              </div>
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <div class="flex items-center gap-3 hero-content">
                <!-- Make both header action buttons identical in size for consistent layout -->

                <a id="exportCsv" href="data:text/csv;charset=utf-8,date,time,name,adm,status,note\n2025-10-08,07:45,John Doe,12345,present,On time" download="attendance.csv" class="inline-flex items-center justify-center gap-2 px-4 py-2 h-10 w-36 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                  <i class="bi bi-download"></i> 
                    Export CSV
                </a>

              </div>
            </div>
          </header>
        </div>

        <section class="bg-white p-4 rounded-lg shadow mb-6">
          <div class="md:flex md:items-center md:gap-4 mb-4">
            <div class="flex-1 flex items-center gap-3">

              <div class="relative flex-1">

                <!-- Moved search input here from Livewire component for better integration -->

                <livewire:search-bar  :students="$students" :classId="$classId" :schoolId="$schoolId" :school="$schoolId" />

              </div>

              <div class="hidden md:block text-sm text-gray-500">Showing <span id="resultCount">2</span> records</div>
            </div>

            <div class="mt-3 md:mt-0 flex items-center gap-2">
              <button data-filter="all" class="filter-chip bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-sm hover:bg-teal-50 hover:text-teal-700 transition-colors duration-150 cursor-pointer">
                All
              </button>

              <button data-filter="present" class="filter-chip border px-3 py-1 rounded-full text-sm hover:bg-teal-50 hover:text-teal-700 transition-colors duration-150 cursor-pointer">
                Present
              </button>

              <button data-filter="late" class="filter-chip border px-3 py-1 rounded-full text-sm hover:bg-teal-50 hover:text-teal-700 transition-colors duration-150 cursor-pointer">
                Late
              </button>

              <button data-filter="absent" class="filter-chip border px-3 py-1 rounded-full text-sm hover:bg-teal-50 hover:text-teal-700 transition-colors duration-150 cursor-pointer">
                Absent
              </button>

            </div>
          </div>

          <div class="overflow-x-auto max-w-full hidden sm:block">
            
            <livewire:student-attendance-table :classId="$classId" :schoolId="$schoolId" />

          </div>

          <!-- Mobile card list -->
          <div id="mobileList" class="sm:hidden space-y-3 mt-4">
            <article class="bg-white border rounded-lg p-3 shadow-sm" data-status="present">
              <div class="flex items-start justify-between">
                <div>
                  <div class="text-sm text-gray-500">2025-10-08 · 07:45</div>
                  <div class="font-medium">John Doe</div>
                  <div class="text-xs text-gray-500">Adm: 12345</div>
                </div>
                <div class="text-right">
                  <div><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Present</span></div>
                  <button class="edit-btn mt-3 inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50" data-record="1"><i class="bi bi-pencil-fill"></i><span class="ml-1">Edit</span></button>
                </div>
              </div>
              <div class="mt-2 text-sm text-gray-600">Note: On time</div>
            </article>

            <article class="bg-white border rounded-lg p-3 shadow-sm" data-status="late">
              <div class="flex items-start justify-between">
                <div>
                  <div class="text-sm text-gray-500">2025-10-07 · 07:58</div>
                  <div class="font-medium">Jane Smith</div>
                  <div class="text-xs text-gray-500">Adm: 12346</div>
                </div>
                <div class="text-right">
                  <div><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Late</span></div>
                  <button class="edit-btn mt-3 inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50" data-record="2"><i class="bi bi-pencil-fill"></i><span class="ml-1">Edit</span></button>
                </div>
              </div>
              <div class="mt-2 text-sm text-gray-600">Note: Traffic</div>
            </article>
          </div>
        </section>

        <section class="bg-white p-4 rounded-lg shadow">

          <h3 class="font-semibold mb-3">
            Quick Actions
          </h3>

          <div class="flex gap-2">

            <a href="{{ route('teacher.registerstudentattendance.view') }}" class="bg-indigo-600 text-white px-3 py-2 rounded inline-flex items-center gap-2">
                <i class="bi bi-person-plus"></i>
                 Register Attendance
            </a>

            <button id="refreshBtn" class="border px-3 py-2 rounded inline-flex items-center gap-2">
                <i class="bi bi-arrow-clockwise"></i> 
                    Refresh
            </button>

          </div>
        </section>
      </main>
    </div>

    <script>


    </script>

</x-Teacher-sidebar>