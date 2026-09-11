<x-Student-sidebar>

    @php
      $className = $student?->classAvailables?->name ?? 'N/A';
      $csv = "date,status\n";
      foreach ($records as $r) {
          $csv .= $r->date . ',' . ($r->status == '1' ? 'present' : 'absent') . "\n";
      }
    @endphp

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 relative pl-3 md:pl-4">
            <div class="flex items-center gap-3">
              <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
              <div>
                <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Attendance Report</h1>
                <p class="text-sm text-gray-500 mt-1">Your attendance history</p>
              </div>
            </div>
            @if ($records->isNotEmpty())
              <a href="data:text/csv;charset=utf-8,{{ rawurlencode($csv) }}" download="attendance.csv" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded text-sm">
                <i class="bi bi-download"></i> Export CSV
              </a>
            @endif
          </div>
        </header>

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
        @else
          <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5 flex items-start gap-4">
            <div class="w-14 h-14 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xl font-semibold">
              {{ strtoupper(substr($student->fname, 0, 1)) }}
            </div>
            <div>
              <h2 class="text-lg font-semibold text-gray-900">{{ $student->fname }} {{ $student->lname }}</h2>
              <p class="text-sm text-gray-500">{{ $className }} · ID {{ $student->id }}</p>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Total Records</p>
              <p class="text-2xl font-bold text-indigo-800 mt-1">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Present</p>
              <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['present'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Absent</p>
              <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['absent'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Attendance %</p>
              <p class="text-2xl font-bold text-indigo-800 mt-1">{{ $stats['pct'] }}%</p>
            </div>
          </div>

          @if ($monthly->isNotEmpty())
            <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
              <h3 class="text-sm font-semibold text-indigo-800 mb-4">Monthly attendance %</h3>
              <div class="flex items-end gap-3 h-32">
                @foreach ($monthly as $month => $pct)
                  <div class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-indigo-100 rounded-t" style="height: {{ max($pct, 5) }}%"></div>
                    <div class="text-xs mt-2 text-gray-600">{{ $month }}</div>
                    <div class="text-xs text-indigo-600 font-medium">{{ $pct }}%</div>
                  </div>
                @endforeach
              </div>
            </section>
          @endif

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100">
              <h3 class="text-sm font-semibold text-indigo-800">Attendance log</h3>
            </div>
            @if ($records->isEmpty())
              <p class="p-8 text-center text-gray-500">No attendance records yet.</p>
            @else
              <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                  <thead class="bg-indigo-50 text-indigo-800">
                    <tr>
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Status</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100">
                    @foreach ($records as $record)
                      <tr class="hover:bg-indigo-50/50">
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                          @if ($record->status == '1')
                            <span class="text-xs font-semibold uppercase px-2 py-1 rounded-full bg-green-50 text-green-700">Present</span>
                          @else
                            <span class="text-xs font-semibold uppercase px-2 py-1 rounded-full bg-red-50 text-red-700">Absent</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </section>

          <div class="flex gap-3">
            <a href="{{ route('student.attendance.checkin') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded text-sm">
              <i class="bi bi-person-check-fill"></i> Check In
            </a>
          </div>
        @endif
      </div>
    </main>

</x-Student-sidebar>
