<div
	data-add-stock-modal
	class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
	role="dialog"
	aria-modal="true"
	aria-labelledby="add-stock-title"
>
	<div
		data-add-stock-dialog
		class="w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
	>
		<div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Inventory</p>
				<h2 id="add-stock-title" class="mt-1 text-2xl font-bold text-slate-900">Add Stock Entry</h2>
				<p class="mt-1 text-sm text-slate-500">Record new copies, their condition, and where they are stored.</p>
			</div>

			<button
				type="button"
				data-close-add-stock-modal
				class="rounded-full border border-slate-200 p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
				aria-label="Close modal"
			>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>

		<form class="max-h-[80vh] overflow-y-auto px-6 py-6">
			<div class="grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(280px,0.8fr)]">
				<div class="space-y-6">
					<div class="grid gap-4 md:grid-cols-2">
						<div class="md:col-span-2">
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-book">Book title</label>
							<select id="stock-book" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select a book title</option>
								<option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
								<option value="1984">1984</option>
								<option value="The Great Gatsby">The Great Gatsby</option>
								<option value="Sapiens">Sapiens</option>
								<option value="Dune">Dune</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-isbn">ISBN</label>
							<select id="stock-isbn" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select an ISBN</option>
								<option value="978-0061120084">978-0061120084</option>
								<option value="978-0451524935">978-0451524935</option>
								<option value="978-0743273565">978-0743273565</option>
								<option value="978-0062316097">978-0062316097</option>
								<option value="978-0441013593">978-0441013593</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-category">Category</label>
							<select id="stock-category" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select category</option>
								<option>Fiction</option>
								<option>Science</option>
								<option>History</option>
								<option>Biography</option>
								<option>Reference</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-location">Location</label>
							<input id="stock-location" type="text" placeholder="Shelf A-12" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-copies">Copies added</label>
							<input id="stock-copies" type="number" min="1" value="1" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-condition">Condition</label>
							<select id="stock-condition" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option>Excellent</option>
								<option>Good</option>
								<option>Fair</option>
								<option>Damaged</option>
							</select>
						</div>
					</div>

					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="stock-notes">Notes</label>
						<textarea id="stock-notes" rows="5" placeholder="Add a note about this stock entry..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"></textarea>
					</div>
				</div>

				<div class="space-y-6 rounded-2xl bg-slate-50 p-5">
					<div>
						<h3 class="text-sm font-semibold text-slate-900">Quick Summary</h3>
						<p class="mt-1 text-sm text-slate-500">Use this to keep inventory counts and storage organized.</p>
						<div class="mt-4 space-y-3 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-600">
							<div class="flex items-center justify-between">
								<span>Copies tracked</span>
								<span class="font-semibold text-slate-900">15,420</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Low stock titles</span>
								<span class="font-semibold text-amber-600">3</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Damaged items</span>
								<span class="font-semibold text-red-600">34</span>
							</div>
						</div>
					</div>

					<div class="rounded-2xl border border-indigo-100 bg-indigo-50 p-4 text-sm text-slate-600">
						<p class="font-semibold text-slate-900">Tip</p>
						<p class="mt-1">Choose a matching condition and location so the stock table stays accurate later.</p>
					</div>
				</div>
			</div>

			<div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-end">
				<button
					type="button"
					data-close-add-stock-modal
					class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-800"
				>
					Cancel
				</button>
				<button
					type="button"
					class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
				>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
					</svg>
					Save Stock
				</button>
			</div>
		</form>
	</div>
</div>
