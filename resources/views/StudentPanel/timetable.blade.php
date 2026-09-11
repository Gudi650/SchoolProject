<x-Student-sidebar>

    @php
      $hasSchedule = $scheduleByDay->flatten()->isNotEmpty();
      $allEntries = $hasSchedule ? $scheduleByDay->flatten() : collect();
      $totalSlots = $allEntries->count();
      $subjectCount = $allEntries->pluck('subject_id')->unique()->count();
      $todayName = now()->format('l');
      $todayCount = $hasSchedule ? ($scheduleByDay[$todayName] ?? collect())->count() : 0;
      $dayShort = ['Monday' => 'Mon', 'Tuesday' => 'Tue', 'Wednesday' => 'Wed', 'Thursday' => 'Thu', 'Friday' => 'Fri'];
    @endphp

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="flex items-center gap-3 relative pl-3 md:pl-4">
            <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
            <div>
              <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Timetable</h1>
              <p class="text-sm text-gray-500 mt-1">{{ $className ? $className . ' · weekly schedule' : 'Your weekly class schedule' }}</p>
            </div>
          </div>
        </header>

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg shadow-sm">No student profile linked to your account.</div>
        @elseif (!$hasSchedule)
          <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-10 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-indigo-50 text-indigo-600 mb-4">
              <i class="bi bi-calendar-x text-2xl"></i>
            </div>
            <p class="text-gray-600 font-medium">No timetable published yet</p>
            <p class="text-sm text-gray-500 mt-1">Your school will publish it once ready.</p>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-calendar-week"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">This Week</p>
                <p class="text-xl font-bold text-indigo-800">{{ $totalSlots }}</p>
                <p class="text-xs text-gray-500">class sessions</p>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-book"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Subjects</p>
                <p class="text-xl font-bold text-indigo-800">{{ $subjectCount }}</p>
                <p class="text-xs text-gray-500">unique subjects</p>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-calendar-day"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Today</p>
                <p class="text-xl font-bold text-indigo-800">{{ $todayCount }}</p>
                <p class="text-xs text-gray-500">{{ $todayName }}</p>
              </div>
            </div>
          </div>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 md:p-6">
            <h2 class="text-sm font-semibold text-indigo-800 mb-4 flex items-center gap-2">
              <i class="bi bi-grid-3x3-gap"></i> Week at a glance
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
              @foreach ($days as $day)
                @php $isToday = $day === $todayName; @endphp
                <div class="rounded-lg border {{ $isToday ? 'border-indigo-300 ring-1 ring-indigo-100' : 'border-gray-200' }} overflow-hidden">
                  <div class="px-3 py-2 {{ $isToday ? 'bg-indigo-100' : 'bg-indigo-50' }} flex items-center justify-between">
                    <span class="text-sm font-semibold text-indigo-800">{{ $dayShort[$day] ?? $day }}</span>
                    @if ($isToday)
                      <span class="text-[10px] uppercase tracking-wide font-semibold text-indigo-600 bg-white px-2 py-0.5 rounded-full">Today</span>
                    @endif
                  </div>
                  <ul class="p-2 space-y-2 min-h-[80px]">
                    @forelse ($scheduleByDay[$day] ?? [] as $entry)
                      <li class="p-3 bg-gray-50 rounded-md border border-gray-100 hover:border-indigo-200 transition-colors">
                        <div class="flex items-start gap-2">
                          <i class="bi bi-mortarboard text-indigo-600 mt-0.5"></i>
                          <div class="min-w-0 flex-1">
                            <p class="font-medium text-gray-900 text-sm truncate">{{ $entry->subject->subject_name ?? 'Subject' }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                              <i class="bi bi-clock"></i>
                              {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                            </p>
                            @if ($entry->teacher)
                              <p class="text-xs text-indigo-600 mt-1 truncate">{{ $entry->teacher->fname }} {{ $entry->teacher->lname }}</p>
                            @endif
                          </div>
                        </div>
                      </li>
                    @empty
                      <li class="text-xs text-gray-400 text-center py-4">No classes</li>
                    @endforelse
                  </ul>
                </div>
              @endforeach
            </div>
          </section>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-4 md:px-6 py-4 border-b border-gray-100">
              <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2">
                <i class="bi bi-list-ul"></i> Full schedule
              </h2>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full text-sm text-left">
                <thead class="bg-indigo-50 text-indigo-800 text-xs uppercase tracking-wide">
                  <tr>
                    <th class="px-4 py-3 font-semibold">Day</th>
                    <th class="px-4 py-3 font-semibold">Time</th>
                    <th class="px-4 py-3 font-semibold">Subject</th>
                    <th class="px-4 py-3 font-semibold">Teacher</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  @foreach ($days as $day)
                    @foreach ($scheduleByDay[$day] ?? [] as $entry)
                      <tr class="hover:bg-indigo-50/50 transition-colors {{ $day === $todayName ? 'bg-indigo-50/30' : '' }}">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $dayShort[$day] ?? $day }}</td>
                        <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                          {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                        </td>
                        <td class="px-4 py-3 text-gray-800">{{ $entry->subject->subject_name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $entry->teacher ? trim($entry->teacher->fname . ' ' . $entry->teacher->lname) : '-' }}</td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </section>
        @endif
      </div>
    </main>

</x-Student-sidebar>
