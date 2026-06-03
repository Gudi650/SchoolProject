<div
	data-checkout-modal
	class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
	role="dialog"
	aria-modal="true"
	aria-labelledby="checkout-title"
>
	<div
		data-checkout-dialog
		class="w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
	>
		<div class="flex items-start justify-between border-b border-slate-200 px-6 py-5">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Loans</p>
				<h2 id="checkout-title" class="mt-1 text-2xl font-bold text-slate-900">Check Out Book</h2>
				<p class="mt-1 text-sm text-slate-500">Create a new loan entry and set the expected return date.</p>
			</div>

			<button
				type="button"
				data-close-checkout-modal
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
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-book">Book title</label>
							<select id="checkout-book" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select a book title</option>
								<option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
								<option value="1984">1984</option>
								<option value="The Great Gatsby">The Great Gatsby</option>
								<option value="The Hobbit">The Hobbit</option>
								<option value="Sapiens">Sapiens</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-isbn">ISBN</label>
							<select id="checkout-isbn" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select an ISBN</option>
								<option value="978-0061120084">978-0061120084</option>
								<option value="978-0451524935">978-0451524935</option>
								<option value="978-0743273565">978-0743273565</option>
								<option value="978-0261102217">978-0261102217</option>
								<option value="978-0062316097">978-0062316097</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-borrower">Borrower</label>
							<select id="checkout-borrower" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select borrower</option>
								<option>Alex Johnson</option>
								<option>Michael Chen</option>
								<option>David Miller</option>
								<option>Sara Lee</option>
								<option>Noah Brown</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-grade">Grade level</label>
							<select id="checkout-grade" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
								<option value="">Select grade</option>
								<option>Grade 7</option>
								<option>Grade 8</option>
								<option>Grade 9</option>
								<option>Grade 10</option>
								<option>Grade 11</option>
								<option>Grade 12</option>
							</select>
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-date">Checkout date</label>
							<input id="checkout-date" type="date" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
						</div>

						<div>
							<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-due">Due date</label>
							<input id="checkout-due" type="date" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
						</div>
					</div>

					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="checkout-notes">Notes</label>
						<textarea id="checkout-notes" rows="5" placeholder="Add any special checkout notes or loan conditions..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"></textarea>
					</div>
				</div>

				<div class="space-y-6 rounded-2xl bg-slate-50 p-5">
					<div>
						<h3 class="text-sm font-semibold text-slate-900">Quick Summary</h3>
						<p class="mt-1 text-sm text-slate-500">Confirm the loan details before saving the checkout.</p>
						<div class="mt-4 space-y-3 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-600">
							<div class="flex items-center justify-between">
								<span>Active loans</span>
								<span class="font-semibold text-slate-900">342</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Due today</span>
								<span class="font-semibold text-amber-600">18</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Overdue</span>
								<span class="font-semibold text-red-600">28</span>
							</div>
						</div>
					</div>

					<div class="rounded-2xl border border-indigo-100 bg-indigo-50 p-4 text-sm text-slate-600">
						<p class="font-semibold text-slate-900">Tip</p>
						<p class="mt-1">Set the due date before saving so the loan can move into the correct tab later.</p>
					</div>
				</div>
			</div>

			<div class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-end">
				<button
					type="button"
					data-close-checkout-modal
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
					Save Checkout
				</button>
			</div>
		</form>
	</div>
</div>
