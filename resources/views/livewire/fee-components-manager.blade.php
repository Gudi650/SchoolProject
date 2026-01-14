<div class="space-y-2">
  @forelse($components as $component)
    <div class="grid grid-cols-12 gap-2">
      <input 
        type="text"
        wire:model="components.{{ $loop->index }}.name"
        name="{{ $type }}_components[{{ $loop->index }}][name]"
        class="col-span-7 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        placeholder="Component name"
      />
      <input 
        type="number"
        wire:model="components.{{ $loop->index }}.amount"
        name="{{ $type }}_components[{{ $loop->index }}][amount]"
        min="0"
        step="0.01"
        class="col-span-4 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        placeholder="Amount"
      />
      <button 
        type="button"
        wire:click="removeComponent({{ $component['id'] }})"
        class="col-span-1 rounded bg-rose-100 text-rose-700 hover:bg-rose-200 flex items-center justify-center"
      >
        <i data-lucide="trash-2" class="w-4 h-4"></i>
      </button>
    </div>
  @empty
    <p class="text-sm text-slate-500">No custom components added yet.</p>
  @endforelse

  <button 
    type="button"
    wire:click="addComponent"
    class="px-3 py-2 rounded text-sm border-2 border-dashed border-slate-300 hover:border-indigo-400 text-slate-700 hover:text-indigo-700 bg-white flex items-center gap-2"
  >
    <i data-lucide="plus" class="w-4 h-4"></i>
    Add Component
  </button>
</div>
