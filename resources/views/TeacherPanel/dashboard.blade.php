<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
              <div class="flex items-center gap-3">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded">
                  <i class="bi bi-list"></i>
                </button>
                <h1 class="text-base sm:text-xl md:text-2xl font-bold text-indigo-800">
                  Welcome back{{ $teacher ? ', ' . trim($teacher->fname . ' ' . $teacher->lname) : '' }}
                </h1>
              </div>
              <div class="flex items-center gap-3">
                <div class="text-sm text-gray-500 text-right">
                  <div class="uppercase tracking-wide text-xs text-gray-400">Today</div>
                  <div class="font-medium">{{ now()->format('M j, Y') }}</div>
                </div>
                <a href="{{ route('teacher.profile') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600">
                  <i class="bi bi-person-circle"></i> Profile
                </a>
              </div>
            </div>
          </header>

          @if(!$teacher)
            <div class="bg-white p-8 rounded-lg shadow-sm text-center text-gray-500">Teacher profile not found.</div>
          @else
          <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div><p class="text-sm text-gray-500">Total Students</p><p class="mt-1 text-2xl font-semibold">{{ $stats['students'] }}</p></div>
              <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">👩‍🎓</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div><p class="text-sm text-gray-500">My Classes</p><p class="mt-1 text-2xl font-semibold">{{ $stats['classes'] }}</p></div>
              <div class="bg-green-50 text-green-600 p-3 rounded-full">📚</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div><p class="text-sm text-gray-500">My Assignments</p><p class="mt-1 text-2xl font-semibold">{{ $stats['assignments'] }}</p></div>
              <div class="bg-yellow-50 text-yellow-700 p-3 rounded-full">📝</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
              <div><p class="text-sm text-gray-500">Announcements</p><p class="mt-1 text-2xl font-semibold">{{ $stats['announcements'] }}</p></div>
              <div class="bg-indigo-50 text-indigo-700 p-3 rounded-full">📣</div>
            </div>
          </section>

          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-indigo-700">Recent Announcements</h3>
                <a href="{{ route('teacher.announcements') }}" class="text-sm text-indigo-600">View all</a>
              </div>
              @forelse($recentAnnouncements as $item)
                <div class="p-3 border border-gray-100 rounded-md mb-3">
                  <h4 class="font-medium">{{ $item->title }}</h4>
                  <p class="text-sm text-gray-500 mt-1">{{ $item->created_at->format('M d, Y') }}</p>
                </div>
              @empty
                <p class="text-sm text-gray-500">No announcements yet.</p>
              @endforelse
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
              <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('teacher.postresults') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm"><i class="bi bi-journal-plus"></i> Post Results</a>
                <a href="{{ route('teacher.generatedtimetable.view') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-100 hover:bg-gray-50"><i class="bi bi-table"></i> Generate Timetable</a>
                <a href="{{ route('teacher.announcements') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-100 hover:bg-gray-50"><i class="bi bi-megaphone"></i> Announcements</a>
              </div>
            </div>
          </section>

          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-indigo-700">Today's Schedule</h3>
                <a href="{{ route('teacher.schedule') }}" class="text-sm text-indigo-600">Full schedule</a>
              </div>
              @forelse($todaySchedule as $slot)
                <div class="p-3 border border-gray-100 rounded-md mb-3 flex justify-between">
                  <div>
                    <p class="font-medium">{{ $slot->subject->name ?? 'Subject' }}</p>
                    <p class="text-sm text-gray-500">{{ $slot->classAvailable->name ?? 'Class' }}</p>
                  </div>
                  <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}</p>
                </div>
              @empty
                <p class="text-sm text-gray-500">No classes scheduled today.</p>
              @endforelse
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4 text-indigo-700">My Classes</h3>
              @forelse($assignedClasses as $classId => $rows)
                <div class="p-3 border border-gray-100 rounded-md mb-3">
                  <div class="text-sm font-medium">{{ $rows->first()->classAvailable->name ?? 'Class' }}</div>
                  <div class="text-xs text-gray-500">{{ $rows->pluck('availablesubject.name')->filter()->join(', ') }}</div>
                </div>
              @empty
                <p class="text-sm text-gray-500">No classes assigned.</p>
              @endforelse
            </div>
          </section>
          @endif
        </div>
      </main>

</x-Teacher-sidebar>
