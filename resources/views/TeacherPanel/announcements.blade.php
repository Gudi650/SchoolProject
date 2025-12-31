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
          @endif <!--end the message -->

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

              {{-- check if the $announcement variable is set and if so display the announcements --}}
              @if (isset($announcements) && $announcements->count() > 0)

                {{-- display the announcements --}}
                @foreach ($announcements as $announcement)
                  <article class="bg-white p-4 rounded-md shadow-sm card" data-category="{{ $announcement->type }}" data-tab-type="{{ $announcement->created_by == auth()->user()->id ? 'my-posts' : 'all' }}">
                    <div class="flex items-start justify-between gap-4">
                      <div>
                        <div class="flex items-center gap-2 mb-2">
                          <h3 class="font-semibold text-indigo-800">{{ $announcement->title }}</h3>
                          @if ($announcement->created_by == auth()->user()->id)
                            <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full font-medium">You</span>
                          @endif
                        </div>
                        <p class="max-w-xs md:max-w-lg text-sm text-gray-600 mt-1 truncate ">{{ $announcement->content }}</p>
                        <div class="text-xs text-gray-400 mt-3 flex items-center gap-3">
                          <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                          <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded">
                            @switch($announcement->intended_audience)
                              @case(0)
                                All
                                @break
                              @case(2)
                                All Students
                                @break
                              @case(3)
                                All Teachers
                                @break
                              @case(4)
                                By Subject
                                @break
                              @case(5)
                                Custom Audience
                                @break
                              @default
                                Unknown
                            @endswitch
                          </span>
                        </div>
                      </div>

                      <div class="flex flex-col items-end gap-2">
                        <div class="text-xs text-gray-400">{{ $announcement->created_at->format('h:i A') }}</div>
                        <div class="flex gap-2">
                          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openViewModal" 
                          data-title="{{ $announcement->title }}" 
                          data-body="{{ $announcement->content }}" 
                          data-date="{{ $announcement->created_at->format('M d, Y') }}" 
                          data-time="{{ $announcement->created_at->format('h:i A') }}" 
                          data-audience="@switch($announcement->intended_audience)
                              @case(0)
                                All
                                @break
                              @case(2)
                                All Students
                                @break
                              @case(3)
                                All Teachers
                                @break
                              @case(4)
                                By Subject
                                @break
                              @case(5)
                                Custom Audience
                                @break
                              @default
                                Unknown
                            @endswitch" 
                          data-attachments="{{ $announcement->attachment_original_name ?? '' }}"
                          data-file-path="{{ $announcement->attachements ? asset('storage/' . $announcement->attachements) : '' }}">View</button>
                          <button class="px-2 py-1 text-sm border rounded text-gray-600 hover:bg-gray-50 openEditModal" 
                            data-id="{{ $announcement->id }}" 
                            data-title="{{ $announcement->title }}" 
                            data-body="{{ $announcement->content }}" 
                            data-audience="{{ $announcement->intended_audience }}" 
                            data-attachments="{{ $announcement->attachment_original_name ?? '' }}">Edit</button>
                        </div>
                      </div>
                    </div>
                  </article>
                @endforeach
                
              @endif
              
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
                  <div id="viewBody" class="break-all mt-2 p-3 bg-gray-50 rounded-lg text-gray-700 text-sm leading-relaxed whitespace-pre-wrap"></div>
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

                <!--preview button-->
                <div>
                  <label class="text-sm font-medium text-gray-700">Current Attachment</label>
                  <div class="mt-2 inline-flex w-full items-center gap-3 rounded-xl bg-gradient-to-r from-indigo-50 via-white to-slate-50 border border-indigo-100/70 px-4 py-3 shadow-sm">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-700">
                      <i class="bi bi-paperclip text-lg"></i>
                    </span>
                    <span id="viewAttachment" class="flex-1 text-sm text-gray-800 italic">No attachment</span>
                    <button class="openPreviewModal border px-2 py-1 border-green-200 rounded-lg hover:bg-green-100 hover:shadow-sm" data-file-path="">
                      <span class="text-xs text-green-700  border-green-200 rounded-lg ">Preview</span>
                    </button>
                    
                  </div>
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

                {{-- happa ndo shida ipo sasa --}}
                <div>
                  <label class="text-sm font-medium text-gray-700">Current Attachment</label>
                  <div class="mt-2 text-sm text-gray-500 italic">No attachment</div>
                </div>

                <div>
                  <label class="text-sm font-medium text-gray-700">Current Attachment</label>
                  <div class="mt-2 inline-flex w-full items-center gap-3 rounded-xl bg-gradient-to-r from-indigo-50 via-white to-slate-50 border border-indigo-100/70 px-4 py-3 shadow-sm">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-700">
                      <i class="bi bi-paperclip text-lg"></i>
                    </span>
                    <span id="editAttachmentPreview" class="flex-1 text-sm text-gray-800 italic">No attachment</span>
                    <button type="button" class="openPreviewModal border px-2 py-1 border-green-200 rounded-lg hover:bg-green-100 hover:shadow-sm" data-file-path="">
                      <span class="text-xs text-green-700">Preview</span>
                    </button>
                  </div>
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

          <!-- Preview Document Modal -->
          <div id="previewModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-6xl h-[90vh] rounded-2xl overflow-hidden shadow-2xl ring-1 ring-black/5 flex flex-col">
              <!-- Header -->
              <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                  <div class="h-10 w-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <i class="bi bi-file-earmark-text text-xl"></i>
                  </div>
                  <h2 class="text-lg font-semibold text-indigo-900">Document Preview</h2>
                </div>
                <button id="closePreviewModal" class="text-gray-400 hover:text-gray-700 p-2 rounded-md transition-colors">
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>
              <!-- Iframe Container for PDF -->
              <div id="pdfContainer" class="flex-1 p-4 bg-gray-50 hidden">
                <iframe id="previewFrame" class="w-full h-full border-0 rounded-lg bg-white shadow-sm" src=""></iframe>
              </div>
              <!-- Container for Word Documents -->
              <div id="docContainer" class="flex-1 p-4 bg-gray-50 overflow-auto hidden">
                <div id="docContent" class="bg-white p-6 rounded-lg shadow-sm max-w-4xl mx-auto"></div>
              </div>
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

<!-- PDF.js library for viewing PDF files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<!-- Mammoth.js library for viewing Word documents (.docx) -->
<script src="https://cdn.jsdelivr.net/npm/mammoth@1.6.0/mammoth.browser.min.js"></script>

<!-- JSZip library for extracting images from DOCX files -->
<script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>

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

    // Shared helper: display attachment
    function displayAttachment(element, attachments){
      if (attachments && attachments.trim() !== '' && attachments !== 'null') {
        element.textContent = attachments;
        element.classList.remove('italic');
      } else {
        element.textContent = 'No attachment';
        element.classList.add('italic');
      }
    }

    // View modal open/close
    function showViewModal(title, body, date, time, audience, attachments, filePath){
      document.getElementById('viewTitle').textContent = title;
      document.getElementById('viewBody').textContent = body;
      document.getElementById('viewDate').textContent = date;
      document.getElementById('viewTime').textContent = time;
      document.getElementById('viewAudience').textContent = audience;
      
      displayAttachment(document.getElementById('viewAttachment'), attachments);
      
      // Set file path for preview button
      const previewBtn = viewModal.querySelector('.openPreviewModal');
      if (previewBtn) previewBtn.setAttribute('data-file-path', filePath || '');
      
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
    function showEditModal(id, title, body, audience, attachments){

      // Fill the form inputs with the data
      const editForm = document.getElementById('editAnnForm');
      editForm.querySelector('input[name="title"]').value = title || '';
      editForm.querySelector('textarea[name="body"]').value = body || '';
      
      // Update the form action to include the announcement ID
      //editForm.action = `/teacher/announcements/${id}/update`;
      
      // Select the correct audience radio button based on intended_audience value
      /*const audienceRadios = document.querySelectorAll('.edit-aud-radio');
      audienceRadios.forEach(radio => {
        // Map database values to form values
        let radioValue = '';
        if (audience == 0) radioValue = 'all';
        else if (audience == 2) radioValue = 'all_students';
        else if (audience == 3) radioValue = 'all_teachers';
        else if (audience == 4) radioValue = 'by_subject';
        
        radio.checked = (radio.value === radioValue);
      }); */
      
      displayAttachment(editModal.querySelector('.mt-2.text-sm.text-gray-500'), attachments);
      
      // Show the modal
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
        const filePath = btn.getAttribute('data-file-path');
        showViewModal(title, body, date, time, audience, attachments, filePath);
      });
    });
    if (closeViewBtn) closeViewBtn.addEventListener('click', hideViewModal);
    if (closeViewModalBtn) closeViewModalBtn.addEventListener('click', hideViewModal);
    viewModal.addEventListener('click', e => { if (e.target === viewModal) hideViewModal(); });

    // Wire edit triggers
    openEditBtns.forEach(btn => {
      btn.addEventListener('click', e => {
        e.preventDefault();
        // Read data from button's data-* attributes
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const body = btn.getAttribute('data-body');
        const audience = btn.getAttribute('data-audience');
        const attachments = btn.getAttribute('data-attachments');
        // Pass data to the modal
        showEditModal(id, title, body, audience, attachments);
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

    // Preview modal
    const previewModal = document.getElementById('previewModal');
    const pdfContainer = document.getElementById('pdfContainer');
    const docContainer = document.getElementById('docContainer');
    const previewFrame = document.getElementById('previewFrame');
    const docContent = document.getElementById('docContent');
    const closePreviewBtn = document.getElementById('closePreviewModal');
    
    // Load pdf.js library for PDF viewing
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    
    if (previewModal) {
      // Helper function: Display PDF using pdf.js
      function displayPdf(filePath) {
        pdfContainer.classList.remove('hidden');
        docContainer.classList.add('hidden');
        
        // Use pdf.js to render the PDF
        const pdf = pdfjsLib.getDocument(filePath);
        
        pdf.promise.then(function(pdfDoc) {
          // Render first page of PDF
          pdfDoc.getPage(1).then(function(page) {
            const scale = 1.5;
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            
            const viewport = page.getViewport({ scale: scale });
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            page.render({
              canvasContext: ctx,
              viewport: viewport
            }).promise.then(() => {
              // For now, show as image. For full PDF viewer, use iframe
              previewFrame.src = filePath;
            });
          });
        }).catch(() => {
          alert('Could not load PDF. Please try again.');
        });
      }
      
      // Helper function: Display Word document using Mammoth.js with image support
      function displayDocx(filePath) {
        pdfContainer.classList.add('hidden');
        docContainer.classList.remove('hidden');
        docContent.innerHTML = '<p class="text-gray-500">Loading document...</p>';
        
        // Fetch the DOCX file (which is actually a ZIP archive)
        fetch(filePath)
          .then(response => {
            if (!response.ok) throw new Error('Failed to load file');
            return response.arrayBuffer();
          })
          .then(arrayBuffer => {
            // Use JSZip to extract the DOCX file contents
            return JSZip.loadAsync(arrayBuffer).then(zip => {
              // Create an object to store extracted images
              const imageMap = {};
              
              // Extract all images from the word/media folder inside DOCX
              const mediaPromises = [];
              zip.folder('word/media')?.forEach((relativePath, file) => {
                mediaPromises.push(
                  file.async('base64').then(base64Data => {
                    // Store the image as base64 so it can be displayed
                    imageMap[relativePath] = base64Data;
                  })
                );
              });
              
              // Wait for all images to be extracted
              return Promise.all(mediaPromises).then(() => {
                // Now convert the document with images
                return mammoth.convertToHtml({
                  arrayBuffer: arrayBuffer,
                  // Tell Mammoth how to handle images
                  convertImage: mammoth.images.imgElement(image => {
                    // Get the image filename from the image reference
                    const imageFileName = image.contentType === 'image/png' ? 
                      image.relationshipId + '.png' : 
                      image.relationshipId + '.jpeg';
                    
                    // Look up the extracted image data
                    const base64 = imageMap[imageFileName] || 
                                  Object.values(imageMap)[0]; // Fallback to first image
                    
                    if (base64) {
                      // Return the image as a data URL (embedded in HTML)
                      return {
                        src: 'data:image/png;base64,' + base64
                      };
                    }
                    return {};
                  })
                });
              });
            });
          })
          .then(result => {
            // Display the HTML content with images
            docContent.innerHTML = result.value;
          })
          .catch(error => {
            docContent.innerHTML = '<p class="text-red-500">Error loading document: ' + error.message + '</p>';
          });
      }
      
      // Listen for clicks on preview buttons
      document.addEventListener('click', e => {
        const btn = e.target.closest('.openPreviewModal');
        if (btn) {
          e.preventDefault();
          
          // Get the file path from the button's data attribute
          const filePath = btn.getAttribute('data-file-path');
          
          // Check if file path exists and is not empty
          if (filePath && filePath.trim() !== '') {
            // Get the file extension (e.g., "pdf" from "file.pdf")
            const fileExtension = filePath.split('.').pop().toLowerCase();
            
            // Show the preview modal
            previewModal.classList.remove('hidden');
            previewModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            // Check file type and use appropriate viewer
            if (fileExtension === 'pdf') {
              // Use PDF viewer
              displayPdf(filePath);
            } else if (fileExtension === 'docx' || fileExtension === 'doc') {
              // Use Word document viewer (only DOCX, not DOC)
              if (fileExtension === 'docx') {
                displayDocx(filePath);
              } else {
                docContent.innerHTML = '<p class="text-red-500">DOC files are not supported. Please convert to DOCX.</p>';
                docContainer.classList.remove('hidden');
                pdfContainer.classList.add('hidden');
              }
            } else {
              // Unsupported file type
              docContent.innerHTML = '<p class="text-red-500">File type not supported for preview.</p>';
              docContainer.classList.remove('hidden');
              pdfContainer.classList.add('hidden');
            }
          } else {
            alert('No file to preview');
          }
        }
      });
      
      // Close button click handler
      if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', () => {
          previewModal.classList.add('hidden');
          previewModal.classList.remove('flex');
          previewFrame.src = ''; // Clear the iframe
          docContent.innerHTML = ''; // Clear the content
          document.body.style.overflow = '';
        });
      }
      
      // Close when clicking outside the modal (on the dark background)
      previewModal.addEventListener('click', e => {
        if (e.target === previewModal) {
          previewModal.classList.add('hidden');
          previewModal.classList.remove('flex');
          previewFrame.src = ''; // Clear the iframe
          docContent.innerHTML = ''; // Clear the content
          document.body.style.overflow = '';
        }
      });
    }

    // Audience toggles (compose)
    function updateAudience(){
      const val = Array.from(audRadios).find(r => r.checked)?.value;
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

  })();
</script>