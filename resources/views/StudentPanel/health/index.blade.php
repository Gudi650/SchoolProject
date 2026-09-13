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

          @include('StudentPanel.health.partials.profile-tab')
          @include('StudentPanel.health.partials.appointments-tab')
          @include('StudentPanel.health.partials.records-tab')
        @endif
      </div>
    </main>

    @if ($student ?? false)
      @include('StudentPanel.health.partials.scripts')
    @endif

</x-Student-sidebar>
