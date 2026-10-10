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

    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-indigo-50 text-sm">Vendors</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="border-b bg-slate-50">
              <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left">Contact</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3"></th>
              </tr>
            </thead>
            <tbody class="divide-y">
              @forelse($vendors as $v)
                <tr>
                  <td class="px-4 py-3">{{ $v->name }}<span class="block text-xs text-slate-500">{{ $v->category }}</span></td>
                  <td class="px-4 py-3">{{ ucfirst($v->type) }}</td>
                  <td class="px-4 py-3">{{ $v->phone }}<span class="block text-xs text-slate-500">{{ $v->email }}</span></td>
                  <td class="px-4 py-3">{{ ucfirst($v->status) }}</td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <a href="{{ route('accounting.createVendor', ['edit' => $v->id]) }}" class="text-indigo-600 text-xs">Edit</a>
                    <form method="POST" action="{{ route('accounting.vendorsManagement.destroy', $v) }}" class="inline" onsubmit="return confirm('Delete?')">
                      @csrf @method('DELETE')
                      <button class="text-red-600 text-xs ml-2">Del</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No vendors yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="bg-white rounded-xl border overflow-hidden">
        <h2 class="px-4 py-3 font-semibold border-b bg-slate-50 text-sm">Audit log</h2>
        <ul class="divide-y text-sm max-h-80 overflow-y-auto">
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
  </main>
</x-Account-sidebar>
