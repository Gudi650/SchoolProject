@php $fmt = fn ($n) => money_format_app($n); @endphp
<x-Account-sidebar>
  <x-slot name="title">Expenses</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6">
      <h1 class="text-xl font-bold text-slate-900">Expenses</h1>
      <p class="text-sm text-slate-600">This month: {{ $fmt($monthTotal ?? 0) }}</p>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif

    <div class="grid lg:grid-cols-2 gap-6">
      <form method="POST" action="{{ $editExpense ? route('accounting.expensesManagement.update', $editExpense) : route('accounting.expensesManagement.store') }}" class="bg-white border rounded-xl p-6 space-y-3">
        @csrf
        @if($editExpense) @method('PUT') @endif
        <h2 class="font-semibold">{{ $editExpense ? 'Edit expense #'.$editExpense->id : 'Record expense' }}</h2>
        @if($editExpense)<a href="{{ route('accounting.expensesManagement') }}" class="text-xs text-indigo-600">Cancel edit</a>@endif
        <input type="text" name="title" required placeholder="Title" value="{{ old('title', $editExpense->title ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <select name="category" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['utilities','salaries','maintenance','supplies','other'] as $c)
            <option value="{{ $c }}" @selected(old('category', $editExpense->category ?? '') === $c)>{{ ucfirst($c) }}</option>
          @endforeach
        </select>
        <input type="text" name="vendor" placeholder="Vendor" value="{{ old('vendor', $editExpense->vendor ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input type="number" name="amount" step="0.01" min="0.01" required value="{{ old('amount', $editExpense->amount ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input type="date" name="expense_date" required value="{{ old('expense_date', optional($editExpense?->expense_date)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2">
        <select name="status" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['paid','pending'] as $s)
            <option value="{{ $s }}" @selected(old('status', $editExpense->status ?? 'paid') === $s)>{{ ucfirst($s) }}</option>
          @endforeach
        </select>
        <select name="payment_method" class="w-full border rounded-lg px-3 py-2">
          <option value="">Payment method</option>
          @foreach(['cash','mobile','bank','cheque'] as $m)
            <option value="{{ $m }}" @selected(old('payment_method', $editExpense->payment_method ?? '') === $m)>{{ ucfirst($m) }}</option>
          @endforeach
        </select>
        <input type="text" name="reference" placeholder="Reference" value="{{ old('reference', $editExpense->reference ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <textarea name="notes" rows="2" placeholder="Notes" class="w-full border rounded-lg px-3 py-2">{{ old('notes', $editExpense->notes ?? '') }}</textarea>
        <button type="submit" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg">{{ $editExpense ? 'Update' : 'Save' }}</button>
      </form>

      <div class="space-y-6">
        <div class="bg-white border rounded-xl overflow-hidden">
          <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Recent expenses</h2>
          <div class="overflow-x-auto max-h-80">
            <table class="w-full text-sm">
              <thead class="border-b"><tr><th class="px-3 py-2 text-left">Date</th><th class="px-3 py-2 text-left">Title</th><th class="px-3 py-2">Amount</th><th class="px-3 py-2"></th></tr></thead>
              <tbody class="divide-y">
                @forelse($expenses as $e)
                  <tr>
                    <td class="px-3 py-2">{{ $e->expense_date->format('M j') }}</td>
                    <td class="px-3 py-2">{{ $e->title }}<span class="block text-xs text-slate-500">{{ ucfirst($e->category) }} · {{ ucfirst($e->status) }}</span></td>
                    <td class="px-3 py-2 font-medium">{{ $fmt($e->amount) }}</td>
                    <td class="px-3 py-2 whitespace-nowrap">
                      <a href="{{ route('accounting.expensesManagement', ['edit' => $e->id]) }}" class="text-indigo-600 text-xs">Edit</a>
                      <form method="POST" action="{{ route('accounting.expensesManagement.destroy', $e) }}" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 text-xs ml-2">Del</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No expenses yet.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="bg-white border rounded-xl overflow-hidden">
          <h2 class="px-4 py-3 font-semibold border-b bg-slate-50 text-sm">Audit log</h2>
          <ul class="divide-y text-sm max-h-48 overflow-y-auto">
            @forelse($audits as $a)
              <li class="px-4 py-2">
                <span class="font-medium">{{ ucfirst($a->action) }}</span>
                @if($a->expense_id) #{{ $a->expense_id }} @endif
                · {{ trim(($a->user->fname ?? '').' '.($a->user->lname ?? '')) ?: 'User' }}
                · {{ $a->created_at->format('M j, H:i') }}
              </li>
            @empty
              <li class="px-4 py-6 text-center text-slate-500">No audit entries.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </main>
</x-Account-sidebar>
