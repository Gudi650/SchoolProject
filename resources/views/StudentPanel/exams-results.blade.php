<x-Student-sidebar>

    

    <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="flex items-center justify-between bg-white p-4 rounded shadow mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <p class="text-2xl font-semibold">Exam Results</p>
        </div>
        <div class="flex gap-2">
          <button id="current-semester-btn" class="px-3 py-1 bg-indigo-600 text-white rounded">Current Semester</button>
          <button id="previous-semester-btn" class="px-3 py-1 border rounded">Previous Semester</button>
        </div>
      </header>

      <div class="flex flex-col md:flex-row gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow flex-1 flex items-center gap-4">
          <i class="bi bi-graph-up text-2xl text-indigo-600"></i>
          <div>
            <p class="text-sm font-medium">Average Score</p>
            <p class="text-lg font-semibold text-indigo-600" id="average-score">85%</p>
          </div>
        </div>

        <div class="bg-white p-4 rounded shadow flex-1 flex items-center gap-4">
          <i class="bi bi-star-fill text-2xl text-green-600"></i>
          <div>
            <p class="text-sm font-medium">Remarks</p>
            <p class="text-lg font-semibold text-green-600" id="remarks">Excellent</p>
          </div>
        </div>

        <div class="bg-white p-4 rounded shadow flex-1 flex items-center gap-4">
          <i class="bi bi-trophy text-2xl text-red-600"></i>
          <div>
            <p class="text-sm font-medium">Position</p>
            <p class="text-lg font-semibold text-red-600" id="position">100/100</p>
          </div>
        </div>
      </div>

      <div id="current-semester-table" class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-3">Subject</th>
              <th class="px-4 py-3">Score</th>
              <th class="px-4 py-3">Grade</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b"><td class="px-4 py-3">Mathematics</td><td class="px-4 py-3">93%</td><td class="px-4 py-3">A+</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Physics</td><td class="px-4 py-3">73%</td><td class="px-4 py-3">B</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Biology</td><td class="px-4 py-3">89%</td><td class="px-4 py-3">A</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Chemistry</td><td class="px-4 py-3">80%</td><td class="px-4 py-3">A</td></tr>
            <tr class="border-b"><td class="px-4 py-3">English</td><td class="px-4 py-3">95%</td><td class="px-4 py-3">A+</td></tr>
          </tbody>
        </table>
      </div>

      <div id="previous-semester-table" class="bg-white rounded shadow mt-6 hidden overflow-hidden">
        <table class="w-full text-left">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-3">Subject</th>
              <th class="px-4 py-3">Score</th>
              <th class="px-4 py-3">Grade</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b"><td class="px-4 py-3">Mathematics</td><td class="px-4 py-3">88%</td><td class="px-4 py-3">A</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Physics</td><td class="px-4 py-3">85%</td><td class="px-4 py-3">A</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Biology</td><td class="px-4 py-3">92%</td><td class="px-4 py-3">A+</td></tr>
            <tr class="border-b"><td class="px-4 py-3">Chemistry</td><td class="px-4 py-3">78%</td><td class="px-4 py-3">B+</td></tr>
            <tr class="border-b"><td class="px-4 py-3">English</td><td class="px-4 py-3">90%</td><td class="px-4 py-3">A</td></tr>
            <tr class="border-b"><td class="px-4 py-3">History</td><td class="px-4 py-3">82%</td><td class="px-4 py-3">A-</td></tr>
          </tbody>
        </table>
      </div>

      <!-- Teacher's remarks and recommendations (modernized) -->
      <section class="mt-6">
        <div class="bg-white rounded-lg shadow-sm p-5">
          <div class="flex items-start justify-between mb-4 gap-4">
            <div class="flex items-start gap-4">
              <!-- Avatar: show image if available, otherwise show a colorful icon fallback -->
              <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0 relative">
                <img src="../StudentPanel/image.png" alt="Teacher avatar" class="w-full h-full object-cover rounded-full shadow-sm" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');" />
                <div class="fallback-avatar hidden absolute inset-0 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center font-semibold text-lg">
                  <i class="bi bi-person-badge-fill text-2xl"></i>
                </div>
              </div>
              <div>
                <h2 class="text-lg font-semibold text-indigo-600 flex items-center gap-2">
                  <i class="bi bi-chat-left-text"></i>
                  Teacher's Remarks & Recommendations
                </h2>
                <p class="text-sm text-gray-500">Ms. A. N. Teacher — Class Teacher</p>
              </div>
            </div>
            <div class="text-sm text-gray-500 whitespace-nowrap">Last updated: <span id="remarks-updated">2025-10-09</span></div>
          </div>

          <div class="grid grid-cols-1 gap-6">
            <div>
              <h3 class="text-sm font-medium text-gray-700 mb-2">Remarks</h3>

              <div id="teacher-remarks-container" class="relative bg-gray-50 rounded-md p-4">
                <p id="teacher-remarks" class="text-gray-700 leading-relaxed">The student has demonstrated strong aptitude in Mathematics and English with consistently high scores. There is room for improvement in Physics where more practice is required on problem-solving techniques. Continued focus on laboratory work will help improve application-based questions. Participation in class discussions has been good; however, attention to deadline management for assignments will increase overall performance. Encourage reading for comprehension to support essay-style answers and integrate short weekly quizzes to track progress.</p>

                <!-- subtle fade at the bottom on small screens to hint there's more -->
                <div id="remarks-fade" class="pointer-events-none absolute left-0 right-0 bottom-0 h-12 bg-gradient-to-t from-white to-transparent md:hidden rounded-b-md"></div>
              </div>

              <button id="remarks-toggle" class="mt-3 inline-flex items-center gap-2 text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md text-sm font-medium hover:bg-indigo-100 transition" aria-expanded="false">
                <span id="remarks-toggle-text">Show more</span>
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div>
              <h3 class="text-sm font-medium text-gray-700 mb-2">Recommendations</h3>

              <div class="space-y-3">
                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-md">
                  <i class="bi bi-check-circle-fill text-green-500 text-xl mt-1"></i>
                  <div class="text-gray-700"><span class="font-medium">Physics practice:</span> Schedule extra problem-solving sessions (1hr/week).</div>
                </div>

                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-md">
                  <i class="bi bi-clock-history text-indigo-500 text-xl mt-1"></i>
                  <div class="text-gray-700"><span class="font-medium">Timed practice:</span> Complete past-paper exercises under timed conditions.</div>
                </div>

                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-md">
                  <i class="bi bi-book-fill text-yellow-500 text-xl mt-1"></i>
                  <div class="text-gray-700"><span class="font-medium">Reading:</span> Read a short article weekly and write a one-paragraph summary.</div>
                </div>

                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-md">
                  <i class="bi bi-beaker text-pink-500 text-xl mt-1"></i>
                  <div class="text-gray-700"><span class="font-medium">Lab work:</span> Attend lab revision sessions to strengthen practical skills.</div>
                </div>

                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-md">
                  <i class="bi bi-journal-check text-sky-500 text-xl mt-1"></i>
                  <div class="text-gray-700"><span class="font-medium">Organization:</span> Use a planner to manage deadlines and revision blocks.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  
  <script>
    (function(){
      const curBtn = document.getElementById('current-semester-btn');
      const prevBtn = document.getElementById('previous-semester-btn');
      const curTable = document.getElementById('current-semester-table');
      const prevTable = document.getElementById('previous-semester-table');
      const avgEl = document.getElementById('average-score');
      const remarksEl = document.getElementById('remarks');
      const positionEl = document.getElementById('position');

      const currentSemesterData = { average: '85%', remarks: 'Excellent', position: '100/100' };
      const previousSemesterData = { average: '86%', remarks: 'Very Good', position: '95/100' };

      function setActiveButton(activeBtn, inactiveBtn){
        activeBtn.classList.add('bg-indigo-600','text-white');
        activeBtn.classList.remove('border');
        inactiveBtn.classList.remove('bg-indigo-600','text-white');
        inactiveBtn.classList.add('border');
      }

      function showCurrent(){
        setActiveButton(curBtn, prevBtn);
        curTable.classList.remove('hidden');
        prevTable.classList.add('hidden');
        avgEl.textContent = currentSemesterData.average;
        remarksEl.textContent = currentSemesterData.remarks;
        positionEl.textContent = currentSemesterData.position;
      }

      function showPrevious(){
        setActiveButton(prevBtn, curBtn);
        prevTable.classList.remove('hidden');
        curTable.classList.add('hidden');
        avgEl.textContent = previousSemesterData.average;
        remarksEl.textContent = previousSemesterData.remarks;
        positionEl.textContent = previousSemesterData.position;
      }

      if(curBtn && prevBtn && curTable && prevTable){
        curBtn.addEventListener('click', function(e){ e.preventDefault(); showCurrent(); });
        prevBtn.addEventListener('click', function(e){ e.preventDefault(); showPrevious(); });
      }

      // Initialize
      showCurrent();
    })();
  </script>

  <script>
    // Teacher remarks show-more toggle
    (function(){
      const remarksEl = document.getElementById('teacher-remarks');
      const toggleBtn = document.getElementById('remarks-toggle');
      const fadeEl = document.getElementById('remarks-fade');
      const toggleText = document.getElementById('remarks-toggle-text');

      if(!remarksEl || !toggleBtn) return;

      // helper to collapse
      function collapse(){
        // clamp visually using max-height transition
        const lineHeight = parseFloat(getComputedStyle(remarksEl).lineHeight) || 20;
        const clampHeight = Math.round(lineHeight * 3);
        remarksEl.style.maxHeight = clampHeight + 'px';
        remarksEl.style.overflow = 'hidden';
        remarksEl.style.transition = 'max-height 300ms ease';
        if(fadeEl) fadeEl.style.display = '';
        toggleBtn.setAttribute('aria-expanded','false');
        if(toggleText) toggleText.textContent = 'Show more';
        toggleBtn.querySelector('i')?.classList.remove('bi-chevron-up');
        toggleBtn.querySelector('i')?.classList.add('bi-chevron-down');
      }

      function expand(){
        remarksEl.style.maxHeight = remarksEl.scrollHeight + 'px';
        remarksEl.style.overflow = '';
        if(fadeEl) fadeEl.style.display = 'none';
        toggleBtn.setAttribute('aria-expanded','true');
        if(toggleText) toggleText.textContent = 'Show less';
        toggleBtn.querySelector('i')?.classList.remove('bi-chevron-down');
        toggleBtn.querySelector('i')?.classList.add('bi-chevron-up');
      }

      function applyResponsive(){
        if(window.innerWidth < 768){
          // initialize collapsed
          collapse();
          toggleBtn.style.display = 'inline-flex';
        } else {
          // fully expanded on larger screens
          remarksEl.style.maxHeight = '';
          remarksEl.style.overflow = '';
          remarksEl.style.transition = '';
          if(fadeEl) fadeEl.style.display = 'none';
          toggleBtn.style.display = 'none';
        }
      }

      toggleBtn.addEventListener('click', function(e){
        e.preventDefault();
        const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        if(expanded){
          collapse();
        } else {
          expand();
        }
      });

      // initialize
      applyResponsive();
      window.addEventListener('resize', applyResponsive);
    })();
  </script>

</x-Student-sidebar>
