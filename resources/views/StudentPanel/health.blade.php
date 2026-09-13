<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0">
      <div class="space-y-6">
        <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>
          <div class="relative pl-3 md:pl-4">
            <div class="flex items-center gap-3">
              <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
              <div>
                <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Health Status</h1>
                <p class="text-sm text-gray-500 mt-1">Manage your medical information for the school nurse</p>
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 flex items-center gap-1"><i class="bi bi-shield-lock"></i> Only you and authorized school staff can view this.</p>
          </div>
        </header>

        @if (session('success'))
          <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded-lg text-sm">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
          <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded-lg text-sm">{{ $errors->first() }}</div>
        @endif

        @if (!$student)
          <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">No student profile linked to your account.</div>
        @else
          @if ($profile->allergies)
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start gap-3">
              <i class="bi bi-exclamation-triangle-fill text-red-600 text-xl mt-0.5"></i>
              <div>
                <p class="font-semibold text-red-800 text-sm">Allergy alert</p>
                <p class="text-sm text-red-700 mt-1">{{ $profile->allergies }}</p>
              </div>
            </div>
          @endif

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-droplet"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase">Blood Group</p>
                <p class="text-lg font-bold text-indigo-800">{{ $profile->blood_group ?: '—' }}</p>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-shield-check"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase">Insurance</p>
                <p class="text-sm font-semibold text-gray-800">{{ $profile->insurance_provider ?: 'Not set' }}</p>
                @if ($profile->insurance_number)
                  <p class="text-xs text-gray-500">•••• {{ substr($profile->insurance_number, -4) }}</p>
                @endif
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-3">
              <div class="p-2 rounded-full bg-indigo-50 text-indigo-600"><i class="bi bi-capsule"></i></div>
              <div>
                <p class="text-xs text-gray-500 uppercase">Medications</p>
                <p class="text-sm text-gray-700 line-clamp-2">{{ $profile->medications ?: 'None listed' }}</p>
              </div>
            </div>
          </div>

          <div class="inline-flex rounded-lg border border-gray-200 bg-white p-1 shadow-sm" role="tablist">
            <button type="button" data-tab="profile" class="health-tab px-4 py-2 text-sm font-medium rounded-md bg-indigo-600 text-white">Profile</button>
            <button type="button" data-tab="appointments" class="health-tab px-4 py-2 text-sm font-medium rounded-md text-gray-600">Appointments</button>
            <button type="button" data-tab="records" class="health-tab px-4 py-2 text-sm font-medium rounded-md text-gray-600">Records</button>
          </div>

          {{-- Profile --}}
          <section id="tab-profile" class="health-panel bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2"><i class="bi bi-heart-pulse"></i> Medical Profile</h2>
              <button type="button" id="toggleProfileEdit" class="text-sm text-indigo-600 border border-indigo-200 px-3 py-1 rounded-md hover:bg-indigo-50">Edit</button>
            </div>

            <div id="profileView" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
              <div class="p-3 bg-gray-50 rounded-md"><p class="text-gray-500">Blood group</p><p class="font-medium mt-1">{{ $profile->blood_group ?: '—' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md"><p class="text-gray-500">Insurance provider</p><p class="font-medium mt-1">{{ $profile->insurance_provider ?: '—' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md md:col-span-2"><p class="text-gray-500">Insurance number</p><p class="font-medium mt-1">{{ $profile->insurance_number ? '•••• '.substr($profile->insurance_number, -4) : '—' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md md:col-span-2"><p class="text-gray-500">Allergies</p><p class="font-medium mt-1">{{ $profile->allergies ?: 'None' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md md:col-span-2"><p class="text-gray-500">Chronic conditions</p><p class="font-medium mt-1">{{ $profile->chronic_conditions ?: 'None' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md md:col-span-2"><p class="text-gray-500">Medications</p><p class="font-medium mt-1">{{ $profile->medications ?: 'None' }}</p></div>
              <div class="p-3 bg-gray-50 rounded-md md:col-span-2"><p class="text-gray-500">Emergency notes</p><p class="font-medium mt-1">{{ $profile->emergency_notes ?: 'None' }}</p></div>
            </div>

            <form id="profileForm" action="{{ route('student.health.profile') }}" method="POST" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
              @csrf
              <div>
                <label class="text-sm text-gray-600">Blood group</label>
                <select name="blood_group" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
                  <option value="">Select</option>
                  @foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                    <option value="{{ $bg }}" @selected(old('blood_group', $profile->blood_group) === $bg)>{{ $bg }}</option>
                  @endforeach
                </select>
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
                <textarea name="allergies" rows="2" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm" placeholder="e.g. Peanuts, penicillin">{{ old('allergies', $profile->allergies) }}</textarea>
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
              <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">Save Profile</button>
                <button type="button" id="cancelProfileEdit" class="border border-gray-200 px-4 py-2 rounded text-sm">Cancel</button>
              </div>
            </form>
          </section>

          {{-- Appointments --}}
          <section id="tab-appointments" class="health-panel hidden bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2"><i class="bi bi-calendar2-check"></i> External Appointments</h2>
              <button type="button" id="toggleApptForm" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">+ Add</button>
            </div>

            <form id="apptForm" action="{{ route('student.health.appointments.store') }}" method="POST" class="hidden mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-3">
              @csrf
              <div>
                <label class="text-sm text-gray-600">Doctor / clinic</label>
                <input name="provider_name" required class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
              </div>
              <div>
                <label class="text-sm text-gray-600">Date</label>
                <input name="appointment_date" type="date" required class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
              </div>
              <div>
                <label class="text-sm text-gray-600">Status</label>
                <select name="status" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
                  <option value="upcoming">Upcoming</option>
                  <option value="completed">Completed</option>
                  <option value="cancelled">Cancelled</option>
                </select>
              </div>
              <div class="md:col-span-2">
                <label class="text-sm text-gray-600">Reason</label>
                <input name="reason" class="mt-1 w-full border border-gray-200 rounded-md px-3 py-2 text-sm">
              </div>
              <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm w-fit">Save Appointment</button>
            </form>

            <div class="space-y-3">
              @forelse ($appointments as $appt)
                @php
                  $badge = match($appt->status) {
                    'completed' => 'bg-green-50 text-green-700',
                    'cancelled' => 'bg-gray-100 text-gray-600',
                    default => 'bg-blue-50 text-blue-700',
                  };
                @endphp
                <article class="p-4 border border-gray-100 rounded-lg hover:border-indigo-200 transition-colors flex items-start justify-between gap-3">
                  <div>
                    <div class="flex items-center gap-2 flex-wrap">
                      <p class="font-medium text-gray-900">{{ $appt->provider_name }}</p>
                      <span class="text-xs font-semibold uppercase px-2 py-0.5 rounded-full {{ $badge }}">{{ $appt->status }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1"><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }}</p>
                    @if ($appt->reason)<p class="text-sm text-gray-600 mt-2">{{ $appt->reason }}</p>@endif
                  </div>
                  <form action="{{ route('student.health.appointments.destroy', $appt) }}" method="POST" onsubmit="return confirm('Remove this appointment?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 text-sm hover:underline">Remove</button>
                  </form>
                </article>
              @empty
                <div class="text-center py-10 text-gray-500">
                  <i class="bi bi-calendar-x text-3xl text-indigo-300 block mb-2"></i>
                  <p class="text-sm">No appointments yet. Click "+ Add" to log an external visit.</p>
                </div>
              @endforelse
            </div>
          </section>

          {{-- Records --}}
          <section id="tab-records" class="health-panel hidden bg-white rounded-lg shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2"><i class="bi bi-file-earmark-medical"></i> Hospital Records</h2>
              <button type="button" id="toggleDocForm" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">+ Upload</button>
            </div>

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
        @endif
      </div>
    </main>

    @if ($student ?? false)
      <script>
        document.querySelectorAll('.health-tab').forEach(btn => {
          btn.addEventListener('click', () => {
            document.querySelectorAll('.health-tab').forEach(b => {
              b.classList.remove('bg-indigo-600', 'text-white');
              b.classList.add('text-gray-600');
            });
            btn.classList.add('bg-indigo-600', 'text-white');
            btn.classList.remove('text-gray-600');
            document.querySelectorAll('.health-panel').forEach(p => p.classList.add('hidden'));
            document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
          });
        });

        const profileView = document.getElementById('profileView');
        const profileForm = document.getElementById('profileForm');
        const toggleEdit = () => { profileView.classList.toggle('hidden'); profileForm.classList.toggle('hidden'); };
        document.getElementById('toggleProfileEdit')?.addEventListener('click', toggleEdit);
        document.getElementById('cancelProfileEdit')?.addEventListener('click', toggleEdit);
        document.getElementById('toggleApptForm')?.addEventListener('click', () => document.getElementById('apptForm').classList.toggle('hidden'));
        document.getElementById('toggleDocForm')?.addEventListener('click', () => document.getElementById('docForm').classList.toggle('hidden'));
        @if ($errors->any()) toggleEdit(); @endif
      </script>
    @endif

</x-Student-sidebar>
