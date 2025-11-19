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

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">

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

            </div>

            <div>

              <label class="text-sm text-gray-600">
                Select Exam Term
              </label>

              <!-- check if $classes is passed from controller -->
              @if (isset($classes) && $classes->isNotEmpty() )
                
                <select id="avgGradeSelect" 
                name = "class_id"
                class="w-full border rounded px-3 py-2">
                
                  <option value="" disabled selected>
                    Select Exam Term
                  </option>

                  @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
                </select>

              @endif

            </div>

            

            <div class="flex gap-2 justify-end">

              <button id="generateAvgBtn" class="px-4 py-2 bg-indigo-600 text-white rounded">
                Generate
              </button>

              <button id="exportCsvBtn" class="px-4 py-2 border rounded hover:bg-red-100 hover:text-red-700 hover:border-red-200 transition-colors focus:outline-none focus:ring-2 focus:ring-red-200">Export CSV</button>
            </div>

          </div>

          <div class="mt-4">
            <!-- Desktop table -->
            <div class="hidden md:block overflow-x-auto rounded-t-lg shadow-sm border border-gray-100 max-w-full">

              <table id="avgTable" class="w-full table-auto text-sm divide-y divide-gray-200">

                <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 sticky top-0">

                  <tr class="text-xs text-indigo-700 uppercase tracking-wider">
                    <th class="p-3 text-left">Rank</th>
                    <th class="p-3 text-left">Student</th>
                    <th class="p-3 text-center">Mathematics</th>
                    <th class="p-3 text-center">English</th>
                    <th class="p-3 text-center">Kiswahili</th>
                    <th class="p-3 text-right">Total</th>
                    <th class="p-3 text-right">Average</th>
                  </tr>

                </thead>

                <tbody class="bg-white">

                  <tr class="bg-white hover:bg-gray-50 transition-colors">
                    <td class="p-3 font-medium">1</td>
                    <td class="p-3">John Doe</td>
                    <td class="p-3 text-center">85</td>
                    <td class="p-3 text-center">78</td>
                    <td class="p-3 text-center">90</td>
                    <td class="p-3 text-right font-medium">253</td>
                    <td class="p-3 text-right"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">84.33</span></td>

                  </tr>
                  <tr class="bg-gray-50 hover:bg-gray-100 transition-colors">
                    <td class="p-3 font-medium">2</td>
                    <td class="p-3">Jane Smith</td>
                    <td class="p-3 text-center">72</td>
                    <td class="p-3 text-center">68</td>
                    <td class="p-3 text-center">74</td>
                    <td class="p-3 text-right font-medium">214</td>
                    <td class="p-3 text-right"><span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">71.33</span></td>
                  </tr>
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
    });
    </script>

</x-Teacher-sidebar>