@php
  $stats = $stats ?? [];
  $counts = $counts ?? ['total' => 0, 'pending' => 0, 'under_review' => 0, 'approved' => 0, 'rejected' => 0, 'disbursed' => 0];
  $loans = $loans ?? collect();
  $fmt = fn ($n) => money_format_app($n);
  $total = max(0, (int) ($counts['total'] ?? 0));
  $pct = fn ($n) => $total > 0 ? round(((int) $n / $total) * 100) : 0;
  $pipeline = [
      ['label' => 'Pending', 'count' => $counts['pending'], 'bar' => 'bg-amber-500'],
      ['label' => 'Under review', 'count' => $counts['under_review'], 'bar' => 'bg-indigo-500'],
      ['label' => 'Approved', 'count' => $counts['approved'], 'bar' => 'bg-indigo-400'],
      ['label' => 'Disbursed / active', 'count' => $counts['disbursed'], 'bar' => 'bg-green-500'],
      ['label' => 'Rejected', 'count' => $counts['rejected'], 'bar' => 'bg-red-400'],
  ];
@endphp

<x-Account-sidebar>
	<x-slot name="title">Staff Loans Dashboard</x-slot>

	<main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
		<div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
			<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">Staff Loans Dashboard</h1>
					<p class="text-xs sm:text-sm text-slate-700 mt-1">Applications, approvals, and disbursed balances from loan records</p>
				</div>
				<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
					<a href="{{ route('accounting.proposalManagement') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="clipboard-list" class="w-4 h-4"></i>
						Review applications
					</a>
					<a href="{{ route('accounting.loanDisbursements') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
						<i data-lucide="hand-coins" class="w-4 h-4"></i>
						Disbursements
					</a>
				</div>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm">
				<p class="text-xs sm:text-sm text-slate-600">Active portfolio</p>
				<p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['portfolio'] ?? 0) }}</p>
				<p class="text-xs sm:text-sm text-slate-600 mt-2">{{ number_format($stats['activeCount'] ?? 0) }} disbursed or active</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
				<p class="text-xs sm:text-sm text-slate-600">Repaid on active loans</p>
				<p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['repaid'] ?? 0) }}</p>
				<p class="text-xs sm:text-sm text-green-600 mt-2">Recorded as total paid</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
				<p class="text-xs sm:text-sm text-slate-600">Outstanding</p>
				<p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['outstanding'] ?? 0) }}</p>
				<p class="text-xs sm:text-sm text-amber-600 mt-2">Repayment minus amount paid</p>
			</div>
			<div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
				<p class="text-xs sm:text-sm text-slate-600">Awaiting decision</p>
				<p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ $fmt($stats['awaitingAmount'] ?? 0) }}</p>
				<p class="text-xs sm:text-sm text-red-600 mt-2">{{ number_format(($counts['pending'] ?? 0) + ($counts['under_review'] ?? 0)) }} pending or under review</p>
			</div>
		</div>

		<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
			<div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<div class="flex items-center justify-between mb-4">
					<h2 class="text-base sm:text-lg font-semibold text-slate-900">Application pipeline</h2>
					<span class="text-xs text-slate-500">{{ number_format($total) }} applications</span>
				</div>
				<div class="space-y-4">
					@foreach ($pipeline as $step)
						<div>
							<div class="flex items-center justify-between mb-2">
								<span class="text-sm font-medium text-slate-700">{{ $step['label'] }}</span>
								<span class="text-sm font-semibold text-slate-900">{{ number_format($step['count']) }} ({{ $pct($step['count']) }}%)</span>
							</div>
							<div class="w-full bg-slate-100 rounded-full h-2"><div class="h-2 {{ $step['bar'] }} rounded-full" style="width: {{ $pct($step['count']) }}%"></div></div>
						</div>
					@endforeach
				</div>
			</div>

			<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
				<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Queue</h2>
				<div class="space-y-3">
					<a href="{{ route('accounting.proposalManagement') }}" class="block p-3 rounded-lg border border-amber-200 bg-amber-50">
						<p class="text-sm font-medium text-slate-900">Pending</p>
						<p class="text-2xl font-bold text-amber-700 mt-1">{{ number_format($counts['pending']) }}</p>
					</a>
					<a href="{{ route('accounting.proposalManagement') }}" class="block p-3 rounded-lg border border-indigo-200 bg-indigo-50">
						<p class="text-sm font-medium text-slate-900">Under review</p>
						<p class="text-2xl font-bold text-indigo-700 mt-1">{{ number_format($counts['under_review']) }}</p>
					</a>
					<a href="{{ route('accounting.loanDisbursements') }}" class="block p-3 rounded-lg border border-green-200 bg-green-50">
						<p class="text-sm font-medium text-slate-900">Approved, not disbursed</p>
						<p class="text-2xl font-bold text-green-700 mt-1">{{ number_format($counts['approved']) }}</p>
						<p class="text-xs text-slate-600 mt-1">{{ $fmt($stats['approvedAmount'] ?? 0) }}</p>
					</a>
				</div>
			</div>
		</div>

		<div class="mb-6">
			<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Recent applications</h2>
			<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
				<table class="w-full text-left text-sm">
					<thead class="bg-indigo-50 border-b border-indigo-100">
						<tr>
							<th class="px-4 py-3 font-medium text-indigo-900">Reference</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Staff</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Type</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Paid</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Installment</th>
							<th class="px-4 py-3 font-medium text-indigo-900">Status</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-100">
						@forelse ($loans as $loan)
							@php
								$person = trim(($loan->user->fname ?? '') . ' ' . ($loan->user->lname ?? ''));
							@endphp
							<tr class="hover:bg-indigo-50 transition-colors">
								<td class="px-4 py-3">{{ $loan->loan_reference ?: ('#' . $loan->id) }}</td>
								<td class="px-4 py-3">{{ $person !== '' ? $person : '—' }}</td>
								<td class="px-4 py-3">{{ $loan->loanType->name ?? '—' }}</td>
								<td class="px-4 py-3">{{ $fmt($loan->amount) }}</td>
								<td class="px-4 py-3">{{ $fmt($loan->total_paid) }}</td>
								<td class="px-4 py-3">{{ $fmt($loan->monthly_installment) }}</td>
								<td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">{{ ucfirst(str_replace('_', ' ', (string) $loan->status)) }}</span></td>
							</tr>
						@empty
							<tr>
								<td colspan="7" class="px-4 py-8 text-center text-slate-500">No loan applications for this school.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</main>
</x-Account-sidebar>
