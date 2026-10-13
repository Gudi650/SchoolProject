@php
  $fmt = fn ($n) => money_format_app($n);
  $invoices = $invoices ?? collect();
  $audits = $audits ?? collect();
  $stats = $stats ?? [];
  $badge = [
    'paid' => 'bg-green-100 text-green-700',
    'partial' => 'bg-amber-100 text-amber-700',
    'overdue' => 'bg-red-100 text-red-700',
    'sent' => 'bg-indigo-100 text-indigo-700',
    'draft' => 'bg-slate-100 text-slate-700',
    'cancelled' => 'bg-slate-100 text-slate-500',
  ];
@endphp
<x-Account-sidebar>
  <x-slot name="title">Invoicing Management</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Invoicing & Billing</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Bill students, parents, vendors, or any other income</p>
        </div>
        <a href="{{ route('accounting.createInvoice') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm justify-center">
          <i data-lucide="plus" class="w-4 h-4"></i> Create Invoice
        </a>
      </div>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Total invoices</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['count'] ?? 0) }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Paid</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['paid'] ?? 0) }}</p>
        <p class="text-xs text-green-600 mt-2">{{ $stats['paidCount'] ?? 0 }} invoices</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Pending</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['pending'] ?? 0) }}</p>
        <p class="text-xs text-amber-600 mt-2">{{ $stats['pendingCount'] ?? 0 }} invoices</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Overdue</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['overdue'] ?? 0) }}</p>
        <p class="text-xs text-red-600 mt-2">{{ $stats['overdueCount'] ?? 0 }} invoices</p>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-lg font-semibold text-slate-900 mb-4">Quick templates</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('accounting.createInvoice', ['preset' => 'Tuition Fee']) }}" class="p-4 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50">
          <h3 class="font-semibold text-slate-900">Tuition Fee</h3>
          <p class="text-sm text-slate-600">Start an invoice with a tuition line</p>
        </a>
        <a href="{{ route('accounting.createInvoice', ['preset' => 'Transport Fee']) }}" class="p-4 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50">
          <h3 class="font-semibold text-slate-900">Transport Fee</h3>
          <p class="text-sm text-slate-600">Start an invoice with a transport line</p>
        </a>
        <a href="{{ route('accounting.createInvoice', ['preset' => 'Hostel Fee']) }}" class="p-4 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50">
          <h3 class="font-semibold text-slate-900">Hostel Fee</h3>
          <p class="text-sm text-slate-600">Start an invoice with a hostel line</p>
        </a>
        <a href="{{ route('accounting.createInvoice', ['preset' => 'Other income']) }}" class="p-4 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50">
          <h3 class="font-semibold text-slate-900">Other income</h3>
          <p class="text-sm text-slate-600">Rental, donation, services, anything else</p>
        </a>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Invoices</h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Invoice</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Billed to</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Total</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Due</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($invoices as $inv)
              @php $st = $inv->displayStatus(); @endphp
              <tr class="hover:bg-indigo-50">
                <td class="px-4 py-3 font-medium">{{ $inv->invoice_number }}<div class="text-xs text-slate-500">{{ $inv->issue_date?->format('Y-m-d') }}</div></td>
                <td class="px-4 py-3">{{ $inv->partyName() }}<div class="text-xs text-slate-500">{{ $inv->bill_to === 'student' ? 'Student' : 'Other' }}</div></td>
                <td class="px-4 py-3">{{ $fmt($inv->total) }}<div class="text-xs text-slate-500">Paid {{ $fmt($inv->paid_amount) }}</div></td>
                <td class="px-4 py-3">{{ $inv->due_date?->format('Y-m-d') }}</td>
                <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full font-medium {{ $badge[$st] ?? 'bg-slate-100' }}">{{ ucfirst($st) }}</span></td>
                <td class="px-4 py-3">
                  <div class="flex flex-wrap gap-1">
                    <a href="{{ route('accounting.printInvoice', $inv->id) }}" class="px-2 py-1 text-xs bg-slate-100 rounded">Print</a>
                    <a href="{{ route('accounting.pdfInvoice', $inv->id) }}" class="px-2 py-1 text-xs bg-slate-100 rounded">PDF</a>
                    @if($inv->isEditable())
                      <a href="{{ route('accounting.editInvoice', $inv->id) }}" class="px-2 py-1 text-xs bg-indigo-50 text-indigo-700 rounded">Edit</a>
                    @endif
                    @if($inv->status === 'draft')
                      <form method="POST" action="{{ route('accounting.sendInvoice', $inv->id) }}">@csrf<button class="px-2 py-1 text-xs bg-indigo-100 text-indigo-800 rounded">Send</button></form>
                      <form method="POST" action="{{ route('accounting.deleteInvoice', $inv->id) }}" onsubmit="return confirm('Delete this invoice?')">@csrf @method('DELETE')<button class="px-2 py-1 text-xs bg-red-50 text-red-700 rounded">Delete</button></form>
                    @endif
                    @if($inv->remaining() > 0 && $inv->status !== 'cancelled')
                      <button type="button" class="px-2 py-1 text-xs bg-green-50 text-green-700 rounded" onclick="openPay({{ $inv->id }}, '{{ $inv->invoice_number }}', {{ $inv->remaining() }})">Pay</button>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">No invoices yet. <a class="text-indigo-600" href="{{ route('accounting.createInvoice') }}">Create one</a></td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="bg-white rounded-xl border border-indigo-100 shadow-sm overflow-hidden">
      <div class="px-4 py-3 border-b border-indigo-100 bg-indigo-50"><h2 class="font-semibold">Audit log</h2></div>
      <div class="overflow-x-auto max-h-72">
        <table class="w-full text-sm">
          <thead class="bg-indigo-50/70"><tr class="text-left text-xs uppercase text-indigo-900"><th class="px-4 py-3">Action</th><th class="px-4 py-3">Invoice</th><th class="px-4 py-3">User</th><th class="px-4 py-3">When</th></tr></thead>
          <tbody class="divide-y divide-slate-100">
            @forelse($audits as $a)
              <tr>
                <td class="px-4 py-3">{{ ucfirst($a->action) }}</td>
                <td class="px-4 py-3">{{ $a->invoice_id ? '#'.$a->invoice_id : '—' }}</td>
                <td class="px-4 py-3">{{ trim(($a->user->fname ?? '').' '.($a->user->lname ?? '')) ?: 'User' }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $a->created_at?->format('M j, Y H:i') }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No audit entries.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div id="payModal" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center p-4">
      <form method="POST" id="payForm" class="bg-white rounded-xl p-6 w-full max-w-md space-y-3">
        @csrf
        <h3 class="font-semibold text-lg">Record payment <span id="payLabel" class="text-slate-500 font-normal"></span></h3>
        <input type="number" name="amount" id="payAmount" step="0.01" min="0.01" required class="w-full border rounded-lg px-3 py-2">
        <select name="payment_method" id="pay_method" required class="w-full border rounded-lg px-3 py-2">
          <option value="">Method</option>
          @foreach(['cash','mobile','bank'] as $m)
            <option value="{{ $m }}">{{ ucfirst($m) }}</option>
          @endforeach
        </select>
        <select name="bank_account_id" id="pay_account" required class="w-full border rounded-lg px-3 py-2">
          <option value="">Account</option>
          @foreach($accounts ?? [] as $a)
            <option value="{{ $a->id }}" data-kind="{{ $a->kind }}">{{ $a->name }} ({{ ucfirst($a->kind) }})</option>
          @endforeach
        </select>
        <input type="text" name="reference" placeholder="Reference" class="w-full border rounded-lg px-3 py-2">
        <input type="date" name="paid_at" value="{{ now()->toDateString() }}" required class="w-full border rounded-lg px-3 py-2">
        <div class="flex justify-end gap-2">
          <button type="button" onclick="document.getElementById('payModal').classList.add('hidden'); document.getElementById('payModal').classList.remove('flex')" class="px-3 py-2 border rounded-lg">Cancel</button>
          <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg">Save</button>
        </div>
      </form>
    </div>
    <script>
      function openPay(id, num, remaining) {
        const m = document.getElementById('payModal');
        document.getElementById('payForm').action = @json(url('/invoices')) + '/' + id + '/pay';
        document.getElementById('payLabel').textContent = num;
        document.getElementById('payAmount').value = remaining;
        document.getElementById('payAmount').max = remaining;
        m.classList.remove('hidden'); m.classList.add('flex');
      }
      const methodEl = document.getElementById('pay_method');
      const accountEl = document.getElementById('pay_account');
      methodEl?.addEventListener('change', () => {
        const kind = methodEl.value === 'cash' ? 'cash' : 'bank';
        [...accountEl.options].forEach((opt, i) => {
          if (i === 0) return;
          const show = opt.dataset.kind === kind;
          opt.hidden = !show; opt.disabled = !show;
        });
        if (accountEl.selectedOptions[0]?.hidden) accountEl.value = '';
      });
    </script>
  </main>
</x-Account-sidebar>
