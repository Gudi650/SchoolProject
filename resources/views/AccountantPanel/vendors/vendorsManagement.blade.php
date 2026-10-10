<x-Account-sidebar>
  <x-slot name="title">Vendors</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <h1 class="text-xl font-bold text-slate-900 mb-1">Vendors</h1>
    <p class="text-sm text-slate-600 mb-4">{{ $vendors->count() }} on this school</p>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif

    <div class="grid lg:grid-cols-2 gap-6">
      <form method="POST" action="{{ $editVendor ? route('accounting.vendorsManagement.update', $editVendor) : route('accounting.vendorsManagement.store') }}" class="bg-white border rounded-xl p-6 space-y-3">
        @csrf
        @if($editVendor) @method('PUT') @endif
        <h2 class="font-semibold">{{ $editVendor ? 'Edit #'.$editVendor->id : 'Add vendor' }}</h2>
        @if($editVendor)<a href="{{ route('accounting.vendorsManagement') }}" class="text-xs text-indigo-600">Cancel</a>@endif
        <select name="type" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['person','company'] as $t)
            <option value="{{ $t }}" @selected(old('type', $editVendor->type ?? 'company') === $t)>{{ ucfirst($t) }}</option>
          @endforeach
        </select>
        <input name="name" required placeholder="Name" value="{{ old('name', $editVendor->name ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input name="email" type="email" placeholder="Email" value="{{ old('email', $editVendor->email ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input name="phone" placeholder="Phone" value="{{ old('phone', $editVendor->phone ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input name="category" placeholder="Category (e.g. utilities)" value="{{ old('category', $editVendor->category ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <select name="status" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['active','inactive'] as $s)
            <option value="{{ $s }}" @selected(old('status', $editVendor->status ?? 'active') === $s)>{{ ucfirst($s) }}</option>
          @endforeach
        </select>
        <textarea name="notes" rows="2" placeholder="Notes" class="w-full border rounded-lg px-3 py-2">{{ old('notes', $editVendor->notes ?? '') }}</textarea>
        <button class="w-full py-2.5 bg-indigo-600 text-white rounded-lg">{{ $editVendor ? 'Update' : 'Save' }}</button>
      </form>

      <div class="space-y-6">
        <div class="bg-white border rounded-xl overflow-hidden">
          <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">List</h2>
          <div class="overflow-x-auto max-h-80">
            <table class="w-full text-sm">
              <thead class="border-b"><tr><th class="px-3 py-2 text-left">Name</th><th class="px-3 py-2">Type</th><th class="px-3 py-2"></th></tr></thead>
              <tbody class="divide-y">
                @forelse($vendors as $v)
                  <tr>
                    <td class="px-3 py-2">{{ $v->name }}<span class="block text-xs text-slate-500">{{ $v->phone }} {{ $v->email }}</span></td>
                    <td class="px-3 py-2">{{ ucfirst($v->type) }} · {{ ucfirst($v->status) }}</td>
                    <td class="px-3 py-2 whitespace-nowrap">
                      <a href="{{ route('accounting.vendorsManagement', ['edit' => $v->id]) }}" class="text-indigo-600 text-xs">Edit</a>
                      <form method="POST" action="{{ route('accounting.vendorsManagement.destroy', $v) }}" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-xs ml-2">Del</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">No vendors yet.</td></tr>
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
                @if($a->vendor_id) #{{ $a->vendor_id }} @endif
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
