<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 relative pl-3 md:pl-4">
              <div class="flex items-center gap-3 min-w-0">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded">
                  <i class="bi bi-list"></i>
                </button>
                <div>
                  <h1 class="text-base sm:text-xl md:text-2xl font-bold text-indigo-800">
                    Welcome back{{ $teacher ? ', ' . trim($teacher->fname . ' ' . $teacher->lname) : '' }}
                  </h1>
                  <p class="mt-1 text-sm text-gray-500 hidden sm:block">Overview of your classes, schedule, and activity.</p>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <div class="text-sm text-gray-500 text-right hidden sm:block">
                  <div class="uppercase tracking-wide text-xs text-gray-400">Today</div>
                  <div class="font-medium">{{ now()->format('M j, Y') }}</div>
                </div>
                <a href="{{ route('teacher.profile') }}" class="inline-flex items-center gap-2 h-9 px-4 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                  <i class="bi bi-person-circle"></i> Profile
                </a>
              </div>
            </div>
          </header>

          @if(!$teacher)
            <div class="bg-white p-8 rounded-lg shadow-sm text-center text-gray-500">
              <i class="bi bi-person-x text-3xl text-gray-300 block mb-2"></i>
              Teacher profile not found.
            </div>
          @else
          <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @foreach([
              ['label' => 'Total Students', 'value' => $stats['students'], 'icon' => 'bi-people', 'bg' => 'bg-indigo-50', 'iconBg' => 'bg-white text-indigo-600'],
              ['label' => 'My Classes', 'value' => $stats['classes'], 'icon' => 'bi-book', 'bg' => 'bg-white shadow-sm', 'iconBg' => 'bg-indigo-100 text-indigo-700'],
              ['label' => 'My Assignments', 'value' => $stats['assignments'], 'icon' => 'bi-journal-text', 'bg' => 'bg-white shadow-sm', 'iconBg' => 'bg-indigo-100 text-indigo-700'],
              ['label' => 'Announcements', 'value' => $stats['announcements'], 'icon' => 'bi-megaphone', 'bg' => 'bg-white shadow-sm', 'iconBg' => 'bg-indigo-100 text-indigo-700'],
            ] as $kpi)
            <div class="p-3 {{ $kpi['bg'] }} rounded-lg flex items-center gap-3">
              <div class="p-2 {{ $kpi['iconBg'] }} rounded-full"><i class="bi {{ $kpi['icon'] }}"></i></div>
              <div>
                <div class="text-sm text-gray-500">{{ $kpi['label'] }}</div>
                <div class="text-lg font-semibold text-indigo-800">{{ $kpi['value'] }}</div>
              </div>
            </div>
            @endforeach
          </section>

          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-indigo-700 flex items-center gap-3">
                  <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span> Recent Announcements
                </h3>
                <a href="{{ route('teacher.announcements') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
              </div>
              @forelse($recentAnnouncements as $item)
                <div class="p-3 border border-gray-100 rounded-md mb-3 hover:bg-indigo-50/50 transition">
                  <h4 class="font-medium text-gray-800">{{ $item->title }}</h4>
                  <p class="text-sm text-gray-500 mt-1"><i class="bi bi-calendar3 mr-1"></i>{{ $item->created_at->format('M d, Y') }}</p>
                </div>
              @empty
                <p class="text-sm text-gray-500 text-center py-6"><i class="bi bi-megaphone text-gray-300 mr-1"></i> No announcements yet.</p>
              @endforelse
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4 text-indigo-700 flex items-center gap-3">
                <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span> Quick Actions
              </h3>
              <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('teacher.postresults') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm"><i class="bi bi-journal-plus"></i> Post Results</a>
                <a href="{{ route('teacher.generatedtimetable.view') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-200 hover:bg-gray-50 text-sm"><i class="bi bi-table"></i> Generate Timetable</a>
                <a href="{{ route('teacher.announcements') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-gray-200 hover:bg-gray-50 text-sm"><i class="bi bi-megaphone"></i> Announcements</a>
              </div>
            </div>
          </section>

          <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-indigo-700 flex items-center gap-3">
                  <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span> Today's Schedule
                </h3>
                <a href="{{ route('teacher.schedule') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Full schedule</a>
              </div>
              @forelse($todaySchedule as $slot)
                <div class="p-3 border border-gray-100 rounded-md mb-3 flex items-center justify-between hover:bg-indigo-50/50 transition">
                  <div class="flex items-center gap-3 min-w-0">
                    <span class="shrink-0 px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-700 rounded">
                      {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}
                    </span>
                    <div class="min-w-0">
                      <p class="font-medium text-gray-800 truncate">{{ $slot->subject->name ?? 'Subject' }}</p>
                      <p class="text-sm text-gray-500 truncate">{{ $slot->classAvailable->name ?? 'Class' }}</p>
                    </div>
                  </div>
                  <i class="bi bi-calendar-week text-indigo-400 shrink-0"></i>
                </div>
              @empty
                <p class="text-sm text-gray-500 text-center py-6"><i class="bi bi-calendar-x text-gray-300 mr-1"></i> No classes scheduled today.</p>
              @endforelse
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold mb-4 text-indigo-700 flex items-center gap-3">
                <span class="w-2 h-6 rounded bg-indigo-600 inline-block"></span> My Classes
              </h3>
              @forelse($assignedClasses as $rows)
                <div class="p-3 border border-gray-100 rounded-md mb-3 hover:bg-indigo-50/50 transition">
                  <div class="text-sm font-medium text-gray-800">{{ $rows->first()->classAvailable->name ?? 'Class' }}</div>
                  <div class="mt-1 flex flex-wrap gap-1">
                    @foreach($rows->pluck('availablesubject.name')->filter()->unique() as $subject)
                      <span class="text-xs px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded">{{ $subject }}</span>
                    @endforeach
                  </div>
                </div>
              @empty
                <p class="text-sm text-gray-500 text-center py-6"><i class="bi bi-book text-gray-300 mr-1"></i> No classes assigned.</p>
              @endforelse
            </div>
          </section>
          @endif
        </div>
      </main>

</x-Teacher-sidebar>
