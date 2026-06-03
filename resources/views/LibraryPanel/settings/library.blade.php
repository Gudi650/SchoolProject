<x-Libray-sidebar>
	<x-slot name="title">Library Settings</x-slot>

	<div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Library</p>
			<h1 class="mt-1 text-2xl font-bold text-slate-900">Settings</h1>
			<p class="mt-1 text-sm text-slate-500">Manage circulation rules, notifications, and library branding.</p>
		</div>
		<div class="flex items-center gap-2">
			<button class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
				</svg>
				Reset
			</button>
			<button class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
				</svg>
				Save Settings
			</button>
		</div>
	</div>

	<div class="grid gap-6 xl:grid-cols-[18rem_minmax(0,1fr)]">
		<aside class="space-y-4">
			<nav class="rounded-2xl border border-slate-200 bg-white p-2 shadow-sm">
				<a href="#profile" class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700">
					<i data-lucide="user-circle-2" class="h-4 w-4"></i>
					Profile
				</a>
				<a href="#circulation" class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
					<i data-lucide="book-open-check" class="h-4 w-4"></i>
					Circulation
				</a>
				<a href="#notifications" class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
					<i data-lucide="bell" class="h-4 w-4"></i>
					Notifications
				</a>
				<a href="#branding" class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
					<i data-lucide="palette" class="h-4 w-4"></i>
					Branding
				</a>
				<a href="#integrations" class="mt-1 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
					<i data-lucide="plug-2" class="h-4 w-4"></i>
					Integrations
				</a>
			</nav>

			<div class="rounded-2xl border border-indigo-100 bg-indigo-50 p-5 shadow-sm">
				<p class="text-sm font-semibold text-slate-900">Library snapshot</p>
				<div class="mt-4 space-y-3 text-sm text-slate-600">
					<div class="flex items-center justify-between">
						<span>Active loans</span>
						<span class="font-semibold text-slate-900">342</span>
					</div>
					<div class="flex items-center justify-between">
						<span>Overdue items</span>
						<span class="font-semibold text-red-600">28</span>
					</div>
					<div class="flex items-center justify-between">
						<span>Returned today</span>
						<span class="font-semibold text-emerald-600">47</span>
					</div>
				</div>
			</div>
		</aside>

		<div class="space-y-6">
			<section id="profile" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div class="flex items-start justify-between gap-4">
					<div>
						<h2 class="text-lg font-semibold text-slate-900">Profile Settings</h2>
						<p class="mt-1 text-sm text-slate-500">Update the visible library identity and contact details.</p>
					</div>
					<span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">Live</span>
				</div>

				<div class="mt-6 grid gap-5 md:grid-cols-2">
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="library-name">Library name</label>
						<input id="library-name" type="text" value="Scholaria Library" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="library-phone">Contact phone</label>
						<input id="library-phone" type="text" value="+1 (555) 014-2200" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="library-email">Support email</label>
						<input id="library-email" type="email" value="library@school.edu" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="library-hours">Open hours</label>
						<select id="library-hours" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
							<option>7:00 AM - 4:00 PM</option>
							<option>8:00 AM - 5:00 PM</option>
							<option>8:00 AM - 3:00 PM</option>
						</select>
					</div>
				</div>
			</section>

			<section id="circulation" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Circulation Rules</h2>
					<p class="mt-1 text-sm text-slate-500">Control loan periods, renewals, and late fees.</p>
				</div>

				<div class="mt-6 grid gap-5 md:grid-cols-3">
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="loan-days">Loan period</label>
						<select id="loan-days" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
							<option>7 days</option>
							<option selected>14 days</option>
							<option>21 days</option>
							<option>30 days</option>
						</select>
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="renewals">Renewals allowed</label>
						<input id="renewals" type="number" min="0" value="2" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="late-fee">Late fee per day</label>
						<input id="late-fee" type="number" min="0" step="0.25" value="1.00" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
				</div>
			</section>

			<section id="notifications" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Notifications</h2>
					<p class="mt-1 text-sm text-slate-500">Choose which alerts the library staff should receive.</p>
				</div>

				<div class="mt-6 space-y-4">
					<label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
						<input type="checkbox" checked class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
						<span>
							<span class="block text-sm font-medium text-slate-900">Overdue reminders</span>
							<span class="block text-sm text-slate-500">Notify borrowers when a book becomes overdue.</span>
						</span>
					</label>

					<label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
						<input type="checkbox" checked class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
						<span>
							<span class="block text-sm font-medium text-slate-900">Low stock alerts</span>
							<span class="block text-sm text-slate-500">Surface books that need restocking before they run out.</span>
						</span>
					</label>

					<label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
						<input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
						<span>
							<span class="block text-sm font-medium text-slate-900">Damage reports</span>
							<span class="block text-sm text-slate-500">Send alerts when books are marked as damaged.</span>
						</span>
					</label>
				</div>
			</section>

			<section id="branding" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Branding</h2>
					<p class="mt-1 text-sm text-slate-500">Control the library name, header, and accent color.</p>
				</div>

				<div class="mt-6 grid gap-5 md:grid-cols-2">
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="accent-color">Accent color</label>
						<select id="accent-color" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
							<option>Indigo</option>
							<option>Emerald</option>
							<option>Slate</option>
							<option>Amber</option>
						</select>
					</div>
					<div>
						<label class="mb-2 block text-sm font-medium text-slate-700" for="header-text">Header text</label>
						<input id="header-text" type="text" value="Loans, catalog, inventory, and more" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100" />
					</div>
				</div>
			</section>

			<section id="integrations" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
				<div>
					<h2 class="text-lg font-semibold text-slate-900">Integrations</h2>
					<p class="mt-1 text-sm text-slate-500">Connect the tools that support your library workflow.</p>
				</div>

				<div class="mt-6 grid gap-4 md:grid-cols-2">
					<div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
						<p class="text-sm font-medium text-slate-900">Email gateway</p>
						<p class="mt-1 text-sm text-slate-500">Send receipts and overdue notices through your school email provider.</p>
					</div>
					<div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
						<p class="text-sm font-medium text-slate-900">Barcode scanner</p>
						<p class="mt-1 text-sm text-slate-500">Use hardware scanners for faster checkout and returns.</p>
					</div>
				</div>
			</section>
		</div>
	</div>
</x-Libray-sidebar>
