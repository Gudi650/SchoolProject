<div
	data-return-modal
	class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
	role="dialog"
	aria-modal="true"
	aria-labelledby="returnbook-title"
>
	<div
		data-return-dialog
		class="w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
	>
		<div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Loans</p>
				<h2 id="returnbook-title" class="mt-1 text-2xl font-bold text-slate-900">Return Book</h2>
				<p class="mt-1 text-sm text-slate-500">Record a return, capture condition notes, and close the loan.</p>
			</div>

			<button
				type="button"
				data-close-return-modal
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
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-book">Book title</label>
							<select id="return-book" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
								<option value="">Select a book title</option>
								<option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
								<option value="1984">1984</option>
								<option value="The Great Gatsby">The Great Gatsby</option>
								<option value="The Hobbit">The Hobbit</option>
								<option value="Sapiens">Sapiens</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-isbn">ISBN</label>
							<select id="return-isbn" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
								<option value="">Select an ISBN</option>
								<option value="978-0061120084">978-0061120084</option>
								<option value="978-0451524935">978-0451524935</option>
								<option value="978-0743273565">978-0743273565</option>
								<option value="978-0261102217">978-0261102217</option>
								<option value="978-0062316097">978-0062316097</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-borrower">Borrower</label>
							<select id="return-borrower" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
								<option value="">Select borrower</option>
								<option>Alex Johnson</option>
								<option>Michael Chen</option>
								<option>David Miller</option>
								<option>Sara Lee</option>
								<option>Noah Brown</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-date">Return date</label>
							<input id="return-date" type="date" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-condition">Condition</label>
							<select id="return-condition" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
								<option>Good</option>
								<option>Minor wear</option>
								<option>Damaged</option>
								<option>Needs repair</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="return-fee">Late fee</label>
							<input id="return-fee" type="number" min="0" step="0.01" value="0.00" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100" />
						</div>
					</div>

					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="return-notes">Notes</label>
						<textarea id="return-notes" rows="5" placeholder="Add any condition notes, fees, or follow-up details..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"></textarea>
					</div>
				</div>

				<div class="space-y-6 rounded-2xl bg-slate-50 p-5">
					<div>
						<h3 class="text-sm font-semibold text-slate-900">Quick Summary</h3>
						<p class="mt-1 text-sm text-slate-500">Review the return before closing the loan.</p>
						<div class="mt-4 space-y-3 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-600">
							<div class="flex items-center justify-between">
								<span>Active loans</span>
								<span class="font-semibold text-slate-900">342</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Overdue loans</span>
								<span class="font-semibold text-red-600">28</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Returned today</span>
								<span class="font-semibold text-emerald-600">47</span>
							</div>
						</div>
					</div>

					<div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-sm text-slate-600">
						<p class="font-semibold text-slate-900">Tip</p>
						<p class="mt-1">If the book comes back damaged, note it here so inventory can be updated later.</p>
					</div>
				</div>
			</div>

			<div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-end">
				<button
					type="button"
					data-close-return-modal
					class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-800"
				>
					Cancel
				</button>
				<button
					type="button"
					class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
				>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
					</svg>
					Save Return
				</button>
			</div>
		</form>
	</div>
</div>
