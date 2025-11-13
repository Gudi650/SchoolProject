<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">
          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">

            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>

            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">

              <style> .hero-content { position: relative; z-index: 10; } </style>

              <div class="flex items-center gap-3 hero-content">

                <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>

                <div>

                  <h1 class="text-lg md:text-2xl font-bold text-indigo-800">
                    Assign Classes & Subjects
                  </h1>

                  <p class="hidden sm:block text-sm text-gray-500 mt-1">
                    Assign which class section and subject each teacher will handle
                  </p>

                </div>
              </div>

              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>

              <div class="flex items-center gap-3 hero-content">

                <!--greeting message-->
                <div class="text-sm text-gray-500 text-right">
                  Good morning, Teacher
                </div>

                <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700">
                  <i class="bi bi-person-circle text-xl"></i>
                </div><!--profile icon -->

              </div>

            </div>
          </header>

        <!-- Controls -->
        <section class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
          <div class="md:col-span-2 flex flex-wrap items-center gap-3">
            <div class="flex-1 sm:min-w-[220px]">

              <form 
              action="" 
              method = "POST"
              class="w-full">

                <label class="sr-only" for="search">
                  Search teachers
                </label>

                <div class="flex w-full items-center gap-2">

                  <!-- Search input -->
                  <input id="search" 
                  class="flex-1 min-w-0 border border-gray-200 px-3 py-2 rounded-md text-sm" 
                  placeholder="Search by name or ID...">

                  <button type="submit" 
                  class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-200 shadow-sm">

                    <i class="bi bi-search"></i>
                    <span class="hidden sm:inline">
                      Search
                    </span>

                  </button>

                </div>
              </form>
            </div>

          </div>
        </section>

        <!-- Table -->
        <section class="bg-white p-4 rounded shadow-sm">
          <div class="overflow-x-auto hidden md:block">
            <div class="rounded-lg shadow-sm overflow-hidden">
              <table class="min-w-full divide-y divide-gray-100 bg-white">
                <thead class="bg-white">
                  <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Teacher</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Current Assignments</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quick Assign</th>
                    <th class="p-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Manage</th>
                  </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-100">


                  <tr class="hover:bg-indigo-50/20 transition-colors cursor-default">
                    <td class="p-4 align-top align-middle max-w-xs">

                      <div class="min-w-0">
                        <div class="font-medium text-sm text-gray-800 truncate">
                          Peter Kiplagat
                        </div>

                        <div class="text-xs text-gray-500">
                          Subjects (qualified):
                        </div>

                        <div class="text-xs text-gray-500 truncate"></div>

                        <div class="mt-1 flex flex-wrap gap-1">

                          <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                            Geography
                          </span>

                          <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                            Art
                          </span>

                        </div>
                      </div>

                    </td>
                    <td class="p-4 align-top align-middle text-sm text-gray-600">
                      T-1004
                    </td>

                    <td class="p-4 align-top align-middle">

                      <div class="flex flex-wrap gap-2">

                        <div class="text-sm text-gray-400">
                          No assignments
                        </div>
                        

                      </div>

                      <div class="flex flex-wrap gap-2">

                        <div class="text-sm text-gray-400">
                          No assignments
                        </div>
                        
                      </div>
                    </td>

                    <td class="p-4 align-top align-middle w-80">
                      <div class="flex flex-wrap items-center gap-2">

                        <!--option to select the subject-->
                        <select class="border px-2 py-1 rounded text-sm">
                          <option>Grade 1</option>
                          <option>Grade 2</option>
                          <option>Grade 3</option>
                          <option>Grade 4</option>
                          <option>Grade 5</option>
                          <option>Grade 6</option>
                        </select>

                        <!--option to select the class to teach the subject selected-->

                        <select class="border px-2 py-1 rounded text-sm">
                          <option>Mathematics</option>
                          <option>English</option>
                          <option>Science</option>
                          <option>History</option>
                          <option>Geography</option>
                          <option>Art</option>
                          <option>Physical Education</option>
                          <option>Computer Studies</option>
                        </select>

                        <!-- Assign moved to Manage column -->
                      </div>
                    </td>

                    <td class="p-4 align-top align-middle text-center">
                      <div class="flex items-center justify-center gap-2">

                        <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                          Assign
                        </button>

                        <button data-modal-target="#modal-T-1004" class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-200 text-indigo-700 hover:bg-indigo-50 transition text-sm">
                          <i class="bi bi-pencil-fill"></i>
                          <span class="hidden sm:inline">
                            Edit
                          </span>
                        </button>

                      </div>
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Cards mobile -->
          <div id="cardsWrap" class="md:hidden space-y-3">

            <div class="p-3 border rounded-md bg-white">
              <div class="space-y-2">
                <div class="min-w-0">

                  <div class="font-medium text-sm text-gray-800 truncate">
                    Samuel Otieno
                  </div>

                  <div class="text-xs text-gray-500">
                    Subjects (qualified):
                  </div>

                  <div class="text-xs text-gray-500 truncate">
                    T-1002
                  </div>

                  <div class="mt-1 flex flex-wrap gap-1">

                    <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                      Science
                    </span>

                    <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                      Physical Education
                    </span>
                  </div>
                </div>

                <div class="mt-2"> 
                  <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-xs">
                    Grade 3 • Science
                  </div> 
                </div>

                <div class="flex flex-wrap items-center gap-2">

                  <select class="border px-2 py-1 rounded text-sm w-1/2">
                    <option>Grade 1</option>
                    <option>Grade 2</option>
                    <option selected>Grade 3</option>
                  </select>

                  <select class="border px-2 py-1 rounded text-sm w-1/2">
                    <option>Mathematics</option>
                    <option>English</option>
                    <option selected>Science</option>
                  </select>

                  <div class="ml-auto flex items-center gap-2">

                    <button class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                      Assign
                    </button>

                    <button data-modal-target="#modal-T-1002" class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-200 text-indigo-700 hover:bg-indigo-50 transition text-sm">
                      <i class="bi bi-pencil-fill"></i>
                      <span class="hidden sm:inline">
                        Edit
                      </span>
                    </button>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-600" id="selectionInfo">
            </div>
            <div class="flex items-center gap-2">

              <button id="saveBtn" class="px-4 py-2 bg-green-600 text-white rounded-md">
                Save
              </button>

              <button id="resetBtn" class="px-4 py-2 border rounded-md">
                Reset
              </button>

            </div>
          </div>
        </section>
      </main>
    </div>

    <!-- Static per-teacher Manage modals -->

    <div id="modal-T-1004" class="hidden fixed inset-0 z-40 items-center justify-center bg-black bg-opacity-40 px-4">
      <div class="max-w-lg w-full bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="-mx-6 -mt-6 mb-4">
          <div class="bg-indigo-50 p-4 rounded-t-xl">
            <div class="flex items-start justify-between px-6 md:px-8">
              <div class="flex items-center gap-3">
                <i class="bi bi-journal-bookmark-fill text-indigo-700 text-lg"></i>
                <div>
                  <h3 class="text-lg md:text-xl font-semibold text-indigo-800">Edit Assignments — Peter Kiplagat</h3>
                  <div class="text-xs text-indigo-600">T-1004</div>
                </div>
              </div>
              <button class="close-static-modal text-indigo-600 hover:text-indigo-800" aria-label="Close modal"><i class="bi bi-x-lg"></i></button>
            </div>
          </div>
        </div>

        <form class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-medium text-gray-700">Grade</label>
            <select class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>Grade 1</option>
              <option>Grade 2</option>
              <option>Grade 3</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-medium text-gray-700">Subject</label>
            <select class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>Mathematics</option>
              <option>English</option>
              <option>Science</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="text-xs font-medium text-gray-700">Notes (optional)</label>
            <textarea class="mt-1 w-full border border-gray-200 rounded p-2 text-sm" rows="3" placeholder="Add a note about this assignment..."></textarea>
          </div>
        </form>

          <div class="mt-6 flex items-center justify-end gap-3">
            <button class="close-static-modal px-4 py-2 border rounded text-sm hover:bg-red-200 hover:text-red-800 transition-colors">Cancel</button>
            <button class="close-static-modal px-4 py-2 bg-indigo-600 text-white rounded text-sm">Save changes</button>
          </div>
      </div>
    </div>

    <div id="modal-T-1005" class="hidden fixed inset-0 z-40 items-center justify-center bg-black bg-opacity-40 px-4">
      <div class="max-w-lg w-full bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="-mx-6 -mt-6 mb-4">
          <div class="bg-indigo-50 p-4 rounded-t-xl">
            <div class="flex items-start justify-between px-6 md:px-8">
              <div class="flex items-center gap-3">
                <i class="bi bi-journal-bookmark-fill text-indigo-700 text-lg"></i>
                <div>
                  <h3 class="text-lg md:text-xl font-semibold text-indigo-800">Edit Assignments — Mary Wambui</h3>
                  <div class="text-xs text-indigo-600">T-1005</div>
                </div>
              </div>
              <button class="close-static-modal text-indigo-600 hover:text-indigo-800" aria-label="Close modal"><i class="bi bi-x-lg"></i></button>
            </div>
          </div>
        </div>

        <form class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="text-xs font-medium text-gray-700">Grade</label>
            <select class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>Grade 1</option>
              <option selected>Grade 2</option>
              <option>Grade 3</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-medium text-gray-700">Subject</label>
            <select class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>History</option>
              <option>English</option>
              <option>Mathematics</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="text-xs font-medium text-gray-700">Notes (optional)</label>
            <textarea class="mt-1 w-full border border-gray-200 rounded p-2 text-sm" rows="3" placeholder="Add a note about this assignment..."></textarea>
          </div>
        </form>

          <div class="mt-6 flex items-center justify-end gap-3">
            <button class="close-static-modal px-4 py-2 border rounded text-sm hover:bg-red-200 hover:text-red-800 transition-colors">Cancel</button>
            <button class="close-static-modal px-4 py-2 bg-indigo-600 text-white rounded text-sm">Save changes</button>
          </div>
      </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function(){
      

      // Modal open/close for static modals
      document.querySelectorAll('[data-modal-target]').forEach(b => b.addEventListener('click', function(){
        const sel = this.dataset.modalTarget || this.getAttribute('data-modal-target');
        if(!sel) return;
        const modal = document.querySelector(sel);
        if(modal){ modal.classList.remove('hidden'); modal.classList.add('flex'); }
      }));
      document.querySelectorAll('.close-static-modal').forEach(b => b.addEventListener('click', function(){ const modal = this.closest('[id^="modal-"]'); if(modal){ modal.classList.add('hidden'); modal.classList.remove('flex'); } }));
      // clicking overlay on static modals to close
      document.querySelectorAll('[id^="modal-T-"]').forEach(m=> m.addEventListener('click', function(e){ if(e.target===m){ m.classList.add('hidden'); m.classList.remove('flex'); } }));
    });
    </script>

</x-Teacher-sidebar>