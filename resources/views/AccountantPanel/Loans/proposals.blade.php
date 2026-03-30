<x-Account-sidebar>
	<x-slot name="title">Loan Proposals</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">Loan Applications</h1>
					<p class="text-xs sm:text-sm text-slate-700 mt-1">Review loan proposals submitted by staff and take approval decisions</p>
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
						<i data-lucide="check-check" class="w-4 h-4"></i>
						Bulk Review
					</button>
				</div>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-indigo-100">
						<i data-lucide="file-stack" class="w-4 h-4 text-indigo-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Total Applications</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">126</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">Current month</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-amber-100">
						<i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Pending Review</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">18</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">Needs action</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-green-100">
						<i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Approved</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">93</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">₹36.8L approved</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-red-100">
						<i data-lucide="x-circle" class="w-4 h-4 text-red-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Rejected</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">15</p>
				<p class="text-xs sm:text-sm text-red-600 mt-2">Policy mismatch</p>
			</div>
		</div>

		<div class="mb-4">
			<div class="w-full max-w-4xl">
				<label for="proposal-search" class="sr-only">Search applications</label>
				<div class="relative">
					<i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
					<input id="proposal-search" type="search" placeholder="Search by proposal ID, employee name, department, or loan type..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
				</div>
			</div>
		</div>

		<div class="space-y-6 mb-6">
			<div>
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
					<span class="w-1 h-6 bg-amber-500 rounded"></span>
					Pending Applications (Not Accepted)
				</h2>
				<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
					<table class="w-full text-left text-sm relative z-0">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Department</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Action</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							<tr class="hover:bg-indigo-50 transition-colors">
								<td class="px-4 py-3">PROP-2201</td>
								<td class="px-4 py-3">Neema Mushi</td>
								<td class="px-4 py-3">Administration</td>
								<td class="px-4 py-3">Medical</td>
								<td class="px-4 py-3 font-semibold text-slate-900">₹1,20,000</td>
								<td class="px-4 py-3">12 months</td>
								<td class="px-4 py-3">2026-03-29</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
								<td class="px-4 py-3">
									<div class="flex items-center justify-center gap-3 whitespace-nowrap">
										<button class="inline-flex items-center justify-center w-5 h-5 text-blue-600 hover:text-blue-700" title="View" aria-label="View">
											<i data-lucide="eye" class="w-4 h-4"></i>
										</button>
										<button class="inline-flex items-center justify-center w-5 h-5 text-amber-500 hover:text-amber-600" title="Accept" aria-label="Accept">
											<i data-lucide="check" class="w-4 h-4"></i>
										</button>
										<button class="inline-flex items-center justify-center w-5 h-5 text-red-500 hover:text-red-600" title="Decline" aria-label="Decline">
											<i data-lucide="x" class="w-4 h-4"></i>
										</button>
									</div>
								</td>
							</tr>
							<tr class="hover:bg-indigo-50 transition-colors">
								<td class="px-4 py-3">PROP-2194</td>
								<td class="px-4 py-3">Kassim John</td>
								<td class="px-4 py-3">ICT</td>
								<td class="px-4 py-3">Emergency</td>
								<td class="px-4 py-3 font-semibold text-slate-900">₹1,50,000</td>
								<td class="px-4 py-3">15 months</td>
								<td class="px-4 py-3">2026-03-26</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Under Review</span></td>
								<td class="px-4 py-3">
									<div class="flex items-center justify-center gap-3 whitespace-nowrap">
										<button class="inline-flex items-center justify-center w-5 h-5 text-blue-600 hover:text-blue-700" title="View" aria-label="View">
											<i data-lucide="eye" class="w-4 h-4"></i>
										</button>
										<button class="inline-flex items-center justify-center w-5 h-5 text-amber-500 hover:text-amber-600" title="Accept" aria-label="Accept">
											<i data-lucide="check" class="w-4 h-4"></i>
										</button>
										<button class="inline-flex items-center justify-center w-5 h-5 text-red-500 hover:text-red-600" title="Decline" aria-label="Decline">
											<i data-lucide="x" class="w-4 h-4"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div>
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
					<span class="w-1 h-6 bg-green-500 rounded"></span>
					Accepted Applications
				</h2>
				<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
					<table class="w-full text-left text-sm relative z-0">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Department</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Action</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							<tr class="hover:bg-indigo-50 transition-colors">
								<td class="px-4 py-3">PROP-2198</td>
								<td class="px-4 py-3">Asha Temu</td>
								<td class="px-4 py-3">Science</td>
								<td class="px-4 py-3">Education</td>
								<td class="px-4 py-3 font-semibold text-slate-900">₹2,40,000</td>
								<td class="px-4 py-3">24 months</td>
								<td class="px-4 py-3">2026-03-28</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Approved</span></td>
								<td class="px-4 py-3">
									<div class="flex items-center justify-center gap-3 whitespace-nowrap">
										<button class="inline-flex items-center justify-center w-5 h-5 text-blue-600 hover:text-blue-700" title="View" aria-label="View">
											<i data-lucide="eye" class="w-4 h-4"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div>
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
					<span class="w-1 h-6 bg-red-500 rounded"></span>
					Declined Applications
				</h2>
				<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
					<table class="w-full text-left text-sm relative z-0">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Department</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Action</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							<tr class="hover:bg-indigo-50 transition-colors">
								<td class="px-4 py-3">PROP-2196</td>
								<td class="px-4 py-3">Juma Nyerere</td>
								<td class="px-4 py-3">Transport</td>
								<td class="px-4 py-3">Personal</td>
								<td class="px-4 py-3 font-semibold text-slate-900">₹80,000</td>
								<td class="px-4 py-3">10 months</td>
								<td class="px-4 py-3">2026-03-27</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Rejected</span></td>
								<td class="px-4 py-3">
									<div class="flex items-center justify-center gap-3 whitespace-nowrap">
										<button class="inline-flex items-center justify-center w-5 h-5 text-blue-600 hover:text-blue-700" title="View" aria-label="View">
											<i data-lucide="eye" class="w-4 h-4"></i>
										</button>
										<button class="inline-flex items-center justify-center w-5 h-5 text-red-500 hover:text-red-600" title="Delete" aria-label="Delete">
											<i data-lucide="trash-2" class="w-4 h-4"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</main>
</x-Account-sidebar>
