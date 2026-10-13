@php
  $invoice = $invoice ?? null;
  $students = $students ?? collect();
  $categories = $categories ?? collect();
  $preset = $preset ?? null;
  $billTo = old('bill_to', $invoice->bill_to ?? 'other');
  $pt = old('payment_terms', $invoice->payment_terms ?? '');
  $lines = old('items');
  if (! $lines) {
    $lines = $invoice?->items?->map(fn ($i) => [
      'name' => $i->name, 'category' => $i->category, 'description' => $i->description,
      'quantity' => $i->quantity, 'rate' => $i->rate, 'tax' => $i->tax_percent, 'discount' => $i->discount,
    ])->all();
  }
  if (! $lines) {
    $lines = [['name' => $preset, 'category' => '', 'description' => '', 'quantity' => 1, 'rate' => '', 'tax' => '', 'discount' => '']];
  }
@endphp
<x-Account-sidebar>
	<x-slot name="title">{{ $invoice ? 'Edit Invoice' : 'Invoice Management' }}</x-slot>

	<div class="px-4 py-6 sm:px-6 lg:px-8">
		<div class="mx-auto w-full max-w-6xl">
			<div class="rounded-lg border border-indigo-100 bg-indigo-50/60 px-4 py-4 sm:px-5">
				<div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
					<div>
						<h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">{{ $invoice ? 'Edit Invoice' : 'Create Invoice' }}</h1>
						<p class="mt-1 text-sm text-gray-700">Bill a student or any other party — fees, rentals, donations, services.</p>
					</div>
					<div class="flex items-center gap-2">
						<span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-1 text-xs font-semibold text-indigo-700">Accounting</span>
					</div>
				</div>
			</div>

			<div class="mt-6 rounded-lg border border-gray-200 bg-white shadow-sm">
				<div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
					<h2 class="text-base font-semibold text-gray-900">Invoice Details</h2>
					<p class="mt-1 text-sm text-gray-700">Complete the form below to create an invoice.</p>
				</div>

				<form class="px-6 py-6" method="POST" action="{{ $invoice ? route('accounting.updateInvoice', $invoice->id) : route('accounting.storeInvoice') }}">
					@csrf
					@if($invoice) @method('PUT') @endif
					@if($errors->any())<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800 text-sm">{{ $errors->first() }}</div>@endif

					<div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px,1fr]">
						<aside class="rounded-lg border border-indigo-100 bg-indigo-50 p-4">
							<div class="flex flex-col items-center text-center">
								<div class="flex h-20 w-20 items-center justify-center rounded-full border-4 border-white bg-indigo-100 text-indigo-700 shadow-sm">
									<svg class="h-10 w-10" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
										<path d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6H6zm8 1.5L19.5 9H14V3.5z" />
									</svg>
								</div>
								<p class="mt-3 text-sm font-semibold text-gray-800">Invoice Progress</p>
								<p class="text-xs text-gray-600">Review details before saving.</p>
							</div>
							<div class="mt-6 rounded-md border border-indigo-100 bg-white p-4">
								<p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">Completion</p>
								<div class="mt-2 h-2 w-full rounded-full bg-indigo-100">
									<div class="h-2 w-2/3 rounded-full bg-indigo-500"></div>
								</div>
								<p class="mt-2 text-xs text-gray-700">Add items and totals to finish.</p>
							</div>
						</aside>

						<div class="space-y-6">
							<!-- Customer and invoice metadata -->
							<div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 bg-white p-4 sm:grid-cols-2">
								<div class="sm:col-span-2 flex gap-4">
									<label class="text-sm"><input type="radio" name="bill_to" value="student" {{ $billTo === 'student' ? 'checked' : '' }} onchange="toggleBillTo()"> Student</label>
									<label class="text-sm"><input type="radio" name="bill_to" value="other" {{ $billTo !== 'student' ? 'checked' : '' }} onchange="toggleBillTo()"> Other income / party</label>
								</div>
								<div class="sm:col-span-2" id="studentWrap" style="{{ $billTo === 'student' ? '' : 'display:none' }}">
									<label class="text-sm font-medium text-gray-700" for="student_id">Student</label>
									<select id="student_id" name="student_id" class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
										<option value="">Select student</option>
										@foreach($students as $s)
											<option value="{{ $s->id }}" {{ (string) old('student_id', $invoice->student_id ?? '') === (string) $s->id ? 'selected' : '' }}>{{ trim($s->fname.' '.$s->lname) }}</option>
										@endforeach
									</select>
								</div>
								<div class="sm:col-span-2" id="otherWrap" style="{{ $billTo === 'student' ? 'display:none' : '' }}">
									<label class="text-sm font-medium text-gray-700" for="customer_name">Party name</label>
									<input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name', $invoice->customer_name ?? '') }}" placeholder="Parent, company, donor, tenant..." class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="customer_email">Email</label>
									<input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email', $invoice->customer_email ?? '') }}" class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="customer_phone">Phone</label>
									<input id="customer_phone" name="customer_phone" type="tel" value="{{ old('customer_phone', $invoice->customer_phone ?? '') }}" class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
								</div>
								@if($invoice)
								<div>
									<label class="text-sm font-medium text-gray-700">Invoice Number</label>
									<input type="text" value="{{ $invoice->invoice_number }}" disabled class="mt-2 w-full rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-sm">
								</div>
								@endif
								<div>
									<label class="text-sm font-medium text-gray-700" for="issue_date">Issue Date</label>
									<input id="issue_date" name="issue_date" type="date" value="{{ old('issue_date', optional($invoice?->issue_date)->format('Y-m-d') ?? now()->toDateString()) }}" class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm" required>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="due_date">Due Date</label>
									<input id="due_date" name="due_date" type="date" value="{{ old('due_date', optional($invoice?->due_date)->format('Y-m-d')) }}" class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm" required>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="payment_terms">Payment Terms</label>
									<select
										id="payment_terms"
										name="payment_terms"
										class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
									>
										<option value="">Select terms</option>
										<option value="due-on-receipt" @selected($pt === 'due-on-receipt')>Due on receipt</option>
										<option value="net-7" @selected($pt === 'net-7')>Net 7</option>
										<option value="net-14" @selected($pt === 'net-14')>Net 14</option>
										<option value="net-30" @selected($pt === 'net-30')>Net 30</option>
									</select>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="currency">Currency</label>
									<select
										id="currency"
										name="currency"
										class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
									>
										<option value="TSH" selected>Tsh (TZS)</option>
										<option value="USD">USD</option>
										<option value="KES">KES</option>
										<option value="EUR">EUR</option>
									</select>
								</div>
							</div>

							<!-- Billing address and summary -->
							<div class="grid grid-cols-1 gap-6 rounded-lg border border-gray-200 bg-white p-4 lg:grid-cols-2">
								<div class="space-y-4">
									<div>
										<label class="text-sm font-medium text-gray-700" for="billing_address">Billing Address</label>
										<input
											id="billing_address"
											name="billing_address"
											type="text"
											value="{{ old('billing_address', $invoice->billing_address ?? '') }}"
											placeholder="Street address"
											class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
										/>
										<input
											id="billing_address_2"
											name="billing_address_2"
											type="text"
											placeholder="Apartment, suite, etc."
											class="mt-3 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
										/>
									</div>
									<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
										<div>
											<label class="text-sm font-medium text-gray-700" for="billing_city">City</label>
											<input
												id="billing_city"
												name="billing_city"
												type="text"
												placeholder="City"
												class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
											/>
										</div>
										<div>
											<label class="text-sm font-medium text-gray-700" for="billing_state">State</label>
											<input
												id="billing_state"
												name="billing_state"
												type="text"
												placeholder="State"
												class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
											/>
										</div>
										<div>
											<label class="text-sm font-medium text-gray-700" for="billing_zip">ZIP</label>
											<input
												id="billing_zip"
												name="billing_zip"
												type="text"
												placeholder="ZIP"
												class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
											/>
										</div>
									</div>
								</div>
								<div class="space-y-4">
									<div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
										<h3 class="text-sm font-semibold text-gray-800">Invoice Summary</h3>
										<dl class="mt-3 space-y-2 text-sm text-gray-700">
											<div class="flex items-center justify-between">
												<dt>Subtotal</dt>
												<dd class="font-medium text-gray-900" data-summary-subtotal>0.00</dd>
											</div>
											<div class="flex items-center justify-between">
												<dt>Tax</dt>
												<dd class="font-medium text-gray-900" data-summary-tax>0.00</dd>
											</div>
											<div class="flex items-center justify-between">
												<dt>Discount</dt>
												<dd class="font-medium text-gray-900" data-summary-discount>0.00</dd>
											</div>
											<div class="border-t border-gray-200 pt-2 flex items-center justify-between">
												<dt class="font-semibold text-gray-900">Total</dt>
												<dd class="text-base font-semibold text-indigo-700" data-summary-total>0.00</dd>
											</div>
										</dl>
									</div>
									<div>
										<label class="text-sm font-medium text-gray-700" for="reference">Reference</label>
										<input
											id="reference"
											name="reference"
											type="text"
											value="{{ old('reference', $invoice->reference ?? '') }}"
											placeholder="PO or reference number"
											class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
										/>
									</div>
								</div>
							</div>

							<!-- Line items -->
							<div class="rounded-lg border border-gray-200 bg-white">
								<div class="flex flex-col gap-3 border-b border-gray-200 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
									<div>
										<h3 class="text-sm font-semibold text-gray-800">Line Items</h3>
										<p class="text-xs text-gray-600">Add the products or services provided.</p>
									</div>
									<button
										type="button"
										class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-indigo-700 shadow-sm transition hover:bg-gray-50"
										data-add-line
									>
										Add Item
									</button>
								</div>
								<div class="overflow-x-auto">
									<table class="min-w-full divide-y divide-gray-200 text-sm">
										<thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
											<tr>
												<th scope="col" class="px-4 py-3">Item</th>
												<th scope="col" class="px-4 py-3">Category</th>
												<th scope="col" class="px-4 py-3">Description</th>
												<th scope="col" class="px-4 py-3">Qty</th>
												<th scope="col" class="px-4 py-3">Rate</th>
												<th scope="col" class="px-4 py-3">Tax %</th>
												<th scope="col" class="px-4 py-3">Discount</th>
												<th scope="col" class="px-4 py-3">Amount</th>
												<th scope="col" class="px-4 py-3"></th>
											</tr>
										</thead>
										<tbody class="divide-y divide-gray-200" data-line-items>
											@foreach($lines as $i => $line)
											<tr data-line-item>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][name]" type="text" value="{{ $line['name'] ?? '' }}" placeholder="Item name" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
												</td>
												<td class="px-4 py-3">
													<select name="items[{{ $i }}][category]" class="w-36 rounded-md border border-gray-300 px-2 py-2 text-sm">
														<option value="">Any</option>
														@foreach($categories as $cat)
															<option value="{{ $cat }}" @selected(($line['category'] ?? '') === $cat)>{{ $cat }}</option>
														@endforeach
													</select>
												</td>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][description]" type="text" value="{{ $line['description'] ?? '' }}" placeholder="Short description" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
												</td>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][quantity]" type="number" min="0" step="0.01" value="{{ $line['quantity'] ?? 1 }}" class="w-20 rounded-md border border-gray-300 px-2 py-2 text-sm" data-qty>
												</td>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][rate]" type="number" min="0" step="0.01" value="{{ $line['rate'] ?? '' }}" placeholder="0.00" class="w-24 rounded-md border border-gray-300 px-2 py-2 text-sm" data-rate>
												</td>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][tax]" type="number" min="0" step="0.01" value="{{ $line['tax'] ?? '' }}" placeholder="0" class="w-20 rounded-md border border-gray-300 px-2 py-2 text-sm" data-tax>
												</td>
												<td class="px-4 py-3">
													<input name="items[{{ $i }}][discount]" type="number" min="0" step="0.01" value="{{ $line['discount'] ?? '' }}" placeholder="0.00" class="w-24 rounded-md border border-gray-300 px-2 py-2 text-sm" data-discount>
												</td>
												<td class="px-4 py-3 font-medium text-gray-900" data-line-total>0.00</td>
												<td class="px-4 py-3 text-right">
													<button type="button" class="inline-flex items-center rounded-md border border-red-200 bg-red-50 px-2 py-1 text-xs font-semibold text-red-700 hover:bg-red-100" data-remove-line>Remove</button>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="border-t border-gray-200 px-4 py-3 text-xs text-gray-500">
									Tip: Use discount as a flat amount per line item.
								</div>
							</div>

							<!-- Notes and terms -->
							<div class="grid grid-cols-1 gap-6 rounded-lg border border-gray-200 bg-white p-4 lg:grid-cols-2">
								<div>
									<label class="text-sm font-medium text-gray-700" for="notes">Notes for customer</label>
									<textarea
										id="notes"
										name="notes"
										rows="4"
										placeholder="Add a short note or thank you message..."
										class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
									>{{ old('notes', $invoice->notes ?? '') }}</textarea>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-700" for="terms">Terms and conditions</label>
									<textarea
										id="terms"
										name="terms"
										rows="4"
										placeholder="Payment terms, late fees, delivery info..."
										class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
									>{{ old('terms', $invoice->terms ?? '') }}</textarea>
								</div>
							</div>
						</div>
					</div>

					<div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
						<a href="{{ route('accounting.invoiceManagement') }}" class="inline-flex items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-700 shadow-sm hover:bg-red-100">Cancel</a>
						<button
							type="submit"
							class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-200"
						>
							<svg class="mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-2.414-2.414A2 2 0 0013.586 3H4zm0 2h8v3a1 1 0 001 1h3v7H4V5zm2 7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" />
							</svg>
							Save Invoice
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function toggleBillTo() {
			const student = document.querySelector('input[name="bill_to"]:checked')?.value === 'student';
			document.getElementById('studentWrap').style.display = student ? '' : 'none';
			document.getElementById('otherWrap').style.display = student ? 'none' : '';
		}
		document.addEventListener('DOMContentLoaded', () => {
			const lineItems = document.querySelector('[data-line-items]');
			const addButton = document.querySelector('[data-add-line]');
			const subtotalEl = document.querySelector('[data-summary-subtotal]');
			const taxEl = document.querySelector('[data-summary-tax]');
			const discountEl = document.querySelector('[data-summary-discount]');
			const totalEl = document.querySelector('[data-summary-total]');

			const parseValue = (value) => {
				const parsed = parseFloat(value);
				return Number.isFinite(parsed) ? parsed : 0;
			};

			const formatValue = (value) => value.toFixed(2);

			const recalcTotals = () => {
				let subtotal = 0;
				let totalTax = 0;
				let totalDiscount = 0;

				lineItems.querySelectorAll('[data-line-item]').forEach((row) => {
					const qty = parseValue(row.querySelector('[data-qty]').value);
					const rate = parseValue(row.querySelector('[data-rate]').value);
					const tax = parseValue(row.querySelector('[data-tax]').value);
					const discount = parseValue(row.querySelector('[data-discount]').value);

					const lineBase = qty * rate;
					const lineTax = (lineBase * tax) / 100;
					const lineTotal = lineBase + lineTax - discount;

					subtotal += lineBase;
					totalTax += lineTax;
					totalDiscount += discount;

					row.querySelector('[data-line-total]').textContent = formatValue(Math.max(lineTotal, 0));
				});

				subtotalEl.textContent = formatValue(subtotal);
				taxEl.textContent = formatValue(totalTax);
				discountEl.textContent = formatValue(totalDiscount);
				totalEl.textContent = formatValue(Math.max(subtotal + totalTax - totalDiscount, 0));
			};

			const updateIndexes = () => {
				lineItems.querySelectorAll('[data-line-item]').forEach((row, index) => {
					row.querySelectorAll('input, select').forEach((input) => {
						if (input.name) {
							input.name = input.name.replace(/items\[\d+\]/, `items[${index}]`);
						}
					});
				});
			};

			const bindRowEvents = (row) => {
				row.querySelectorAll('input').forEach((input) => {
					input.addEventListener('input', recalcTotals);
				});

				const removeButton = row.querySelector('[data-remove-line]');
				removeButton.addEventListener('click', () => {
					if (lineItems.querySelectorAll('[data-line-item]').length > 1) {
						row.remove();
						updateIndexes();
						recalcTotals();
					}
				});
			};

			addButton.addEventListener('click', () => {
				const template = lineItems.querySelector('[data-line-item]');
				const clone = template.cloneNode(true);

				clone.querySelectorAll('input, select').forEach((input) => {
					if (input.tagName === 'SELECT') {
						input.selectedIndex = 0;
					} else if (input.type === 'number') {
						input.value = input.dataset.qty !== null && input.hasAttribute('data-qty') ? 1 : '';
					} else {
						input.value = '';
					}
				});

				clone.querySelector('[data-line-total]').textContent = '0.00';
				lineItems.appendChild(clone);
				updateIndexes();
				bindRowEvents(clone);
				recalcTotals();
			});

			lineItems.querySelectorAll('[data-line-item]').forEach(bindRowEvents);
			recalcTotals();
		});
	</script>
</x-Account-sidebar>
