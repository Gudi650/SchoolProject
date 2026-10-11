@php
  $fmt = fn ($n) => money_format_app($n);
  $mask = fn ($n) => $n ? '****'.substr(preg_replace('/\s+/', '', $n), -4) : '—';
@endphp
<x-Account-sidebar>
  <x-slot name="title">Banking And Cash Management</x-slot>
  <main class="p-6 bg-white">
    <div class="mb-6">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-slate-900">Banking & Cash Management</h1>
          <p class="text-sm text-slate-600 mt-1">Manage bank accounts, transactions, and cash flow</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
          <button type="button" onclick="document.getElementById('accountModal').classList.remove('hidden')" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 flex items-center gap-2">Add Account</button>
          <button type="button" onclick="document.getElementById('txnModal').classList.remove('hidden')" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add Transaction
          </button>
        </div>
      </div>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
        <p class="text-blue-100 text-sm mb-1">Total Bank Balance</p>
        <p class="text-3xl font-bold">{{ $fmt($bankBalance ?? 0) }}</p>
        <p class="text-blue-100 text-sm mt-2">Across {{ $accounts->where('kind','bank')->count() }} accounts</p>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <p class="text-sm text-slate-600 mb-1">Cash in Hand</p>
        <p class="text-2xl font-bold text-slate-900">{{ $fmt($cashBalance ?? 0) }}</p>
        <p class="text-sm text-green-600 mt-2">As of today</p>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <p class="text-sm text-slate-600 mb-1">Today's Deposits</p>
        <p class="text-2xl font-bold text-slate-900">{{ $fmt($todayDeposits ?? 0) }}</p>
        <p class="text-sm text-slate-600 mt-2">{{ $todayCount ?? 0 }} transactions</p>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <p class="text-sm text-slate-600 mb-1">Pending Reconciliation</p>
        <p class="text-2xl font-bold text-slate-900">{{ $pendingRecon ?? 0 }}</p>
        <p class="text-sm text-amber-600 mt-2">Requires attention</p>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-lg font-semibold text-slate-900 mb-4">Bank Accounts</h2>
      <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto relative z-0">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50">
            <tr>
              <th class="px-4 py-3 font-medium text-slate-700">Bank Name</th>
              <th class="px-4 py-3 font-medium text-slate-700">Account Number</th>
              <th class="px-4 py-3 font-medium text-slate-700">Account Type</th>
              <th class="px-4 py-3 font-medium text-slate-700">Balance</th>
              <th class="px-4 py-3 font-medium text-slate-700">Last Updated</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            @forelse($accounts as $a)
              <tr class="hover:bg-slate-50">
                <td class="px-4 py-3">{{ $a->name }} <span class="text-xs text-slate-500">({{ ucfirst($a->kind) }})</span></td>
                <td class="px-4 py-3">{{ $mask($a->account_number) }}</td>
                <td class="px-4 py-3">{{ $a->account_type ?: '—' }}</td>
                <td class="px-4 py-3 font-semibold text-green-600">{{ $fmt($a->computed_balance) }}</td>
                <td class="px-4 py-3">{{ $a->updated_at?->format('Y-m-d h:i A') }}</td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No accounts yet. Add a bank and a cash account so fees/expenses can post.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-lg font-semibold text-slate-900 mb-4">Recent Bank Transactions</h2>
      <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50">
            <tr>
              <th class="px-4 py-3 font-medium text-slate-700">Transaction ID</th>
              <th class="px-4 py-3 font-medium text-slate-700">Date</th>
              <th class="px-4 py-3 font-medium text-slate-700">Type</th>
              <th class="px-4 py-3 font-medium text-slate-700">Description</th>
              <th class="px-4 py-3 font-medium text-slate-700">Account</th>
              <th class="px-4 py-3 font-medium text-slate-700">Amount</th>
              <th class="px-4 py-3 font-medium text-slate-700">Balance</th>
              <th class="px-4 py-3 font-medium text-slate-700">Reference</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            @forelse($txns as $t)
              <tr class="hover:bg-slate-50">
                <td class="px-4 py-3">TXN{{ $t->id }}</td>
                <td class="px-4 py-3">{{ $t->occurred_at?->format('Y-m-d') }}</td>
                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $t->type === 'credit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $t->type === 'credit' ? 'Credit' : 'Debit' }}</span></td>
                <td class="px-4 py-3">{{ $t->description }}</td>
                <td class="px-4 py-3">{{ $t->account->name ?? '—' }}</td>
                <td class="px-4 py-3 font-semibold {{ $t->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">{{ $t->type === 'credit' ? '+' : '-' }}{{ $fmt($t->amount) }}</td>
                <td class="px-4 py-3">{{ $fmt($t->running) }}</td>
                <td class="px-4 py-3">
                  {{ $t->reference ?: '—' }}
                  @if(!$t->reconciled_at)
                    <form method="POST" action="{{ route('accounting.banking.reconcile', $t) }}" class="inline">@csrf<button class="text-xs text-indigo-600 ml-1">Reconcile</button></form>
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="8" class="px-4 py-8 text-center text-slate-500">No transactions yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div>
      <h2 class="text-lg font-semibold text-slate-900 mb-4">Cash Book (Last 4 Days)</h2>
      <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50">
            <tr>
              <th class="px-4 py-3 font-medium text-slate-700">Date</th>
              <th class="px-4 py-3 font-medium text-slate-700">Opening Balance</th>
              <th class="px-4 py-3 font-medium text-slate-700">Cash Received</th>
              <th class="px-4 py-3 font-medium text-slate-700">Cash Paid</th>
              <th class="px-4 py-3 font-medium text-slate-700">Closing Balance</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            @foreach($cashBook as $row)
              <tr class="hover:bg-slate-50">
                <td class="px-4 py-3">{{ $row['date']->format('Y-m-d') }}</td>
                <td class="px-4 py-3">{{ $fmt($row['opening']) }}</td>
                <td class="px-4 py-3 text-green-600">+{{ $fmt($row['in']) }}</td>
                <td class="px-4 py-3 text-red-600">-{{ $fmt($row['out']) }}</td>
                <td class="px-4 py-3 font-semibold">{{ $fmt($row['closing']) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <div id="accountModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40" onclick="this.parentElement.classList.add('hidden')"></div>
    <form method="POST" action="{{ route('accounting.banking.accounts.store') }}" class="relative mx-auto mt-16 w-full max-w-md bg-white rounded-xl p-6 space-y-3">
      @csrf
      <h2 class="font-semibold text-lg">Add account</h2>
      <input name="name" required placeholder="Name (e.g. CRDB / Cash drawer)" class="w-full border rounded-lg px-3 py-2">
      <select name="kind" required class="w-full border rounded-lg px-3 py-2">
        <option value="bank">Bank</option>
        <option value="cash">Cash</option>
      </select>
      <input name="account_type" placeholder="Type (Current / Savings)" class="w-full border rounded-lg px-3 py-2">
      <input name="account_number" placeholder="Account number" class="w-full border rounded-lg px-3 py-2">
      <input name="opening_balance" type="number" step="0.01" min="0" placeholder="Opening balance" class="w-full border rounded-lg px-3 py-2">
      <div class="flex justify-end gap-2"><button type="button" onclick="document.getElementById('accountModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg text-sm">Cancel</button><button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Save</button></div>
    </form>
  </div>

  <div id="txnModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40" onclick="this.parentElement.classList.add('hidden')"></div>
    <form method="POST" action="{{ route('accounting.banking.transactions.store') }}" class="relative mx-auto mt-16 w-full max-w-md bg-white rounded-xl p-6 space-y-3">
      @csrf
      <h2 class="font-semibold text-lg">Add transaction</h2>
      <select name="bank_account_id" required class="w-full border rounded-lg px-3 py-2">
        <option value="">Account</option>
        @foreach($accounts as $a)
          <option value="{{ $a->id }}">{{ $a->name }} ({{ ucfirst($a->kind) }})</option>
        @endforeach
      </select>
      <select name="type" required class="w-full border rounded-lg px-3 py-2">
        <option value="credit">Credit (deposit)</option>
        <option value="debit">Debit (withdrawal)</option>
      </select>
      <input name="amount" type="number" step="0.01" min="0.01" required placeholder="Amount" class="w-full border rounded-lg px-3 py-2">
      <input name="occurred_at" type="datetime-local" required value="{{ now()->format('Y-m-d\TH:i') }}" class="w-full border rounded-lg px-3 py-2">
      <input name="description" placeholder="Description" class="w-full border rounded-lg px-3 py-2">
      <input name="reference" placeholder="Reference" class="w-full border rounded-lg px-3 py-2">
      <div class="flex justify-end gap-2"><button type="button" onclick="document.getElementById('txnModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg text-sm">Cancel</button><button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Save</button></div>
    </form>
  </div>
</x-Account-sidebar>
