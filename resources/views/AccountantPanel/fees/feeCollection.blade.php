@php $fmt = fn ($n) => money_format_app($n); @endphp

<x-Account-sidebar>
  <x-slot name="title">Fee Collection</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-xl font-bold text-slate-900">Record fee payment</h1>
        <p class="text-sm text-slate-600">This month: {{ $fmt($stats['monthTotal'] ?? 0) }} · Today: {{ $fmt($stats['todayTotal'] ?? 0) }}</p>
      </div>
      <a href="{{ route('accounting.feeManagement') }}" class="text-sm text-indigo-600">Fee structures</a>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif

    <div class="grid lg:grid-cols-2 gap-6">
      <form method="POST" action="{{ route('accounting.feeCollection.store') }}" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium mb-1">Student</label>
          <select name="student_id" required class="w-full border rounded-lg px-3 py-2">
            <option value="">Select student</option>
            @foreach($students as $s)
              <option value="{{ $s->id }}" @selected(old('student_id') == $s->id)>{{ trim($s->fname.' '.$s->lname) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Amount</label>
          <input type="number" name="amount" step="0.01" min="0.01" required value="{{ old('amount') }}" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Method</label>
          <select name="payment_method" required class="w-full border rounded-lg px-3 py-2">
            @foreach(['cash','mobile','bank','cheque'] as $m)
              <option value="{{ $m }}" @selected(old('payment_method') === $m)>{{ ucfirst($m) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Paid at</label>
          <input type="datetime-local" name="paid_at" required value="{{ old('paid_at', now()->format('Y-m-d\TH:i')) }}" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Reference</label>
          <input type="text" name="reference" value="{{ old('reference') }}" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Notes</label>
          <textarea name="notes" rows="2" class="w-full border rounded-lg px-3 py-2">{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save payment</button>
      </form>

      <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Recent payments</h2>
        <div class="overflow-x-auto max-h-[32rem]">
          <table class="w-full text-sm text-left">
            <thead class="border-b"><tr><th class="px-4 py-2">Date</th><th class="px-4 py-2">Student</th><th class="px-4 py-2">Amount</th><th class="px-4 py-2">Method</th></tr></thead>
            <tbody class="divide-y">
              @forelse($payments as $p)
                <tr>
                  <td class="px-4 py-2">{{ $p->paid_at->format('M j, Y') }}</td>
                  <td class="px-4 py-2">{{ trim(($p->student->fname ?? '').' '.($p->student->lname ?? '')) }}</td>
                  <td class="px-4 py-2 font-medium">{{ $fmt($p->amount) }}</td>
                  <td class="px-4 py-2">{{ ucfirst($p->payment_method) }}</td>
                </tr>
              @empty
                <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No payments yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</x-Account-sidebar>
