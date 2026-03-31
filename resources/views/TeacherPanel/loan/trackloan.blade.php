<x-Teacher-sidebar>
	<x-slot name="title">Track My Loans</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen ml-0 md:ml-64 w-full max-w-none">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">My Loan Overview</h1>
					<p class="text-xs sm:text-sm text-slate-700 mt-1">Track your active loans, repayments, and upcoming installments.</p>
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
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹1,08,000</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">1 active loan</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-green-100">
						<i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Paid So Far</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹1,32,000</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">55% repaid</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-amber-100">
						<i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Next Installment</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">₹12,000</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">Due: 2026-04-04</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-blue-100 shadow-sm">
				<div class="flex items-center gap-3 mb-2">
					<div class="p-2 rounded-md bg-blue-100">
						<i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
					</div>
					<p class="text-xs sm:text-sm text-slate-600">Installments Left</p>
				</div>
				<p class="text-xl sm:text-2xl font-bold text-slate-900">9</p>
				<p class="text-xs sm:text-sm text-blue-600 mt-2">Monthly</p>
			</div>
		</div>

		   <div class="mb-6">
			   <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900 flex items-center gap-2">
						<span class="w-1 h-6 bg-indigo-600 rounded"></span>
						Active Loan Repayment Progress
					</h2>
				</div>
				<div class="overflow-x-auto">
					<table class="w-full text-left text-sm">
						<thead class="bg-indigo-50 border-b border-indigo-100">
							<tr>
								<th class="px-4 py-3 font-medium text-indigo-900">Loan ID</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Principal</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Paid</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Remaining</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Progress</th>
								<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-slate-100">
							<tr>
								<td class="px-4 py-3">LOAN-1042</td>
								<td class="px-4 py-3">₹2,40,000</td>
								<td class="px-4 py-3 text-green-700 font-semibold">₹1,32,000</td>
								<td class="px-4 py-3 text-amber-700 font-semibold">₹1,08,000</td>
								<td class="px-4 py-3 w-56">
									<div class="flex items-center gap-3">
										<div class="flex-1 bg-slate-100 rounded-full h-2"><div class="h-2 bg-indigo-600 rounded-full" style="width:55%"></div></div>
										<span class="text-xs font-semibold text-slate-700">55%</span>
									</div>
								</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">On Track</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>

		

		<div class="bg-indigo-100 border border-indigo-200 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
			<div>
				<h3 class="text-lg font-semibold text-indigo-900 mb-1">Need Help?</h3>
				<p class="text-sm text-indigo-800">Contact the accounts office for assistance with your loan or repayments.</p>
			</div>
			<a href="#" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
				<i data-lucide="phone" class="w-4 h-4"></i>
				Contact Support
			</a>
		</div>
	</main>
</x-Teacher-sidebar>
