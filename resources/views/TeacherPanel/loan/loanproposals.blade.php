<x-Teacher-sidebar>
	<x-slot name="title">Loan Application Progress</x-slot>

	<main class="p-2 sm:p-6 bg-slate-50 min-h-screen ml-0 md:ml-64 w-full">
		@php
			// Build a safe collection even if controller does not pass data yet
			$applications = collect($loanApplications ?? []);

			// Quick summary numbers
			$totalApplications = $applications->count();
			$approvedCount = $applications->where('status', 'approved')->count();
			$pendingCount = $applications->filter(fn($item) => in_array(strtolower($item->status ?? ''), ['pending', 'submitted', 'under_review']))->count();
			$rejectedCount = $applications->where('status', 'rejected')->count();

			// Converts status to progress percentage
			$progressMap = [
				'submitted' => 20,
				'pending' => 35,
				'under_review' => 65,
				'approved' => 100,
				'rejected' => 100,
			];
		@endphp

		<!-- Header -->
		<div class="mb-6 rounded-2xl border border-indigo-100 bg-gradient-to-r from-indigo-50 via-blue-50 to-cyan-50 px-5 py-6 shadow-sm">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
				<div>
					<h1 class="text-xl sm:text-2xl font-bold text-slate-900">Loan Application Progress</h1>
					<p class="text-sm text-slate-600 mt-1">Track each loan step from submission to final decision.</p>
				</div>
				<a href="{{ route('teacher.loans') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors w-fit">
					<i data-lucide="layout-dashboard" class="w-4 h-4"></i>
					Back to Dashboard
				</a>
			</div>
		</div>

		<!-- Summary Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
			<div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
				<p class="text-xs text-slate-500">Total Applications</p>
				<p class="text-2xl font-bold text-slate-900 mt-1">{{ $totalApplications }}</p>
			</div>

			<div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
				<p class="text-xs text-emerald-700">Approved</p>
				<p class="text-2xl font-bold text-emerald-700 mt-1">{{ $approvedCount }}</p>
			</div>

			<div class="rounded-xl border border-amber-200 bg-amber-50 p-4 shadow-sm">
				<p class="text-xs text-amber-700">In Progress</p>
				<p class="text-2xl font-bold text-amber-700 mt-1">{{ $pendingCount }}</p>
			</div>

			<div class="rounded-xl border border-rose-200 bg-rose-50 p-4 shadow-sm">
				<p class="text-xs text-rose-700">Rejected</p>
				<p class="text-2xl font-bold text-rose-700 mt-1">{{ $rejectedCount }}</p>
			</div>
		</div>

		<!-- Applications List -->
		<section class="space-y-4">
			@forelse($applications as $application)
				@php
					// Normalize status for easier comparisons
					$status = strtolower($application->status ?? 'pending');
					$progress = $progressMap[$status] ?? 35;

					// Badge styling based on status
					$statusClasses = match($status) {
						'approved' => 'bg-emerald-100 text-emerald-700 border border-emerald-200',
						'rejected' => 'bg-rose-100 text-rose-700 border border-rose-200',
						'under_review' => 'bg-blue-100 text-blue-700 border border-blue-200',
						default => 'bg-amber-100 text-amber-700 border border-amber-200',
					};

					// Progress bar color
					$progressBarClass = $status === 'rejected' ? 'bg-rose-500' : 'bg-indigo-500';
				@endphp

				<article class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
					<div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">
						<div class="space-y-3">
							<div class="flex items-center gap-2 flex-wrap">
								<div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center">
									<i data-lucide="file-text" class="w-4 h-4 text-indigo-600"></i>
								</div>
								<h3 class="text-base sm:text-lg font-semibold text-slate-900 tracking-tight">
									{{ $application->loan_reference ?? 'Loan Application' }}
								</h3>
								<span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
									{{ str_replace('_', ' ', ucfirst($status)) }}
								</span>
							</div>

							<p class="text-sm text-slate-600">
								{{ $application->loanType->name ?? 'Loan Type' }}
							</p>

							<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
								<div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2">
									<p class="text-slate-500 text-xs">Amount</p>
									<p class="font-semibold text-slate-800">Tsh {{ number_format((float)($application->amount ?? 0), 0) }}</p>
								</div>
								<div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2">
									<p class="text-slate-500 text-xs">Duration</p>
									<p class="font-semibold text-slate-800">{{ $application->duration_months ?? '-' }} months</p>
								</div>
								<div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2">
									<p class="text-slate-500 text-xs">Submitted</p>
									<p class="font-semibold text-slate-800">{{ optional($application->created_at)->format('d M Y') ?? '-' }}</p>
								</div>
							</div>
						</div>

						<div class="lg:min-w-[180px] lg:text-right">
							<p class="text-xs uppercase tracking-wide text-slate-500 mb-1">Progress</p>
							<p class="text-2xl font-bold text-slate-900">{{ $progress }}%</p>
							<p class="text-xs text-slate-500 mt-1">Updated {{ optional($application->updated_at)->format('d M Y') ?? '-' }}</p>
						</div>
					</div>

					<!-- Progress Bar -->
					<div class="mt-5">
						<div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
							<div class="h-full {{ $progressBarClass }} rounded-full transition-all duration-700" style="width: {{ $progress }}%"></div>
						</div>
					</div>

					<!-- Progress Steps -->
					<div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
						@php
							$steps = [
								'submitted' => 'Submitted',
								'pending' => 'Pending',
								'under_review' => 'Review',
								'approved' => 'Approved',
							];

							$activeStep = match($status) {
								'submitted' => 1,
								'pending' => 2,
								'under_review' => 3,
								'approved' => 4,
								'rejected' => 3,
								default => 2,
							};
						@endphp

						@foreach(array_values($steps) as $index => $step)
							@php $stepIndex = $index + 1; @endphp
							<div class="flex items-center gap-2 {{ $stepIndex <= $activeStep ? 'text-indigo-700' : 'text-slate-400' }}">
								<span class="w-2.5 h-2.5 rounded-full {{ $stepIndex <= $activeStep ? 'bg-indigo-500' : 'bg-slate-300' }}"></span>
								<span class="font-medium">{{ $step }}</span>
							</div>
						@endforeach
					</div>

					<!-- Full Loan Details (expand/collapse) -->
					<details class="mt-4 rounded-xl border border-slate-200 bg-slate-50" {{ $loop->first ? 'open' : '' }}>
						<summary class="cursor-pointer list-none px-4 py-3.5 flex items-center justify-between hover:bg-slate-100 rounded-xl transition-colors">
							<span class="text-sm font-semibold text-slate-800">View Full Loan Details</span>
							<i data-lucide="chevron-down" class="w-4 h-4 text-slate-500"></i>
						</summary>

						<div class="px-4 pb-4 pt-1">
							<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-sm">
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Loan Reference</p>
									<p class="font-medium text-slate-800">{{ $application->loan_reference ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Loan Type</p>
									<p class="font-medium text-slate-800">{{ $application->loanType->name ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Status</p>
									<p class="font-medium text-slate-800">{{ ucfirst(str_replace('_', ' ', $application->status ?? '-')) }}</p>
								</div>

								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Requested Amount</p>
									<p class="font-medium text-slate-800">Tsh {{ number_format((float)($application->amount ?? 0), 2) }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Duration</p>
									<p class="font-medium text-slate-800">{{ $application->duration_months ?? '-' }} months</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Interest Rate</p>
									<p class="font-medium text-slate-800">{{ number_format((float)($application->interest_rate ?? 0), 2) }}%</p>
								</div>

								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Total Interest</p>
									<p class="font-medium text-slate-800">Tsh {{ number_format((float)($application->total_interest ?? 0), 2) }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Total Repayment</p>
									<p class="font-medium text-slate-800">Tsh {{ number_format((float)($application->total_repayment ?? 0), 2) }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Monthly Installment</p>
									<p class="font-medium text-slate-800">Tsh {{ number_format((float)($application->monthly_installment ?? 0), 2) }}</p>
								</div>

								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">PAYE Applicable</p>
									<p class="font-medium text-slate-800">{{ ($application->paye_applicable ?? false) ? 'Yes' : 'No' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">PAYE Benefit (Monthly)</p>
									<p class="font-medium text-slate-800">
										{{ is_null($application->paye_benefit_monthly) ? '-' : 'Tsh ' . number_format((float)$application->paye_benefit_monthly, 2) }}
									</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">PAYE Benefit (Annual)</p>
									<p class="font-medium text-slate-800">
										{{ is_null($application->paye_benefit_annual) ? '-' : 'Tsh ' . number_format((float)$application->paye_benefit_annual, 2) }}
									</p>
								</div>

								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Submitted On</p>
									<p class="font-medium text-slate-800">{{ optional($application->created_at)->format('d M Y, H:i') ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Approved On</p>
									<p class="font-medium text-slate-800">{{ optional($application->approved_at)->format('d M Y, H:i') ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Rejected On</p>
									<p class="font-medium text-slate-800">{{ optional($application->rejected_at)->format('d M Y, H:i') ?? '-' }}</p>
								</div>

								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Disbursed On</p>
									<p class="font-medium text-slate-800">{{ optional($application->disbursed_at)->format('d M Y, H:i') ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Repayment Start</p>
									<p class="font-medium text-slate-800">{{ optional($application->repayment_start_date)->format('d M Y') ?? '-' }}</p>
								</div>
								<div class="rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500">Total Paid</p>
									<p class="font-medium text-slate-800">Tsh {{ number_format((float)($application->total_paid ?? 0), 2) }}</p>
								</div>
							</div>

							<div class="mt-3 rounded-lg bg-white border border-slate-200 px-3 py-2.5">
								<p class="text-slate-500 text-sm">Purpose</p>
								<p class="font-medium text-slate-800 text-sm">{{ $application->purpose ?? '-' }}</p>
							</div>

							@if(!empty($application->remarks))
								<div class="mt-3 rounded-lg bg-white border border-slate-200 px-3 py-2.5">
									<p class="text-slate-500 text-sm">Remarks</p>
									<p class="font-medium text-slate-800 text-sm">{{ $application->remarks }}</p>
								</div>
							@endif

							@if(!empty($application->attachment))
								<div class="mt-3">
									<a href="{{ asset('storage/' . $application->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-medium text-indigo-700 hover:text-indigo-900 bg-white border border-indigo-200 px-3 py-2 rounded-lg hover:bg-indigo-50 transition-colors">
										<i data-lucide="paperclip" class="w-4 h-4"></i>
										View Attached Document
									</a>
								</div>
							@endif
						</div>
					</details>

					@if($status === 'rejected')
						<p class="mt-3 text-xs text-rose-700 bg-rose-50 border border-rose-200 rounded-lg px-3 py-2">
							This application was not approved. Contact the accounts office for details.
						</p>
					@endif
				</article>
			@empty
				<!-- Empty State -->
				<div class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center shadow-sm">
					<div class="mx-auto w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center mb-3">
						<i data-lucide="file-clock" class="w-6 h-6 text-indigo-600"></i>
					</div>
					<h3 class="text-base font-semibold text-slate-900">No loan applications yet</h3>
					<p class="text-sm text-slate-600 mt-1">Once you apply for a loan, its progress will appear here.</p>
					<a href="{{ route('teacher.loans') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
						<i data-lucide="plus-circle" class="w-4 h-4"></i>
						Go Apply for Loan
					</a>
				</div>
			@endforelse
		</section>
	</main>

	<script>
		// Render Lucide icons on this page
		document.addEventListener('DOMContentLoaded', function () {
			if (window.lucide && typeof window.lucide.createIcons === 'function') {
				window.lucide.createIcons();
			}
		});
	</script>
</x-Teacher-sidebar>
