<x-Account-sidebar>
	<x-slot name="title">Loan Repayment Progress</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					  <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Loan Repayment Progress</h1>
					  <p class="text-xs sm:text-sm text-slate-700 mt-1">Monitor borrower repayments, installment schedules, and overdue risk</p>
				</div>
				<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="calendar" class="w-4 h-4"></i>
						Date Range
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="download" class="w-4 h-4"></i>
						Export
					</button>
					<button class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="send" class="w-4 h-4"></i>
						Send Reminders
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
					<p class="text-xs sm:text-sm text-slate-600">Outstanding Balance</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹17.3L</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">Across 64 borrowers</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-green-100">
						<i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Collected This Month</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹4.9L</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">+9.4% vs last month</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-amber-100">
						<i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Installments Due</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">18</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">Next 7 days</p>
			</div>

			<div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-red-100">
						<i data-lucide="alert-triangle" class="w-4 h-4 text-red-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Overdue Installments</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">11</p>
				<p class="text-xs sm:text-sm text-red-600 mt-2">₹2.1L at risk</p>
			</div>
		</div>

		<div class="mb-4">
			<div class="w-full max-w-4xl">
				<label for="repayment-search" class="sr-only">Search repayments</label>
				<div class="relative">
					<i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
					<input id="repayment-search" type="search" placeholder="Search by loan ID, borrower, department, or status..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
				</div>
			</div>
		</div>

		<div class="mb-6">
			<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
				<span class="w-1 h-6 bg-indigo-600 rounded"></span>
				Active Loan Repayment Progress
			</h2>

			<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
				<table class="w-full text-left text-sm relative z-0">
					<thead class="bg-indigo-50 border-b border-indigo-100">
						<tr>
							<th class="px-4 py-3 font-medium text-indigo-900">Loan ID</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Borrower</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Principal</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Installment</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Paid So Far</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Progress</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Next Due</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-100">
						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1042</td>
							<td class="px-4 py-3">Priya Sharma</td>
							<td class="px-4 py-3">₹2,40,000</td>
							<td class="px-4 py-3">₹12,000</td>
							<td class="px-4 py-3 text-green-700 font-semibold">₹1,32,000</td>
							<td class="px-4 py-3 text-amber-700 font-semibold">₹1,08,000</td>
							<td class="px-4 py-3 w-56">
								<div class="flex items-center gap-3">
									<div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-600 rounded-full" style="width:55%"></div></div>
									<span class="text-xs font-semibold text-slate-700">55%</span>
								</div>
							</td>
							<td class="px-4 py-3">2026-04-04</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
						</tr>

						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1031</td>
							<td class="px-4 py-3">Rohan Gupta</td>
							<td class="px-4 py-3">₹95,000</td>
							<td class="px-4 py-3">₹9,500</td>
							<td class="px-4 py-3 text-green-700 font-semibold">₹38,000</td>
							<td class="px-4 py-3 text-red-700 font-semibold">₹57,000</td>
							<td class="px-4 py-3 w-56">
								<div class="flex items-center gap-3">
									<div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-500 rounded-full" style="width:40%"></div></div>
									<span class="text-xs font-semibold text-slate-700">40%</span>
								</div>
							</td>
							<td class="px-4 py-3">2026-03-30</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Overdue</span></td>
						</tr>

						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1024</td>
							<td class="px-4 py-3">Ananya Das</td>
							<td class="px-4 py-3">₹1,20,000</td>
							<td class="px-4 py-3">₹8,000</td>
							<td class="px-4 py-3 text-green-700 font-semibold">₹96,000</td>
							<td class="px-4 py-3 text-amber-700 font-semibold">₹24,000</td>
							<td class="px-4 py-3 w-56">
								<div class="flex items-center gap-3">
									<div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-500 rounded-full" style="width:80%"></div></div>
									<span class="text-xs font-semibold text-slate-700">80%</span>
								</div>
							</td>
							<td class="px-4 py-3">2026-04-02</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Due Soon</span></td>
						</tr>

						<tr class="hover:bg-indigo-50 transition-colors">
							<td class="px-4 py-3">LOAN-1017</td>
							<td class="px-4 py-3">Amit Patel</td>
							<td class="px-4 py-3">₹1,80,000</td>
							<td class="px-4 py-3">₹15,000</td>
							<td class="px-4 py-3 text-green-700 font-semibold">₹1,08,000</td>
							<td class="px-4 py-3 text-amber-700 font-semibold">₹72,000</td>
							<td class="px-4 py-3 w-56">
								<div class="flex items-center gap-3">
									<div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-600 rounded-full" style="width:60%"></div></div>
									<span class="text-xs font-semibold text-slate-700">60%</span>
								</div>
							</td>
							<td class="px-4 py-3">2026-04-06</td>
							<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!--
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Upcoming Installments</h2>
					<i data-lucide="calendar-clock" class="w-5 h-5 text-indigo-600"></i>
				</div>

				<div class="space-y-3">
					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Kavya Iyer • LOAN-1009</p>
							<p class="text-xs text-slate-500">Installment due on 2026-03-31</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹11,000</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Arjun Singh • LOAN-1028</p>
							<p class="text-xs text-slate-500">Installment due on 2026-04-01</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹9,000</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
						<div>
							<p class="text-sm font-medium text-slate-900">Sneha Reddy • LOAN-1035</p>
							<p class="text-xs text-slate-500">Installment due on 2026-04-03</p>
						</div>
						<span class="text-sm font-semibold text-slate-900">₹13,500</span>
					</div>
				</div>
			</div>

			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Repayment Activity</h2>
					<a href="#" class="text-sm text-indigo-600 hover:text-indigo-700">View all</a>
				</div>

				<div class="space-y-3">
					<div class="flex items-center justify-between p-3 rounded-lg bg-green-50 border border-green-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Installment Paid • LOAN-1031</p>
							<p class="text-xs text-slate-500">Today • Payroll deduction</p>
						</div>
						<span class="text-sm font-semibold text-green-700">₹9,500</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 border border-indigo-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Partial Payment • LOAN-1017</p>
							<p class="text-xs text-slate-500">Yesterday • Manual payment</p>
						</div>
						<span class="text-sm font-semibold text-indigo-700">₹5,000</span>
					</div>

					<div class="flex items-center justify-between p-3 rounded-lg bg-red-50 border border-red-100">
						<div>
							<p class="text-sm font-medium text-slate-900">Late Penalty Added • LOAN-1040</p>
							<p class="text-xs text-slate-500">Yesterday • 10 days late</p>
						</div>
						<span class="text-sm font-semibold text-red-700">₹900</span>
					</div>
				</div>
			</div>
		</div> -->
		
	</main>
</x-Account-sidebar>
