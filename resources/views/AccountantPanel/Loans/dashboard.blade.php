<x-Account-sidebar>
	<x-slot name="title">Staff Loans Dashboard</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">Staff Loans Dashboard</h1>
					<p class="text-xs sm:text-sm text-slate-700 mt-1">Manage employee loan disbursements, repayments, and risk status</p>
				</div>
				<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="send" class="w-4 h-4"></i>
						Send Reminders
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="download" class="w-4 h-4"></i>
						Export
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="plus" class="w-4 h-4"></i>
						New Loan
					</button>
				</div>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-indigo-100">
						<i data-lucide="wallet" class="w-4 h-4 text-indigo-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Total Loan Portfolio</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹28.4L</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">64 active loans</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-green-100">
						<i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Repayment Collected</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹4.9L</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">This month</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-amber-100">
						<i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Due This Week</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹1.2L</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">18 installments</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-red-100">
						<i data-lucide="alert-triangle" class="w-4 h-4 text-red-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Overdue Amount</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹2.1L</p>
				<p class="text-xs sm:text-sm text-red-600 mt-2">11 accounts overdue</p>
			</div>
		</div>

		<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
			<div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
						<span class="w-1 h-6 bg-indigo-600 rounded"></span>
						Application Pipeline
					</h2>
					<span class="text-xs text-slate-500">Live status overview</span>
				</div>

				<div class="space-y-4">
					<div>
						<div class="flex items-center justify-between mb-2">
							<span class="text-sm font-medium text-slate-700">Submitted</span>
							<span class="text-sm font-semibold text-slate-900">126 (100%)</span>
						</div>
						<div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-600 rounded-full" style="width:100%"></div></div>
					</div>

					<div>
						<div class="flex items-center justify-between mb-2">
							<span class="text-sm font-medium text-slate-700">Under Review</span>
							<span class="text-sm font-semibold text-slate-900">18 (14%)</span>
						</div>
						<div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-500 rounded-full" style="width:14%"></div></div>
					</div>

					<div>
						<div class="flex items-center justify-between mb-2">
							<span class="text-sm font-medium text-slate-700">Approved</span>
							<span class="text-sm font-semibold text-slate-900">93 (74%)</span>
						</div>
						<div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-400 rounded-full" style="width:74%"></div></div>
					</div>

					<div>
						<div class="flex items-center justify-between mb-2">
							<span class="text-sm font-medium text-slate-700">Rejected</span>
							<span class="text-sm font-semibold text-slate-900">15 (12%)</span>
						</div>
						<div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-300 rounded-full" style="width:12%"></div></div>
					</div>
				</div>
			</div>

			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Applications Queue</h2>
					<i data-lucide="clipboard-list" class="w-5 h-5 text-indigo-600"></i>
				</div>

				<div class="space-y-3">
					<div class="p-3 rounded-lg border border-amber-200 bg-amber-50">
						<p class="text-sm font-medium text-slate-900">Pending Approval</p>
						<p class="text-2xl font-bold text-amber-700 mt-1">9</p>
						<p class="text-xs text-slate-600 mt-1">₹3.6L requested</p>
					</div>

					<div class="p-3 rounded-lg border border-green-200 bg-green-50">
						<p class="text-sm font-medium text-slate-900">Approved Today</p>
						<p class="text-2xl font-bold text-green-700 mt-1">3</p>
						<p class="text-xs text-slate-600 mt-1">₹1.1L disbursed</p>
					</div>

					<div class="p-3 rounded-lg border border-red-200 bg-red-50">
						<p class="text-sm font-medium text-slate-900">Rejected</p>
						<p class="text-2xl font-bold text-red-700 mt-1">2</p>
						<p class="text-xs text-slate-600 mt-1">Insufficient eligibility</p>
					</div>
				</div>

				<button class="w-full mt-4 px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors flex items-center justify-center gap-2">
					<i data-lucide="shield-check" class="w-4 h-4"></i>
					Review Applications
				</button>
			</div>
		</div>

		<div class="mb-6">
			<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
				<span class="w-1 h-6 bg-indigo-600 rounded"></span>
				Active Loan Accounts
			</h2>
			<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
				<table class="w-full text-left text-sm relative z-0">
					<thead class="bg-indigo-50 border-b border-indigo-100">
						<tr>
							<th class="px-4 py-3 font-medium text-indigo-900">Loan ID</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Employee</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Principal</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Installment</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Next Due</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-100">
						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1042</td>
							<td class="px-4 py-3">Priya Sharma</td>
							<td class="px-4 py-3">Education</td>
							<td class="px-4 py-3">₹2,40,000</td>
							<td class="px-4 py-3 text-amber-600 font-semibold">₹1,08,000</td>
							<td class="px-4 py-3">₹12,000</td>
							<td class="px-4 py-3">2026-04-04</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Current</span></td>
						</tr>
						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1031</td>
							<td class="px-4 py-3">Rohan Gupta</td>
							<td class="px-4 py-3">Emergency</td>
							<td class="px-4 py-3">₹95,000</td>
							<td class="px-4 py-3 text-red-600 font-semibold">₹57,000</td>
							<td class="px-4 py-3">₹9,500</td>
							<td class="px-4 py-3">2026-03-30</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Overdue</span></td>
						</tr>
						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1024</td>
							<td class="px-4 py-3">Ananya Das</td>
							<td class="px-4 py-3">Medical</td>
							<td class="px-4 py-3">₹1,20,000</td>
							<td class="px-4 py-3 text-amber-600 font-semibold">₹24,000</td>
							<td class="px-4 py-3">₹8,000</td>
							<td class="px-4 py-3">2026-04-02</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Due Soon</span></td>
						</tr>
						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1017</td>
							<td class="px-4 py-3">Amit Patel</td>
							<td class="px-4 py-3">Personal</td>
							<td class="px-4 py-3">₹1,80,000</td>
							<td class="px-4 py-3 text-amber-600 font-semibold">₹72,000</td>
							<td class="px-4 py-3">₹15,000</td>
							<td class="px-4 py-3">2026-04-06</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Current</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Repayments Due (Next 7 Days)</h2>
					<i data-lucide="calendar-clock" class="w-5 h-5 text-indigo-600"></i>
				</div>

				<div class="space-y-3">
					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Kavya Iyer • LOAN-1009</p>
							<p class="text-xs text-slate-500">Due on 2026-03-31</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹11,000</span>
					</div>
					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Arjun Singh • LOAN-1028</p>
							<p class="text-xs text-slate-500">Due on 2026-04-01</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹9,000</span>
					</div>
					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Sneha Reddy • LOAN-1035</p>
							<p class="text-xs text-slate-500">Due on 2026-04-03</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹13,500</span>
					</div>
				</div>
			</div>

			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Loan Transactions</h2>
					<a href="#" class="text-sm text-indigo-600 hover:text-indigo-700">View all</a>
				</div>

				<div class="space-y-3">
					<div class="flex items-center justify-between p-3 rounded-lg bg-green-50 border border-green-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Disbursement • LOAN-1048</p>
							<p class="text-xs text-slate-500">Today • To: N. Mushi</p>
						</div>
						<span class="text-sm font-semibold text-green-700">+₹75,000</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 border border-indigo-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Repayment • LOAN-1031</p>
							<p class="text-xs text-slate-500">Today • From payroll deduction</p>
						</div>
						<span class="text-sm font-semibold text-indigo-700">₹9,500</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg bg-red-50 border border-red-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Penalty Applied • LOAN-1019</p>
							<p class="text-xs text-slate-500">Yesterday • 7 days overdue</p>
						</div>
						<span class="text-sm font-semibold text-red-700">₹1,200</span>
					</div>
				</div>
			</div>
		</div>
	</main>
</x-Account-sidebar>
