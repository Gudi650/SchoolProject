<x-Account-sidebar>
  <x-slot name="title">Categories</x-slot>
  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
      <div>
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Expense & vendor categories</h1>
        <p class="text-xs sm:text-sm text-slate-700 mt-1">Add categories here. They appear when recording vendors and expenses.</p>
      </div>
      <a href="{{ route('accounting.vendorsManagement') }}" class="text-sm text-indigo-700">Vendors</a>
    </div>
    @if(session('success'))<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800 text-sm">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

    <form method="POST" action="{{ route('accounting.financeCategories.store') }}" class="bg-white border border-indigo-100 rounded-xl p-4 mb-6 flex flex-col sm:flex-row gap-2">
      @csrf
      <input name="name" required maxlength="64" placeholder="New category name" class="flex-1 border rounded-lg px-3 py-2">
      <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">Add category</button>
    </form>

    <div class="bg-white rounded-xl border border-indigo-100 shadow-sm overflow-hidden">
      <div class="px-4 py-3 border-b border-indigo-100 bg-indigo-50 flex items-center gap-2">
        <span class="w-1 h-5 bg-indigo-600 rounded"></span>
        <h2 class="font-semibold text-slate-900">Categories</h2>
      </div>
      <table class="w-full text-sm">
        <thead class="bg-indigo-50/70 border-b border-indigo-100">
          <tr class="text-left text-xs font-semibold uppercase tracking-wide text-indigo-900">
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($categories as $c)
            <tr class="hover:bg-indigo-50/40">
              <td class="px-4 py-3">
                <form method="POST" action="{{ route('accounting.financeCategories.update', $c) }}" class="flex gap-2">
                  @csrf @method('PUT')
                  <input name="name" required value="{{ $c->name }}" class="flex-1 border rounded-lg px-3 py-1.5">
                </form>
              </td>
              <td class="px-4 py-3 text-right">
                <form method="POST" action="{{ route('accounting.financeCategories.destroy', $c) }}" class="inline" onsubmit="return confirm('Delete this category?')">
                  @csrf @method('DELETE')
                  <button class="px-2 py-1 text-xs font-medium text-red-700 hover:bg-red-50 rounded-md">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="2" class="px-4 py-12 text-center text-slate-500">No categories yet. Add one above.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
</x-Account-sidebar>
