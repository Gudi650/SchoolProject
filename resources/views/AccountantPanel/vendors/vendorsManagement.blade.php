<x-Account-sidebar>
  <x-slot name="title">Vendor Management</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Vendor Management</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Manage vendors, suppliers, and payment tracking</p>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-2">
          <a href="{{ route('accounting.createVendor') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Vendor
          </a>
        </div>
      </div>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Total Vendors</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Active</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $stats['active'] }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Inactive</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $stats['inactive'] }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Added this month</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $stats['month'] }}</p>
      </div>
    </div>

    <div class="space-y-6">
      <div class="bg-white rounded-xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-indigo-100 bg-indigo-50 flex items-center gap-2">
          <span class="w-1 h-5 bg-indigo-600 rounded"></span>
          <h2 class="font-semibold text-slate-900">Vendors</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-indigo-50/70 border-b border-indigo-100">
              <tr class="text-left text-xs font-semibold uppercase tracking-wide text-indigo-900">
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Type</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Phone</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse($vendors as $v)
                <tr class="hover:bg-indigo-50/40 transition-colors">
                  <td class="px-4 py-3 text-slate-500 font-mono text-xs">#{{ $v->id }}</td>
                  <td class="px-4 py-3 font-semibold text-slate-900">{{ $v->name }}</td>
                  <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">{{ ucfirst($v->type) }}</span></td>
                  <td class="px-4 py-3 text-slate-600">{{ $v->category ?: '—' }}</td>
                  <td class="px-4 py-3 text-slate-600">{{ $v->email ?: '—' }}</td>
                  <td class="px-4 py-3 text-slate-600">{{ $v->phone ?: '—' }}</td>
                  <td class="px-4 py-3">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $v->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($v->status) }}</span>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap text-right">
                    <button type="button" onclick="document.getElementById('v-{{ $v->id }}').classList.toggle('hidden')" class="px-2 py-1 rounded-md text-xs font-medium text-slate-600 hover:bg-slate-100">Details</button>
                    <a href="{{ route('accounting.createVendor', ['edit' => $v->id]) }}" class="px-2 py-1 rounded-md text-xs font-medium text-indigo-700 hover:bg-indigo-50">Edit</a>
                    <form method="POST" action="{{ route('accounting.vendorsManagement.destroy', $v) }}" class="inline" onsubmit="return confirm('Delete?')">
                      @csrf @method('DELETE')
                      <button class="px-2 py-1 rounded-md text-xs font-medium text-red-700 hover:bg-red-50">Delete</button>
                    </form>
                  </td>
                </tr>
                <tr id="v-{{ $v->id }}" class="hidden">
                  <td colspan="8" class="px-4 py-3 bg-indigo-50/50">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                      <div class="rounded-lg bg-white border border-indigo-100 p-3"><p class="text-slate-500 mb-0.5">Notes</p><p class="text-slate-800">{{ $v->notes ?: '—' }}</p></div>
                      <div class="rounded-lg bg-white border border-indigo-100 p-3"><p class="text-slate-500 mb-0.5">Added by</p><p class="text-slate-800">{{ trim(($v->creator->fname ?? '').' '.($v->creator->lname ?? '')) ?: '—' }}</p></div>
                      <div class="rounded-lg bg-white border border-indigo-100 p-3"><p class="text-slate-500 mb-0.5">Created</p><p class="text-slate-800">{{ $v->created_at?->format('M j, Y H:i') }}</p></div>
                      <div class="rounded-lg bg-white border border-indigo-100 p-3"><p class="text-slate-500 mb-0.5">Updated</p><p class="text-slate-800">{{ $v->updated_at?->format('M j, Y H:i') }}</p></div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr><td colspan="8" class="px-4 py-12 text-center text-slate-500">No vendors yet.</td></tr>
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
                <th class="px-4 py-3">Vendor</th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">When</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @forelse($audits as $a)
                <tr class="hover:bg-indigo-50/40">
                  <td class="px-4 py-3">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $a->action === 'deleted' ? 'bg-red-100 text-red-700' : ($a->action === 'updated' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700') }}">{{ ucfirst($a->action) }}</span>
                  </td>
                  <td class="px-4 py-3 text-slate-600">{{ $a->vendor_id ? '#'.$a->vendor_id : '—' }}</td>
                  <td class="px-4 py-3 text-slate-800">{{ trim(($a->user->fname ?? '').' '.($a->user->lname ?? '')) ?: 'User' }}</td>
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
</x-Account-sidebar>
