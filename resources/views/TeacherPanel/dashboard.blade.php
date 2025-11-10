<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <!-- Hero / Summary (card with subtle indigo accent) -->
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <!-- left accent stripe matching the toggle color (darker) -->
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
              <!-- ensure content sits above accent on small screens -->
              <style> .hero-content { position: relative; z-index: 10; } </style>

              <!-- Left: heading (with mobile sidebar toggle) -->
              <div class="flex items-center gap-3 hero-content">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>

                <h1 class="text-base sm:text-xl md:text-2xl font-bold text-indigo-800">
                  Welcome back, Teacher
                </h1>
              </div>

              

              <!-- Right: date + Profile button aligned to far right -->
              <div class="flex items-center gap-3 hero-content">
                <div class="text-sm text-gray-500 text-right">
                  <div class="uppercase tracking-wide text-xs text-gray-400">Today</div>
                  <div class="font-medium">Nov 5, 2025</div>
                </div>
                <a href="profile.html" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300"> <i class="bi bi-person-circle"></i> Profile</a>
              </div>
            </div>
          </header>

          <!-- KPI cards -->
          <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-500">Total Students</p>
                <p class="mt-1 text-2xl font-semibold">1,248</p>
              </div>
              <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">👩‍🎓</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-500">Active Classes</p>
                <p class="mt-1 text-2xl font-semibold">6</p>
              </div>
              <div class="bg-green-50 text-green-600 p-3 rounded-full">📚</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-500">Upcoming Exams</p>
                <p class="mt-1 text-2xl font-semibold">3</p>
              </div>
              <div class="bg-yellow-50 text-yellow-700 p-3 rounded-full">📝</div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-500">Announcements</p>
                <p class="mt-1 text-2xl font-semibold">8</p>
              </div>
              <div class="bg-indigo-50 text-indigo-700 p-3 rounded-full">📣</div>
            </div>
          </section>

          <!-- Quick actions + Recent -->
          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold flex items-center gap-3 text-indigo-700">
                  <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span>
                  <span>Recent Activity</span>
                </h3>
                <div class="flex items-center gap-2">
                  <a href="./announcements.html" class="text-sm text-indigo-600">View all</a>
                </div>
              </div>
              <ul class="space-y-3">
                <li class="p-3 border border-gray-100 rounded-md flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-700 flex items-center justify-center font-semibold">PT</div>
                  <div class="flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="font-medium">Parent-Teacher Meeting</h4>
                      <div class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">New</div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Sep 10 · Hall A</p>
                  </div>
                </li>
                <li class="p-3 border border-gray-100 rounded-md flex items-start gap-4">
                  <div class="w-10 h-10 rounded-lg bg-yellow-50 text-yellow-700 flex items-center justify-center font-semibold">EX</div>
                  <div class="flex-1">
                    <div class="flex items-center justify-between">
                      <h4 class="font-medium">Exam Schedules Posted</h4>
                      <div class="text-xs px-2 py-1 rounded-full bg-indigo-100 text-indigo-700">Today</div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Sep 3 · Portal</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
              <div class="grid grid-cols-1 gap-3">
                <a href="./post_results.html" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm"><i class="bi bi-journal-plus"></i> Post Results</a>
                <a href="./generate_timetable.html" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-100 hover:bg-gray-50"><i class="bi bi-table"></i> Generate Timetable</a>
                <a href="./announcements.html" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-100 hover:bg-gray-50"><i class="bi bi-megaphone"></i> New Announcement</a>
              </div>
            </div>
          </section>

          <!-- Bottom section: Exams + Assignments -->
          <!-- Extra details: Attendance, Messages, Today's schedule -->
          <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-3">Attendance Summary</h3>
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-500">Today Present</p>
                  <p class="mt-1 text-2xl font-semibold">112 / 120</p>
                </div>
                <div class="text-sm text-gray-500 text-right">
                  <div>Attendance Rate</div>
                  <div class="mt-1 text-2xl font-semibold">93%</div>
                </div>
              </div>
              <div class="mt-4 h-2 bg-gray-100 rounded overflow-hidden">
                <div class="h-2 bg-green-400 rounded" style="width:93%"></div>
              </div>
              <p class="text-xs text-gray-400 mt-3">Last updated: 10 minutes ago</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-3">Recent Messages</h3>
              <ul class="space-y-3">
                <li class="flex items-start gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center">PT</div>
                  <div>
                    <div class="text-sm font-medium">Parent - Julia</div>
                    <div class="text-xs text-gray-500">Can we reschedule the meeting?</div>
                  </div>
                </li>
                <li class="flex items-start gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center">AD</div>
                  <div>
                    <div class="text-sm font-medium">Admin - Derek</div>
                    <div class="text-xs text-gray-500">New seating plan uploaded.</div>
                  </div>
                </li>
              </ul>
              <a href="./announcements.html" class="mt-4 inline-block text-sm text-indigo-600">View all messages</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-3">Today's Schedule</h3>
              <div class="overflow-x-auto bg-white rounded-md border border-gray-100">
                <table class="min-w-full text-sm">
                  <thead class="bg-gradient-to-r from-indigo-50 to-white">
                    <tr>
                      <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600">Time</th>
                      <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600">Class</th>
                      <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600">Details</th>
                      <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600">Room</th>
                      <th class="px-3 py-3 text-right text-xs font-semibold text-indigo-600">Action</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y bg-white">
                    <tr class="hover:bg-indigo-50">
                      <td class="px-3 py-3 align-top font-semibold text-gray-800">09:00 — 10:00</td>
                      <td class="px-3 py-3 align-top">
                        <div class="flex items-center gap-2">
                          <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center">M</div>
                          <div class="font-medium">Mathematics</div>
                        </div>
                      </td>
                      <td class="px-3 py-3 align-top text-gray-500">Grade 10</td>
                      <td class="px-3 py-3 align-top text-gray-500">Room 12</td>
                      <td class="px-3 py-3 align-top text-right">
                        <span class="inline-flex items-center gap-2 mr-3 px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">Confirmed</span>
                        <a href="./view_schedule.html" class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700"><i class="bi bi-calendar-week"></i> View</a>
                      </td>
                    </tr>
                    <tr class="hover:bg-indigo-50">
                      <td class="px-3 py-3 align-top font-semibold text-gray-800">11:00 — 12:00</td>
                      <td class="px-3 py-3 align-top">
                        <div class="flex items-center gap-2">
                          <div class="w-8 h-8 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center">S</div>
                          <div class="font-medium">Science</div>
                        </div>
                      </td>
                      <td class="px-3 py-3 align-top text-gray-500">Grade 9 (Lab)</td>
                      <td class="px-3 py-3 align-top text-gray-500">Lab 3</td>
                      <td class="px-3 py-3 align-top text-right">
                        <span class="inline-flex items-center gap-2 mr-3 px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs">Lab</span>
                        <a href="./view_schedule.html" class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700"><i class="bi bi-calendar-week"></i> View</a>
                      </td>
                    </tr>
                    <tr class="hover:bg-indigo-50">
                      <td class="px-3 py-3 align-top font-semibold text-gray-800">14:00 — 15:00</td>
                      <td class="px-3 py-3 align-top">
                        <div class="flex items-center gap-2">
                          <div class="w-8 h-8 bg-pink-100 text-pink-700 rounded-full flex items-center justify-center">P</div>
                          <div class="font-medium">Physics</div>
                        </div>
                      </td>
                      <td class="px-3 py-3 align-top text-gray-500">Class 3</td>
                      <td class="px-3 py-3 align-top text-gray-500">Room 7</td>
                      <td class="px-3 py-3 align-top text-right">
                        <span class="inline-flex items-center gap-2 mr-3 px-2 py-1 rounded-full bg-gray-100 text-gray-700 text-xs">Scheduled</span>
                        <a href="./view_schedule.html" class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700"><i class="bi bi-calendar-week"></i> View</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <a href="./view_schedule.html" class="mt-4 inline-block text-sm text-indigo-600">Open full schedule</a>
            </div>
          </section>

          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold flex items-center gap-3 text-indigo-700">
                  <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span>
                  <span>Upcoming Exams</span>
                </h3>
                <a href="./post_results.html" class="text-sm text-indigo-600">Manage</a>
              </div>
              <div class="space-y-4">
                <div class="p-3 border border-gray-100 rounded-md flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-md bg-indigo-50 flex items-center justify-center text-indigo-700 font-semibold">M</div>
                    <div>
                      <p class="font-medium">Mathematics — Grade 10</p>
                      <p class="text-sm text-gray-500">Oct 21 · 09:00 AM</p>
                    </div>
                  </div>
                  <div class="text-sm text-gray-400">Room 12</div>
                </div>

                <div class="p-3 border border-gray-100 rounded-md flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-md bg-yellow-50 flex items-center justify-center text-yellow-700 font-semibold">S</div>
                    <div>
                      <p class="font-medium">Science — Grade 9</p>
                      <p class="text-sm text-gray-500">Oct 24 · 10:00 AM</p>
                    </div>
                  </div>
                  <div class="text-sm text-gray-400">Lab 3</div>
                </div>
              </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4 flex items-center gap-3 text-indigo-700">
                <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span>
                <span>Your Assignments</span>
              </h3>
              <div class="space-y-3">
                <div class="p-3 border border-gray-100 rounded-md">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center">3</div>
                      <div>
                        <div class="text-sm font-medium">Class 3</div>
                        <div class="text-xs text-gray-500">Physics, Mathematics</div>
                      </div>
                    </div>
                    <div class="text-xs text-indigo-600 font-medium">Primary</div>
                  </div>
                </div>
                <div class="p-3 border border-gray-100 rounded-md">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 rounded-full bg-pink-50 text-pink-700 flex items-center justify-center">5</div>
                      <div>
                        <div class="text-sm font-medium">Class 5</div>
                        <div class="text-xs text-gray-500">Biology</div>
                      </div>
                    </div>
                    <div class="text-xs text-indigo-600 font-medium">Secondary</div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
    </div>

</x-Teacher-sidebar>