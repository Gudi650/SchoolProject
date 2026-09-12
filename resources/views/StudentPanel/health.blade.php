<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="relative pl-3 md:pl-4 flex items-center gap-3">
            <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
            <div>
              <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Health Status</h1>
              <p class="text-sm text-gray-500 mt-1">Medical profile, appointments & records</p>
            </div>
          </div>
        </header>

        @if (session('success'))
          <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Blood Group</p>
              <p class="text-lg font-bold text-indigo-800 mt-1">{{ $profile->blood_group ?: '—' }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Insurance</p>
              <p class="text-sm font-semibold text-gray-800 mt-1">{{ $profile->insurance_provider ?: 'Not set' }}</p>
              @if ($profile->insurance_number)
                <p class="text-xs text-gray-500 mt-1">•••• {{ substr($profile->insurance_number, -4) }}</p>
              @endif
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
              <p class="text-xs text-gray-500 uppercase">Allergies</p>
              <p class="text-sm text-gray-700 mt-1 line-clamp-2">{{ $profile->allergies ?: 'None listed' }}</p>
            </div>
          </div>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-indigo-800 mb-4 flex items-center gap-2"><i class="bi bi-heart-pulse"></i> Medical Profile</h2>
            <form action="{{ route('student.health.profile') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
              @csrf
              <div>
                <label class="text-sm text-gray-600">Blood group</label>
                <input name="blood_group" value="{{ old('blood_group', $profile->blood_group) }}" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm" placeholder="e.g. O+">
              </div>
              <div>
                <label class="text-sm text-gray-600">Insurance provider</label>
                <input name="insurance_provider" value="{{ old('insurance_provider', $profile->insurance_provider) }}" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Insurance / member number</label>
                <input name="insurance_number" value="{{ old('insurance_number', $profile->insurance_number) }}" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Allergies</label>
                <textarea name="allergies" rows="2" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">{{ old('allergies', $profile->allergies) }}</textarea>
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Chronic conditions</label>
                <textarea name="chronic_conditions" rows="2" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">{{ old('chronic_conditions', $profile->chronic_conditions) }}</textarea>
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Current medications</label>
                <textarea name="medications" rows="2" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">{{ old('medications', $profile->medications) }}</textarea>
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Emergency notes</label>
                <textarea name="emergency_notes" rows="2" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">{{ old('emergency_notes', $profile->emergency_notes) }}</textarea>
              </div>
              <div class="md:col-span-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">Save Profile</button>
              </div>
            </form>
          </section>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-indigo-800 mb-4 flex items-center gap-2"><i class="bi bi-calendar2-check"></i> External Appointments</h2>
            <form action="{{ route('student.health.appointments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6">
              @csrf
              <input name="provider_name" required placeholder="Doctor / clinic" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
              <input name="appointment_date" type="date" required class="border border-gray-200 rounded-md px-3 py-2 text-sm">
              <select name="status" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
                <option value="upcoming">Upcoming</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
              </select>
              <input name="reason" placeholder="Reason (optional)" class="border border-gray-200 rounded-md px-3 py-2 text-sm md:col-span-4">
              <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm md:col-span-4 w-fit">Add Appointment</button>
            </form>
            @forelse ($appointments as $appt)
              <div class="flex items-start justify-between gap-3 py-3 border-t border-gray-100 first:border-0">
                <div>
                  <p class="font-medium text-gray-900">{{ $appt->provider_name }}</p>
                  <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }} · {{ ucfirst($appt->status) }}</p>
                  @if ($appt->reason)<p class="text-sm text-gray-600 mt-1">{{ $appt->reason }}</p>@endif
                </div>
                <form action="{{ route('student.health.appointments.destroy', $appt) }}" method="POST">
                  @csrf @method('DELETE')
                  <button type="submit" class="text-red-600 text-sm">Remove</button>
                </form>
              </div>
            @empty
              <p class="text-sm text-gray-500">No appointments yet.</p>
            @endforelse
          </section>

          <section class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-indigo-800 mb-4 flex items-center gap-2"><i class="bi bi-file-earmark-medical"></i> Hospital Records</h2>
            <form action="{{ route('student.health.documents.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6">
              @csrf
              <input name="title" required placeholder="Record title" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
              <select name="record_type" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
                <option value="discharge">Discharge summary</option>
                <option value="lab">Lab results</option>
                <option value="prescription">Prescription</option>
                <option value="other">Other</option>
              </select>
              <input name="record_date" type="date" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
              <input name="file" type="file" required accept=".pdf,.jpg,.jpeg,.png" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
              <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm md:col-span-4 w-fit">Upload Document</button>
            </form>
            @forelse ($documents as $doc)
              <div class="flex items-center justify-between gap-3 py-3 border-t border-gray-100 first:border-0">
                <div>
                  <p class="font-medium text-gray-900">{{ $doc->title }}</p>
                  <p class="text-sm text-gray-500">{{ ucfirst($doc->record_type) }} · {{ $doc->record_date ? \Carbon\Carbon::parse($doc->record_date)->format('M d, Y') : 'No date' }}</p>
                </div>
                <div class="flex items-center gap-3">
                  <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="text-indigo-600 text-sm">View</a>
                  <form action="{{ route('student.health.documents.destroy', $doc) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 text-sm">Remove</button>
                  </form>
                </div>
              </div>
            @empty
              <p class="text-sm text-gray-500">No documents uploaded yet.</p>
            @endforelse
          </section>
        @endif
      </div>
    </main>

</x-Student-sidebar>
