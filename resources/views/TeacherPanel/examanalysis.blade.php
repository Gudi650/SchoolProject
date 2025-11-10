<x-Teacher-sidebar>

    <!-- Chart.js for client-side charts (no backend required) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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
                  <h1 class="text-xl md:text-2xl font-bold text-indigo-800">Exam Results Analysis</h1>
                </div>
              </div>
              <div class="flex-1 text-center">
                <!-- snapshot message intentionally removed on non-homepage pages -->
              </div>
              <div class="flex items-center gap-3 hero-content">
                <a href="./homepage.html" class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm"> <i class="bi bi-house-door"></i> Dashboard</a>
              </div>
            </div>
          </header>

        <section class="bg-white p-6 rounded-lg shadow-sm mt-6">
          <div class="flex flex-col md:flex-row md:items-start md:gap-6">
            <!-- Left: Chart -->
            <div class="flex-1">
              <div class="flex items-center justify-between mb-4">
                <div>
                  <h2 class="text-lg font-semibold">Subject Performance Comparison</h2>
                  <p class="text-sm text-gray-600">Compare current marks to previous exam records for selected subject.</p>
                </div>
                <div class="mt-2 md:mt-0">
                  <label class="text-sm text-gray-500 mr-2">Subject:</label>
                  <select id="subjectSelect" class="border rounded p-2 bg-white">
                    <!-- Filled by JS -->
                  </select>
                </div>
              </div>

              <div class="bg-gray-50 p-4 rounded-md">
                <canvas id="comparisonChart" aria-label="Comparison chart" role="img"></canvas>
              </div>

              <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="p-3 bg-white rounded shadow-sm">
                  <div class="text-sm text-gray-500">Class Average (Current)</div>
                  <div id="avgCurrent" class="text-2xl font-bold">--</div>
                </div>
                <div class="p-3 bg-white rounded shadow-sm">
                  <div class="text-sm text-gray-500">Class Average (Previous)</div>
                  <div id="avgPrevious" class="text-2xl font-bold">--</div>
                </div>
              </div>
            </div>

            <!-- Right: Table / Cards -->
            <aside class="w-full md:w-96 mt-6 md:mt-0">
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-md font-semibold">Student Breakdown</h3>
                <button id="exportCsv" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">Export CSV</button>
              </div>

              <!-- Desktop table -->
              <div id="tableWrap" class="hidden md:block bg-white rounded shadow-sm overflow-x-auto max-w-full">
                <table class="w-full table-auto">
                  <thead class="bg-gray-100 text-left"><tr><th class="p-3">Student</th><th class="p-3">Current</th><th class="p-3">Previous</th><th class="p-3">Δ</th></tr></thead>
                  <tbody id="studentsTableBody"></tbody>
                </table>
              </div>

              <!-- Mobile cards -->
              <div id="cardsWrap" class="md:hidden space-y-3">
                <!-- Filled by JS -->
              </div>
            </aside>
          </div>
        </section>

        <!-- Class Average Over Time -->
        <section class="bg-white p-6 rounded-lg shadow-sm mt-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-lg font-semibold">Class Average Over Time</h2>
              <p class="text-sm text-gray-600">View the class' average performance across recent exams.</p>
            </div>
            <div class="flex items-center gap-3">
              <label class="text-sm text-gray-500">Show:</label>
              <select id="classRangeSelect" class="border rounded p-2 bg-white">
                <option value="4">Last 4 exams</option>
                <option value="6">Last 6 exams</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
            <div class="md:col-span-2 bg-gray-50 p-4 rounded">
              <canvas id="classAvgChart" aria-label="Class average over time" role="img"></canvas>
            </div>
            <div class="bg-white p-4 rounded shadow-sm">
              <div class="text-sm text-gray-500">Latest Class Average (all subjects)</div>
              <div id="latestClassAvg" class="text-3xl font-bold mt-2">--</div>
              <div id="classTrend" class="text-sm text-gray-500 mt-2">Trend: --</div>
              <div id="classLegend" class="mt-3 flex flex-wrap gap-2"></div>
            </div>
          </div>
        </section>

      </main>
    </div>

  <script>
  // Page JS: shared sidebar helpers + chart + sample data (client-side only)
  document.addEventListener('DOMContentLoaded', function () {


      // ---------- Sample data (client-only) ----------
      // Structure: subjects -> array of { adm, name, previous, current }
      const sample = {
        'Mathematics': [
          {adm: 'A001', name: 'Alice K', previous: 78, current: 85},
          {adm: 'A002', name: 'Brian M', previous: 65, current: 72},
          {adm: 'A003', name: 'Charles T', previous: 88, current: 90},
          {adm: 'A004', name: 'Diana P', previous: 54, current: 60},
          {adm: 'A005', name: 'Eve R', previous: 92, current: 95},
        ],
        'English': [
          {adm: 'A001', name: 'Alice K', previous: 82, current: 78},
          {adm: 'A002', name: 'Brian M', previous: 70, current: 75},
          {adm: 'A003', name: 'Charles T', previous: 85, current: 88},
          {adm: 'A004', name: 'Diana P', previous: 60, current: 66},
          {adm: 'A005', name: 'Eve R', previous: 90, current: 91},
        ],
        'Biology': [
          {adm: 'A001', name: 'Alice K', previous: 70, current: 74},
          {adm: 'A002', name: 'Brian M', previous: 68, current: 70},
          {adm: 'A003', name: 'Charles T', previous: 80, current: 78},
          {adm: 'A004', name: 'Diana P', previous: 50, current: 58},
          {adm: 'A005', name: 'Eve R', previous: 88, current: 90},
        ]
      };

      const subjectSelect = document.getElementById('subjectSelect');
      const comparisonChartCtx = document.getElementById('comparisonChart').getContext('2d');
      let chart = null;

      function populateSubjects() {
        Object.keys(sample).forEach(sub => {
          const opt = document.createElement('option'); opt.value = sub; opt.textContent = sub; subjectSelect.appendChild(opt);
        });
        subjectSelect.value = Object.keys(sample)[0];
      }

      function computeAverages(list) {
        const cur = list.reduce((s, r) => s + r.current, 0) / list.length;
        const prev = list.reduce((s, r) => s + r.previous, 0) / list.length;
        return {cur: Math.round(cur * 10) / 10, prev: Math.round(prev * 10) / 10};
      }

      function renderChart(subject) {
        const rows = sample[subject] || [];
        const labels = rows.map(r => r.name);
        const currentData = rows.map(r => r.current);
        const previousData = rows.map(r => r.previous);

        const data = {
          labels,
          datasets: [
            { label: 'Previous', data: previousData, borderColor: 'rgba(99,102,241,0.7)', backgroundColor: 'rgba(99,102,241,0.12)', tension: 0.2 },
            { label: 'Current', data: currentData, borderColor: 'rgba(16,185,129,0.85)', backgroundColor: 'rgba(16,185,129,0.12)', tension: 0.2 }
          ]
        };

        const cfg = { type: 'line', data, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, max: 100 } } } };

        // ensure canvas has a height for responsive layout
        document.getElementById('comparisonChart').height = 320;

        if (chart) chart.destroy();
        chart = new Chart(comparisonChartCtx, cfg);
      }

      function renderStudentsList(subject) {
        const rows = sample[subject] || [];
        const tbody = document.getElementById('studentsTableBody'); tbody.innerHTML = '';
        const cardsWrap = document.getElementById('cardsWrap'); cardsWrap.innerHTML = '';

        rows.forEach(r => {
          const delta = r.current - r.previous;
          // table row (desktop)
          const tr = document.createElement('tr'); tr.className = 'border-b';
          tr.innerHTML = `<td class="p-3">${r.name} <div class="text-xs text-gray-400">${r.adm}</div></td><td class="p-3">${r.current}</td><td class="p-3">${r.previous}</td><td class="p-3">${delta>0? '+'+delta: delta}</td>`;
          tbody.appendChild(tr);

          // mobile card
          const card = document.createElement('div'); card.className = 'p-3 bg-white rounded shadow-sm';
          card.innerHTML = `<div class="flex items-center justify-between"><div><div class="font-semibold">${r.name}</div><div class="text-xs text-gray-400">${r.adm}</div></div><div class="text-right"><div class="text-lg font-bold">${r.current}</div><div class="text-xs text-gray-500">Prev: ${r.previous}</div></div></div>`;
          cardsWrap.appendChild(card);
        });

        const avgs = computeAverages(rows);
        document.getElementById('avgCurrent').textContent = avgs.cur;
        document.getElementById('avgPrevious').textContent = avgs.prev;
      }

      function exportCsvForSubject(subject) {
        const rows = sample[subject] || [];
        const csv = ['Admission,Name,Current,Previous,Delta'].concat(rows.map(r => `${r.adm},"${r.name}",${r.current},${r.previous},${r.current - r.previous}`)).join('\n');
        const blob = new Blob([csv], {type: 'text/csv'});
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a'); a.href = url; a.download = `${subject.replace(/\s+/g,'_')}_comparison.csv`; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
      }

      // wire up selectors and export
      populateSubjects();
      renderChart(subjectSelect.value);
      renderStudentsList(subjectSelect.value);

      subjectSelect.addEventListener('change', function () {
        const s = this.value;
        renderChart(s);
        renderStudentsList(s);
      });

      document.getElementById('exportCsv').addEventListener('click', function () { exportCsvForSubject(subjectSelect.value); });

      // End page-specific JS
    });
    
    // Class average chart (multi-series per subject) + sample data
    (function(){
      // sample: exams and per-subject averages (most recent last)
      const classSeries = {
        exams: ['Term1','Term2','Midterm','Term3','Prelim','Final'],
        subjects: {
          'Mathematics': [68.5, 70.0, 71.8, 71.6, 73.9, 75.4],
          'English':     [66.2, 67.8, 69.3, 68.5, 70.1, 71.7],
          'Biology':     [64.0, 65.6, 66.5, 66.8, 68.9, 70.2]
        }
      };

      const colors = ['rgba(99,102,241,0.85)', 'rgba(16,185,129,0.85)', 'rgba(234,88,12,0.85)', 'rgba(14,165,233,0.85)'];

      const classCtxEl = document.getElementById('classAvgChart');
      if (!classCtxEl) return;
      const classCtx = classCtxEl.getContext('2d');
      let classChart = null;

      function renderClassAvg(range) {
        const start = Math.max(0, classSeries.exams.length - range);
        const labels = classSeries.exams.slice(start);

        const datasets = Object.keys(classSeries.subjects).map((subject, i) => {
          const full = classSeries.subjects[subject];
          const data = full.slice(start);
          return {
            label: subject,
            data,
            borderColor: colors[i % colors.length],
            backgroundColor: colors[i % colors.length].replace('0.85', '0.12'),
            fill: true,
            tension: 0.2,
            pointRadius: 3
          };
        });

        const cfg = {
          type: 'line',
          data: { labels, datasets },
          options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, max: 100 } }, interaction: { mode: 'index', intersect: false } }
        };

        classCtxEl.height = 260;
        if (classChart) classChart.destroy();
        classChart = new Chart(classCtx, cfg);

        // update latest overall avg (mean of subject latests) and trend
        const latestVals = Object.keys(classSeries.subjects).map(s => {
          const arr = classSeries.subjects[s].slice(start);
          return arr[arr.length - 1];
        });
        const prevVals = Object.keys(classSeries.subjects).map(s => {
          const arr = classSeries.subjects[s].slice(start);
          return arr[arr.length - 2] ?? arr[arr.length - 1];
        });
        const latestAvg = latestVals.reduce((a,b)=>a+b,0)/latestVals.length;
        const prevAvg = prevVals.reduce((a,b)=>a+b,0)/prevVals.length;
        document.getElementById('latestClassAvg').textContent = latestAvg.toFixed(1);
        const trend = latestAvg - prevAvg;
        document.getElementById('classTrend').textContent = `Trend: ${trend>=0? '+':'-'}${Math.abs(trend).toFixed(1)}`;

        // build legend toggles
        const legendWrap = document.getElementById('classLegend');
        legendWrap.innerHTML = '';
        datasets.forEach((ds, idx) => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'px-2 py-1 rounded text-sm border flex items-center gap-2';
          btn.innerHTML = `<span style="display:inline-block;width:12px;height:12px;background:${ds.borderColor};border-radius:3px"></span>${ds.label}`;
          btn.addEventListener('click', function(){
            const meta = classChart.getDatasetMeta(idx);
            meta.hidden = meta.hidden === null ? !classChart.data.datasets[idx].hidden : !meta.hidden;
            classChart.update();
            btn.classList.toggle('opacity-50', meta.hidden === true);
          });
          legendWrap.appendChild(btn);
        });
      }

      const rangeSelect = document.getElementById('classRangeSelect');
      renderClassAvg(Number(rangeSelect.value));
      rangeSelect.addEventListener('change', function(){ renderClassAvg(Number(this.value)); });
    })();
    </script>

</x-Teacher-sidebar>