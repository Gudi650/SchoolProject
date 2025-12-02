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
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">
                    Generate Timetable
                  </h1>

                  <p class="text-sm text-gray-500 mt-1">
                    Create a subject timetable for each class, assigning teachers to subjects and periods. Preview and export your curriculum plan.
                  </p>

                </div>
              </div>
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <div class="flex items-center gap-3 hero-content">
                <!-- placeholder for right-side actions -->
              </div>
            </div>
          </header>
        <section class="bg-white p-6 rounded shadow mb-8">
          <h2 class="text-lg font-bold text-indigo-700 mb-4 flex items-center gap-2"><i class="bi bi-sliders"></i>
             Timetable Conditions & Preferences
            </h2>

          <form 
          action = "{{ route('teacher.timetableconditions.submit') }}"
          method = "POST"
          class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">

          @csrf

            <div>
              <label for="prioritySubjects" class="block text-sm font-medium text-gray-700 mb-1">Subjects to Prioritize in the Morning</label>
              <select id="prioritySubjects" 
              multiple class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
              name="priority_subjects[]">

              <!--check if subjects variable is passed from controller-->
                @if (isset($subjects) && $subjects->isNotEmpty() )
                  
                  <!--loop through subjects and create options-->
                  @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                  @endforeach

                @endif

              </select>
              <span class="text-xs text-gray-400">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</span>
            </div>

            <div>
              <label for="breaks" class="block text-sm font-medium text-gray-700 mb-1">
                Break Times (e.g. 10:00-10:20, 12:00-12:30)
              </label>

              <input id="breaks" type="text" 
              name="break_times"
              placeholder="e.g. 10:00-10:20, 12:00-12:30" 
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">
                Separate multiple breaks with commas.
              </span>

            </div>

            <div>
              <label for="classTimes" class="block text-sm font-medium text-gray-700 mb-1">Class Start & End Times</label>
              
              <input id="classTimes" 
              name = "class_times"
              type="text" 
              placeholder="e.g. 09:00 - 15:00" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            </div>

            <div>
              <label for="exceptions" class="block text-sm font-medium text-gray-700 mb-1">Day Exceptions (e.g. Friday ends early)</label>

              <input id="exceptions" type="text" placeholder="e.g. Friday: 09:00 - 12:00" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />

              <span class="text-xs text-gray-400">
                Specify any day with different times or fewer periods.
              </span>

            </div>
            <div>

              <label for="periodsPerDay" class="block text-sm font-medium text-gray-700 mb-1">
                Periods Per Day
              </label>


              <input id="periodsPerDay" 
              type="number" 
              name="PeriodPerDay"
              min="1" max="10" 
              placeholder="e.g. 6" 
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />

            </div>
            <div>
              <label for="periodsExceptions" class="block text-sm font-medium text-gray-700 mb-1">Periods Per Day Exceptions</label>

              <input id="periodsExceptions" type="text" placeholder="e.g. Friday: 4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">
                Specify if any day has fewer periods.
              </span>

            </div>

            <div class="md:col-span-2">
              <label for="diffTimetableClasses" class="block text-sm font-medium text-gray-700 mb-1">
                Classes with a Different Timetable
              </label>

              <input id="diffTimetableClasses" type="text" placeholder="e.g. Grade 3, Grade 5" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 mb-2" />

              <span class="text-xs text-gray-400">
                List classes that have a different timetable from the rest (comma separated).
              </span>
            </div>

            <div class="md:col-span-2">

              <label for="diffTimetableTimes" class="block text-sm font-medium text-gray-700 mb-1">
                Custom Start & End Times for These Classes
              </label>

              <input id="diffTimetableTimes" 
              type="text" 
              placeholder="e.g. Grade 3: 10:00 - 14:00, Grade 5: 08:30 - 12:30" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 mb-2" />
              <span class="text-xs text-gray-400">
                Specify custom times for each class as needed.
              </span>

            </div>

            <div class="md:col-span-2">
              <label for="extraCurricular" class="block text-sm font-medium text-gray-700 mb-1">Extra Curriculum Activities</label>

              <input id="extraCurricular" type="text" placeholder="e.g. Sports, Music Club, Debate" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 mb-2" />
              <span class="text-xs text-gray-400">
                List any extra curriculum activities (comma separated).
              </span>

            </div>

            <div class="md:col-span-2">

              <label for="extraCurricularTimes" class="block text-sm font-medium text-gray-700 mb-1">
                Start & End Times for Extra Curriculum Activities
              </label>

              <input id="extraCurricularTimes" type="text" placeholder="e.g. Sports: Friday 14:00-15:00, Music Club: Wednesday 13:00-14:00" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
              <span class="text-xs text-gray-400">
                Specify times for each activity as needed.
              </span>
            </div>

            <div class="flex justify-end mt-4">

              <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded shadow transition flex items-center gap-2 text-lg">
                <i class="bi bi-gear"></i> Generate Timetable
              </button>
            </div>

          </form>

        </section>
          <form class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
              <label for="classSelect" class="block text-sm font-medium text-gray-700 mb-1">Class</label>
              <select id="classSelect" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Class</option>
                <option value="Grade 1">Grade 1</option>
                <option value="Grade 2">Grade 2</option>
                <option value="Grade 3">Grade 3</option>
                <option value="Grade 4">Grade 4</option>
                <option value="Grade 5">Grade 5</option>
              </select>
            </div>
            <div>
              <label for="subjectSelect" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
              <select id="subjectSelect" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Subject</option>
                <option value="Mathematics">Mathematics</option>
                <option value="English">English</option>
                <option value="Science">Science</option>
                <option value="Social Studies">Social Studies</option>
                <option value="Art">Art</option>
                <option value="Physical Education">Physical Education</option>
              </select>
            </div>
            <div>
              <label for="teacherSelect" class="block text-sm font-medium text-gray-700 mb-1">Teacher</label>
              <select id="teacherSelect" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <option value="">Select Teacher</option>
                <option value="Mr. Smith">Mr. Smith</option>
                <option value="Ms. Johnson">Ms. Johnson</option>
                <option value="Mrs. Lee">Mrs. Lee</option>
                <option value="Mr. Brown">Mr. Brown</option>
                <option value="Ms. Patel">Ms. Patel</option>
              </select>
            </div>
            <div class="md:col-span-3 flex gap-3 mt-2">
              <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto">Add to Timetable</button>
              <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto">Reset</button>
            </div>
          </form>
        </section>
        <section class="bg-white p-6 rounded shadow">
          <h2 class="text-xl font-bold mb-6 text-indigo-700 flex items-center gap-2"><i class="bi bi-table"></i> Weekly Timetables for All Classes</h2>
          <div class="flex flex-col gap-8">
            <!-- Example for 3 classes, you can add more as needed -->
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 1</span>
              </div>
              <table class="min-w-full table-auto">
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
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                  </tr>
                  <tr class="bg-white">
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Physical Ed.<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 2</span>
              </div>
              <table class="min-w-full table-auto">
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
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                    <td class="px-2 py-2">Physical Ed.<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                  </tr>
                  <tr class="bg-white">
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-x-auto bg-gray-50">
              <div class="bg-indigo-100 px-4 py-2 rounded-t-lg flex items-center gap-2">
                <i class="bi bi-journal-bookmark text-indigo-600"></i>
                <span class="font-semibold text-indigo-700">Grade 3</span>
              </div>
              <table class="min-w-full table-auto">
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
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                  </tr>
                  <tr class="bg-white">
                    <td class="px-2 py-2 font-semibold text-gray-600">10:00 - 11:00</td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                    <td class="px-2 py-2">Mathematics<br><span class="text-xs text-gray-500">Mr. Smith</span></td>
                  </tr>
                  <tr>
                    <td class="px-2 py-2 font-semibold text-gray-600">11:00 - 12:00</td>
                    <td class="px-2 py-2">English<br><span class="text-xs text-gray-500">Ms. Johnson</span></td>
                    <td class="px-2 py-2">Social Studies<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                    <td class="px-2 py-2">Physical Ed.<br><span class="text-xs text-gray-500">Mr. Brown</span></td>
                    <td class="px-2 py-2">Science<br><span class="text-xs text-gray-500">Mrs. Lee</span></td>
                    <td class="px-2 py-2">Art<br><span class="text-xs text-gray-500">Ms. Patel</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="flex flex-col md:flex-row md:justify-between gap-4 mt-8">
            <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto flex items-center gap-2 justify-center"><i class="bi bi-download"></i> Export All Timetables</button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded shadow transition w-full md:w-auto flex items-center gap-2 justify-center"><i class="bi bi-printer"></i> Print All</button>
          </div>
        </section>
      </main>

</x-Teacher-sidebar>