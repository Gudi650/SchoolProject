<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 relative pl-3 md:pl-4">
            <div class="flex items-center gap-3">
              <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
              <div>
                <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Exam Results</h1>
                <p class="text-sm text-gray-500 mt-1">Your published exam performance</p>
              </div>
            </div>
            @if ($currentTerm && $previousTerm)
              <div class="flex gap-2">
                <button id="current-semester-btn" type="button" class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">{{ $currentTerm }}</button>
                <button id="previous-semester-btn" type="button" class="px-3 py-1 border rounded text-sm">{{ $previousTerm }}</button>
              </div>
            @elseif ($currentTerm)
              <span class="text-sm text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">{{ $currentTerm }}</span>
            @endif
          </div>
        </header>

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
        @elseif (empty($terms))
          <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-10 text-center">
            <i class="bi bi-mortarboard text-4xl text-indigo-300 mb-3 block"></i>
            <p class="text-gray-600">No exam results published yet.</p>
          </div>
        @else
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <i class="bi bi-graph-up text-2xl text-indigo-600"></i>
              <div>
                <p class="text-sm text-gray-500">Average Score</p>
                <p class="text-lg font-semibold text-indigo-800" id="average-score">—</p>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <i class="bi bi-star-fill text-2xl text-green-600"></i>
              <div>
                <p class="text-sm text-gray-500">Performance</p>
                <p class="text-lg font-semibold text-green-600" id="remarks">—</p>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <i class="bi bi-trophy text-2xl text-red-600"></i>
              <div>
                <p class="text-sm text-gray-500">Position</p>
                <p class="text-lg font-semibold text-red-600" id="position">—</p>
              </div>
            </div>
          </div>

          <div id="results-table" class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden"></div>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-indigo-800 mb-3 flex items-center gap-2">
              <i class="bi bi-chat-left-text"></i> Teacher's Remarks
            </h2>
            <p id="teacher-remarks" class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-4 rounded-md">—</p>
          </section>
        @endif
      </div>
    </main>

    @if (!empty($terms))
      <script>
        const termData = @json($terms);
        const currentTerm = @json($currentTerm);
        const previousTerm = @json($previousTerm);
        const tableEl = document.getElementById('results-table');
        const avgEl = document.getElementById('average-score');
        const remarksEl = document.getElementById('remarks');
        const positionEl = document.getElementById('position');
        const teacherRemarksEl = document.getElementById('teacher-remarks');

        function renderTerm(term) {
          const data = termData[term];
          if (!data) return;
          avgEl.textContent = data.average + '%';
          remarksEl.textContent = data.remarks;
          positionEl.textContent = data.position;
          teacherRemarksEl.textContent = data.teacher_remarks;
          tableEl.innerHTML = '<table class="w-full text-sm text-left"><thead class="bg-indigo-50 text-indigo-800"><tr><th class="px-4 py-3">Subject</th><th class="px-4 py-3">Score</th><th class="px-4 py-3">Grade</th></tr></thead><tbody class="divide-y divide-gray-100">' +
            data.results.map(r => '<tr class="hover:bg-indigo-50/50"><td class="px-4 py-3">' + r.subject + '</td><td class="px-4 py-3">' + r.score + '%</td><td class="px-4 py-3">' + r.grade + '</td></tr>').join('') +
            '</tbody></table>';
        }

        function setActive(active, inactive) {
          if (!active || !inactive) return;
          active.classList.add('bg-indigo-600', 'text-white');
          active.classList.remove('border');
          inactive.classList.remove('bg-indigo-600', 'text-white');
          inactive.classList.add('border');
        }

        const curBtn = document.getElementById('current-semester-btn');
        const prevBtn = document.getElementById('previous-semester-btn');

        if (curBtn && prevBtn) {
          curBtn.addEventListener('click', () => { setActive(curBtn, prevBtn); renderTerm(currentTerm); });
          prevBtn.addEventListener('click', () => { setActive(prevBtn, curBtn); renderTerm(previousTerm); });
          setActive(curBtn, prevBtn);
          renderTerm(currentTerm);
        } else {
          renderTerm(currentTerm);
        }
      </script>
    @endif

</x-Student-sidebar>
