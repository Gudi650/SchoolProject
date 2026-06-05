<div
	data-add-category-modal
	class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
	role="dialog"
	aria-modal="true"
	aria-labelledby="add-category-title"
>
	<div
		data-add-category-dialog
		class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
	>
		<div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-600">Library Catalog</p>
				<h2 id="add-category-title" class="mt-1 text-2xl font-bold text-slate-900">Add New Category</h2>
				<p class="mt-1 text-sm text-slate-500">Create a new book category for the catalog filters and book form.</p>
			</div>

			<button
				type="button"
				data-close-add-category-modal
				class="rounded-full border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
				aria-label="Close modal"
			>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<form method="POST" action="{{ route('library.categories.store') }}" class="px-6 py-6">
			@csrf

			<div class="space-y-2">
				<label class="block text-sm font-medium text-slate-700" for="category-name">Category name</label>
				<input
					id="category-name"
					name="category_name"
					type="text"
					value="{{ old('category_name') }}"
					placeholder="e.g. Poetry, Mathematics, Local History"
					class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100"
				/>
				@error('category_name')
					<p class="text-sm text-red-600">{{ $message }}</p>
				@enderror
			</div>

			<div class="mt-5 rounded-2xl border border-brand-100 bg-brand-50 p-4 text-sm text-slate-600">
				<p class="font-semibold text-slate-900">Tip</p>
				<p class="mt-1">Keep names short and descriptive. The system will generate the category slug automatically.</p>
			</div>

			<div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-end">
				<button
					type="button"
					data-close-add-category-modal
					class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-800"
				>
					Cancel
				</button>
				<button
					type="submit"
					class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700"
				>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
					</svg>
					Save Category
				</button>
			</div>
		</form>
	</div>
</div>

<script>
	(function () {
		var openButton = document.querySelector('[data-open-add-category-modal]');
		var modal = document.querySelector('[data-add-category-modal]');

		if (!modal) {
			return;
		}

		var closeButtons = modal.querySelectorAll('[data-close-add-category-modal]');
		var dialog = modal.querySelector('[data-add-category-dialog]');

		function openModal() {
			modal.classList.remove('hidden');
			modal.classList.add('flex');
			document.body.classList.add('overflow-hidden');
			var firstField = modal.querySelector('input, select, textarea, button');
			if (firstField) {
				firstField.focus();
			}
		}

		function closeModal() {
			modal.classList.add('hidden');
			modal.classList.remove('flex');
			document.body.classList.remove('overflow-hidden');
		}

		if (openButton) {
			openButton.addEventListener('click', openModal);
		}

		closeButtons.forEach(function (button) {
			button.addEventListener('click', closeModal);
		});

		modal.addEventListener('click', function (event) {
			if (event.target === modal) {
				closeModal();
			}
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
				closeModal();
			}
		});

		if (dialog) {
			dialog.addEventListener('click', function (event) {
				event.stopPropagation();
			});
		}

		if ({{ $errors->has('category_name') ? 'true' : 'false' }}) {
			openModal();
		}
    }
    )();
</script>

