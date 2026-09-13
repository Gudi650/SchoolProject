<section id="tab-records" class="health-panel hidden bg-white rounded-lg shadow-sm border border-gray-100 p-5">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2"><i class="bi bi-file-earmark-medical"></i> Hospital Records</h2>
    <button type="button" id="toggleDocForm" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">+ Upload</button>
  </div>

  @include('StudentPanel.health.modals.document-form')

  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    @forelse ($documents as $doc)
      <article class="p-4 border border-gray-100 rounded-lg hover:border-indigo-200 transition-colors flex items-start gap-3">
        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-md"><i class="bi bi-file-earmark-pdf"></i></div>
        <div class="flex-1 min-w-0">
          <p class="font-medium text-gray-900 truncate">{{ $doc->title }}</p>
          <p class="text-xs text-indigo-600 mt-1 uppercase font-semibold">{{ $doc->record_type }}</p>
          <p class="text-sm text-gray-500 mt-1">{{ $doc->record_date ? \Carbon\Carbon::parse($doc->record_date)->format('M d, Y') : 'No date' }}</p>
          <div class="flex gap-3 mt-2">
            <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="text-indigo-600 text-sm">View</a>
            <form action="{{ route('student.health.documents.destroy', $doc) }}" method="POST" onsubmit="return confirm('Remove this document?')">
              @csrf @method('DELETE')
              <button type="submit" class="text-red-600 text-sm">Remove</button>
            </form>
          </div>
        </div>
      </article>
    @empty
      <div class="md:col-span-2 text-center py-10 text-gray-500">
        <i class="bi bi-folder2-open text-3xl text-indigo-300 block mb-2"></i>
        <p class="text-sm">No records uploaded. Click "+ Upload" to add hospital documents.</p>
      </div>
    @endforelse
  </div>
</section>
