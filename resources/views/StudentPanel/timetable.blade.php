<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
          <div>
            <h1 class="text-2xl font-semibold">Timetable</h1>
            <p class="text-sm text-gray-500">{{ $className ? $className . ' — weekly schedule' : 'Weekly schedule' }}</p>
          </div>
        </div>
      </header>

      @php $hasSchedule = $scheduleByDay->flatten()->isNotEmpty(); @endphp

      @if (!$student)
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
      @elseif (!$hasSchedule)
        <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
          <i class="bi bi-calendar-x text-4xl mb-3 block"></i>
          No timetable published yet. Your school admin will generate it.
        </div>
      @else
        <section class="bg-white rounded-lg shadow p-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach ($days as $day)
              <div class="p-3 rounded border bg-gray-50">
                <div class="font-semibold mb-2">{{ $day }}</div>
                <ul class="space-y-2 text-sm">
                  @forelse ($scheduleByDay[$day] ?? [] as $entry)
                    <li class="p-2 bg-white rounded shadow-sm">
                      <div class="font-medium">{{ $entry->subject->subject_name ?? 'Subject' }}</div>
                      <div class="text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                      </div>
                      @if ($entry->teacher)
                        <div class="text-xs text-indigo-600 mt-1">{{ $entry->teacher->fname }} {{ $entry->teacher->lname }}</div>
                      @endif
                    </li>
                  @empty
                    <li class="text-xs text-gray-400 p-2">No classes</li>
                  @endforelse
                </ul>
              </div>
            @endforeach
          </div>
        </section>

        <section class="mt-6 bg-white rounded-lg shadow overflow-x-auto">
          <table class="w-full text-left text-sm">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-3">Day</th>
                <th class="px-4 py-3">Time</th>
                <th class="px-4 py-3">Subject</th>
                <th class="px-4 py-3">Teacher</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($days as $day)
                @foreach ($scheduleByDay[$day] ?? [] as $entry)
                  <tr class="border-b">
                    <td class="px-4 py-3">{{ $day }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                      {{ \Carbon\Carbon::parse($entry->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($entry->end_time)->format('H:i') }}
                    </td>
                    <td class="px-4 py-3">{{ $entry->subject->subject_name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $entry->teacher ? trim($entry->teacher->fname . ' ' . $entry->teacher->lname) : '-' }}</td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </section>
      @endif
    </main>

</x-Student-sidebar>
