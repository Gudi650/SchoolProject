<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto min-w-0">

          <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6">

            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>

            <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">

              <style> 
                .hero-content { position: relative; z-index: 10; } 
              </style>

              <div class="flex items-center gap-3 hero-content">

                <button id="sidebarToggle" 
                aria-label="Open sidebar" 
                class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                  <i class="bi bi-list"></i> 
                </button>

                <div>

                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">
                    Assign Roles
                  </h1>

                  <p class="text-sm text-gray-500 mt-1">
                    Assign or update staff roles quickly and efficiently
                  </p>

                </div>
              </div>

              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <div class="flex items-center gap-3 hero-content">

                <div class="text-sm text-gray-500">
                  Good morning, Teacher
                </div>

                <button aria-label="Profile" 
                class="h-9 w-9 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                
                  <i class="bi bi-person-fill"></i>
                </button>

              </div>
            </div>
          </header>

        <!-- Controls -->
        <section class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
          <div class="md:col-span-2 flex items-center gap-3">
            <div class="flex-1">

              <label class="sr-only" for="search">
                Search users
              </label>
              <input id="search" 
              class="w-full border px-3 py-2 rounded-md" placeholder="Search by name or admission number...">
            </div>

            <select id="roleFilter" class="border px-3 py-2 rounded-md">
              <option value="all">All Roles</option>
            </select>

            <button id="clearFilters" class="px-3 py-2 bg-gray-100 rounded-md text-sm">Clear</button>
          </div>

          <div class="flex items-center justify-end gap-2">
            <select id="bulkRole" class="border px-3 py-2 rounded-md text-sm">
              <option value="">Bulk assign role...</option>
            </select>
            <button id="applyBulk" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Apply</button>
            <button id="bulkDelete" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm" title="Delete selected">Delete</button>
          </div>
        </section>

        <!-- Table (desktop) -->
        <form method="POST" action="{{ route('teacher.assignroles.submit') }}">
          @csrf
        <section class="bg-white p-4 rounded shadow-sm">

          <div class="overflow-x-auto hidden md:block">

            <table class="w-full table-auto text-left rounded-md bg-white shadow-sm">

              <thead class="border-b">
                <tr>
                  <th class="p-3 bg-indigo-100 text-indigo-700 font-semibold text-sm">Teacher</th>
                  <th class="p-3 bg-indigo-100 text-indigo-700 font-semibold text-sm">Admission #</th>
                  <th class="p-3 bg-indigo-100 text-indigo-700 font-semibold text-sm">Current Role</th>
                  <th class="p-3 bg-indigo-100 text-indigo-700 font-semibold text-sm">Assign Role</th>
                  <th class="p-3 bg-indigo-100 text-indigo-700 font-semibold text-sm">Actions</th>
                </tr>
              </thead>

              <tbody id="tableBody" class="divide-y divide-gray-100">
                <!--check if there are teachers in the db-->
                @if (isset($teachers) && $teachers->isEmpty())
                    <tr>
                      <td colspan="5" class="p-3 text-center text-gray-500">
                        No teachers found.
                      </td>
                    </tr>
                @elseif (isset($teachers) && $teachers)
                  
                <!--loop to display teachers from the db-->
                    @foreach ($teachers as $teacher)

                    <tr class="border-b">
                      <td class="p-3 align-top whitespace-normal break-words">
                        <div class="font-medium">
                          {{ $teacher->fname }} {{ $teacher->lname }}
                        </div>
                        <div class="text-sm text-gray-500">
                          Mathematics
                        </div>
                      </td>

                      <td class="p-3 align-top whitespace-normal break-words">
                        T-1001
                      </td>

                      <!--check for the role of the teacher-->
                      @if ($teacher->assignedRoles->isNotEmpty())
                        <td class="p-3 align-top whitespace-normal break-words">
                          <span class="hidden">
                          <!--get the first id of the assigned role-->
                          {{ 
                             $rolezid = $teacher->assignedRoles->first()->teacher_role_id;
                           }}

                           <!--display the name of the assigned role using the id-->
                            {{ 
                              $roleName = $teacherroles->firstWhere('id', $rolezid)->name;
                            }}
                          </span>

                          {{ $roleName }}
                        </td>
                      @else
                        <td class="p-3 align-top whitespace-normal break-words text-gray-500">
                          No role assigned Yet
                        </td>
                      @endif
                      
                      
                      <td class="p-3 align-top whitespace-normal break-words">

                        

                        <!-- Hidden input to store teacher ID -->
                        <input type="hidden" name="teacher_id[]" value="{{ $teacher->id }}">

                        <!--selectos showing the roles available-->
                        <select 
                        name="teacher_role_id[]"
                        class="assign-select border px-2 py-1 rounded cursor-pointer">

                          <!--forloop to display the available roles from the db-->

                          @foreach ($teacherroles as $teacherrole) 
                          <option value= "{{ $teacherrole->id }}">
                            {{ $teacherrole->name }}
                          </option>
                          @endforeach

                        </select>
                      </td>

                      <td class="p-3 align-top space-x-2">
                        <button class="px-2 py-1 text-sm bg-red-100 text-red-600 rounded"><i class="bi bi-trash"></i> Delete</button>
                      </td>
                    </tr>
                    @endforeach


                @endif
                    
                  </tbody>
            </table>
          </div>

          <!-- Cards (mobile) - hardcoded for no-JS mode -->
          <div id="cardsWrap" class="md:hidden space-y-3">

            <!--loop to display teachers from the db-->
            @foreach ($teachers as $teacher)
              <div class="bg-white p-4 rounded shadow">

                <div class="font-medium">
                  {{ $teacher->fname }} {{ $teacher->lname }}
                </div>

                <div class="text-xs text-gray-500">
                  T-1001 · Mathematics
                </div>

                <div class="mt-3">
                  <label class="text-xs text-gray-600">
                    Assign Role
                  </label>

                  <!-- Hidden input to store teacher ID -->
                  <input type="hidden" name="teacher_id[]" value="{{ $teacher->id }}">

                  <select 
                  name="teacher_role_id[]"
                  class="w-full border rounded px-2 py-1 mt-1 text-sm">
                    <!--forloop to display the available roles from the db-->
                      @foreach ($teacherroles as $teacherrole) 
                        <option value= "{{ $teacherrole->id }}">
                          {{ $teacherrole->name }}
                        </option>
                      @endforeach

                  </select>
                </div>
              </div>
            @endforeach
          </div><!--end of the cards wrap-->

          <div class="mt-4 flex items-center justify-between">
             <div class="text-sm text-gray-600" id="selectionInfo"></div>
             <div class="flex items-center gap-2">
               <button id="saveBtn" 
               type="submit"
               class="px-4 py-2 bg-green-600 text-white rounded-md">
                 Save
               </button>

              <button id="resetBtn"
               type="button"
               class="px-4 py-2 border rounded-md">Reset</button>
            </div>
          </div>

          </form>

        </section>
      </main>

    
</x-Teacher-sidebar>