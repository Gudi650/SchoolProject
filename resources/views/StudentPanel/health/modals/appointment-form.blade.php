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
