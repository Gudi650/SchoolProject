<div>
    {{-- The Master doesn't talk, he acts. --}}
</div>
<!-- Payment Terms Configuration Section -->
	<div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm mb-6">
		<form method="POST" action="#">
			@csrf

			<div class="bg-white rounded-xl border border-slate-200 pb-6 px-6">
				<div class="mb-4">
					<div class="-mx-6 px-6 py-3 bg-blue-50 rounded-t-lg flex items-center justify-between">
						<div>
							<h2 class="text-lg font-semibold text-slate-900">Payment Terms Configuration</h2>
							<p class="text-sm text-slate-600">Set how many times students can pay fees throughout the Year</p>
						</div>
					</div>
				</div>
				
				<div class="space-y-4">
					<!-- Number of Payment Terms -->
					<div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
						<label class="block text-sm font-semibold text-slate-700 mb-2">Number of Payment Installments</label>
						<div class="flex items-center gap-4">
							<input type="number" name="payment_terms_count" value="4" min="1" max="12" class="w-24 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800 font-medium">
							<span class="text-sm text-slate-600">times during the academic year</span>
						</div>
					</div>

					<!-- Payment Schedule -->
					<div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
						<label class="block text-sm font-semibold text-slate-700 mb-3">Payment Schedule</label>
						<div class="space-y-3" id="paymentScheduleContainer">
							<div class="flex items-center gap-3">
								<span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full font-semibold text-sm flex-shrink-0">1</span>
								<input type="text" name="payment_schedule[]" value="1st Semester Start" placeholder="e.g., 1st Semester Start" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
							</div>
							<div class="flex items-center gap-3">
								<span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full font-semibold text-sm flex-shrink-0">2</span>
								<input type="text" name="payment_schedule[]" value="Mid Semester (1st)" placeholder="e.g., Mid Semester" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
							</div>
							<div class="flex items-center gap-3">
								<span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full font-semibold text-sm flex-shrink-0">3</span>
								<input type="text" name="payment_schedule[]" value="2nd Semester Start" placeholder="e.g., 2nd Semester Start" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
							</div>
							<div class="flex items-center gap-3">
								<span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full font-semibold text-sm flex-shrink-0">4</span>
								<input type="text" name="payment_schedule[]" value="End of Term" placeholder="e.g., End of Term" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
							</div>
						</div>
						<p class="text-xs text-slate-500 mt-3">Update the number of installments above to adjust payment schedule fields</p>
					</div>

					<!-- Info Box -->
					<div class="bg-blue-50 border border-blue-200 rounded-lg p-3 flex items-start gap-2">
						<i data-lucide="info" class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5"></i>
						<p class="text-xs text-blue-700">Students will be notified to pay on these scheduled dates. You can customize each payment period label.</p>
					</div>
				</div>
			</div>

			<div class="mt-6 flex justify-end">
				<button type="submit" class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium flex items-center gap-2">
					<i data-lucide="save" class="w-4 h-4"></i>
					<span>Save Payment Terms</span>
				</button>
			</div>
		</form>
	</div>