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
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">Generate Exam Results</h1>
                </div>

              </div>

              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>

              <div class="flex items-center gap-3 hero-content">

                <a href="./homepage.html" class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                   <i class="bi bi-house-door"></i>
                    Dashboard
                </a>

              </div>

            </div>
          </header>

        <!-- Class Summary (separated) -->
        <section id="classResults" class="bg-white p-6 rounded-lg shadow-sm mt-6">
          <div class="flex items-center justify-between mb-4">

            <h3 class="text-lg font-semibold">
              Class Summary — Generate Averages
            </h3>

            <p class="text-sm text-gray-500">
              Compute student averages across posted subjects and rank them.
            </p>

          </div>

          <form action="{{ route('teacher.searchexamresults') }}" method="POST">

          @csrf

          <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">

              <div>

                <label class="text-sm text-gray-600">
                  Select Class
                </label>

                <!-- check if $classes is passed from controller -->
                @if (isset($classes) && $classes->isNotEmpty() )
                  
                  <select id="avgGradeSelect" 
                  name = "class_id"
                  class="w-full border rounded px-3 py-2">
                    <option value="" disabled selected>Select Class</option>
                    @foreach ($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                  </select>

                @endif

              </div><!--end of exam term-->

              <!--choose exam-date section-->
              <div>

                <label class="text-sm text-gray-600">
                  Select Exam Date
                </label>

                <!--check if $examDates is passed from controller-->
                @if (isset($examDates) && $examDates->isNotEmpty())

                  <select id="avgGradeSelect" 
                  name = "exam-date"
                  class="w-full border rounded px-3 py-2">
                  
                    <option value="" disabled selected>
                      Select Exam Date
                    </option>

                    @foreach ($examDates as $examDate)
                      <option value="{{ $examDate }}">{{ \Carbon\Carbon::parse($examDate)->format('F d, Y') }}</option>
                    @endforeach

                  @else

                    <option class="text-red-500">
                      No exams date posted yet
                    </option>
                  
                @endif
                </select>


              </div><!--end of exam-date-->

              <!--exam name section-->
              <div>

                <label class="text-sm text-gray-600">
                  Select Exam Name
                </label>

                <!--check if examnames is passed from controller-->
                @if (isset($examNames) && $examNames->isNotEmpty())
                  
                  <select id="avgExamSelect" 
                  name = "exam-name"
                  class="w-full border rounded px-3 py-2">

                  <option value="" disabled selected>
                      Select Exam Name
                  </option>

                  @foreach ($examNames as $examName)
                    <option value="{{ $examName }}">
                      {{ $examName }}
                    </option>
                    
                  @endforeach

                  @else

                    <option class="text-red-500">
                      No exam names posted yet
                    </option>

                @endif
                </select>

              </div><!-- end of exam name-->

              <div class="flex gap-2 ml-2">

                <button id="SearchBtn" type="submit" name="action" value="search"
                  class="px-24 py-2 bg-indigo-600 text-white rounded">
                  Search
                </button>
                
              </div>

          </div><!--end of grid-->
          </form>

          <div class="flex gap-2 justify-end my-2">

            <form action="{{ route('teacher.savegeneratedresults') }}" method="POST" class="inline">
              @csrf
              <button id="saveGeneratedBtn" type="submit" class="ml-2 px-3 py-2 bg-green-600 text-white rounded">
                Save Results
              </button>
            </form>

            <button id="exportCsvBtn" class="px-4 py-2 border rounded hover:bg-red-100 hover:text-red-700 hover:border-red-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-200">
              Export CSV
            </button>

          </div>
          

          <div class="mt-4">
            <!-- Desktop table -->
            <div class="hidden md:block overflow-x-auto rounded-t-lg shadow-sm border border-gray-100 max-w-full">

              <table id="avgTable" class="w-full table-auto text-sm divide-y divide-gray-200">

                <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 sticky top-0">

                  <tr class="text-xs text-indigo-700 uppercase tracking-wider">
                    <th class="p-3 text-left">
                      Rank
                    </th>

                    <th class="p-3 text-left">
                      Student
                    </th>

                    <!--check for $subjects passed from controller-->
                    @if (isset($subjects) && $subjects->isNotEmpty())
                      @foreach ($subjects as $subject)

                        <th class="p-3 text-center">
                          {{ $subject->subject_name }}
                        </th>

                      @endforeach

                    @endif

                    <th class="p-3 text-right">Total</th>
                    <th class="p-3 text-right">Average</th>

                  </tr>

                </thead>

                <tbody class="bg-white">

                  <!--check if $examResult is passed from controller-->

                  @if (isset($examResults) && $examResults->isNotEmpty())

                    <!-- get the student values -->
                    @foreach ($students as $student )
                      
                      <tr 
                      data-student-id = "{{ $student->id }}"
                      class="bg-white hover:bg-gray-50 transition-colors">

                      <td class="p-3 font-medium">
                        {{ $resultSummaries[$student->id]['rank'] }}
                      </td>

                      <td class="p-3">
                        {{ $student->fname }}
                        {{ $student->lname }}

                        <!--obtain the student id-->
                        <span class = "hidden">
                          {{ session()->put('student_id', $student->id) }}
                        </span>
                        
                      </td> 
                      <!--loop through the exam-results to get the scores per subject of the student using student id-->

                      <!--check if { session()->get('student_id') }} exists -->

                      @if (session()->get('student_id')  )

                        <!--get the score from $examResults where student_id matches-->

                        @foreach ($subjects as $subject)

                          @php
                            
                            $score = $examResults->where('student_id', session()->get('student_id'))
                            ->where('subject_id', $subject->id)
                            ->first();

                            $totalScore = 0;

                          @endphp

                          <td class="p-3 text-center">

                            @if ($score)
                              {{ $score->score }}
                            @else
                              N/A
                            @endif

                          </td>

                         

                        @endforeach
                        
                      @endif

                      <!--check if $resultSummaries is passed from controller-->

                      @if (isset($resultSummaries) && !empty($resultSummaries[ $student->id ]) )

                        <td class="p-3 text-right font-medium">
                          {{ $resultSummaries[ $student->id ]['total_score'] }}
                        </td>

                        <td class="p-3 text-right">
                          <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ number_format($resultSummaries[ $student->id ]['average_score'], 2) }}
                          </span>
                        </td>
                        
                      @endif

                      </tr>
                  
                    @endforeach

                    
                  @else

                    <tr>
                      <td colspan="{{ isset($subjects) ? $subjects->count() + 4 : 4 }}" class="p-4 text-center text-gray-500">
                        No results found. Please adjust your filters and try again.
                      </td>
                    </tr>

                  @endif

                  
                </tbody>
              </table>
            </div>

            <!-- Mobile cards -->
            <div id="avgMobileList" class="md:hidden mt-3 space-y-3">
              <div class="p-4 bg-white border rounded-lg shadow-sm">
                <div class="flex items-center justify-between mb-2">
                  <div class="font-semibold">1. John Doe</div>
                  <div class="text-sm text-gray-500">Avg <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">84.33</span></div>
                </div>
                <div class="grid grid-cols-3 gap-2 text-sm text-gray-700 mb-2">
                  <div class="text-center"><div class="text-xs text-gray-500">Mat</div><div class="font-medium">85</div></div>
                  <div class="text-center"><div class="text-xs text-gray-500">Eng</div><div class="font-medium">78</div></div>
                  <div class="text-center"><div class="text-xs text-gray-500">Kisw</div><div class="font-medium">90</div></div>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500"><div>Subjects: 3</div><div>Total: <span class="font-medium text-gray-700">253</span></div></div>
              </div>

              <div class="p-4 bg-white border rounded-lg shadow-sm">
                <div class="flex items-center justify-between mb-2">
                  <div class="font-semibold">2. Jane Smith</div>
                  <div class="text-sm text-gray-500">Avg <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">71.33</span></div>
                </div>
                <div class="grid grid-cols-3 gap-2 text-sm text-gray-700 mb-2">
                  <div class="text-center"><div class="text-xs text-gray-500">Mat</div><div class="font-medium">72</div></div>
                  <div class="text-center"><div class="text-xs text-gray-500">Eng</div><div class="font-medium">68</div></div>
                  <div class="text-center"><div class="text-xs text-gray-500">Kisw</div><div class="font-medium">74</div></div>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500"><div>Subjects: 3</div><div>Total: <span class="font-medium text-gray-700">214</span></div></div>
              </div>
            </div>
          </div>
        </section>

      </main>
    </div>

    {{-- flash / toast messages --}}
    @if(session('success') || session('error') || $errors->any())
      <div id="flashToast" class="fixed top-6 right-6 z-50 space-y-2">
        @if(session('success'))
          <div class="px-4 py-3 rounded shadow bg-green-50 border border-green-200 text-green-800" role="alert">
            {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="px-4 py-3 rounded shadow bg-red-50 border border-red-200 text-red-800" role="alert">
            {{ session('error') }}
          </div>
        @endif

        @if($errors->any())
          <div class="px-4 py-3 rounded shadow bg-red-50 border border-red-200 text-red-800" role="alert">
            <ul class="list-disc pl-5">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    @endif

    <script>

    document.addEventListener('DOMContentLoaded', function () {
      // Export CSV (page-specific)
      const exportBtn = document.getElementById('exportCsvBtn');
      if (exportBtn) {
        exportBtn.addEventListener('click', function(){
          const rows = Array.from(document.querySelectorAll('#avgTable tbody tr'));
          if(rows.length===0){ alert('No results to export.'); return; }
          const headers = Array.from(document.querySelectorAll('#avgTable thead th')).map(h=> '"'+h.textContent.trim()+'"');
          let csv = headers.join(',') + '\n';
          rows.forEach(r=>{ const cols = Array.from(r.querySelectorAll('td')).map(c=> '"'+c.textContent.trim()+'"'); csv += cols.join(',') + '\n'; });
          const blob = new Blob([csv], {type: 'text/csv'});
          const url = URL.createObjectURL(blob);
          const a = document.createElement('a'); a.href = url; a.download = 'class_averages.csv'; a.click(); URL.revokeObjectURL(url);
        });
      }

      const toast = document.getElementById('flashToast');
      if (!toast) return;
      // auto-dismiss after 5s with fade
      setTimeout(() => {
        toast.classList.add('transition', 'duration-500', 'opacity-0');
        setTimeout(() => toast.remove(), 600);
      }, 5000);
      // allow click-to-dismiss
      toast.addEventListener('click', () => toast.remove());
    });
    </script>

</x-Teacher-sidebar>