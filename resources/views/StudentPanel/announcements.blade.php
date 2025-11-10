<x-Student-sidebar>

    <!-- Main -->
    <main class="flex-1 min-h-screen md:ml-64 p-6 md:p-10">
      <header class="flex items-center justify-between bg-white p-4 rounded-lg shadow mb-6">
        <h1 class="text-2xl font-medium">Announcements</h1>
      </header>

      <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="relative w-full md:w-72">
          <input id="search" type="search" placeholder="Search announcements..." class="w-full pl-10 pr-3 py-2 border rounded-md focus:border-indigo-500" />
          <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        <div class="flex gap-2 flex-wrap">
          <button class="tag-filter active px-3 py-1 rounded-full text-sm bg-indigo-600 text-white" data-filter="all">All</button>
          <button class="tag-filter px-3 py-1 rounded-full text-sm bg-orange-100 text-orange-700" data-filter="examinations">Examinations</button>
          <button class="tag-filter px-3 py-1 rounded-full text-sm bg-green-100 text-green-700" data-filter="holidays">Holidays</button>
          <button class="tag-filter px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700" data-filter="meetings">Meetings</button>
          <button class="tag-filter px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-700" data-filter="tour">Tour</button>
        </div>
      </div>

      <section id="announcements" class="space-y-4">

        <!-- Card example (Holidays) -->
        <article class="card bg-white p-5 rounded-lg shadow" data-category="holidays">
          <div class="flex items-start justify-between">
            <div>
              <h3 class="text-lg font-medium flex items-center gap-2"><i class="bi bi-bell text-indigo-500"></i> Winter Break Announcement</h3>
              <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                <span><i class="bi bi-calendar"></i> 12/06/2025</span>
                <span class="inline-block bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">Holiday</span>
              </div>
            </div>
          </div>

          <p class="mt-4 text-gray-700">The winter break will commence from December 20th, 2023 and classes will resume on January 5th, 2024. All pending assignments should be submitted before the break.</p>

          <div class="expanded-content mt-4 hidden bg-gray-50 p-4 rounded">
            <h4 class="font-semibold mb-2">Additional Information:</h4>
            <ul class="list-disc pl-5 text-sm text-gray-700 mb-3">
              <li>School will be closed from December 20th to January 4th</li>
              <li>All assignments must be submitted by December 18th</li>
              <li>Library will remain open for study purposes</li>
              <li>Emergency contact: 555-0123</li>
            </ul>
            <div class="p-3 rounded bg-yellow-50 border-l-4 border-yellow-400 text-sm"> <strong>Important:</strong> Students must collect their report cards before leaving for the break.</div>

            <div class="mt-4 p-3 bg-white border rounded">
              <h5 class="text-sm font-medium text-gray-700"><i class="bi bi-download text-blue-500 mr-1"></i> Official Documents</h5>
              <div class="mt-2 text-sm">
                <a href="#" class="text-blue-600 mr-4">Winter Break Schedule (PDF)</a>
                <a href="#" class="text-blue-600">Assignment Submission Guidelines (PDF)</a>
              </div>
            </div>
          </div>

          <div class="mt-4 flex items-center justify-between text-indigo-600">
            <button class="read-more-btn text-sm">Read More</button>
            <div class="flex items-center gap-2 text-sm"><i class="bi bi-trash text-indigo-600"></i> Delete Announcement</div>
          </div>
        </article>

        <!-- Card example (Examinations) -->
        <article class="card bg-white p-5 rounded-lg shadow" data-category="examinations">
          <h3 class="text-lg font-medium">End of Semester Examination Schedule</h3>
          <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
            <span><i class="bi bi-calendar"></i> 01/06/2025</span>
            <span class="inline-block bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">Examinations</span>
          </div>
          <p class="mt-4 text-gray-700">Please find attached the schedule for the end of semester examinations starting from December 10th, 2023. All students are required to be present at least 15 minutes before the scheduled examination time.</p>
          <div class="expanded-content mt-4 hidden bg-gray-50 p-4 rounded">
            <h4 class="font-semibold mb-2">Examination Schedule:</h4>
            <ul class="list-disc pl-5 text-sm mb-3 text-gray-700">
              <li><strong>December 10th:</strong> Mathematics (9:00 AM - 12:00 PM)</li>
              <li><strong>December 12th:</strong> English Literature (9:00 AM - 11:30 AM)</li>
              <li><strong>December 14th:</strong> Science (9:00 AM - 12:00 PM)</li>
              <li><strong>December 16th:</strong> History (9:00 AM - 11:00 AM)</li>
            </ul>
            <div class="p-3 rounded bg-green-50 border-l-4 border-green-400 text-sm"> <strong>Exam Rules:</strong> No electronic devices allowed. Bring your own stationery.</div>
          </div>
          <div class="mt-4 flex items-center justify-between text-indigo-600">
            <button class="read-more-btn text-sm">Read More</button>
            <div class="flex items-center gap-2 text-sm"><i class="bi bi-trash text-indigo-600"></i> Delete Announcement</div>
          </div>
        </article>

        <!-- Card example (Meetings) -->
        <article class="card bg-white p-5 rounded-lg shadow" data-category="meetings">
          <h3 class="text-lg font-medium">Parent-Teacher Meeting Schedule</h3>
          <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
            <span><i class="bi bi-calendar"></i> 15/06/2025</span>
            <span class="inline-block bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">Meetings</span>
          </div>
          <p class="mt-4 text-gray-700">The annual parent-teacher meeting is scheduled for December 15th, 2023 from 2:00 PM to 5:00 PM. Parents are requested to book their time slots through the school portal. Individual progress reports will be discussed.</p>
          <div class="expanded-content mt-4 hidden bg-gray-50 p-4 rounded">
            <h4 class="font-semibold mb-2">Meeting Details:</h4>
            <ul class="list-disc pl-5 text-sm mb-3 text-gray-700">
              <li><strong>Location:</strong> School Auditorium</li>
              <li><strong>Duration:</strong> 15 minutes per parent</li>
              <li><strong>Booking:</strong> Available on school portal</li>
              <li><strong>Documents:</strong> Bring previous report cards</li>
            </ul>
            <div class="p-3 rounded bg-blue-50 border-l-4 border-blue-400 text-sm"> <strong>Note:</strong> Please arrive 10 minutes before your scheduled time.</div>
          </div>
          <div class="mt-4 flex items-center justify-between text-indigo-600">
            <button class="read-more-btn text-sm">Read More</button>
            <div class="flex items-center gap-2 text-sm"><i class="bi bi-trash text-indigo-600"></i> Delete Announcement</div>
          </div>
        </article>

      </section>
    </main>
  </div>

  <script>
    (function(){
      // Sidebar toggle
      const sidebar = document.getElementById('sidebar');
      const toggle = document.getElementById('sidebarToggle');
      const overlay = document.getElementById('sidebarOverlay');
      if(toggle && sidebar){
        toggle.addEventListener('click', ()=>{
          sidebar.classList.toggle('hidden');
          overlay.classList.toggle('hidden');
        });
      }
      if(overlay){
        overlay.addEventListener('click', ()=>{ sidebar.classList.add('hidden'); overlay.classList.add('hidden'); });
      }

      // Read more toggles
      document.querySelectorAll('.read-more-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          const card = btn.closest('.card');
          if(!card) return;
          const expanded = card.querySelector('.expanded-content');
          if(!expanded) return;
          expanded.classList.toggle('hidden');
          btn.textContent = expanded.classList.contains('hidden') ? 'Read More' : 'Show Less';
        });
      });

      // Tag filters
      const filters = document.querySelectorAll('.tag-filter');
      filters.forEach(f=> f.addEventListener('click', ()=>{
        filters.forEach(x=> x.classList.remove('active', 'bg-indigo-600', 'text-white'));
        f.classList.add('active','bg-indigo-600','text-white');
        const cat = f.dataset.filter;
        document.querySelectorAll('#announcements .card').forEach(card=>{
          if(cat==='all') card.style.display=''; else card.style.display = (card.dataset.category===cat) ? '' : 'none';
        });
      }));

      // Search
      const searchInput = document.getElementById('search');
      if(searchInput){
        searchInput.addEventListener('input', ()=>{
          const q = searchInput.value.toLowerCase();
          document.querySelectorAll('#announcements .card').forEach(card=>{
            const title = (card.querySelector('h3')||{textContent:''}).textContent.toLowerCase();
            card.style.display = title.includes(q) ? '' : 'none';
          });
        });
      }
    })();
  </script>

</x-Student-sidebar>