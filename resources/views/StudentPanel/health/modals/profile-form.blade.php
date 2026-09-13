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
