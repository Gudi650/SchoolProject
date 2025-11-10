<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10">
    <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <h1 class="text-2xl font-semibold">Timetable</h1>
          <div class="ml-3 text-sm text-gray-500">View and download your weekly or annual timetables</div>
        </div>
        <div class="flex items-center gap-2">
          <div class="inline-flex rounded-md shadow-sm" role="tablist" aria-label="View switch">
            <button id="viewWeekly" class="px-4 py-2 bg-white border rounded-l-md text-sm font-medium">Weekly</button>
            <button id="viewAnnual" class="px-4 py-2 bg-white border rounded-r-md text-sm font-medium">Annual</button>
          </div>
          <a id="downloadVisible" href="#" class="ml-3 inline-flex items-center gap-2 bg-indigo-600 text-white px-3 py-2 rounded text-sm"><i class="bi bi-download"></i> Download PDF</a>
        </div>
      </header>

      <!-- Weekly view grid -->
      <section id="weeklyView" class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="hidden sm:flex items-center justify-between mb-4">
          <div class="text-sm text-gray-600">Showing: Week of <span id="weekRange">2025-10-06 — 2025-10-12</span></div>
          <div class="flex items-center gap-2">
            <button id="prevWeek" class="px-3 py-1 border rounded">Prev</button>
            <button id="nextWeek" class="px-3 py-1 border rounded">Next</button>
          </div>
        </div>

        <!-- responsive grid: on small screens show cards by day; on larger screens show table-like grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
          <!-- Monday -->
          <div class="p-3 rounded border bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Monday</div>
              <div class="text-xs text-gray-500">6 Oct</div>
            </div>
            <ul class="space-y-2 text-sm">
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Mathematics</div><div class="text-xs text-gray-500">08:00 — 09:00 • Room 12</div></div><div class="text-xs text-indigo-600">J. Smith</div></li>
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">English</div><div class="text-xs text-gray-500">09:15 — 10:15 • Room 7</div></div><div class="text-xs text-indigo-600">A. Brown</div></li>
            </ul>
          </div>

          <!-- Tuesday -->
          <div class="p-3 rounded border bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Tuesday</div>
              <div class="text-xs text-gray-500">7 Oct</div>
            </div>
            <ul class="space-y-2 text-sm">
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Science</div><div class="text-xs text-gray-500">08:00 — 09:00 • Lab</div></div><div class="text-xs text-indigo-600">M. Green</div></li>
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">History</div><div class="text-xs text-gray-500">10:30 — 11:30 • Room 3</div></div><div class="text-xs text-indigo-600">L. King</div></li>
            </ul>
          </div>

          <!-- Wednesday -->
          <div class="p-3 rounded border bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Wednesday</div>
              <div class="text-xs text-gray-500">8 Oct</div>
            </div>
            <ul class="space-y-2 text-sm">
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Computer Lab</div><div class="text-xs text-gray-500">08:00 — 10:00 • IT Lab</div></div><div class="text-xs text-indigo-600">T. Lee</div></li>
            </ul>
          </div>

          <!-- Thursday -->
          <div class="p-3 rounded border bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Thursday</div>
              <div class="text-xs text-gray-500">9 Oct</div>
            </div>
            <ul class="space-y-2 text-sm">
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Mathematics</div><div class="text-xs text-gray-500">08:00 — 09:00 • Room 12</div></div><div class="text-xs text-indigo-600">J. Smith</div></li>
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Physical Education</div><div class="text-xs text-gray-500">11:00 — 12:00 • Sports Hall</div></div><div class="text-xs text-indigo-600">Coach</div></li>
            </ul>
          </div>

          <!-- Friday -->
          <div class="p-3 rounded border bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Friday</div>
              <div class="text-xs text-gray-500">10 Oct</div>
            </div>
            <ul class="space-y-2 text-sm">
              <li class="p-2 bg-white rounded shadow-sm flex items-center justify-between"><div><div class="font-medium">Art</div><div class="text-xs text-gray-500">09:00 — 10:00 • Art Room</div></div><div class="text-xs text-indigo-600">S. Cole</div></li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Annual view -->
      <section id="annualView" class="hidden bg-white rounded-lg shadow p-4">
        <div class="flex items-center justify-between mb-4">
          <div class="text-sm text-gray-600">Annual Timetable / Terms</div>
          <div class="text-sm text-gray-500">Download a full PDF per term</div>
        </div>

  <div class="flex flex-col gap-4">
          <div class="p-4 border rounded bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Term 1</div>
              <div class="text-xs text-gray-500">Jan — Mar</div>
            </div>
            <p class="text-sm text-gray-700 mb-3">Detailed Term 1 schedule: daily lessons, practical sessions and special activities with times and durations.</p>

            <div class="overflow-x-auto mb-3">
              <table class="w-full table-fixed text-sm">
                <thead>
                  <tr class="text-left text-gray-600">
                    <th class="px-3 py-2 w-28">Date / Range</th>
                    <th class="px-3 py-2 w-28">Time</th>
                    <th class="px-3 py-2 w-20">Duration</th>
                    <th class="px-3 py-2 w-2/5">Activity / Subject</th>
                    <th class="px-3 py-2 w-20 hidden sm:table-cell">Room</th>
                    <th class="px-3 py-2 w-28 hidden sm:table-cell">Teacher</th>
                    <th class="px-3 py-2 w-32 hidden sm:table-cell">Notes</th>
                  </tr>
                </thead>
                <tbody class="text-gray-800">
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-01-06</td>
                    <td class="px-3 py-2 whitespace-nowrap">08:00 — 09:00</td>
                    <td class="px-3 py-2">1h</td>
                    <td class="px-3 py-2 break-words">Mathematics — Algebra (Introduction to linear equations)</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Room 12</td>
                    <td class="px-3 py-2 hidden sm:table-cell">J. Smith</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Bring exercise book</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-01-06</td>
                    <td class="px-3 py-2 whitespace-nowrap">09:15 — 10:15</td>
                    <td class="px-3 py-2">1h</td>
                    <td class="px-3 py-2 break-words">English — Reading comprehension (Poetry)</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Room 7</td>
                    <td class="px-3 py-2 hidden sm:table-cell">A. Brown</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Read poem ahead</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-01-08 — 2025-01-10</td>
                    <td class="px-3 py-2 whitespace-nowrap">08:00 — 10:00</td>
                    <td class="px-3 py-2">2h</td>
                    <td class="px-3 py-2 break-words">Computer Lab — Practical: HTML/CSS basics</td>
                    <td class="px-3 py-2 hidden sm:table-cell">IT Lab</td>
                    <td class="px-3 py-2 hidden sm:table-cell">T. Lee</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Bring laptop if available</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <a href="data:application/pdf;base64,JVBERi0xLjQK..." download="timetable_term1.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download PDF</a>
          </div>

          <div class="p-4 border rounded bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Term 2</div>
              <div class="text-xs text-gray-500">Apr — Jun</div>
            </div>
            <p class="text-sm text-gray-700 mb-3">Detailed Term 2 schedule: lessons, laboratory sessions and assessments.</p>

            <div class="overflow-x-auto mb-3">
              <table class="w-full table-fixed text-sm">
                <thead>
                  <tr class="text-left text-gray-600">
                    <th class="px-3 py-2 w-28">Date / Range</th>
                    <th class="px-3 py-2 w-28">Time</th>
                    <th class="px-3 py-2 w-20">Duration</th>
                    <th class="px-3 py-2 w-2/5">Activity / Subject</th>
                    <th class="px-3 py-2 w-20 hidden sm:table-cell">Room</th>
                    <th class="px-3 py-2 w-28 hidden sm:table-cell">Teacher</th>
                    <th class="px-3 py-2 w-32 hidden sm:table-cell">Notes</th>
                  </tr>
                </thead>
                <tbody class="text-gray-800">
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-04-02</td>
                    <td class="px-3 py-2 whitespace-nowrap">08:00 — 09:00</td>
                    <td class="px-3 py-2">1h</td>
                    <td class="px-3 py-2 break-words">Science — Biology (Plant cells)</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Lab</td>
                    <td class="px-3 py-2 hidden sm:table-cell">M. Green</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Lab coat required</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-04-05</td>
                    <td class="px-3 py-2 whitespace-nowrap">10:30 — 11:30</td>
                    <td class="px-3 py-2">1h</td>
                    <td class="px-3 py-2 break-words">History — Early Civilizations</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Room 3</td>
                    <td class="px-3 py-2 hidden sm:table-cell">L. King</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Chapter 4 reading</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-05-12 — 2025-05-14</td>
                    <td class="px-3 py-2 whitespace-nowrap">09:00 — 12:00</td>
                    <td class="px-3 py-2">3h</td>
                    <td class="px-3 py-2 break-words">Practical Assessment — Science experiments</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Lab</td>
                    <td class="px-3 py-2 hidden sm:table-cell">M. Green</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Assessment: bring lab report</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <a href="data:application/pdf;base64,JVBERi0xLjQK..." download="timetable_term2.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download PDF</a>
          </div>

          <div class="p-4 border rounded bg-gray-50">
            <div class="flex items-center justify-between mb-2">
              <div class="font-semibold">Term 3</div>
              <div class="text-xs text-gray-500">Jul — Sep</div>
            </div>
            <p class="text-sm text-gray-700 mb-3">Detailed Term 3 schedule: revision sessions, projects and final activities.</p>

            <div class="overflow-x-auto mb-3">
              <table class="w-full table-fixed text-sm">
                <thead>
                  <tr class="text-left text-gray-600">
                    <th class="px-3 py-2 w-28">Date / Range</th>
                    <th class="px-3 py-2 w-28">Time</th>
                    <th class="px-3 py-2 w-20">Duration</th>
                    <th class="px-3 py-2 w-2/5">Activity / Subject</th>
                    <th class="px-3 py-2 w-20 hidden sm:table-cell">Room</th>
                    <th class="px-3 py-2 w-28 hidden sm:table-cell">Teacher</th>
                    <th class="px-3 py-2 w-32 hidden sm:table-cell">Notes</th>
                  </tr>
                </thead>
                <tbody class="text-gray-800">
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-07-07</td>
                    <td class="px-3 py-2 whitespace-nowrap">08:00 — 09:00</td>
                    <td class="px-3 py-2">1h</td>
                    <td class="px-3 py-2 break-words">Mathematics — Revision: Algebra & Geometry</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Room 12</td>
                    <td class="px-3 py-2 hidden sm:table-cell">J. Smith</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Bring past exam papers</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-08-15 — 2025-08-16</td>
                    <td class="px-3 py-2 whitespace-nowrap">10:00 — 13:00</td>
                    <td class="px-3 py-2">3h</td>
                    <td class="px-3 py-2 break-words">Project Presentations — Group projects (final)</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Hall</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Multiple</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Prepare slides (10 min each)</td>
                  </tr>
                  <tr class="bg-white border-t">
                    <td class="px-3 py-2">2025-09-01</td>
                    <td class="px-3 py-2 whitespace-nowrap">09:00 — 12:00</td>
                    <td class="px-3 py-2">3h</td>
                    <td class="px-3 py-2 break-words">Final Assessments — Mixed subjects</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Main Hall</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Examination Team</td>
                    <td class="px-3 py-2 hidden sm:table-cell">Arrive 30 min early</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <a href="data:application/pdf;base64,JVBERi0xLjQK..." download="timetable_term3.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download PDF</a>
          </div>
        </div>
      </section>

    </main>
  </div>

  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <script>

      // View switching
      const weekly = document.getElementById('weeklyView');
      const annual = document.getElementById('annualView');
      const btnW = document.getElementById('viewWeekly');
      const btnA = document.getElementById('viewAnnual');
      const downloadVisible = document.getElementById('downloadVisible');

      function showWeekly(){ weekly.classList.remove('hidden'); annual.classList.add('hidden'); btnW.classList.add('bg-indigo-600','text-white'); btnA.classList.remove('bg-indigo-600','text-white'); downloadVisible.href = 'data:text/plain;charset=utf-8,Weekly%20Timetable%20sample'; downloadVisible.setAttribute('download','timetable_weekly.txt'); }
      function showAnnual(){ annual.classList.remove('hidden'); weekly.classList.add('hidden'); btnA.classList.add('bg-indigo-600','text-white'); btnW.classList.remove('bg-indigo-600','text-white'); downloadVisible.href = 'data:application/pdf;base64,JVBERi0xLjQK...'; downloadVisible.setAttribute('download','timetable_annual.pdf'); }

      btnW.addEventListener('click', showWeekly);
      btnA.addEventListener('click', showAnnual);
      // default
      showWeekly();
    });
  </script>

</x-Student-sidebar>