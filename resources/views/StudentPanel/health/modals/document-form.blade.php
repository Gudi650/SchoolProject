<form id="docForm" action="{{ route('student.health.documents.store') }}" method="POST" enctype="multipart/form-data" class="hidden mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-3">
  @csrf
  <div>
    <label class="text-sm text-gray-600">Title</label>
    <input name="title" required class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
  </div>
  <div>
    <label class="text-sm text-gray-600">Type</label>
    <select name="record_type" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
      <option value="discharge">Discharge summary</option>
      <option value="lab">Lab results</option>
      <option value="prescription">Prescription</option>
      <option value="other">Other</option>
    </select>
  </div>
  <div>
    <label class="text-sm text-gray-600">Record date</label>
    <input name="record_date" type="date" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
  </div>
  <div>
    <label class="text-sm text-gray-600">File (PDF, JPG, PNG · max 10MB)</label>
    <input name="file" type="file" required accept=".pdf,.jpg,.jpeg,.png" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
  </div>
  <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm w-fit md:col-span-2">Upload</button>
</form>
