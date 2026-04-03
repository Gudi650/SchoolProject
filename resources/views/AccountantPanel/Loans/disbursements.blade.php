<x-Account-sidebar>
	<x-slot name="title">Loan Disbursements</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">Loan Disbursements</h1>
					<p class="text-xs sm:text-sm text-slate-700 mt-1">Release approved loans and track disbursement records in one place</p>
				</div>
				<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="filter" class="w-4 h-4"></i>
						Filter
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="download" class="w-4 h-4"></i>
						Export
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="send" class="w-4 h-4"></i>
						Run Disbursement
					</button>
				</div>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-indigo-100">
						<i data-lucide="clipboard-check" class="w-4 h-4 text-indigo-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Approved Queue</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $approvedQueue }}</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">Waiting for release</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-cyan-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-cyan-100">
						<i data-lucide="hand-coins" class="w-4 h-4 text-cyan-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Disbursed Today</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $disbursedToday }}</p>
				<p class="text-xs sm:text-sm text-cyan-600 mt-2">₹{{ number_format($disbursedTodayAmount / 100000, 1) }}L released</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-green-100">
						<i data-lucide="shield-check" class="w-4 h-4 text-green-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Successful Transfers</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $successfulTransfers }}</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">Active loans</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-amber-100">
						<i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Pending Confirmation</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $pendingConfirmation }}</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">Awaiting bank callback</p>
			</div>
		</div>

		<div class="mb-4">
			<div class="w-full max-w-4xl">
				<label for="disbursement-search" class="sr-only">Search disbursements</label>
				<div class="relative">
					<i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
					<input id="disbursement-search" type="search" placeholder="Search by proposal ID, employee name, payment reference, or bank account..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
				</div>
			</div>
		</div>

		<div class="space-y-6 mb-6">
			<div>
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
					<span class="w-1 h-6 bg-indigo-600 rounded"></span>
					Ready for Disbursement (Approved)
				</h2>
				<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
					@if ($approvedLoans->count() > 0)
					<table class="w-full text-left text-sm">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Approved Amount</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Approved Date</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
								<th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							@foreach ($approvedLoans as $loan)
								<tr class="hover:bg-indigo-50 transition-colors">
									<td class="px-4 py-3">{{ $loan->loan_reference }}</td>
									<td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</td>
									<td class="px-4 py-3">{{ $loan->loanType->name ?? 'N/A' }}</td>
									<td class="px-4 py-3 font-semibold text-slate-900">₹{{ number_format($loan->amount, 0) }}</td>
									<td class="px-4 py-3">{{ optional($loan->approved_at)->format('Y-m-d') ?? $loan->created_at->format('Y-m-d') }}</td>
									<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Approved</span></td>
									<td class="px-4 py-3 w-72">
										<div class="flex items-center justify-start gap-2 whitespace-nowrap">
											<button class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium">
												<i data-lucide="eye" class="w-4 h-4"></i>
												View
											</button>
											<button class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-cyan-200 text-cyan-700 bg-cyan-50 hover:bg-cyan-100 text-xs font-medium">
												<i data-lucide="hand-coins" class="w-4 h-4"></i>
												Disburse
											</button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@else
						<div class="px-4 py-6 text-center">
							<p class="text-sm text-slate-500">No approved loans ready for disbursement</p>
						</div>
					@endif
				</div>
			</div>

			<div>
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
					<span class="w-1 h-6 bg-cyan-500 rounded"></span>
					Recent Disbursements
				</h2>
				<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
					@if ($recentDisbursements->count() > 0)
					<table class="w-full text-left text-sm">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Method</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Reference</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Disbursed On</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
								<th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							@foreach ($recentDisbursements as $loan)
								<tr class="hover:bg-indigo-50 transition-colors">
									<td class="px-4 py-3">{{ $loan->loan_reference }}</td>
									<td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</td>
									<td class="px-4 py-3 font-semibold text-slate-900">₹{{ number_format($loan->amount, 0) }}</td>
									<td class="px-4 py-3">Bank Transfer</td>
									<td class="px-4 py-3">{{ $loan->loan_reference }}</td>
									<td class="px-4 py-3">{{ optional($loan->disbursed_at)->format('Y-m-d') ?? '-' }}</td>
									<td class="px-4 py-3">
										@if ($loan->status === 'disbursed')
											<span class="px-2 py-1 text-xs font-medium rounded-full bg-cyan-100 text-cyan-700">Disbursed</span>
										@elseif ($loan->status === 'active')
											<span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Active</span>
										@else
											<span class="px-2 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-700">Completed</span>
										@endif
									</td>
									<td class="px-4 py-3 w-72">
										<div class="flex items-center justify-start gap-2 whitespace-nowrap">
											<button class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium">
												<i data-lucide="eye" class="w-4 h-4"></i>
												View
											</button>
											@if ($loan->status === 'disbursed')
												<button class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-indigo-200 text-indigo-700 bg-indigo-50 hover:bg-indigo-100 text-xs font-medium">
													<i data-lucide="activity" class="w-4 h-4"></i>
													Mark Active
												</button>
											@endif
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@else
						<div class="px-4 py-6 text-center">
							<p class="text-sm text-slate-500">No recent disbursement records</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</main>
</x-Account-sidebar>
