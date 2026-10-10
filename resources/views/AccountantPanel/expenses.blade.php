@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Expense Management</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Expense Management</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Track and manage all school expenses</p>
        </div>
        <button type="button" onclick="openExpense()" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2 shadow-sm justify-center">
          <i data-lucide="plus" class="w-4 h-4"></i> Record Expense
        </button>
      </div>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Total this month</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $fmt($stats['monthTotal'] ?? 0) }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Pending</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $fmt($stats['pending'] ?? 0) }}</p>
        <p class="text-xs text-amber-600 mt-1">{{ $stats['pendingCount'] ?? 0 }} items</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Records</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $stats['count'] ?? 0 }}</p>
      </div>
    </div>

    <div class="space-y-6">
      <div class="bg-white rounded-xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-indigo-100 bg-indigo-50 flex items-center gap-2">
          <span class="w-1 h-5 bg-indigo-600 rounded"></span>
          <h2 class="font-semibold text-slate-900">Expenses</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-indigo-50/70 border-b border-indigo-100">
              <tr class="text-left text-xs font-semibold uppercase tracking-wide text-indigo-900">
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Title</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Vendor</th>
                <th class="px-4 py-3">Amount</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse($expenses as $e)
                <tr class="hover:bg-indigo-50/40">
                  <td class="px-4 py-3 text-slate-600">{{ $e->expense_date->format('M j, Y') }}</td>
                  <td class="px-4 py-3 font-semibold text-slate-900">{{ $e->title }}</td>
                  <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded-full text-xs bg-slate-100 text-slate-700">{{ ucfirst($e->category) }}</span></td>
                  <td class="px-4 py-3 text-slate-600">{{ $e->vendorRecord->name ?? $e->vendor ?? '—' }}</td>
                  <td class="px-4 py-3 font-medium">{{ $fmt($e->amount) }}</td>
                  <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $e->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($e->status) }}</span></td>
                  <td class="px-4 py-3 whitespace-nowrap text-right">
                    <button type="button" onclick='openExpense(@json($e))' class="px-2 py-1 rounded-md text-xs font-medium text-indigo-700 hover:bg-indigo-50">Edit</button>
                    <form method="POST" action="{{ route('accounting.expensesManagement.destroy', $e) }}" class="inline" onsubmit="return confirm('Delete?')">
                      @csrf @method('DELETE')
                      <button class="px-2 py-1 rounded-md text-xs font-medium text-red-700 hover:bg-red-50">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="7" class="px-4 py-12 text-center text-slate-500">No expenses yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="bg-white rounded-xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-indigo-100 bg-indigo-50 flex items-center gap-2">
          <span class="w-1 h-5 bg-indigo-600 rounded"></span>
          <h2 class="font-semibold text-slate-900">Audit log</h2>
        </div>
        <div class="overflow-x-auto max-h-72">
          <table class="w-full text-sm">
            <thead class="bg-indigo-50/70 border-b border-indigo-100 sticky top-0">
              <tr class="text-left text-xs font-semibold uppercase tracking-wide text-indigo-900">
                <th class="px-4 py-3">Action</th>
                <th class="px-4 py-3">Expense</th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">When</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse($audits as $a)
                <tr class="hover:bg-indigo-50/40">
                  <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $a->action === 'deleted' ? 'bg-red-100 text-red-700' : ($a->action === 'updated' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700') }}">{{ ucfirst($a->action) }}</span></td>
                  <td class="px-4 py-3 text-slate-600">{{ $a->expense_id ? '#'.$a->expense_id : '—' }}</td>
                  <td class="px-4 py-3">{{ trim(($a->user->fname ?? '').' '.($a->user->lname ?? '')) ?: 'User' }}</td>
                  <td class="px-4 py-3 text-slate-500">{{ $a->created_at->format('M j, Y H:i') }}</td>
                </tr>
              @empty
                <tr><td colspan="4" class="px-4 py-10 text-center text-slate-500">No audit entries.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <div id="expenseModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40" onclick="closeExpense()"></div>
    <div class="relative mx-auto mt-16 w-full max-w-lg bg-white rounded-xl shadow-xl p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 id="expenseModalTitle" class="text-lg font-semibold">Record expense</h2>
        <button type="button" onclick="closeExpense()" class="text-slate-500 hover:text-slate-800">✕</button>
      </div>
      <form id="expenseForm" method="POST" action="{{ route('accounting.expensesManagement.store') }}" class="space-y-3">
        @csrf
        <input type="hidden" name="_method" id="expenseMethod" disabled>
        <select name="vendor_id" id="ex_vendor" onchange="applyVendor()" class="w-full border rounded-lg px-3 py-2">
          <option value="">No vendor (enter details)</option>
          @foreach($vendors as $v)
            <option value="{{ $v->id }}">{{ $v->name }}</option>
          @endforeach
        </select>
        <input name="title" id="ex_title" required placeholder="Title" class="w-full border rounded-lg px-3 py-2">
        <select name="category" id="ex_category" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['utilities','salaries','maintenance','supplies','other'] as $c)
            <option value="{{ $c }}">{{ ucfirst($c) }}</option>
          @endforeach
        </select>
        <input type="number" name="amount" id="ex_amount" step="0.01" min="0.01" required placeholder="Amount" class="w-full border rounded-lg px-3 py-2">
        <input type="date" name="expense_date" id="ex_date" required class="w-full border rounded-lg px-3 py-2">
        <select name="status" id="ex_status" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['paid','pending'] as $s)<option value="{{ $s }}">{{ ucfirst($s) }}</option>@endforeach
        </select>
        <select name="payment_method" id="ex_method" class="w-full border rounded-lg px-3 py-2">
          <option value="">Payment method</option>
          @foreach(['cash','mobile','bank','cheque'] as $m)<option value="{{ $m }}">{{ ucfirst($m) }}</option>@endforeach
        </select>
        <input name="reference" id="ex_ref" placeholder="Reference" class="w-full border rounded-lg px-3 py-2">
        <textarea name="notes" id="ex_notes" rows="2" placeholder="Notes" class="w-full border rounded-lg px-3 py-2"></textarea>
        <div class="flex justify-end gap-2 pt-2">
          <button type="button" onclick="closeExpense()" class="px-4 py-2 border rounded-lg text-sm">Cancel</button>
          <button id="expenseSubmit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Save</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    const storeUrl = @json(route('accounting.expensesManagement.store'));
    const updateBase = @json(url('/expenses-management'));
    const vendorMap = @json($vendors->mapWithKeys(fn ($v) => [$v->id => ['category' => strtolower((string) $v->category)]]));
    const cats = ['utilities','salaries','maintenance','supplies','other'];
    function applyVendor() {
      const id = document.getElementById('ex_vendor').value;
      const cat = document.getElementById('ex_category');
      if (id && vendorMap[id]) {
        const c = vendorMap[id].category;
        cat.value = cats.includes(c) ? c : 'other';
        cat.disabled = true;
        cat.classList.add('bg-slate-100');
      } else {
        cat.disabled = false;
        cat.classList.remove('bg-slate-100');
      }
    }
    function openExpense(row) {
      const form = document.getElementById('expenseForm');
      const method = document.getElementById('expenseMethod');
      document.getElementById('expenseModal').classList.remove('hidden');
      if (row) {
        form.action = updateBase + '/' + row.id;
        method.disabled = false; method.value = 'PUT';
        document.getElementById('expenseModalTitle').textContent = 'Edit expense';
        document.getElementById('expenseSubmit').textContent = 'Update';
        document.getElementById('ex_title').value = row.title || '';
        document.getElementById('ex_category').value = row.category || 'other';
        document.getElementById('ex_vendor').value = row.vendor_id || '';
        document.getElementById('ex_amount').value = row.amount || '';
        document.getElementById('ex_date').value = (row.expense_date || '').slice(0, 10);
        document.getElementById('ex_status').value = row.status || 'paid';
        document.getElementById('ex_method').value = row.payment_method || '';
        document.getElementById('ex_ref').value = row.reference || '';
        document.getElementById('ex_notes').value = row.notes || '';
        applyVendor();
      } else {
        form.action = storeUrl; method.disabled = true;
        document.getElementById('expenseModalTitle').textContent = 'Record expense';
        document.getElementById('expenseSubmit').textContent = 'Save';
        form.reset();
        document.getElementById('ex_date').value = new Date().toISOString().slice(0, 10);
        applyVendor();
      }
    }
    document.getElementById('expenseForm').addEventListener('submit', () => {
      document.getElementById('ex_category').disabled = false;
    });
    function closeExpense() { document.getElementById('expenseModal').classList.add('hidden'); }
    @if($errors->any()) document.addEventListener('DOMContentLoaded', () => openExpense()); @endif
  </script>
</x-Account-sidebar>
