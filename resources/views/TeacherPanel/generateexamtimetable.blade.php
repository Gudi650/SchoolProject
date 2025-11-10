<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <header class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-6 rounded shadow mb-8 gap-4">
          <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
            <div>
              <h1 class="text-3xl md:text-4xl font-extrabold text-indigo-700 tracking-tight leading-tight drop-shadow-sm">Generate Exam Timetable</h1>
              <p class="text-base md:text-lg text-gray-500 mt-1">Schedule exams per class and assign invigilators. Preview and export exam timetables.</p>
            </div>
          </div>
        </header>

        <section class="bg-white p-6 rounded shadow mb-8">
          <h2 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="bi bi-list-check"></i> Add Exam Session</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
              <label for="examClass" class="block text-sm font-medium text-gray-700 mb-1">Class</label>
              <select id="examClass" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Class</option>
                <option>Grade 1</option>
                <option>Grade 2</option>
                <option>Grade 3</option>
                <option>Grade 4</option>
                <option>Grade 5</option>
              </select>
            </div>
            <div>
              <label for="examSubject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
              <select id="examSubject" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Subject</option>
                <option>Mathematics</option>
                <option>English</option>
                <option>Science</option>
                <option>Social Studies</option>
              </select>
            </div>
            <div>
              <label for="examDate" class="block text-sm font-medium text-gray-700 mb-1">Date & Time</label>
              <input id="examDate" type="datetime-local" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>
            <div>
              <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (mins)</label>
              <input id="duration" type="number" min="10" max="480" placeholder="e.g. 90" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>
            <div>
              <label for="invigilator" class="block text-sm font-medium text-gray-700 mb-1">Invigilator</label>
              <select id="invigilator" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Invigilator</option>
                <option>Mr. Smith</option>
                <option>Ms. Johnson</option>
                <option>Mrs. Lee</option>
              </select>
            </div>
            <div class="md:col-span-3 flex gap-3">
              <button id="addExamBtn" disabled class="bg-gray-300 text-gray-600 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto cursor-not-allowed">Add Exam</button>
              <button id="clearForm" disabled class="bg-gray-300 text-gray-600 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto cursor-not-allowed">Clear</button>
            </div>
          </div>
        </section>

        <section class="bg-white p-6 rounded shadow mb-8">
          <h2 class="text-xl font-bold mb-4 text-indigo-700 flex items-center gap-2"><i class="bi bi-gear-wide-connected"></i> Generation Conditions</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Exams Per Day</label>
              <input id="conds_examsPerDay" type="number" min="1" max="4" value="2" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">How many exam slots per class per day.</span>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Exam Duration (mins)</label>
              <input id="conds_duration" type="number" min="10" max="480" value="120" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Custom Exam Times (comma separated, 24h)</label>
              <input id="conds_times" type="text" value="09:00,13:00" placeholder="e.g. 09:00,13:00" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">Matches number of exams per day.</span>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">No-Exam Days (comma separated)</label>
              <input id="conds_noDays" type="text" placeholder="e.g. Friday" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">Days to exclude (e.g., Friday or Saturday).</span>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Max Invigilator Assignments Per Day</label>
              <input id="conds_maxInvPerDay" type="number" min="1" max="10" value="2" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">Prevent overbooking invigilators.</span>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
              <input id="conds_startDate" type="date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>
          </div>
          <h2 class="text-xl font-bold mb-4 text-indigo-700 flex items-center gap-2"><i class="bi bi-calendar3"></i> Exam Timetable Preview</h2>
          <div id="examList" class="space-y-6">
            <!-- Hard-coded per-class schedules (static, frontend-only) -->

            <!-- Grade 1 -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 1</span>
              </div>
              <table class="w-full table-fixed">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Period</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Monday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Tuesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Wednesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Thursday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Friday</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">09:00 - 10:00</td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Mathematics</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Science</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Art</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Mathematics</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Science</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">13:00 - 14:00</td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">14:00 - 15:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Grade 2 -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 2</span>
              </div>
              <table class="w-full table-fixed">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Period</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Monday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Tuesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Wednesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Thursday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Friday</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">09:00 - 10:00</td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">English</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Social Studies</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Physical Education</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">13:00 - 14:00</td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Science</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Science</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">14:00 - 15:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Grade 3 -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 3</span>
              </div>
              <table class="w-full table-fixed">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Period</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Monday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Tuesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Wednesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Thursday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Friday</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">09:00 - 10:00</td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Science</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mrs. Lee · 09:00</div></td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Art</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mrs. Lee · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Mrs. Lee · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Science</div><div class="text-xs text-gray-500">Mrs. Lee · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Mrs. Lee · 09:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">13:00 - 14:00</td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Mrs. Lee · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mrs. Lee · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Mrs. Lee · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Mrs. Lee · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mrs. Lee · 13:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">14:00 - 15:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Grade 4 -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 4</span>
              </div>
              <table class="w-full table-fixed">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Period</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Monday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Tuesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Wednesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Thursday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Friday</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">09:00 - 10:00</td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Social Studies</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Mr. Smith · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mr. Smith · 09:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">13:00 - 14:00</td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">English</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Mr. Smith · 13:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">14:00 - 15:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Grade 5 -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 5</span>
              </div>
              <table class="min-w-full w-full table-fixed">
                <thead class="bg-indigo-50">
                  <tr>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Period</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Monday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Tuesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Wednesday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Thursday</th>
                    <th class="px-2 py-2 text-xs font-bold text-gray-700">Friday</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">09:00 - 10:00</td>
                    <td class="px-2 py-2 align-top"><div class="text-sm font-medium whitespace-normal break-words">Art</div><div class="text-xs sm:text-sm text-gray-500 whitespace-normal break-words">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Science</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Ms. Johnson · 09:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">13:00 - 14:00</td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Physical Education</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Social Studies</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Art</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                    <td class="px-2 py-2"><div class="text-sm font-medium">Mathematics</div><div class="text-xs text-gray-500">Ms. Johnson · 13:00</div></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">14:00 - 15:00</td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                    <td class="px-2 py-2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
          <div class="flex flex-col md:flex-row md:justify-between gap-4 mt-6">
              <button id="autoGenerateAll" disabled class="bg-gray-400 text-white px-6 py-2 rounded cursor-not-allowed" title="Schedule is shown automatically">Schedule shown automatically</button>
            <div class="flex gap-3">
              <button id="generateExams" disabled class="bg-gray-300 text-gray-600 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto flex items-center gap-2 justify-center cursor-not-allowed"><i class="bi bi-download"></i> Export Exam Timetables</button>
              <button id="printExams" onclick="window.print()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto flex items-center gap-2 justify-center"><i class="bi bi-printer"></i> Print</button>
            </div>
          </div>
        </section>
      </main>

</x-Teacher-sidebar>    