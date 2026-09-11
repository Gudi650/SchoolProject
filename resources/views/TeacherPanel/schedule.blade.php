<x-Teacher-sidebar>

      <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="md:flex md:items-center md:justify-between gap-4 relative pl-3 md:pl-4">
              <div class="flex items-center gap-3 min-w-0">
                <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
                <div>
                  <h1 class="text-lg sm:text-xl md:text-2xl font-extrabold text-indigo-800">My Schedule</h1>
                  <p class="mt-1 text-sm text-gray-500 hidden sm:block">Your weekly teaching timetable from the generated schedule.</p>
                </div>
              </div>
              <a href="{{ route('teacher.dashboard') }}" class="mt-3 md:mt-0 inline-flex items-center gap-2 h-9 px-4 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                <i class="bi bi-house-door"></i> Dashboard
              </a>
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
              <div class="p-3 bg-indigo-50 rounded-md flex items-center gap-3">
                <div class="p-2 bg-white rounded-full text-indigo-600"><i class="bi bi-calendar-event"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Classes This Week</div>
                  <div class="text-lg font-semibold text-indigo-800">{{ $weeklyClassCount }}</div>
                </div>
              </div>
              <div class="p-3 bg-white rounded-md flex items-center gap-3 shadow-sm">
                <div class="p-2 bg-indigo-100 rounded-full text-indigo-700"><i class="bi bi-book"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Subjects</div>
                  <div class="text-lg font-semibold text-indigo-800">{{ $subjectCount }}</div>
                </div>
              </div>
              <div class="p-3 bg-white rounded-md flex items-center gap-3 shadow-sm">
                <div class="p-2 bg-indigo-100 rounded-full text-indigo-700"><i class="bi bi-people"></i></div>
                <div>
                  <div class="text-sm text-gray-500">Appointments Today</div>
                  <div class="text-lg font-semibold text-indigo-800">—</div>
                </div>
              </div>
            </div>
          </header>

          <section class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Weekly Teaching Schedule</h2>

            @if ($weeklyClassCount === 0)
              <p class="text-gray-500 py-8 text-center">No classes scheduled yet. Generate a school timetable first.</p>
            @else
              <div class="hidden md:grid md:grid-cols-5 md:gap-3">
                @foreach ($days as $day)
                  <div class="min-h-[160px] bg-gray-50 rounded p-3 flex flex-col">
                    <div class="text-sm font-medium mb-2">{{ $day }}</div>
                    <div class="space-y-2">
                      @forelse ($scheduleByDay[$day] as $entry)
                        <div class="bg-indigo-100 text-indigo-700 p-2 rounded">
                          <div class="font-medium">{{ $entry->subject->subject_name ?? 'Subject' }}</div>
                          <div class="text-xs text-gray-600">
                            {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                          </div>
                          <div class="text-xs text-gray-500 mt-1">{{ $entry->classAvailable->name ?? 'Class' }}</div>
                        </div>
                      @empty
                        <div class="text-xs text-gray-400">No classes</div>
                      @endforelse
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="md:hidden space-y-3">
                @foreach ($days as $day)
                  @foreach ($scheduleByDay[$day] as $entry)
                    <div class="bg-white border rounded-lg p-3 shadow-sm">
                      <div class="font-medium">{{ $day }} — {{ $entry->subject->subject_name ?? 'Subject' }}</div>
                      <div class="text-sm text-gray-600 mt-1">
                        {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                        · {{ $entry->classAvailable->name ?? 'Class' }}
                      </div>
                    </div>
                  @endforeach
                @endforeach
              </div>
            @endif
          </section>

          <aside class="mt-6 bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold mb-2">Appointments</h3>
            <p class="text-sm text-gray-500">Appointment scheduling coming soon.</p>
          </aside>
        </div>
      </main>

</x-Teacher-sidebar>
