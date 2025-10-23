<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
            <h1 class="text-xl font-medium">Assignments</h1>
          </div>
          <div class="w-full sm:w-auto">
            <input id="search" type="search" placeholder="Search assignments" class="w-full sm:w-64 border rounded px-3 py-2" />
          </div>
        </div>
      </header>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <section class="lg:col-span-2 space-y-6">
          <!-- Filters and controls -->
          <div class="bg-white rounded-lg shadow p-4 flex flex-col sm:flex-row items-start sm:items-center gap-3">
            <select id="filterSubject" class="w-full sm:w-auto border rounded p-2">
              <option value="">All subjects</option>
              <option>Mathematics</option>
              <option>English</option>
              <option>Science</option>
            </select>
            <select id="filterStatus" class="w-full sm:w-auto border rounded p-2">
              <option value="">All</option>
              <option value="pending">Pending</option>
              <option value="submitted">Submitted</option>
            </select>
            <div class="ml-auto text-sm text-gray-500">You have <span id="pendingCount" class="font-medium">2</span> pending assignments</div>
          </div>

          <!-- Assignment list (cards) - hardcoded -->
          <div id="assignmentsList" class="space-y-4">
            <div class="bg-white p-4 rounded-lg shadow">
              <div class="flex items-start gap-3">
                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <div>
                      <h3 class="font-semibold">Algebra Practice</h3>
                      <div class="text-sm text-gray-500">Mathematics • Due 2025-10-15</div>
                    </div>
                    <div class="text-sm text-yellow-600 font-medium">pending</div>
                  </div>
                  <p class="text-sm text-gray-700 mt-2">Complete exercises 1-20 on page 42.</p>
                  <div class="mt-3 flex flex-col sm:flex-row sm:items-center gap-2">
                    <a href="data:text/plain;charset=utf-8,Algebra%20Practice%20-%20sample%20attachment" download="algebra.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download</a>
                    <button class="inline-flex items-center gap-2 px-3 py-1 rounded bg-indigo-50 text-indigo-700">Upload Submission</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
              <div class="flex items-start gap-3">
                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <div>
                      <h3 class="font-semibold">Book Report</h3>
                      <div class="text-sm text-gray-500">English • Due 2025-10-20</div>
                    </div>
                    <div class="text-sm text-green-600 font-medium">submitted</div>
                  </div>
                  <p class="text-sm text-gray-700 mt-2">Write a 500-word review of the assigned reading.</p>
                  <div class="mt-3 flex flex-col sm:flex-row sm:items-center gap-2">
                    <a href="data:text/plain;charset=utf-8,Book%20Report%20-%20sample%20attachment" download="report.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download</a>
                    <button class="inline-flex items-center gap-2 px-3 py-1 rounded bg-indigo-50 text-indigo-700">View Submission</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
              <div class="flex items-start gap-3">
                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <div>
                      <h3 class="font-semibold">Lab Worksheet</h3>
                      <div class="text-sm text-gray-500">Science • Due 2025-10-18</div>
                    </div>
                    <div class="text-sm text-yellow-600 font-medium">pending</div>
                  </div>
                  <p class="text-sm text-gray-700 mt-2">Fill in the lab worksheet and attach results.</p>
                  <div class="mt-3 flex flex-col sm:flex-row sm:items-center gap-2">
                    <a href="data:text/plain;charset=utf-8,Lab%20Worksheet%20-%20sample%20attachment" download="lab.pdf" class="inline-flex items-center gap-2 text-indigo-600 hover:underline"><i class="bi bi-file-earmark-arrow-down"></i> Download</a>
                    <button class="inline-flex items-center gap-2 px-3 py-1 rounded bg-indigo-50 text-indigo-700">Upload Submission</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <aside class="space-y-6">
          <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold mb-2">Upload Submission</h4>
            <div id="dropzone" class="border-2 border-dashed border-gray-200 rounded p-4 text-center text-sm text-gray-500">
              <p>Drag & drop your completed assignment here or</p>
              <label class="inline-block mt-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded cursor-pointer"><input id="fileInput" type="file" class="hidden" /> Choose file</label>
              <div id="uploadedFiles" class="mt-3 text-sm text-gray-700"></div>
            </div>
            <button id="submitBtn" class="mt-3 w-full bg-indigo-600 text-white px-3 py-2 rounded">Submit</button>
          </div>

          <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold mb-2">Help</h4>
            <p class="text-sm text-gray-600">Accepted formats: PDF, DOCX, ZIP. Max 20MB (demo client-side only).</p>
          </div>
        </aside>
      </div>
    </main>
  </div>

  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <script>
    // Sidebar behavior (same as homepage)
    document.addEventListener('DOMContentLoaded', function() {
      

      // File preview only (no backend logic)
      const fileInput = document.getElementById('fileInput');
      const uploadedFiles = document.getElementById('uploadedFiles');
      fileInput.addEventListener('change', function(){ const f = fileInput.files && fileInput.files[0]; if(f){ uploadedFiles.innerHTML = `<div class="text-sm">Selected: <span class="font-medium">${f.name}</span> (${Math.round(f.size/1024)} KB)</div>`; } });
    });
  </script>

</x-Student-sidebar>