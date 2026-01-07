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

        {{-- check if the announcements is available --}}
        @if (isset($announcements) && $announcements->count() > 0)
          
          @foreach ($announcements as $announcement)
              <article class="card bg-white p-5 rounded-lg shadow" data-category="{{ strtolower($announcement->category) }}">
                  <div class="flex items-start justify-between">
                      <div>
                          <h3 class="text-lg font-medium flex items-center gap-2"><i class="bi bi-bell text-indigo-500"></i> {{ $announcement->title }}</h3>
                          <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                              <span><i class="bi bi-calendar"></i> {{ $announcement->created_at }}</span>
                              <span class="inline-block bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">{{ $announcement->category ? $announcement->category: 'Category' }}</span>
                          </div>
                      </div>
                  </div>

                  <p class="mt-4 text-gray-700">{{ $announcement->content }}</p>

                  <div class="expanded-content mt-4 hidden bg-gray-50 p-4 rounded">
                      <!-- Additional content can be added here if needed -->
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
                        <div class="mt-2 text-sm flex items-center gap-3">
                          @if($announcement->attachements)
                            <button type="button" class="openPreviewModal text-blue-600 underline hover:no-underline" data-file-path="{{ asset('storage/' . $announcement->attachements) }}">
                              <i class="bi bi-eye mr-1"></i> {{ $announcement->attachment_original_name ?? 'Preview' }}
                            </button>
                            <a href="{{ asset('storage/' . $announcement->attachements) }}" download class="text-green-600 bg-blue-100 px-2 py-1 rounded hover:bg-blue-200">
                              <i class="bi bi-download mr-1"></i> Download
                            </a>
                          @else
                            <span class="text-gray-400">No documents available</span>
                          @endif
                        </div>
                      </div>
                  </div>

                  <div class="mt-4 flex items-center justify-between text-indigo-600">
                    <button class="read-more-btn text-sm">Read More</button>
                    {{-- DElete button
                    <div class="flex items-center gap-2 text-sm">
                      <i class="bi bi-trash text-indigo-600"></i>
                       Delete Announcement
                      </div>  --}}
                  </div>

          </article>

          @endforeach

        @endif

      </section>
    </main>
  </div>

  <!-- Preview Document Modal -->
  <div id="previewModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-6xl h-[90vh] rounded-2xl overflow-hidden shadow-2xl ring-1 ring-black/5 flex flex-col">
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <div class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
            <i class="bi bi-file-earmark-text text-xl"></i>
          </div>
          <h2 class="text-lg font-semibold text-indigo-900">Document Preview</h2>
        </div>
        <button id="closePreviewModal" class="text-gray-400 hover:text-gray-700 p-2 rounded-md transition-colors">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <!-- PDF Container -->
      <div id="pdfContainer" class="flex-1 p-4 bg-gray-50 hidden">
        <iframe id="previewFrame" class="w-full h-full border-0 rounded-lg bg-white shadow-sm" src=""></iframe>
      </div>
      <!-- Word Document Container -->
      <div id="docContainer" class="flex-1 p-4 bg-gray-50 overflow-auto hidden">
        <div id="docContent" class="bg-white p-6 rounded-lg shadow-sm max-w-4xl mx-auto"></div>
      </div>
    </div>
  </div>

  <!-- PDF.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <!-- Mammoth.js for Word docs -->
  <script src="https://cdn.jsdelivr.net/npm/mammoth@1.6.0/mammoth.browser.min.js"></script>
  <!-- JSZip for DOCX extraction -->
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>

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

      // Document Preview Modal
      const previewModal = document.getElementById('previewModal');
      const pdfContainer = document.getElementById('pdfContainer');
      const docContainer = document.getElementById('docContainer');
      const previewFrame = document.getElementById('previewFrame');
      const docContent = document.getElementById('docContent');
      const closePreviewBtn = document.getElementById('closePreviewModal');
      
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
      
      function displayPdf(filePath) {
        pdfContainer.classList.remove('hidden');
        docContainer.classList.add('hidden');
        previewFrame.src = filePath;
      }
      
      function displayDocx(filePath) {
        pdfContainer.classList.add('hidden');
        docContainer.classList.remove('hidden');
        docContent.innerHTML = '<p class="text-gray-500">Loading document...</p>';
        
        fetch(filePath)
          .then(response => {
            if (!response.ok) throw new Error('Failed to load file');
            return response.arrayBuffer();
          })
          .then(arrayBuffer => {
            return mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
          })
          .then(result => {
            docContent.innerHTML = result.value;
          })
          .catch(error => {
            console.error('Error:', error);
            docContent.innerHTML = '<p class="text-red-500">Error loading document: ' + error.message + '</p>';
          });
      }
      
      document.addEventListener('click', e => {
        const btn = e.target.closest('.openPreviewModal');
        if (btn) {
          e.preventDefault();
          const filePath = btn.getAttribute('data-file-path');
          
          if (filePath && filePath.trim() !== '') {
            const fileExtension = filePath.split('.').pop().toLowerCase();
            
            previewModal.classList.remove('hidden');
            previewModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            if (fileExtension === 'pdf') {
              displayPdf(filePath);
            } else if (fileExtension === 'docx') {
              displayDocx(filePath);
            } else {
              docContent.innerHTML = '<p class="text-red-500">File type not supported for preview.</p>';
              docContainer.classList.remove('hidden');
              pdfContainer.classList.add('hidden');
            }
          } else {
            alert('No file to preview');
          }
        }
      });
      
      if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', () => {
          previewModal.classList.add('hidden');
          previewModal.classList.remove('flex');
          previewFrame.src = '';
          docContent.innerHTML = '';
          document.body.style.overflow = '';
        });
      }
      
      previewModal.addEventListener('click', e => {
        if (e.target === previewModal) {
          previewModal.classList.add('hidden');
          previewModal.classList.remove('flex');
          previewFrame.src = '';
          docContent.innerHTML = '';
          document.body.style.overflow = '';
        }
      });
    })();
  </script>

</x-Student-sidebar>