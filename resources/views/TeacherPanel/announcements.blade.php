<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">

          <!-- Success/Error Messages -->
          @if(session('success'))
          <div id="successMessage" class="mb-4 ml-auto max-w-md w-full bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-md overflow-hidden animate-slideDown">
            <div class="p-3 flex items-center gap-3">
              <div class="flex-shrink-0">
                <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center shadow-sm">
                  <i class="bi bi-check-circle-fill text-white text-sm"></i>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-xs font-medium text-green-900">{{ session('success') }}</p>
              </div>
              <button onclick="this.closest('#successMessage').remove()" class="flex-shrink-0 text-green-600 hover:text-green-800 transition-colors">
                <i class="bi bi-x-lg text-sm"></i>
              </button>
            </div>
            <div class="h-0.5 bg-green-500 animate-progress"></div>
          </div>
          @endif

          @if(session('error'))
          <div id="errorMessage" class="mb-4 ml-auto max-w-md w-full bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden animate-slideDown">
            <div class="p-3 flex items-center gap-3">
              <div class="flex-shrink-0">
                <div class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center shadow-sm">
                  <i class="bi bi-exclamation-circle-fill text-white text-sm"></i>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-xs font-medium text-red-900">{{ session('error') }}</p>
              </div>
              <button onclick="this.closest('#errorMessage').remove()" class="flex-shrink-0 text-red-600 hover:text-red-800 transition-colors">
                <i class="bi bi-x-lg text-sm"></i>
              </button>
            </div>
            <div class="h-0.5 bg-red-500 animate-progress"></div>
          </div>
          @endif

          @if(session('info'))
          <div id="infoMessage" class="mb-4 ml-auto max-w-md w-full bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-lg shadow-md overflow-hidden animate-slideDown">
            <div class="p-3 flex items-center gap-3">
              <div class="flex-shrink-0">
                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center shadow-sm">
                  <i class="bi bi-info-circle-fill text-white text-sm"></i>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-xs font-medium text-blue-900">{{ session('info') }}</p>
              </div>
              <button onclick="this.closest('#infoMessage').remove()" class="flex-shrink-0 text-blue-600 hover:text-blue-800 transition-colors">
                <i class="bi bi-x-lg text-sm"></i>
              </button>
            </div>
            <div class="h-0.5 bg-blue-500 animate-progress"></div>
          </div>
          @endif

          <!-- Hero -->
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-700 opacity-30"></div>
            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
              <style> .hero-content { position: relative; z-index: 10; } </style>

              <div class="flex items-center gap-3 hero-content">
                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>

                <div>

                  <h1 class="text-lg sm:text-2xl font-bold text-indigo-800">
                    Announcements
                  </h1>

                  <p class="text-sm text-gray-500">
                    Post messages to students, colleagues or targeted groups.
                  </p>
                  
                </div>
              </div>

              <div class="flex items-center gap-3 hero-content">
                <div class="text-sm text-gray-500 text-right hidden sm:block">
                  <div class="uppercase tracking-wide text-xs text-gray-400">Today</div>
                  <div class="font-medium" id="todayDate">{{ now()->format('M j, Y') }}</div>
                </div>

                <a href="{{ route('teacher.profile') }}" 
                  class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-600 text-white shadow-sm hover:from-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                  <i class="bi bi-person-circle"></i> Profile
                </a>
              </div>
            </div>
          </header>

          <!-- Controls -->
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3 flex-wrap">
              <div class="relative">
                <input id="search" name="q" type="search" placeholder="Search announcements..." class="w-72 pl-10 pr-3 py-2 rounded-md border focus:ring-indigo-200 focus:border-indigo-300">
                <span class="absolute left-3 top-2 text-gray-400"><i class="bi bi-search"></i></span>
              </div>

              <div class="flex items-center gap-1 bg-white rounded-lg shadow-sm p-1">
                <!-- Main tabs -->
                <button class="tab-btn active px-3 py-1 rounded-md text-sm font-medium transition" data-tab="all">
                  All
                </button>
                <button class="tab-btn px-3 py-1 rounded-md text-sm font-medium transition" data-tab="my-posts">
                  My Posts
                </button>
                <button class="tab-btn px-3 py-1 rounded-md text-sm font-medium transition" data-tab="new">
                  New <span class="ml-1 px-1.5 py-0.5 bg-red-500 text-white text-xs rounded-full">3</span>
                </button>
                <span class="w-px h-6 bg-gray-300 mx-1"></span>
                <!-- Category filters -->
                <button class="tab-btn px-3 py-1 rounded-md text-sm transition" data-tab="notice">Notices</button>
                <button class="tab-btn px-3 py-1 rounded-md text-sm transition" data-tab="reminder">Reminders</button>
                <button class="tab-btn px-3 py-1 rounded-md text-sm transition" data-tab="teacher">Teachers</button>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <a href="#" id="openCompose" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                <i class="bi bi-plus-lg"></i> New Announcement
              </a>
            </div>
          </div>

          <!-- Main grid: announcements full width -->
          <section class="grid grid-cols-1 gap-6">
            <!-- Announcement feed (full width) -->
            <div class="space-y-4">
              <!-- Announcement cards (render from controller $announcements) -->
              <div id="annList" class="space-y-4">
  <!-- Hard-coded announcements (backend will be wired later) -->

  <article class="bg-white p-4 rounded-md shadow-sm card" data-category="notice" data-tab-type="my-posts">
    <div class="flex items-start justify-between gap-4">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <h3 class="font-semibold text-indigo-800">Holiday Notice</h3>
          <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full font-medium">You</span>
        </div>
        <p class="text-sm text-gray-600 mt-1">School will be closed on Monday due to a public holiday. All classes and extracurricular activities are suspended.</p>
        <div class="text-xs text-gray-400 mt-3 flex items-center gap-3">
          <span>Sep 1, 2025</span>
          <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded">All Students</span>
        </div>
      </div>

      <div class="flex flex-col items-end gap-2">
        <div class="text-xs text-gray-400">08:15 AM</div>
        <div class="flex gap-2">
          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openViewModal" data-title="Holiday Notice" data-body="School will be closed on Monday due to a public holiday. All classes and extracurricular activities are suspended." data-date="Sep 1, 2025" data-time="08:15 AM" data-audience="All Students" data-attachments="">View</button>
          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openEditModal">Edit</button>
        </div>
      </div>
    </div>
  </article>

  <article class="bg-white p-4 rounded-md shadow-sm card" data-category="reminder" data-tab-type="new">
    <div class="flex items-start justify-between gap-4">
      <div>

        <div class="flex items-center gap-2 mb-2">
          <h3 class="font-semibold text-indigo-800">
            Parent-Teacher Meeting Reminder
          </h3>
          <span class="px-2 py-0.5 bg-blue-500 text-white text-xs rounded-full font-medium animate-pulse">NEW</span>
        </div>

        <p class="text-sm text-gray-600 mt-1">
          Reminder: Parent-Teacher meeting next Friday at 2:00 PM in the main hall. Teachers, please prepare student progress reports.
        </p>

        <div class="text-xs text-gray-400 mt-3 flex items-center gap-3">
          <span>Aug 28, 2025</span>
          <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded">Class 7 - Math</span>
        </div>
        
      </div>

      <div class="flex flex-col items-end gap-2">
        <div class="text-xs text-gray-400">03:24 PM</div>
        <div class="flex gap-2">
          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openViewModal" data-title="Parent-Teacher Meeting Reminder" data-body="Reminder: Parent-Teacher meeting next Friday at 2:00 PM in the main hall. Teachers, please prepare student progress reports." data-date="Aug 28, 2025" data-time="03:24 PM" data-audience="Class 7 - Math" data-attachments="meeting_agenda.pdf,student_reports.docx">View</button>
          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openEditModal">Edit</button>
        </div>
      </div>
    </div>
  </article>

  <article class="bg-white p-4 rounded-md shadow-sm card" data-category="notice" data-tab-type="new">
    <div class="flex items-start justify-between gap-4">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <h3 class="font-semibold text-indigo-800">Staff Meeting Tomorrow</h3>
          <span class="px-2 py-0.5 bg-blue-500 text-white text-xs rounded-full font-medium animate-pulse">NEW</span>
        </div>
        <p class="text-sm text-gray-600 mt-1">All teaching staff are required to attend the meeting tomorrow at 10:00 AM in the conference room. Agenda: Curriculum updates.</p>
        <div class="text-xs text-gray-400 mt-3 flex items-center gap-3">
          <span>Dec 29, 2025</span>
          <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded">All Teachers</span>
        </div>
      </div>

      <div class="flex flex-col items-end gap-2">
        <div class="text-xs text-gray-400">09:15 AM</div>
        <div class="flex gap-2">
          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openViewModal" data-title="Staff Meeting Tomorrow" data-body="All teaching staff are required to attend the meeting tomorrow at 10:00 AM in the conference room. Agenda: Curriculum updates." data-date="Dec 29, 2025" data-time="09:15 AM" data-audience="All Teachers" data-attachments="">View</button>
        </div>
      </div>
    </div>
  </article>

</div>

              <!-- Pagination placeholder (server-side) -->
              <div class="flex justify-between items-center bg-white p-3 rounded-md shadow-sm">

                <div class="text-sm text-gray-500">
                  Showing 1 - 10 of 42
                </div>

                <div class="flex gap-2">

                  <a href="?page=prev" class="px-3 py-1 border rounded">
                    Previous
                  </a>

                  <a href="?page=next" class="px-3 py-1 bg-indigo-600 text-white rounded">
                    Next
                  </a>
                </div>
              </div>
            </div>
          </section>

          <!-- View Announcement Modal -->
          <div id="viewModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-2xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
              <!-- Header -->
              <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                  <div class="h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm">
                    <i class="bi bi-eye-fill text-xl"></i>
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-indigo-900">View Announcement</h2>
                    <p class="text-sm text-gray-500">Full announcement details</p>
                  </div>
                </div>
                <button id="closeViewModal" class="text-gray-400 hover:text-gray-700 p-2 rounded-md transition-colors" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>

              <!-- Content -->
              <div class="mt-6 space-y-4">
                <div>
                  <label class="text-sm font-medium text-gray-700">Title</label>
                  <div id="viewTitle" class="mt-2 p-3 bg-gray-50 rounded-lg text-gray-900 text-sm"></div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Message</label>
                  <div id="viewBody" class="mt-2 p-3 bg-gray-50 rounded-lg text-gray-700 text-sm leading-relaxed whitespace-pre-wrap"></div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="text-sm font-medium text-gray-700">Date</label>
                    <div id="viewDate" class="mt-2 p-3 bg-gray-50 rounded-lg text-gray-900 text-sm"></div>
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700">Time</label>
                    <div id="viewTime" class="mt-2 p-3 bg-gray-50 rounded-lg text-gray-900 text-sm"></div>
                  </div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Audience</label>
                  <div id="viewAudience" class="mt-2 inline-block px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium"></div>
                </div>

                <div id="attachmentsSection" class="hidden">
                  <label class="text-sm font-medium text-gray-700">Documents</label>
                  <div id="viewAttachments" class="mt-2 space-y-2"></div>
                </div>
              </div>

              <!-- Footer -->
              <div class="flex items-center justify-end gap-2 pt-6 mt-6 border-t border-gray-200">
                <button id="closeViewModalBtn" class="px-4 py-2 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm hover:bg-red-100 hover:shadow-sm">Close</button>
              </div>
            </div>
          </div>

          <!-- Edit Announcement Modal -->
          <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-2xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
              <!-- Header -->
              <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                  <div class="h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm">
                    <i class="bi bi-pencil-fill text-xl"></i>
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-indigo-900">Edit Announcement</h2>
                    <p class="text-sm text-gray-500">Update your announcement details.</p>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <button id="closeEditModal" class="text-gray-400 hover:text-gray-700 p-2 rounded-md transition-colors" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>

              <form id="editAnnForm" class="space-y-4 mt-5" method="POST" action="#" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                  <label class="text-sm font-medium text-gray-700">Title</label>
                  <input name="title" required placeholder="Short, clear title" value="Holiday Notice"
                    class="w-full mt-2 border border-gray-200 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 transition" />
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Message</label>
                  <textarea name="body" rows="6" required placeholder="Write your announcement..."
                    class="w-full mt-2 border border-gray-200 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 resize-y transition">School will be closed on Monday due to a public holiday. All classes and extracurricular activities are suspended.</textarea>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Audience</label>
                  <div class="mt-3 grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="radio" name="edit_audience_type" value="all_students" checked class="edit-aud-radio">
                      <span class="text-sm">All Students</span>
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="radio" name="edit_audience_type" value="all_teachers" class="edit-aud-radio">
                      <span class="text-sm">All Teachers</span>
                    </label>
                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="radio" name="edit_audience_type" value="by_subject" class="edit-aud-radio">
                      <span class="text-sm">By Subject</span>
                    </label>
                  </div>

                  <!-- By Subject -->
                  <div id="editBySubject" class="mt-3 hidden">
                    <label class="text-sm font-medium text-gray-700">Select Subject</label>
                    <select name="subject_id" class="w-full mt-2 border border-gray-200 px-3 py-2 rounded-lg">
                      <option value="">-- Choose subject --</option>
                      <option value="math">Mathematics</option>
                      <option value="eng">English</option>
                      <option value="sci">Science</option>
                    </select>
                    <div class="mt-2 flex items-center gap-3">
                      <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="notify_teachers" class="h-4 w-4"> Notify teachers</label>
                    </div>
                  </div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Current Attachment</label>
                  <div class="mt-2 text-sm text-gray-500 italic">No attachment</div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Replace Attachment (optional)</label>
                  <label class="mt-2 flex items-center justify-center px-4 py-3 border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                    <div class="text-center">
                      <i class="bi bi-paperclip text-2xl text-gray-400"></i>
                      <div class="text-xs text-gray-500 mt-1">Click to upload or drag files here</div>
                    </div>
                    <input id="editAttachment" type="file" name="attachment" class="hidden" />
                  </label>
                  <div id="editAttachmentName" class="mt-2 hidden">
                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 shadow-sm text-sm text-gray-800">
                      <i class="bi bi-paperclip text-indigo-600"></i>
                      <span class="file-name">No file selected</span>
                      <button type="button" id="editAttachmentClear" class="ml-2 px-2 py-1 text-xs rounded-md border border-red-200 text-red-700 bg-red-50 hover:bg-red-100">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                </div>

                <div class="flex items-center justify-between gap-3 pt-2">
                  <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="pin" class="h-4 w-4"> Pin to top</label>
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="notify" checked class="h-4 w-4"> Send notification</label>
                  </div>

                  <div class="flex items-center gap-2">
                    <button type="button" id="cancelEditBtn" class="px-4 py-2 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm hover:bg-red-100 hover:shadow-sm">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-700">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Compose Annnouncement Modal -->

          <div id="modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-2xl rounded-2xl p-6 overflow-auto max-h-[90vh] shadow-2xl ring-1 ring-black/5">
              <!-- Header -->
              <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                  <div class="h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm">
                    <i class="bi bi-megaphone-fill text-xl"></i>
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-indigo-900">Create Announcement</h2>
                    <p class="text-sm text-gray-500">Broadcast a message to students, teachers, or a selected group.</p>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <button id="closeModal" class="text-gray-400 hover:text-gray-700 p-2 rounded-md transition-colors" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>

              <form id="annForm" class="space-y-4 mt-5" method="POST" action="{{ route('teacher.addannouncement') }}" enctype="multipart/form-data">
                @csrf

                <div>
                  <label class="text-sm font-medium text-gray-700">Title</label>
                  <input name="title" required placeholder="Short, clear title"
                    class="w-full mt-2 border border-gray-200 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 transition" />
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Message</label>
                  <textarea name="content" rows="6" required placeholder="Write your announcement..."
                    class="w-full mt-2 border border-gray-200 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200 resize-y transition"></textarea>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Audience</label>
                  <div class="mt-3 grid grid-cols-2 sm:grid-cols-4 gap-2">

                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="checkbox" name="audience_type[]" value="all" class="aud-radio">
                      <span class="text-sm">Everyone</span>
                    </label>

                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="checkbox" name="audience_type[]" value="all_students" checked class="aud-radio">
                      <span class="text-sm">Only Students</span>
                    </label>

                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="checkbox" name="audience_type[]" value="all_teachers" class="aud-radio">
                      <span class="text-sm">Only School Staff</span>
                    </label>


                    {{-- 
                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="radio" name="audience_type" value="specific_students" class="aud-radio">
                      <span class="text-sm">Specific Students</span>
                    </label>  --}}

                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-100 hover:shadow-sm cursor-pointer">
                      <input type="checkbox" name="audience_type[]" value="by_subject" class="aud-radio">
                      <span class="text-sm">By Subject</span>
                    </label>
                  </div>

                  <!-- Specific Students -->
                  <div id="specificStudents" class="mt-3 hidden">
                    <label class="text-sm font-medium text-gray-700">Select Students</label>

                    <!-- Class selector -->
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
                      <select id="classSelect" name="class_id" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200">
                        <option value="">All classes</option>
                        <option value="7A">7A</option>
                        <option value="7B">7B</option>
                        <option value="8A">8A</option>
                        <option value="8B">8B</option>
                      </select>

                      <!-- Search -->
                      <div>
                        <input id="studentSearch" type="search" placeholder="Search students..." autocomplete="off"
                          class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-200" />
                      </div>
                    </div>

                    <!-- Checklist (replace entries with server data) -->
                    <div id="studentList" class="mt-2 max-h-40 overflow-auto border border-gray-100 rounded-lg p-2 space-y-1">

                      <label class="flex items-center gap-2 p-2 rounded hover:bg-gray-50" data-class="7A">
                        <input type="checkbox" name="students[]" value="1" class="h-4 w-4">
                        <span class="text-sm">John Doe (7A)</span>
                      </label>

                      <label class="flex items-center gap-2 p-2 rounded hover:bg-gray-50" data-class="8B">
                        <input type="checkbox" name="students[]" value="2" class="h-4 w-4">
                        <span class="text-sm">Jane Smith (8B)</span>
                      </label>

                      <label class="flex items-center gap-2 p-2 rounded hover:bg-gray-50" data-class="7A">
                        <input type="checkbox" name="students[]" value="3" class="h-4 w-4">
                        <span class="text-sm">Ali Khan (7A)</span>
                      </label>
                      
                      <!-- Add more items or render via Blade loop when wiring backend -->
                    </div>

                    <p class="text-xs text-gray-400 mt-1">Tip: Select a class to narrow results, or type to search and check desired students.</p>
                  </div>

                  <!-- By Subject -->
                  <div id="bySubject" class="mt-3 hidden">
                    <label class="text-sm font-medium text-gray-700">Select Subject</label>
                    <select name="subject_id[]" class="w-full mt-2 border border-gray-200 px-3 py-2 rounded-lg">
                      <option value="">-- Choose subject --</option>
                      {{-- Example placeholder; replace with actual $subjects --}}

                      {{-- check if the $subjects is available  --}}

                      @if ($subjects->count() > 0)
                        
                        @foreach($subjects as $subject)
                          <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                      @else
                        <option value="">No subjects available</option>
                      @endif

                      
                    </select>
                    <div class="mt-2 flex items-center gap-3">
                      <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="notify_teachers" class="h-4 w-4"> Notify teachers</label>
                    </div>
                  </div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Attach (optional)</label>
                  <label class="mt-2 flex items-center justify-center px-4 py-3 border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                    <div class="text-center">
                      <i class="bi bi-paperclip text-2xl text-gray-400"></i>
                      <div class="text-xs text-gray-500 mt-1">Click to upload or drag files here</div>
                      <div class="text-xs text-gray-500 mt-1">MAX 5MB</div>
                    </div>
                    <input id="composeAttachment" type="file" name="attachment" class="hidden" />
                  </label>
                  <div id="composeAttachmentName" class="mt-2 hidden">
                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 shadow-sm text-sm text-gray-800">
                      <i class="bi bi-paperclip text-indigo-600"></i>
                      <span class="file-name">No file selected</span>
                      <button type="button" id="composeAttachmentClear" class="ml-2 px-2 py-1 text-xs rounded-md border border-red-200 text-red-700 bg-red-50 hover:bg-red-100">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                </div>

                <div class="flex items-center justify-between gap-3 pt-2">
                  <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="pin" class="h-4 w-4"> Pin to top</label>
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="notify" checked class="h-4 w-4"> Send notification</label>
                  </div>

                  <div class="flex items-center gap-2">
                    <button type="button" id="cancelBtn" class="px-4 py-2 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm hover:bg-red-100 hover:shadow-sm">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm">Publish</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </main>

</x-Teacher-sidebar>

<!-- Minimal JS: only modal open/close, audience toggles and small client-side student list helper.
     No JS for search/filters/pagination or any backend work — those will be handled in Laravel. -->
<style>
  .tab-btn {
    color: #6b7280;
  }
  .tab-btn.active {
    background-color: #4f46e5;
    color: white;
  }
  .tab-btn:hover:not(.active) {
    background-color: #f3f4f6;
  }

  /* Success/Error Message Animations */
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes progress {
    from {
      width: 100%;
    }
    to {
      width: 0%;
    }
  }

  .animate-slideDown {
    animation: slideDown 0.4s ease-out;
  }

  .animate-progress {
    animation: progress 5s linear forwards;
  }

  /* Auto-dismiss messages after 5 seconds */
  #successMessage,
  #errorMessage,
  #infoMessage {
    position: relative;
  }
</style>
<script>
  (function(){
    // Auto-dismiss success/error messages after 5 seconds
    const successMsg = document.getElementById('successMessage');
    const errorMsg = document.getElementById('errorMessage');
    const infoMsg = document.getElementById('infoMessage');

    if (successMsg) {
      setTimeout(() => {
        successMsg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        successMsg.style.opacity = '0';
        successMsg.style.transform = 'translateY(-20px)';
        setTimeout(() => successMsg.remove(), 500);
      }, 5000);
    }

    if (errorMsg) {
      setTimeout(() => {
        errorMsg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        errorMsg.style.opacity = '0';
        errorMsg.style.transform = 'translateY(-20px)';
        setTimeout(() => errorMsg.remove(), 500);
      }, 5000);
    }

    if (infoMsg) {
      setTimeout(() => {
        infoMsg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        infoMsg.style.opacity = '0';
        infoMsg.style.transform = 'translateY(-20px)';
        setTimeout(() => infoMsg.remove(), 500);
      }, 5000);
    }

    const modal = document.getElementById('modal');
    const viewModal = document.getElementById('viewModal');
    const editModal = document.getElementById('editModal');
    const openBtns = document.querySelectorAll('#openCompose, #openCompose2');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const closeViewBtn = document.getElementById('closeViewModal');
    const closeViewModalBtn = document.getElementById('closeViewModalBtn');
    const closeEditBtn = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const openViewBtns = document.querySelectorAll('.openViewModal');
    const openEditBtns = document.querySelectorAll('.openEditModal');

    const audRadios = document.querySelectorAll('.aud-radio');
    const editAudRadios = document.querySelectorAll('.edit-aud-radio');
    const specificStudents = document.getElementById('specificStudents');
    const bySubject = document.getElementById('bySubject');
    const editBySubject = document.getElementById('editBySubject');
    const composeAttachInput = document.getElementById('composeAttachment');
    const composeAttachName = document.getElementById('composeAttachmentName');
    const composeAttachNameText = composeAttachName?.querySelector('.file-name');
    const composeAttachClear = document.getElementById('composeAttachmentClear');
    const editAttachInput = document.getElementById('editAttachment');
    const editAttachName = document.getElementById('editAttachmentName');
    const editAttachNameText = editAttachName?.querySelector('.file-name');
    const editAttachClear = document.getElementById('editAttachmentClear');

    // student search & class filter (UI helper only)
    const studentSearch = document.getElementById('studentSearch');
    const classSelect = document.getElementById('classSelect');
    const studentItems = document.querySelectorAll('#studentList label');

    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const tab = btn.getAttribute('data-tab');
        
        // Update active tab
        tabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        // Filter cards
        cards.forEach(card => {
          const tabType = card.getAttribute('data-tab-type');
          const category = card.getAttribute('data-category');
          
          if (tab === 'all') {
            card.style.display = '';
          } else if (tab === 'my-posts' && tabType === 'my-posts') {
            card.style.display = '';
          } else if (tab === 'new' && tabType === 'new') {
            card.style.display = '';
          } else if (tab === category) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // Compose modal open/close
    function showModal(){
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
    function hideModal(){
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = '';
    }

    // View modal open/close + attachment list render
    function showViewModal(title, body, date, time, audience, attachments){
      document.getElementById('viewTitle').textContent = title;
      document.getElementById('viewBody').textContent = body;
      document.getElementById('viewDate').textContent = date;
      document.getElementById('viewTime').textContent = time;
      document.getElementById('viewAudience').textContent = audience;
      
      const attachmentsSection = document.getElementById('attachmentsSection');
      const viewAttachments = document.getElementById('viewAttachments');
      
      if (attachments && attachments.trim() !== '') {
        const files = attachments.split(',').map(f => f.trim());
        viewAttachments.innerHTML = files.map(file => `
          <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition cursor-pointer">
            <i class="bi bi-file-earmark text-indigo-600 text-lg"></i>
            <span class="text-sm text-gray-900 flex-1">${file}</span>
            <i class="bi bi-download text-gray-400 text-sm"></i>
          </div>
        `).join('');
        attachmentsSection.classList.remove('hidden');
      } else {
        attachmentsSection.classList.add('hidden');
        viewAttachments.innerHTML = '';
      }
      
      viewModal.classList.remove('hidden');
      viewModal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
    function hideViewModal(){
      viewModal.classList.add('hidden');
      viewModal.classList.remove('flex');
      document.body.style.overflow = '';
    }

    // Edit modal open/close
    function showEditModal(){
      editModal.classList.remove('hidden');
      editModal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
    function hideEditModal(){
      editModal.classList.add('hidden');
      editModal.classList.remove('flex');
      document.body.style.overflow = '';
    }

    // Wire compose triggers
    openBtns.forEach(b => b.addEventListener('click', e => { e.preventDefault(); showModal(); }));
    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);
    modal.addEventListener('click', e => { if (e.target === modal) hideModal(); });

    // Wire view triggers
    openViewBtns.forEach(btn => {
      btn.addEventListener('click', e => {
        e.preventDefault();
        const title = btn.getAttribute('data-title');
        const body = btn.getAttribute('data-body');
        const date = btn.getAttribute('data-date');
        const time = btn.getAttribute('data-time');
        const audience = btn.getAttribute('data-audience');
        const attachments = btn.getAttribute('data-attachments');
        showViewModal(title, body, date, time, audience, attachments);
      });
    });
    if (closeViewBtn) closeViewBtn.addEventListener('click', hideViewModal);
    if (closeViewModalBtn) closeViewModalBtn.addEventListener('click', hideViewModal);
    viewModal.addEventListener('click', e => { if (e.target === viewModal) hideViewModal(); });

    // Wire edit triggers
    openEditBtns.forEach(btn => {
      btn.addEventListener('click', e => {
        e.preventDefault();
        showEditModal();
      });
    });
    if (closeEditBtn) closeEditBtn.addEventListener('click', hideEditModal);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', hideEditModal);
    editModal.addEventListener('click', e => { if (e.target === editModal) hideEditModal(); });

    // Shared helper: wire attachment preview + clear
    function wireAttachmentPreview(input, wrapper, nameEl, clearBtn){
      if (!input || !wrapper || !nameEl) return;
      input.addEventListener('change', () => {
        const file = input.files?.[0];
        if (file) {
          nameEl.textContent = file.name;
          wrapper.classList.remove('hidden');
        } else {
          nameEl.textContent = '';
          wrapper.classList.add('hidden');
        }
      });
      if (clearBtn) {
        clearBtn.addEventListener('click', () => {
          input.value = '';
          nameEl.textContent = '';
          wrapper.classList.add('hidden');
        });
      }
    }

    wireAttachmentPreview(composeAttachInput, composeAttachName, composeAttachNameText, composeAttachClear);
    wireAttachmentPreview(editAttachInput, editAttachName, editAttachNameText, editAttachClear);

    // Audience toggles (compose)
    function updateAudience(){
      const val = Array.from(audRadios).find(r => r.checked)?.value;
      if (specificStudents) specificStudents.classList.toggle('hidden', val !== 'specific_students');
      if (bySubject) bySubject.classList.toggle('hidden', val !== 'by_subject');
    }
    audRadios.forEach(r => r.addEventListener('change', updateAudience));
    updateAudience();

    // Audience toggles (edit modal)
    function updateEditAudience(){
      const val = Array.from(editAudRadios).find(r => r.checked)?.value;
      if (editBySubject) editBySubject.classList.toggle('hidden', val !== 'by_subject');
    }
    editAudRadios.forEach(r => r.addEventListener('change', updateEditAudience));
    updateEditAudience();

    // Minimal client-side filter for the student checklist UI only
    function filterStudents(){
      if (!studentItems || studentItems.length === 0) return;
      const q = (studentSearch?.value || '').trim().toLowerCase();
      const cls = (classSelect?.value || '').trim();
      studentItems.forEach(label => {
        const text = (label.textContent || '').trim().toLowerCase();
        const itemClass = (label.getAttribute('data-class') || '').trim();
        const matchesQ = q ? text.includes(q) : true;
        const matchesClass = cls ? (itemClass === cls) : true;
        label.style.display = (matchesQ && matchesClass) ? '' : 'none';
      });
    }
    if (studentSearch) studentSearch.addEventListener('input', filterStudents);
    if (classSelect) classSelect.addEventListener('change', filterStudents);
    // initialize UI helper (safe no-op if elements missing)
    filterStudents();

  })();
</script>