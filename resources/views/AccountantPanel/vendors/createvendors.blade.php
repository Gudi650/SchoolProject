<x-Account-sidebar>
  <x-slot name="title">{{ $editVendor ? 'Edit Vendor' : 'Create Vendor' }}</x-slot>
  <div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-3xl">
      <div class="rounded-lg border border-indigo-100 bg-indigo-50/60 px-4 py-4 sm:px-5 mb-6 flex items-center justify-between gap-3">
        <div>
          <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">{{ $editVendor ? 'Edit Vendor' : 'Create Vendor' }}</h1>
          <p class="mt-1 text-sm text-gray-700">Add a vendor for procurement, billing, and records.</p>
        </div>
        <a href="{{ route('accounting.vendorsManagement') }}" class="text-sm text-indigo-600">Back to dashboard</a>
      </div>
      @if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif
      <form method="POST" action="{{ $editVendor ? route('accounting.vendorsManagement.update', $editVendor) : route('accounting.vendorsManagement.store') }}" class="rounded-lg border bg-white p-6 space-y-3 shadow-sm">
        @csrf
        @if($editVendor) @method('PUT') @endif
        <select name="type" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['person','company'] as $t)
            <option value="{{ $t }}" @selected(old('type', $editVendor->type ?? 'company') === $t)>{{ ucfirst($t) }}</option>
          @endforeach
        </select>
        <input name="name" required placeholder="Full name / company" value="{{ old('name', $editVendor->name ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input name="email" type="email" placeholder="Email" value="{{ old('email', $editVendor->email ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <input name="phone" placeholder="Phone" value="{{ old('phone', $editVendor->phone ?? '') }}" class="w-full border rounded-lg px-3 py-2">
        <select name="category" class="w-full border rounded-lg px-3 py-2">
          <option value="">Select category</option>
          @php $currentCat = old('category', $editVendor->category ?? ''); @endphp
          @if($currentCat && !collect($categories ?? [])->contains($currentCat))
            <option value="{{ $currentCat }}" selected>{{ $currentCat }}</option>
          @endif
          @foreach($categories ?? [] as $c)
            <option value="{{ $c }}" @selected($currentCat === $c)>{{ $c }}</option>
          @endforeach
        </select>
        <p class="text-xs text-slate-500">Manage list in <a href="{{ route('accounting.financeCategories') }}" class="text-indigo-600">Categories</a>.</p>
        <select name="status" required class="w-full border rounded-lg px-3 py-2">
          @foreach(['active','inactive'] as $s)
            <option value="{{ $s }}" @selected(old('status', $editVendor->status ?? 'active') === $s)>{{ ucfirst($s) }}</option>
          @endforeach
        </select>
        <textarea name="notes" rows="3" placeholder="Notes" class="w-full border rounded-lg px-3 py-2">{{ old('notes', $editVendor->notes ?? '') }}</textarea>
        <div class="flex gap-2 justify-end">
          <a href="{{ route('accounting.vendorsManagement') }}" class="px-4 py-2 border rounded-lg text-sm">Cancel</a>
          <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">{{ $editVendor ? 'Update' : 'Save' }}</button>
          </div>
        </form>
    </div>
  </div>
</x-Account-sidebar>
