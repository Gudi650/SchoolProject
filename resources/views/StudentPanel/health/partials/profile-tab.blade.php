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

  @include('StudentPanel.health.modals.profile-form')
</section>
