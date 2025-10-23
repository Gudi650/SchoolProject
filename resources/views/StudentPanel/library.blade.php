<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10">
      <header class="flex items-center justify-between bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex items-center gap-4">
          <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"> <i class="bi bi-list"></i> </button>
          <h1 class="text-xl font-medium">Library</h1>
        </div>
        <div class="flex items-center gap-3">
          <div class="text-sm text-gray-500">Visits: <span id="visitCount">0</span></div>
          <div class="text-xs text-gray-400">(Visits are recorded by library staff)</div>
        </div>
      </header>

      <div class="bg-white rounded shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h2 class="text-lg font-semibold">Your Library Activity</h2>
            <p class="text-sm text-gray-500">Track visits and borrowed books (local demo).</p>
          </div>
          <div class="space-x-2">
            <button id="addBorrowBtn" class="px-3 py-1 bg-green-600 text-white rounded text-sm"><i class="bi bi-plus-lg"></i> Borrow Book</button>
            <button id="clearBtn" class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded text-sm">Clear Demo</button>
          </div>
        </div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="p-4 bg-indigo-50 rounded">
            <div class="text-sm text-gray-500">Total Visits</div>
            <div id="totalVisits" class="text-2xl font-semibold">0</div>
          </div>
          <div class="p-4 bg-green-50 rounded">
            <div class="text-sm text-gray-500">Books Borrowed</div>
            <div id="booksBorrowed" class="text-2xl font-semibold">0</div>
          </div>
          <div class="p-4 bg-yellow-50 rounded">
            <div class="text-sm text-gray-500">Currently Borrowed</div>
            <div id="currentlyBorrowed" class="text-2xl font-semibold">0</div>
          </div>
        </div>

        <div class="mb-4 flex items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <label class="text-sm text-gray-600">Period</label>
            <select id="periodSelect" class="p-2 border rounded text-sm">
              <option value="all">All Time</option>
              <option value="2025-01">Jan 2025</option>
              <option value="2025-02">Feb 2025</option>
              <option value="2025-03">Mar 2025</option>
              <option value="2025-04">Apr 2025</option>
              <option value="2025-05">May 2025</option>
              <option value="2025-06">Jun 2025</option>
              <option value="2025-07">Jul 2025</option>
              <option value="2025-08">Aug 2025</option>
              <option value="2025-09">Sep 2025</option>
              <option value="2025-10">Oct 2025</option>
              <option value="2025-11">Nov 2025</option>
              <option value="2025-12">Dec 2025</option>
            </select>
          </div>
          <div class="text-sm text-gray-500">Trend: borrows in selected period</div>
        </div>

        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-white p-4 rounded shadow-sm">
            <div class="text-sm font-medium mb-2">Visits Trend</div>
            <svg id="visitsSvg" class="w-full h-36"></svg>
          </div>
          <div class="bg-white p-4 rounded shadow-sm">
            <div class="text-sm font-medium mb-2">Borrows Trend</div>
            <svg id="trendSvg" class="w-full h-36"></svg>
          </div>
        </div>

        <div>
          <h3 class="font-medium mb-3">Borrow Records</h3>
          <div id="recordsContainer" class="space-y-3">
            <!-- records injected here -->
          </div>
        </div>
      </div>

      <!-- Borrow modal -->
      <div id="borrowModal" class="hidden fixed inset-0 z-40 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative bg-white rounded shadow-lg w-full max-w-md p-6 z-50">
          <h4 class="text-lg font-semibold mb-3">Borrow a Book</h4>
          <div class="space-y-3">
            <div>
              <label class="text-sm text-gray-600">Book Title</label>
              <input id="bookTitle" class="w-full mt-1 p-2 border rounded" placeholder="E.g., Introduction to Biology" />
            </div>
            <div>
              <label class="text-sm text-gray-600">Author</label>
              <input id="bookAuthor" class="w-full mt-1 p-2 border rounded" placeholder="E.g., M. Green" />
            </div>
            <div>
              <label class="text-sm text-gray-600">Borrow Date</label>
              <input id="borrowDate" type="date" class="w-full mt-1 p-2 border rounded" />
            </div>
            <div>
              <label class="text-sm text-gray-600">Return Date</label>
              <input id="returnDate" type="date" class="w-full mt-1 p-2 border rounded" />
            </div>
          </div>
          <div class="mt-4 flex justify-end gap-2">
            <button id="cancelBorrow" class="px-3 py-1 rounded border">Cancel</button>
            <button id="confirmBorrow" class="px-3 py-1 bg-green-600 text-white rounded">Confirm Borrow</button>
          </div>
        </div>
      </div>

    </main>
  </div>

  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-30"></div>

  <script>
    
  // Library app logic
  // NOTE: localStorage/demo backend code removed — supply real backend integration here.
  const visitCountEl = document.getElementById('visitCount');
      const totalVisitsEl = document.getElementById('totalVisits');
      const booksBorrowedEl = document.getElementById('booksBorrowed');
      const currentlyBorrowedEl = document.getElementById('currentlyBorrowed');
      const recordsContainer = document.getElementById('recordsContainer');

  // user cannot record visits here; visits will be recorded by librarian
      const addBorrowBtn = document.getElementById('addBorrowBtn');
      const borrowModal = document.getElementById('borrowModal');
      const cancelBorrow = document.getElementById('cancelBorrow');
      const confirmBorrow = document.getElementById('confirmBorrow');
      const clearBtn = document.getElementById('clearBtn');

  // Placeholder storage variables — replace with real backend reads
  let visitCountPlaceholder = 0;
  let recordsPlaceholder = []; // array of { title, author, borrowDate, returnDate, returned }
  let visitLogPlaceholder = []; // array of ISO date strings

  // Utilities (currently read-only placeholders). Replace these with fetch()/XHR to your backend.
  function readVisits(){ return visitCountPlaceholder; }
  function writeVisits(n){ visitCountPlaceholder = Number(n) || 0; console.warn('writeVisits: placeholder updated; implement backend API to persist visit count'); }
  function readRecords(){ return Array.isArray(recordsPlaceholder) ? recordsPlaceholder.slice() : []; }
  function writeRecords(arr){ recordsPlaceholder = Array.isArray(arr) ? arr.slice() : []; console.warn('writeRecords: placeholder updated; implement backend API to persist records', arr); }

  const periodSelect = document.getElementById('periodSelect');
  const trendSvg = document.getElementById('trendSvg');
  const visitsSvg = document.getElementById('visitsSvg');

  // visit log placeholder (backend should provide this)
  // const VISIT_LOG_KEY = 'lib_demo_visit_log_v1'; // removed local key

      function parseDate(s){ if(!s) return null; const d = new Date(s); if(isNaN(d)) return null; return d; }

      function filterRecordsForPeriod(records, period){
        // period: 'all' or 'YYYY-MM'
        if(period === 'all') return records;
        // month selection
        const [y, m] = period.split('-').map(Number);
        if(!y || isNaN(m)) return records;
        return records.filter(r=>{
          const d = parseDate(r.borrowDate);
          return d && d.getFullYear() === y && (d.getMonth()+1) === m;
        });
      }

  function readVisitLog(){ return Array.isArray(visitLogPlaceholder) ? visitLogPlaceholder.slice() : []; }
  function writeVisitLog(arr){ visitLogPlaceholder = Array.isArray(arr) ? arr.slice() : []; console.warn('writeVisitLog: placeholder updated; implement backend API to persist visit log', arr); }

      // create a simple count-per-month or per-term aggregator for visits
      function aggregateVisitsForPeriod(log, period){
        const records = log.map(d=>parseDate(d)).filter(Boolean);
        if(period === 'all'){
          // monthly counts for Jan..Dec
          const months = Array.from({length:12}, (_,i)=>0);
          records.forEach(d=>{ const mm = d.getMonth(); months[mm] = months[mm] + 1; });
          return months;
        }
        // specific month -> return counts per day of that month
        const [y,m] = period.split('-').map(Number);
        if(!y) return [];
        const daysInMonth = new Date(y, m, 0).getDate();
        const days = Array.from({length: daysInMonth}, ()=>0);
        records.forEach(d=>{ if(d.getFullYear()===y && (d.getMonth()+1)===m){ days[d.getDate()-1]++; }});
        return days;
      }

      function drawTrend(records, period, svgEl){
        // reusable line chart renderer
        const targetSvg = svgEl || trendSvg;
        targetSvg.innerHTML = '';
        const svgNS = 'http://www.w3.org/2000/svg';
        const w = Math.max(targetSvg.clientWidth || 320, 320);
        const h = Math.max(targetSvg.clientHeight || 120, 120);
        // margins for axes
        const margin = { top: 12, right: 12, bottom: 28, left: 36 };
        const chartW = w - margin.left - margin.right;
        const chartH = h - margin.top - margin.bottom;

        if(!records) return;
        let labels = [];
        let values = [];

        // build labels/values based on period: 'all' => months, 'YYYY-MM' => days
        if(period === 'all'){
          labels = Array.from({length:12}, (_,i)=> new Date(2025,i,1).toLocaleString(undefined,{month:'short'}));
          values = Array.from({length:12}, ()=>0);
          records.forEach(r=>{
            if(r == null) return;
            // if pseudo entry has explicit value
            if(typeof r._v === 'number'){
              const d = parseDate(r.borrowDate);
              if(!d) return;
              values[d.getMonth()] += r._v;
            } else {
              const d = parseDate(r.borrowDate);
              if(!d) return;
              values[d.getMonth()] += 1;
            }
          });
        } else {
          // expect YYYY-MM
          const [yy, mm] = period.split('-').map(Number);
          const daysInMonth = new Date(yy, mm, 0).getDate();
          labels = Array.from({length: daysInMonth}, (_,i)=> String(i+1));
          values = Array.from({length: daysInMonth}, ()=>0);
          records.forEach(r=>{
            if(r == null) return;
            const d = parseDate(r.borrowDate);
            if(!d) return;
            if(d.getFullYear() !== yy || (d.getMonth()+1) !== mm) return;
            if(typeof r._v === 'number'){
              values[d.getDate()-1] += r._v;
            } else {
              values[d.getDate()-1] += 1;
            }
          });
        }

        const max = Math.max(...values, 1);

        // set viewBox for crisp scaling
        targetSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);

        // draw background (invisible, but keeps spacing)
        const bg = document.createElementNS(svgNS,'rect');
        bg.setAttribute('x', 0); bg.setAttribute('y', 0); bg.setAttribute('width', w); bg.setAttribute('height', h); bg.setAttribute('fill','none');
        targetSvg.appendChild(bg);

        // horizontal grid lines + y labels
        const ticks = 4;
        for(let i=0;i<=ticks;i++){
          const y = margin.top + Math.round(chartH - (i/ticks)*chartH);
          const gx = document.createElementNS(svgNS,'line');
          gx.setAttribute('x1', margin.left); gx.setAttribute('x2', margin.left + chartW);
          gx.setAttribute('y1', y); gx.setAttribute('y2', y);
          gx.setAttribute('stroke', '#e6e6e6'); gx.setAttribute('stroke-width','1');
          targetSvg.appendChild(gx);
          const tv = Math.round((i/ticks)*max);
          const ty = document.createElementNS(svgNS,'text');
          ty.setAttribute('x', margin.left - 8); ty.setAttribute('y', y+4);
          ty.setAttribute('text-anchor','end'); ty.setAttribute('font-size','11'); ty.setAttribute('fill','#6b7280');
          ty.textContent = tv;
          targetSvg.appendChild(ty);
        }

        // prepare points
        const pointCount = values.length;
        if(pointCount === 0) return;
        const gap = chartW / Math.max(pointCount - 1, 1);
        const points = values.map((v, i)=>{
          const x = margin.left + Math.round(i * gap);
          const y = margin.top + Math.round(chartH - (v / max) * chartH);
          return { x, y, v };
        });

        // draw area (smooth-ish polyline using straight lines)
        const areaPath = document.createElementNS(svgNS,'path');
        const linePath = document.createElementNS(svgNS,'path');
        let dArea = '';
        let dLine = '';
        points.forEach((p,i)=>{
          if(i===0){ dLine += `M ${p.x} ${p.y}`; dArea += `M ${p.x} ${margin.top + chartH} L ${p.x} ${p.y}`; }
          else { dLine += ` L ${p.x} ${p.y}`; dArea += ` L ${p.x} ${p.y}`; }
        });
        const last = points[points.length-1];
        dArea += ` L ${last.x} ${margin.top + chartH} Z`;
        areaPath.setAttribute('d', dArea);
        areaPath.setAttribute('fill', 'rgba(79,70,229,0.10)');
        targetSvg.appendChild(areaPath);

        linePath.setAttribute('d', dLine);
        linePath.setAttribute('fill','none');
        linePath.setAttribute('stroke','#4f46e5');
        linePath.setAttribute('stroke-width','2');
        linePath.setAttribute('stroke-linejoin','round');
        linePath.setAttribute('stroke-linecap','round');
        targetSvg.appendChild(linePath);

        // draw points and labels
        points.forEach((p,i)=>{
          const circle = document.createElementNS(svgNS,'circle');
          circle.setAttribute('cx', p.x); circle.setAttribute('cy', p.y); circle.setAttribute('r','3.5');
          circle.setAttribute('fill','#4f46e5');
          targetSvg.appendChild(circle);
          // value label
          const vt = document.createElementNS(svgNS,'text');
          vt.setAttribute('x', p.x); vt.setAttribute('y', p.y - 6);
          vt.setAttribute('text-anchor','middle'); vt.setAttribute('font-size','10'); vt.setAttribute('fill','#111827');
          vt.textContent = p.v;
          targetSvg.appendChild(vt);
        });

        // x-axis labels (rotate if too dense)
        const maxLabelChars = 6;
        points.forEach((p,i)=>{
          const lbl = document.createElementNS(svgNS,'text');
          lbl.setAttribute('x', p.x); lbl.setAttribute('y', margin.top + chartH + 18);
          lbl.setAttribute('text-anchor','middle'); lbl.setAttribute('font-size','11'); lbl.setAttribute('fill','#374151');
          let text = labels[i] || '';
          if(text.length > maxLabelChars) text = text.slice(0, maxLabelChars-1) + '.';
          lbl.textContent = text;
          targetSvg.appendChild(lbl);
        });
      }

      function render(){
        const visits = readVisits();
        const records = readRecords();
        const total = visits;
        const borrowed = records.length;
        const currently = records.filter(r=>!r.returned).length;
        visitCountEl.textContent = visits;
        totalVisitsEl.textContent = total;
        booksBorrowedEl.textContent = borrowed;
        currentlyBorrowedEl.textContent = currently;

        recordsContainer.innerHTML = '';
        if(records.length === 0){ recordsContainer.innerHTML = '<div class="text-sm text-gray-500">No borrow records yet.</div>'; return; }

        records.forEach((r, idx)=>{
          const card = document.createElement('div');
          card.className = 'p-3 bg-gray-50 rounded border flex items-start justify-between gap-3';
          const left = document.createElement('div');
          // determine overdue state
          const today = new Date();
          const returnDt = new Date(r.returnDate + 'T23:59:59');
          const isOverdue = !r.returned && returnDt < today;
          const borrowBadge = `<span class=\"inline-block text-xs px-2 py-0.5 rounded bg-blue-100 text-blue-800 mr-2\">Borrowed: ${escapeHtml(r.borrowDate)}</span>`;
          const returnBadgeClass = r.returned ? 'bg-green-100 text-green-800' : (isOverdue ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800');
          const returnBadge = `<span class=\"inline-block text-xs px-2 py-0.5 rounded ${returnBadgeClass}\">Return: ${escapeHtml(r.returnDate)}</span>`;
          left.innerHTML = `<div class=\"font-medium\">${escapeHtml(r.title)}</div><div class=\"text-xs text-gray-500 mb-2\">${escapeHtml(r.author)}</div><div>${borrowBadge}${returnBadge}</div>`;
          const right = document.createElement('div');
          right.className = 'text-right';
          if(r.returned){
            right.innerHTML = '<div class="text-sm text-green-600 font-medium">Returned</div>';
          } else {
            const btn = document.createElement('button');
            btn.className = 'px-2 py-1 bg-indigo-600 text-white rounded text-sm';
            btn.textContent = 'Mark Returned';
            btn.addEventListener('click', function(){ markReturned(idx); });
            right.appendChild(btn);
          }
          card.appendChild(left);
          card.appendChild(right);
          recordsContainer.appendChild(card);
        });

  // draw trend for selected period for borrows and visits
  const period = (periodSelect && periodSelect.value) ? periodSelect.value : 'all';
        try{ drawTrend(readRecords(), period, trendSvg); }catch(e){ }
        try{
          const visitLog = readVisitLog();
          const visitValues = aggregateVisitsForPeriod(visitLog, period);
          // transform visitValues into pseudo-records with borrowDate mapped for label generation
          if(period === 'all'){
            // months labels: create pseudo dates on 1st of each month
            const pseudo = visitValues.map((v, idx)=>({ borrowDate: `2025-${String(idx+1).padStart(2,'0')}-01`, _v: v }));
            drawTrend(pseudo, period, visitsSvg);
          } else {
            // days: map index -> day
            const [y,m] = period.split('-');
            const pseudo = visitValues.map((v, idx)=>({ borrowDate: `${y}-${m}-${String(idx+1).padStart(2,'0')}`, _v: v }));
            drawTrend(pseudo, period, visitsSvg);
          }
        }catch(e){}
        }

        // redraw chart on resize to keep proportions, and react to period changes
        window.addEventListener('resize', function(){ render(); });
        if(periodSelect){ periodSelect.addEventListener('change', function(){ render(); }); }

      function escapeHtml(s){ return String(s).replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[c]; }); }

  function openBorrow(){ borrowModal.classList.remove('hidden'); }
      function closeBorrow(){ borrowModal.classList.add('hidden'); }

      function confirmBorrowAction(){
        const title = document.getElementById('bookTitle').value.trim();
        const author = document.getElementById('bookAuthor').value.trim();
        const borrowDate = document.getElementById('borrowDate').value;
        const returnDate = document.getElementById('returnDate').value;
        if(!title || !author || !borrowDate || !returnDate){ alert('Please fill all fields'); return; }
        const records = readRecords();
        records.unshift({ title, author, borrowDate, returnDate, returned:false, created: new Date().toISOString() });
        writeRecords(records);
        closeBorrow();
        // re-render after adding
        render();
      }

      function markReturned(index){ const records = readRecords(); if(!records[index]) return; records[index].returned = true; writeRecords(records); render(); }

  // wire up
  addBorrowBtn.addEventListener('click', openBorrow);
      cancelBorrow.addEventListener('click', closeBorrow);
      confirmBorrow.addEventListener('click', confirmBorrowAction);
  clearBtn.addEventListener('click', function(){ if(confirm('Clear demo data?')){ visitCountPlaceholder = 0; recordsPlaceholder = []; visitLogPlaceholder = []; render(); } });

      // No local demo seeding. Backend should populate initial data and set the placeholder arrays
      // Example: set recordsPlaceholder = [...] and visitCountPlaceholder = N; then call render().
      // For now, placeholders are empty so UI will show zero/empty states until backend is wired.

      render();
    });
  </script>

</x-Student-sidebar>