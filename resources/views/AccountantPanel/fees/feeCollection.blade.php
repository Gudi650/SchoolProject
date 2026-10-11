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
    @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

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
          <select name="payment_method" id="fee_method" required class="w-full border rounded-lg px-3 py-2">
            <option value="">Select method</option>

            @foreach(['cash','mobile','bank'] as $m)
              <option value="{{ $m }}" @selected(old('payment_method') === $m)>{{ ucfirst($m) }}</option>
            @endforeach
            
          </select>
        </div>
        <div id="fee_account_wrap" class="{{ old('payment_method') ? '' : 'hidden' }}">
          <label class="block text-sm font-medium mb-1" id="fee_account_label">Account</label>
          <select name="bank_account_id" id="fee_account" class="w-full border rounded-lg px-3 py-2">
            <option value="">Select account</option>
            @foreach($accounts ?? [] as $a)
              <option value="{{ $a->id }}" data-kind="{{ $a->kind }}" @selected(old('bank_account_id') == $a->id)>{{ $a->name }} ({{ ucfirst($a->kind) }})</option>
            @endforeach
          </select>
          <p id="fee_account_empty" class="hidden text-xs text-amber-700 mt-1">No matching account. Add one under Banking first.</p>
        </div>
        <script>
          const methodEl = document.getElementById('fee_method');
          const wrap = document.getElementById('fee_account_wrap');
          const accountEl = document.getElementById('fee_account');
          const emptyEl = document.getElementById('fee_account_empty');
          const labelEl = document.getElementById('fee_account_label');
          function kindFor(m) { return m === 'cash' ? 'cash' : 'bank'; }
          function filterAccounts() {
            const m = methodEl.value;
            wrap.classList.toggle('hidden', !m);
            accountEl.required = !!m;
            if (!m) { accountEl.value = ''; return; }
            const kind = kindFor(m);
            labelEl.textContent = kind === 'cash' ? 'Cash account' : 'Bank account';
            let visible = 0;
            [...accountEl.options].forEach((opt, i) => {
              if (i === 0) return;
              const show = opt.dataset.kind === kind;
              opt.hidden = !show;
              opt.disabled = !show;
              if (show) visible++;
            });
            if (accountEl.selectedOptions[0]?.hidden) accountEl.value = '';
            emptyEl.classList.toggle('hidden', visible > 0);
          }
          methodEl.addEventListener('change', filterAccounts);
          filterAccounts();
        </script>
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
