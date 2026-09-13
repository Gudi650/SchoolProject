<section id="tab-appointments" class="health-panel hidden bg-white rounded-lg shadow-sm border border-gray-100 p-5">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-sm font-semibold text-indigo-800 flex items-center gap-2"><i class="bi bi-calendar2-check"></i> External Appointments</h2>
    <button type="button" id="toggleApptForm" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">+ Add</button>
  </div>

  @include('StudentPanel.health.modals.appointment-form')

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
