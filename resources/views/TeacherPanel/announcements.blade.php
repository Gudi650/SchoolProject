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
                  Announcements
                </h1>
              </div>

              <!-- Middle: supporting snapshot (hidden on extra-small screens) -->
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>

              <!-- Right: date + Profile button aligned to far right -->
              <div class="flex items-center gap-3 hero-content">
                <div class="text-sm text-gray-500 text-right">
                  <div class="uppercase tracking-wide text-xs text-gray-400">Today</div>
                  <div class="font-medium">Nov 5, 2025</div>
                </div>

                <a href="{{ route('teacher.profile') }}" 
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-sm hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                 <i class="bi bi-person-circle"></i>
                  Profile
                </a>
                
              </div>
            </div>
          </header>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <article class="bg-white p-4 rounded-md shadow-sm card" data-category="notice">
            <h3 class="font-semibold">Holiday Notice</h3>
            <p class="text-sm text-gray-500">School will be closed on Monday due to a public holiday.</p>
            <div class="text-xs text-gray-400 mt-2">Sep 1</div>
          </article>

          <article class="bg-white p-4 rounded-md shadow-sm card" data-category="reminder">
            <h3 class="font-semibold">PTM Reminder</h3>
            <p class="text-sm text-gray-500">Don't forget the Parent-Teacher meeting next Friday.</p>
            <div class="text-xs text-gray-400 mt-2">Aug 28</div>
          </article>
        </section>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
          <div class="bg-white w-full max-w-lg rounded-md p-6">
            <h2 class="text-lg font-semibold mb-3">Create Announcement</h2>
            <form id="annForm" class="space-y-3">
              <div>
                <label class="text-sm">Title</label>
                <input required class="w-full border px-3 py-2 rounded-md" />
              </div>
              <div>
                <label class="text-sm">Message</label>
                <textarea required class="w-full border px-3 py-2 rounded-md"></textarea>
              </div>
              <div class="flex justify-end gap-2">
                <button type="button" id="cancelBtn" class="px-4 py-2">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Publish</button>
              </div>
            </form>
          </div>
        </div>
      </main>

</x-Teacher-sidebar>