<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="relative pl-3 md:pl-4 flex items-center gap-3">
            <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
            <div>
              <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Announcements</h1>
              <p class="text-sm text-gray-500 mt-1">Updates from your school</p>
            </div>
          </div>
        </header>

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
        @else
          <div class="relative w-full max-w-md">
            <input id="search" type="search" placeholder="Search announcements..." class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-md text-sm focus:border-indigo-500">
            <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          </div>

          <section id="announcements" class="space-y-4">
            @forelse ($announcements as $announcement)
              @php
                $audience = match((int) $announcement->intended_audience) {
                  0 => 'All',
                  2 => 'Students',
                  3 => 'Staff',
                  4 => 'Subject',
                  5 => 'Custom',
                  default => 'General',
                };
                $hasExtra = $announcement->important_note || $announcement->attachements;
              @endphp
              <article class="card bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                  <i class="bi bi-bell text-indigo-500"></i> {{ $announcement->title }}
                </h3>
                <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                  <span><i class="bi bi-calendar"></i> {{ $announcement->created_at->format('M d, Y') }}</span>
                  <span class="text-xs font-semibold uppercase px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700">{{ $audience }}</span>
                </div>
                <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $announcement->content }}</p>

                @if ($hasExtra)
                  <div class="expanded-content mt-4 hidden space-y-4">
                    @if ($announcement->important_note)
                      <div class="p-3 rounded bg-yellow-50 border-l-4 border-yellow-400 text-sm text-gray-700">
                        <strong>Important:</strong> {{ $announcement->important_note }}
                      </div>
                    @endif
                    @if ($announcement->attachements)
                      <div class="p-3 bg-gray-50 border border-gray-100 rounded-lg">
                        <h5 class="text-sm font-medium text-gray-700"><i class="bi bi-paperclip text-indigo-500"></i> Attachment</h5>
                        <div class="mt-2 text-sm flex items-center gap-3 flex-wrap">
                          <button type="button" class="openPreviewModal text-indigo-600 hover:underline" data-file-path="{{ asset('storage/' . $announcement->attachements) }}">
                            <i class="bi bi-eye"></i> {{ $announcement->attachment_original_name ?? 'Preview' }}
                          </button>
                          <a href="{{ asset('storage/' . $announcement->attachements) }}" download class="text-indigo-600 hover:underline">
                            <i class="bi bi-download"></i> Download
                          </a>
                        </div>
                      </div>
                    @endif
                  </div>
                  <button type="button" class="read-more-btn mt-4 text-sm text-indigo-600 font-medium">Read more</button>
                @endif
              </article>
            @empty
              <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-10 text-center text-gray-500">
                <i class="bi bi-bell-slash text-3xl text-indigo-300 block mb-2"></i>
                <p>No announcements yet.</p>
              </div>
            @endforelse
          </section>

          @if ($announcements->hasPages())
            <div class="mt-4">{{ $announcements->links() }}</div>
          @endif
        @endif
      </div>
    </main>

  <div id="previewModal" class="fixed inset-0 z-50 bg-black/50 hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-6xl h-[90vh] rounded-xl overflow-hidden flex flex-col">
      <div class="flex items-center justify-between p-4 border-b">
        <h2 class="text-lg font-semibold text-indigo-800">Document Preview</h2>
        <button id="closePreviewModal" type="button" class="text-gray-400 hover:text-gray-700 p-2"><i class="bi bi-x-lg"></i></button>
      </div>
      <div id="pdfContainer" class="flex-1 p-4 bg-gray-50 hidden"><iframe id="previewFrame" class="w-full h-full border-0 rounded bg-white"></iframe></div>
      <div id="docContainer" class="flex-1 p-4 bg-gray-50 overflow-auto hidden"><div id="docContent" class="bg-white p-6 rounded max-w-4xl mx-auto"></div></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/mammoth@1.6.0/mammoth.browser.min.js"></script>
  <script>
    document.querySelectorAll('.read-more-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const box = btn.previousElementSibling;
        if (!box) return;
        box.classList.toggle('hidden');
        btn.textContent = box.classList.contains('hidden') ? 'Read more' : 'Show less';
      });
    });
    document.getElementById('search')?.addEventListener('input', e => {
      const q = e.target.value.toLowerCase();
      document.querySelectorAll('#announcements .card').forEach(card => {
        const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
        card.style.display = title.includes(q) ? '' : 'none';
      });
    });
    const previewModal = document.getElementById('previewModal');
    const previewFrame = document.getElementById('previewFrame');
    const docContent = document.getElementById('docContent');
    document.addEventListener('click', e => {
      const btn = e.target.closest('.openPreviewModal');
      if (!btn) return;
      e.preventDefault();
      const path = btn.dataset.filePath;
      const ext = path.split('.').pop().toLowerCase();
      previewModal.classList.remove('hidden');
      previewModal.classList.add('flex');
      if (ext === 'pdf') {
        document.getElementById('pdfContainer').classList.remove('hidden');
        document.getElementById('docContainer').classList.add('hidden');
        previewFrame.src = path;
      } else if (ext === 'docx') {
        document.getElementById('pdfContainer').classList.add('hidden');
        document.getElementById('docContainer').classList.remove('hidden');
        fetch(path).then(r => r.arrayBuffer()).then(b => mammoth.convertToHtml({ arrayBuffer: b }))
          .then(r => docContent.innerHTML = r.value).catch(() => docContent.innerHTML = '<p class="text-red-500">Could not load file.</p>');
      }
    });
    document.getElementById('closePreviewModal')?.addEventListener('click', () => {
      previewModal.classList.add('hidden');
      previewModal.classList.remove('flex');
      previewFrame.src = '';
      docContent.innerHTML = '';
    });
  </script>

</x-Student-sidebar>
