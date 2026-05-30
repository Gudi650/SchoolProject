<x-Student-sidebar>

    @php
      $subjects = $assignments->pluck('subject')->filter()->unique('id')->values();
      $submissionLookup = $submissions ?? collect();
    @endphp

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
      <div class="w-full min-w-0 space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>

          <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
            <div class="flex items-center gap-3">
              <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded">
                <i class="bi bi-list"></i>
              </button>
              <div>
                <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Assignments</h1>
                <p class="hidden sm:block text-sm text-gray-500 mt-1">View classwork posted by your teacher.</p>
              </div>
            </div>

            <div class="hidden sm:block w-full max-w-sm">
              <input id="search" type="search" placeholder="Search assignments" class="w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            </div>
          </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <section class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col sm:flex-row items-start sm:items-center gap-3">
              <select id="filterSubject" class="w-full sm:w-auto rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm">
                <option value="">All subjects</option>
                @foreach ($subjects as $subject)
                  <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
                @endforeach
              </select>

              <select id="filterStatus" class="w-full sm:w-auto rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm">
                <option value="">All</option>
                <option value="pending">Pending</option>
                <option value="submitted">Submitted</option>
              </select>

              <div class="sm:ml-auto text-sm text-gray-500">
                You have <span id="pendingCount" class="font-semibold text-gray-800">{{ $pendingCount }}</span> pending assignments
              </div>
            </div>

            <div id="assignmentsList" class="space-y-4">
              @forelse ($assignments as $assignment)
                @php
                  $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                  $submission = $submissionLookup->get($assignment->id);
                  $statusLabel = $submission ? 'submitted' : 'pending';
                  $statusClass = $submission ? 'text-green-700 bg-green-50' : 'text-yellow-700 bg-yellow-50';
                @endphp

                <article class="assignment-card bg-white p-4 md:p-5 rounded-lg shadow-sm border border-gray-100 hover:border-indigo-200 hover:shadow-md transition-all duration-200" data-assignment-id="{{ $assignment->id }}" data-subject="{{ $assignment->subject->subject_name ?? '' }}" data-status="{{ $statusLabel }}">
                  <div class="flex items-start gap-3">
                    <div class="flex-1 min-w-0">
                      <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                          <h3 class="font-semibold text-gray-900 truncate">{{ $assignment->title }}</h3>
                          <div class="mt-1 text-sm text-gray-500 flex flex-wrap gap-x-3 gap-y-1">
                            <span>{{ $assignment->subject->subject_name ?? 'General' }}</span>
                            <span>Class {{ $assignment->classAvailable->name ?? 'N/A' }}</span>
                            <span>Due {{ $dueDate->format('M d, Y') }}</span>
                          </div>
                        </div>

                        <div class="text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full {{ $statusClass }} self-start">
                          {{ $statusLabel }}
                        </div>
                      </div>

                      <p class="text-sm text-gray-700 mt-3 leading-6 whitespace-pre-line">{{ $assignment->description }}</p>

                      <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-3">
                        @if ($assignment->attachment)
                          <a href="{{ asset('storage/' . $assignment->attachment) }}" download class="inline-flex items-center gap-2 text-indigo-600 hover:underline text-sm">
                            <i class="bi bi-file-earmark-arrow-down"></i>
                            Download attachment
                          </a>
                        @endif

                        <button type="button" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-indigo-50 text-indigo-700 text-sm hover:bg-indigo-100 transition-colors select-assignment-btn" data-assignment-id="{{ $assignment->id }}">
                          <i class="bi bi-upload"></i>
                          {{ $submission ? 'Update Submission' : 'Upload Submission' }}
                        </button>

                        @if ($submission && $submission->attachment)
                          <a href="{{ asset('storage/' . $submission->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-green-700 hover:underline text-sm">
                            <i class="bi bi-file-earmark-check"></i>
                            View submitted file
                          </a>
                        @endif
                      </div>
                    </div>
                  </div>
                </article>
              @empty
                <div class="rounded-lg border border-dashed border-gray-200 bg-white p-8 text-center shadow-sm">
                  <div class="mx-auto mb-3 h-12 w-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <i class="bi bi-journal-text text-2xl"></i>
                  </div>
                  <h3 class="text-base font-semibold text-gray-800">No assignments yet</h3>
                  <p class="mt-1 text-sm text-gray-500">Your teacher has not posted any assignments for your class yet.</p>
                </div>
              @endforelse
            </div>
          </section>

          <aside class="space-y-6">
            <form action="{{ route('student.assignments.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm p-4 space-y-4">
              @csrf

              <div>
                <h4 class="font-semibold mb-1 text-gray-800">Quick Submit</h4>
                <p class="text-sm text-gray-500">Choose an assignment, attach your work, and send it to your teacher.</p>
              </div>

              <div>
                <label for="assignment_id" class="block text-sm font-medium text-gray-700 mb-1">Assignment</label>
                <select id="assignment_id" name="assignment_id" class="w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm">
                  <option value="">Select assignment</option>
                  @foreach ($assignments as $assignment)
                    <option value="{{ $assignment->id }}">{{ $assignment->title }} - {{ $assignment->subject->subject_name ?? 'General' }} - {{ $assignment->classAvailable->name ?? 'N/A' }}</option>
                  @endforeach
                </select>
                @error('assignment_id')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" rows="3" class="w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm" placeholder="Add a note for your teacher..."></textarea>
                @error('remarks')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
              </div>

              <div id="dropzone" class="border-2 border-dashed border-gray-200 rounded-lg p-4 text-center text-sm text-gray-500 bg-gray-50">
                <p>Drag & drop your completed assignment here or</p>
                <label class="inline-block mt-3 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-md cursor-pointer hover:bg-indigo-100 transition-colors">
                  <input id="fileInput" name="attachment" type="file" class="hidden" />
                  Choose file
                </label>
                <div id="uploadedFiles" class="mt-3 text-sm text-gray-700"></div>
                @error('attachment')<div class="mt-2 text-xs text-red-600">{{ $message }}</div>@enderror
              </div>

              <button id="submitBtn" type="submit" class="w-full bg-indigo-600 text-white px-3 py-2 rounded-md hover:bg-indigo-700 transition-colors">Submit</button>
            </form>

            <div class="bg-white rounded-lg shadow-sm p-4">
              <h4 class="font-semibold mb-2 text-gray-800">Help</h4>
              <p class="text-sm text-gray-600 leading-6">Accepted formats: PDF, DOCX, ZIP. Max 20MB.</p>
            </div>
          </aside>
        </div>
      </div>
    </main>
  </div>

  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('search');
      const subjectFilter = document.getElementById('filterSubject');
      const statusFilter = document.getElementById('filterStatus');
      const cards = Array.from(document.querySelectorAll('.assignment-card'));
      const assignmentSelect = document.getElementById('assignment_id');

      function applyFilters() {
        const searchTerm = (searchInput?.value || '').toLowerCase();
        const subjectValue = subjectFilter?.value || '';
        const statusValue = statusFilter?.value || '';

        cards.forEach(card => {
          const subject = (card.dataset.subject || '').toLowerCase();
          const status = (card.dataset.status || '').toLowerCase();
          const text = card.textContent.toLowerCase();

          const matchesSearch = !searchTerm || text.includes(searchTerm);
          const matchesSubject = !subjectValue || subject === subjectValue.toLowerCase();
          const matchesStatus = !statusValue || status === statusValue.toLowerCase();

          card.classList.toggle('hidden', !(matchesSearch && matchesSubject && matchesStatus));
        });
      }

      if (searchInput) searchInput.addEventListener('input', applyFilters);
      if (subjectFilter) subjectFilter.addEventListener('change', applyFilters);
      if (statusFilter) statusFilter.addEventListener('change', applyFilters);

      const fileInput = document.getElementById('fileInput');
      const uploadedFiles = document.getElementById('uploadedFiles');
      if (fileInput && uploadedFiles) {
        fileInput.addEventListener('change', function(){
          const f = fileInput.files && fileInput.files[0];
          if (f) {
            uploadedFiles.innerHTML = `<div class="text-sm">Selected: <span class="font-medium">${f.name}</span> (${Math.round(f.size/1024)} KB)</div>`;
          }
        });
      }

      document.querySelectorAll('.select-assignment-btn').forEach(button => {
        button.addEventListener('click', function() {
          const assignmentId = button.dataset.assignmentId;
          if (assignmentSelect && assignmentId) {
            assignmentSelect.value = assignmentId;
            assignmentSelect.dispatchEvent(new Event('change', { bubbles: true }));
          }
          const quickSubmitForm = button.closest('article')?.querySelector('button[type="button"]') || assignmentSelect;
          if (quickSubmitForm) {
            quickSubmitForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }

          if (fileInput) {
            fileInput.click();
          }
        });
      });
    });
  </script>

</x-Student-sidebar>