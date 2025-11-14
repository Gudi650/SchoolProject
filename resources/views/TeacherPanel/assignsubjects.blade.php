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
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Teacher
                    </th>

                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      ID
                    </th>

                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Current Assignments
                    </th>

                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Quick Assign
                    </th>

                    <th class="p-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                      Manage
                    </th>

                  </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-100">

                  <!--check if the teacher is available-->
                  @if (isset($teachers) && $teachers )
                    
                  <!--loop through the teachers-->
                  @foreach ($teachers as $teacher)

                  <!--single row-->
                  
                  <tr class="hover:bg-indigo-50/20 transition-colors cursor-default
                  border-b border-gray-100">

                    <!--form to collect data from each row-->
                    <form
                    action = "{{ route('teacher.assignsubjects.submit') }}"
                    method = "POST"
                    >

                    @csrf

                    <!--hidden input to pass teacher_id-->
                    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

                    <!--hidden input to pass school_id-->
                    <input type="hidden" name="school_id" value="{{ $teacher->school_id }}">


                    <td class="p-4 align-top align-middle max-w-xs">

                      <div class="min-w-0">
                        <div class="font-medium text-sm text-gray-800 truncate">
                          {{ $teacher->fname }}
                          {{ $teacher->lname }}
                        </div>

                        <div class="text-xs text-gray-500">
                          Subjects (qualified):
                        </div>

                        <div class="text-xs text-gray-500 truncate"></div>

                        <div class="mt-1 flex flex-wrap gap-1">

                          <!--display teachers qualifications-->

                          <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                            {{ $teacher->subject_specialization }}
                          </span>

                          <!--
                          <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                            Art
                          </span> 
                          -->

                        </div>
                      </div>

                    </td>
                    <td class="p-4 align-top align-middle text-sm text-gray-600">
                      T-1004
                    </td>

                    <td class="p-4 align-top align-middle">

                      <!--check for current assignments-->

                      @if (isset($assignedTeachers) && $assignedTeachers )

                      <!--loop through all the asigned subjects-->
                      @foreach ($assignedTeachers as $assignedTeacher )
                        <!--check if the assigned teacher matches the current teacher-->
                        @if ($assignedTeacher->teacher_id == $teacher->id)

                          <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-xs mb-1">

                            <!--display class name and subject name-->
                            {{$assignedTeacher->classAvailable->name }} • {{$assignedTeacher->availablesubject->subject_name }}

                          </div>

                        @endif
                      @endforeach

                      @else 
                        <div class="flex flex-wrap gap-2">

                          <div class="text-sm text-gray-400">
                            No assignments
                          </div>
                        </div>
                      @endif

                    </td>

                    <td class="p-4 align-top align-middle w-80">
                      <div class="flex flex-wrap items-center gap-2">

                        <!--display the subjects option of the schools-->
                        @if (isset($subjects) && $subjects)

                        <!--option to select the subject-->
                        <select 
                          name= "availablesubject_id"
                          class="border px-2 py-1 rounded text-sm">

                          @foreach ($subjects as $subject)
                            <option
                            value = "{{ $subject->id }}"
                            >{{ $subject->subject_name }}</option>
                          @endforeach

                        </select>
                        @else
                        <div class="text-sm text-red-600">
                          No subjects available for your school.
                        </div>
                        @endif

                        <!--option to select the class to teach the subject selected-->

                        <!--display the subjects option of the schools-->
                        @if (isset($classes) && $classes)

                          <select 
                          name = "class_id"
                          class="border px-2 py-1 rounded text-sm">
                            @foreach ($classes as $class)
                              <option
                              value="{{ $class->id }}"
                              >{{ $class->name }}</option>
                              
                            @endforeach
                          </select>
                        @else
                        <div class="text-sm text-red-600">
                          No classes available for your school.
                        </div>
                        @endif
                        <!-- Assign moved to Manage column -->
                      </div>
                    </td>

                    <td class="p-4 align-top align-middle text-center">
                      <div class="flex items-center justify-center gap-2">

                        <button 
                        type="submit"
                        class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                          Assign
                        </button>

                        <button data-modal-target="#modal-T-1004" class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-200 text-indigo-700 hover:bg-indigo-50 transition text-sm open-left-edit"
                                data-teacher-name="{{ $teacher->fname }} {{ $teacher->lname }}" 

                                data-teacher-id="T-1004">

                          <i class="bi bi-pencil-fill"></i>
                          <span class="hidden sm:inline">
                            Edit
                          </span>

                        </button>

                      </div>
                    </td>

                    <!--end of form-->
                    </form>

                  </tr>

                  @endforeach

                  <!--now check if there is no data set at all-->
                  @else
                
                    <!--display message for empy teachers-->
                    <div class="p-4">
                      <div class="text-sm text-red-600">
                        No teachers found for your school.
                      </div>
                    </div>
                  </div>

                  @endif

                  
                </tbody>
              </table>
            </div>
          </div>

          <!-- Cards mobile -->
          <div id="cardsWrap" class="md:hidden space-y-3">

            <!--single card-->

            <!--check for teachers-->
            @if (isset($teachers) && $teachers )
              
            <!--loop through teachers as well-->
            @foreach ($teachers as $teacher)

              <!--opening form to take the class and subject assignment and the teacher-id-->

              <form 
              action="{{ route('teacher.assignsubjects.submit') }}"
              method = "POST">

              @csrf

              <!--hidden input to pass teacher_id-->
              <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

              <!--hidden input to pass school_id-->
              <input type="hidden" name="school_id" value="{{ $teacher->school_id }}">

              <div class="p-3 border rounded-md bg-white"> 
              <div class="space-y-2">
                <div class="min-w-0">

                  <div class="font-medium text-sm text-gray-800 truncate">
                    {{ $teacher->fname }} 
                    {{ $teacher->lname }}
                  </div>

                  <div class="text-xs text-gray-500">
                    Subjects (qualified):
                  </div>

                  <div class="text-xs text-gray-500 truncate">
                    T-1002
                  </div>

                  <div class="mt-1 flex flex-wrap gap-1">

                    <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                      {{ $teacher->subject_specialization }}
                    </span>

                    <span class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full">
                      Physical Education
                    </span>
                  </div>
                </div>

                <div class="mt-2"> 
                  <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-xs">
                    Not assigned yet

                    <!--
                      Grade 3 • Science
                    -->

                  </div> 
                </div>

                <div class="flex flex-wrap items-center gap-2">

                  <!--check for classes available in the school-->
                  @if (isset($classes) && $classes )
                    
                    <select 
                    name = "class_id"
                    class="border px-2 py-1 rounded text-sm w-1/2">

                      <!--loop the classes available-->
                      @foreach ($classes as $class)
                        <option 
                         value = "{{ $class->id }}"
                         selected >
                          {{ $class->name }}
                        </option>
                      @endforeach

                    </select>
                  @else

                    <div class="text-sm text-red-600 w-1/2">
                      No classes available for your school.
                    </div>

                  @endif
                  <!--check for subjects available in the school-->

                    @if (isset($subjects) && $subjects)

                      <select 
                        name="availablesubject_id"
                        class="border px-2 py-1 rounded text-sm w-1/2">

                        <!--loop the subjects available-->
                        @foreach ($subjects as $subject)
                          <option 
                            value = "{{ $subject->id }}" 
                            selected>
                            {{ $subject->subject_name }}
                          </option>
                        @endforeach
                      </select>
                    
                    @else

                    <div class="text-sm text-red-600 w-1/2">
                      No subjects available for your school yet.
                    </div>

                    @endif

                  <div class="ml-auto flex items-center gap-2">

                    <button 
                    type="submit"
                    class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                      Assign
                    </button>

                    <button data-modal-target="#modal-T-1002" class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-200 text-indigo-700 hover:bg-indigo-50 transition text-sm open-left-edit"
                            data-teacher-name="Samuel Otieno" data-teacher-id="T-1002">
                      <i class="bi bi-pencil-fill"></i>
                      <span class="hidden sm:inline">Edit</span>
                    </button>

                  </div>
                </div>
              </div>
            </div> <!--end of single card-->
 
              </form>
            @endforeach

            @else

              <div class="p-4">
                <div class="text-sm text-red-600">
                  No teachers found for your school.
                </div>
              </div>
            @endif

          </div>  <!--end of cards wrap-->

          <div class="mt-4 flex items-center justify-between ">
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

    <!-- Reusable modal (single instance for all rows/cards) -->
    <div id="reusableModal" class="hidden fixed inset-0 z-40 items-center justify-center bg-black bg-opacity-40 px-4">
      <div class="max-w-lg w-full bg-white rounded-xl shadow-lg p-6 md:p-8">
        <div class="-mx-6 -mt-6 mb-4">
          <div class="bg-indigo-50 p-4 rounded-t-xl">
            <div class="flex items-start justify-between px-6 md:px-8">
              <div class="flex items-center gap-3">
                <i class="bi bi-journal-bookmark-fill text-indigo-700 text-lg"></i>
                <div>
                  <h3 class="text-lg md:text-xl font-semibold text-indigo-800">Edit Assignments — <span id="reusableModalTeacherName">Teacher</span></h3>
                  <div id="reusableModalTeacherId" class="text-xs text-indigo-600">ID</div>
                </div>
              </div>
              <button id="reusableModalClose" class="text-indigo-600 hover:text-indigo-800" aria-label="Close modal"><i class="bi bi-x-lg"></i></button>
            </div>
          </div>
        </div>

        <form id="reusableModalForm" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>

            <label class="text-xs font-medium text-gray-700">
              Grade
            </label>

            <select id="reusableModalGrade" class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>Grade 1</option>
              <option>Grade 2</option>
              <option>Grade 3</option>
              <option>Grade 4</option>
              <option>Grade 5</option>
              <option>Grade 6</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-medium text-gray-700">Subject</label>
            <select id="reusableModalSubject" class="mt-1 block w-full border border-gray-200 rounded px-3 py-2 bg-white text-sm">
              <option>Mathematics</option>
              <option>English</option>
              <option>Science</option>
              <option>History</option>
              <option>Geography</option>
              <option>Art</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="text-xs font-medium text-gray-700">
              Notes (optional)
            </label>

            <textarea id="reusableModalNotes" class="mt-1 w-full border border-gray-200 rounded p-2 text-sm" rows="3" placeholder="Add a note about this assignment..."></textarea>

          </div>
        </form>

        <div class="mt-6 flex items-center justify-end gap-3">
          <button id="reusableModalCancel" class="px-4 py-2 border rounded text-sm hover:bg-red-200 hover:text-red-800 transition-colors">Cancel</button>
          <button id="reusableModalSave" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">Save changes</button>
        </div>
      </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      const modal = document.getElementById('reusableModal');
      const closeBtn = document.getElementById('reusableModalClose');
      const cancelBtn = document.getElementById('reusableModalCancel');
      const saveBtn = document.getElementById('reusableModalSave');

      function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }
      function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }

      // Open reusable modal for any Edit button.
      // NOTE: JS will NOT populate any form fields or set teacher data.
      // Server (PHP) will supply data when you implement backend later.
      document.addEventListener('click', function(e){
        const btn = e.target.closest('.open-left-edit, [data-open-left-edit]');
        if(!btn) return;
        e.preventDefault();
        openModal();
      });

      // close handlers
      closeBtn.addEventListener('click', closeModal);
      cancelBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', function(e){ if(e.target === modal) closeModal(); });

      // Save: closes modal only. Backend form submission will be implemented in PHP later.
      saveBtn.addEventListener('click', function(){
        closeModal();
      });
    });
    </script>
 
 </x-Teacher-sidebar>