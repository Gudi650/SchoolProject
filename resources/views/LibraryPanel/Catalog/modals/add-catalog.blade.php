<div
	data-add-book-modal
	class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
	role="dialog"
	aria-modal="true"
	aria-labelledby="add-book-title"
>
	<div
		data-add-book-dialog
		class="w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
	>
		<div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-600">Library Catalog</p>
				<h2 id="add-book-title" class="mt-1 text-2xl font-bold text-slate-900">Add New Book</h2>
				<p class="mt-1 text-sm text-slate-500">Create a new catalog entry for the library collection.</p>
			</div>

			<button
				type="button"
				data-close-add-book-modal
				class="rounded-full border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
				aria-label="Close modal"
			>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<form method="POST" action="{{ route('library.catalog.store') }}" class="max-h-[80vh] overflow-y-auto px-6 py-6" enctype="multipart/form-data">
			@csrf
			<div class="grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(280px,0.8fr)]">
				<div class="space-y-6">
					<div class="grid gap-4 md:grid-cols-2">
						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-title">Book title</label>
							<input id="book-title" name="title" type="text" placeholder="Enter book title" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-author">Author</label>
							<input id="book-author" name="author" type="text" placeholder="Enter author name" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-isbn">ISBN</label>
							<input id="book-isbn" name="isbn" type="text" placeholder="978-0-00-000000-0" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-category">Category</label>
							<select id="book-category" name="category_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100">
								<option value="">Select category</option>
								@foreach (($categories ?? []) as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-publisher">Publisher</label>
							<input id="book-publisher" name="publisher" type="text" placeholder="Publisher name" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-year">Publication year</label>
							<input id="book-year" name="publication_year" type="number" min="1500" max="2100" placeholder="2026" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-shelf">Shelf / location</label>
							<input id="book-shelf" name="shelf_location" type="text" placeholder="Shelf A-12" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="book-quantity">Copies</label>
							<input id="book-quantity" name="total_copies" type="number" min="1" value="1" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100" />
						</div>
					</div>

					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="book-description">Description</label>
						<textarea id="book-description" name="description" rows="5" placeholder="Write a short summary of the book..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:bg-white focus:ring-4 focus:ring-brand-100"></textarea>
					</div>
				</div>

				<div class="space-y-6 rounded-2xl bg-slate-50 p-5">
					<div>
						<h3 class="text-sm font-semibold text-slate-900">Book Cover</h3>
						<p class="mt-1 text-sm text-slate-500">Upload a clean cover image for the catalog entry.</p>
						<label class="mt-4 flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-white px-4 py-10 text-center transition hover:border-brand-300 hover:bg-brand-50/40">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
							</svg>
							<span class="mt-3 text-sm font-medium text-slate-700">Drop cover image here or click to browse</span>
							<span class="mt-1 text-xs text-slate-500">PNG, JPG up to 5MB</span>
							<input type="file" class="sr-only" accept="image/*" />
						</label>
					</div>

					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="book-status">Status</label>
						<select id="book-status" name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-brand-500 focus:ring-4 focus:ring-brand-100">
							<option value="available" selected>Available</option>
							<option value="reference">Reference only</option>
							<option value="checked-out">Checked out</option>
						</select>
					</div>

					<div class="rounded-2xl border border-brand-100 bg-brand-50 p-4 text-sm text-slate-600">
						<p class="font-semibold text-slate-900">Tip</p>
						<p class="mt-1">Keep the title, ISBN, and category consistent so search and filters stay reliable later.</p>
					</div>
				</div>
			</div>

			<div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-end">
				<button
					type="button"
					data-close-add-book-modal
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
					Save Book
				</button>
			</div>
		</form>
	</div>
</div>
