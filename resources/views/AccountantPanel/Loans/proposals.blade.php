<x-Account-sidebar>
    <x-slot name="title">Loan Proposals</x-slot>

    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
        @if (session('success') || session('error'))
            <div id="loan-action-alert"
                class="mb-4 rounded-lg border px-4 py-3 text-sm {{ session('success') ? 'border-green-200 bg-green-50 text-green-800' : 'border-red-200 bg-red-50 text-red-800' }}"
                role="alert">
                <div class="flex items-start justify-between gap-3">
                    <p>{{ session('success') ?? session('error') }}</p>
                    <button type="button" class="text-current/80 hover:text-current" aria-label="Close alert"
                        onclick="document.getElementById('loan-action-alert')?.remove()">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Loan Applications</h1>
                    <p class="text-xs sm:text-sm text-slate-700 mt-1">Review loan proposals submitted by staff and take
                        approval decisions</p>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
                    <button
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                        Filter
                    </button>
                    <button
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-slate-300 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        Export
                    </button>
                    <button
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
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
                <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $totalApplications }}</p>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">All time</p>
            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 border border-amber-100 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 rounded-md bg-amber-100">
                        <i data-lucide="clock-3" class="w-4 h-4 text-amber-600"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600">Pending Review</p>
                </div>
                <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $pendingCount }}</p>
                <p class="text-xs sm:text-sm text-amber-600 mt-2">Needs action</p>
            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 rounded-md bg-green-100">
                        <i data-lucide="badge-check" class="w-4 h-4 text-green-600"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600">Approved</p>
                </div>
                <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $approvedCount }}</p>
                <p class="text-xs sm:text-sm text-green-600 mt-2">
                    ₹{{ number_format($totalApprovedAmount / 100000, 1) }}L approved</p>
            </div>

            <div class="bg-white rounded-xl p-4 sm:p-6 border border-red-100 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 rounded-md bg-red-100">
                        <i data-lucide="x-circle" class="w-4 h-4 text-red-600"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600">Rejected</p>
                </div>
                <p class="text-xl sm:text-2xl font-bold text-slate-900">{{ $rejectedCount }}</p>
                <p class="text-xs sm:text-sm text-red-600 mt-2">Not approved</p>
            </div>
        </div>

        <div class="mb-4">
            <div class="w-full max-w-4xl">
                <label for="proposal-search" class="sr-only">Search applications</label>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input id="proposal-search" type="search"
                        placeholder="Search by proposal ID, employee name, department, or loan type..."
                        class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>
            </div>
        </div>

        <div class="mb-6 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold text-slate-900">Status guide</p>
                    <p class="text-xs text-slate-500 mt-1">A quick overview of how loan applications move through the
                        review flow.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">pending</span>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">under_review</span>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">approved</span>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">rejected</span>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-cyan-100 text-cyan-700">disbursed</span>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">active</span>
                    <span
                        class="px-2.5 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-700">completed</span>
                </div>
            </div>
        </div>

        <div class="space-y-6 mb-6">
            <!-- Pending Applications -->
            @php
                $pendingLoans = $allLoans->where('status', 'pending');
            @endphp
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-amber-500 rounded"></span>
                    Pending Applications ({{ $pendingLoans->count() }})
                </h2>
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
                    <table class="w-full text-left text-sm relative z-0">
                        <thead class="bg-indigo-50 border-b border-indigo-100">
                            <tr>
                                <th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                                <th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($pendingLoans->count() > 0)
                                @foreach ($pendingLoans as $loan)
                                    <tr class="hover:bg-indigo-50 transition-colors">
                                        <td class="px-4 py-3">{{ $loan->loan_reference }}</td>
                                        <td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }}
                                            {{ $loan->user->lname ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $loan->loanType->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">
                                            ₹{{ number_format($loan->amount, 0) }}</td>
                                        <td class="px-4 py-3">{{ $loan->duration_months }} months</td>
                                        <td class="px-4 py-3">{{ $loan->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3"><span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span>
                                        </td>
                                        <td class="px-4 py-3 w-72">
                                            <div class="flex items-center justify-start gap-2 whitespace-nowrap">
                                                <button type="button"
                                                    class="js-loan-view-toggle inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium"
                                                    data-target="loan-detail-pending-{{ $loan->id }}"
                                                    title="View details" aria-label="View details" aria-expanded="false">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    <span class="js-toggle-label">View</span>
                                                </button>
                                                <form method="POST" action="{{ route('accounting.proposal.moveUnderReview', $loan->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-indigo-200 text-indigo-700 bg-indigo-50 hover:bg-indigo-100 text-xs font-medium"
                                                        title="Move to under review" aria-label="Move to under review">
                                                        <i data-lucide="arrow-right-circle" class="w-4 h-4"></i>
                                                        Under Review
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="loan-detail-pending-{{ $loan->id }}" class="js-loan-detail-row hidden bg-slate-50/60">
                                        <td colspan="8" class="px-4 py-4">
                                            <div class="rounded-lg border border-slate-200 bg-white p-4">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                                    <div><p class="text-slate-500">Reference</p><p class="font-semibold text-slate-800">{{ $loan->loan_reference }}</p></div>
                                                    <div><p class="text-slate-500">Applicant</p><p class="font-semibold text-slate-800">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</p></div>
                                                    <div><p class="text-slate-500">Loan Type</p><p class="font-semibold text-slate-800">{{ $loan->loanType->name ?? 'N/A' }}</p></div>
                                                    <div><p class="text-slate-500">Status</p><p class="font-semibold text-slate-800">{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</p></div>
                                                    <div><p class="text-slate-500">Amount</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->amount, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Duration</p><p class="font-semibold text-slate-800">{{ $loan->duration_months }} months</p></div>
                                                    <div><p class="text-slate-500">Interest Rate</p><p class="font-semibold text-slate-800">{{ number_format($loan->interest_rate, 2) }}%</p></div>
                                                    <div><p class="text-slate-500">Monthly Installment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->monthly_installment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Interest</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_interest ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Repayment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_repayment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Submitted At</p><p class="font-semibold text-slate-800">{{ optional($loan->created_at)->format('Y-m-d H:i') ?? '-' }}</p></div>
                                                    <div><p class="text-slate-500">Remarks</p><p class="font-semibold text-slate-800">{{ $loan->remarks ?: '-' }}</p></div>
                                                </div>
                                                <div class="mt-3 border-t border-slate-100 pt-3 ">
                                                    <p class="text-slate-500">Purpose</p>
                                                    <p class="text-slate-800">{{ $loan->purpose ?: 'No purpose provided' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">No applications</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Under Review Applications -->
            @php
                $underReviewLoans = $allLoans->where('status', 'under_review');
            @endphp
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-500 rounded"></span>
                    Under Review ({{ $underReviewLoans->count() }})
                </h2>
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
                    <table class="w-full text-left text-sm relative z-0">
                        <thead class="bg-indigo-50 border-b border-indigo-100">
                            <tr>
                                <th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                                <th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($underReviewLoans->count() > 0)
                                @foreach ($underReviewLoans as $loan)
                                    <tr class="hover:bg-indigo-50 transition-colors">
                                        <td class="px-4 py-3">{{ $loan->loan_reference }}</td>
                                        <td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }}
                                            {{ $loan->user->lname ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $loan->loanType->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">
                                            ₹{{ number_format($loan->amount, 0) }}</td>
                                        <td class="px-4 py-3">{{ $loan->duration_months }} months</td>
                                        <td class="px-4 py-3">{{ $loan->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3"><span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700">Under
                                                Review</span></td>
                                        <td class="px-4 py-3 w-72">
                                            <div class="flex items-center justify-start gap-2 whitespace-nowrap">
                                                <button type="button"
                                                    class="js-loan-view-toggle inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium"
                                                    data-target="loan-detail-review-{{ $loan->id }}"
                                                    title="View details" aria-label="View details" aria-expanded="false">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    <span class="js-toggle-label">View</span>
                                                </button>
                                                <button
                                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-green-200 text-green-700 bg-green-50 hover:bg-green-100 text-xs font-medium"
                                                    title="Approve application" aria-label="Approve application">
                                                    <i data-lucide="badge-check" class="w-4 h-4"></i>
                                                    Approve
                                                </button>
                                                <button
                                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-red-200 text-red-700 bg-red-50 hover:bg-red-100 text-xs font-medium"
                                                    title="Reject application" aria-label="Reject application">
                                                    <i data-lucide="x-circle" class="w-4 h-4"></i>
                                                    Reject
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="loan-detail-review-{{ $loan->id }}" class="js-loan-detail-row hidden bg-slate-50/60">
                                        <td colspan="8" class="px-4 py-4">
                                            <div class="rounded-lg border border-slate-200 bg-white p-4">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                                    <div><p class="text-slate-500">Reference</p><p class="font-semibold text-slate-800">{{ $loan->loan_reference }}</p></div>
                                                    <div><p class="text-slate-500">Applicant</p><p class="font-semibold text-slate-800">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</p></div>
                                                    <div><p class="text-slate-500">Loan Type</p><p class="font-semibold text-slate-800">{{ $loan->loanType->name ?? 'N/A' }}</p></div>
                                                    <div><p class="text-slate-500">Status</p><p class="font-semibold text-slate-800">{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</p></div>
                                                    <div><p class="text-slate-500">Amount</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->amount, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Duration</p><p class="font-semibold text-slate-800">{{ $loan->duration_months }} months</p></div>
                                                    <div><p class="text-slate-500">Interest Rate</p><p class="font-semibold text-slate-800">{{ number_format($loan->interest_rate, 2) }}%</p></div>
                                                    <div><p class="text-slate-500">Monthly Installment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->monthly_installment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Interest</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_interest ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Repayment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_repayment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Submitted At</p><p class="font-semibold text-slate-800">{{ optional($loan->created_at)->format('Y-m-d H:i') ?? '-' }}</p></div>
                                                    <div><p class="text-slate-500">Remarks</p><p class="font-semibold text-slate-800">{{ $loan->remarks ?: '-' }}</p></div>
                                                </div>
                                                <div class="mt-3 border-t border-slate-100 pt-3 ">
                                                    <p class="text-slate-500">Purpose</p>
                                                    <p class="text-slate-800">{{ $loan->purpose ?: 'No purpose provided' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">No applications</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Approved Applications -->
            @php
                $approvedLoans = $allLoans->where('status', 'approved');
            @endphp
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-green-500 rounded"></span>
                    Approved Applications ({{ $approvedLoans->count() }})
                </h2>
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
                    <table class="w-full text-left text-sm relative z-0">
                        <thead class="bg-indigo-50 border-b border-indigo-100">
                            <tr>
                                <th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                                <th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($approvedLoans->count() > 0)
                                @foreach ($approvedLoans as $loan)
                                    <tr class="hover:bg-indigo-50 transition-colors">
                                        <td class="px-4 py-3">{{ $loan->loan_reference }}</td>
                                        <td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }}
                                            {{ $loan->user->lname ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $loan->loanType->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">
                                            ₹{{ number_format($loan->amount, 0) }}</td>
                                        <td class="px-4 py-3">{{ $loan->duration_months }} months</td>
                                        <td class="px-4 py-3">{{ $loan->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3"><span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Approved</span>
                                        </td>
                                        <td class="px-4 py-3 w-72">
                                            <div class="flex items-center justify-start gap-2 whitespace-nowrap">
                                                <button type="button"
                                                    class="js-loan-view-toggle inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium"
                                                    data-target="loan-detail-approved-{{ $loan->id }}"
                                                    title="View details" aria-label="View details" aria-expanded="false">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    <span class="js-toggle-label">View</span>
                                                </button>
                                                <button
                                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-cyan-200 text-cyan-700 bg-cyan-50 hover:bg-cyan-100 text-xs font-medium"
                                                    title="Mark as disbursed" aria-label="Mark as disbursed">
                                                    <i data-lucide="hand-coins" class="w-4 h-4"></i>
                                                    Disburse
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="loan-detail-approved-{{ $loan->id }}" class="js-loan-detail-row hidden bg-slate-50/60">
                                        <td colspan="8" class="px-4 py-4">
                                            <div class="rounded-lg border border-slate-200 bg-white p-4">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                                    <div><p class="text-slate-500">Reference</p><p class="font-semibold text-slate-800">{{ $loan->loan_reference }}</p></div>
                                                    <div><p class="text-slate-500">Applicant</p><p class="font-semibold text-slate-800">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</p></div>
                                                    <div><p class="text-slate-500">Loan Type</p><p class="font-semibold text-slate-800">{{ $loan->loanType->name ?? 'N/A' }}</p></div>
                                                    <div><p class="text-slate-500">Status</p><p class="font-semibold text-slate-800">{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</p></div>
                                                    <div><p class="text-slate-500">Amount</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->amount, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Duration</p><p class="font-semibold text-slate-800">{{ $loan->duration_months }} months</p></div>
                                                    <div><p class="text-slate-500">Interest Rate</p><p class="font-semibold text-slate-800">{{ number_format($loan->interest_rate, 2) }}%</p></div>
                                                    <div><p class="text-slate-500">Monthly Installment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->monthly_installment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Interest</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_interest ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Repayment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_repayment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Approved At</p><p class="font-semibold text-slate-800">{{ optional($loan->approved_at)->format('Y-m-d H:i') ?? '-' }}</p></div>
                                                    <div><p class="text-slate-500">Remarks</p><p class="font-semibold text-slate-800">{{ $loan->remarks ?: '-' }}</p></div>
                                                </div>
                                                <div class="mt-3 border-t border-slate-100 pt-3 ">
                                                    <p class="text-slate-500">Purpose</p>
                                                    <p class="text-slate-800">{{ $loan->purpose ?: 'No purpose provided' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">No applications</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rejected Applications -->
            @php
                $rejectedLoans = $allLoans->where('status', 'rejected');
            @endphp
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-red-500 rounded"></span>
                    Rejected Applications ({{ $rejectedLoans->count() }})
                </h2>
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto relative z-0">
                    <table class="w-full text-left text-sm relative z-0">
                        <thead class="bg-indigo-50 border-b border-indigo-100">
                            <tr>
                                <th class="px-4 py-3 font-medium text-indigo-900">Proposal ID</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Tenure</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Submitted</th>
                                <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                                <th class="px-4 py-3 font-medium text-indigo-900 w-72">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($rejectedLoans->count() > 0)
                                @foreach ($rejectedLoans as $loan)
                                    <tr class="hover:bg-indigo-50 transition-colors">
                                        <td class="px-4 py-3">{{ $loan->loan_reference }}</td>
                                        <td class="px-4 py-3">{{ $loan->user->fname ?? 'N/A' }}
                                            {{ $loan->user->lname ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $loan->loanType->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">
                                            ₹{{ number_format($loan->amount, 0) }}</td>
                                        <td class="px-4 py-3">{{ $loan->duration_months }} months</td>
                                        <td class="px-4 py-3">{{ $loan->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3"><span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Rejected</span>
                                        </td>
                                        <td class="px-4 py-3 w-72">
                                            <div class="flex items-center justify-start gap-2 whitespace-nowrap">
                                                <button type="button"
                                                    class="js-loan-view-toggle inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium"
                                                    data-target="loan-detail-rejected-{{ $loan->id }}"
                                                    title="View details" aria-label="View details" aria-expanded="false">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    <span class="js-toggle-label">View</span>
                                                </button>
                                                <button
                                                    class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md border border-slate-200 text-slate-700 bg-slate-50 hover:bg-slate-100 text-xs font-medium"
                                                    title="No further action" aria-label="No further action">
                                                    <i data-lucide="minus-circle" class="w-4 h-4"></i>
                                                    Closed
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="loan-detail-rejected-{{ $loan->id }}" class="js-loan-detail-row hidden bg-slate-50/60">
                                        <td colspan="8" class="px-4 py-4">
                                            <div class="rounded-lg border border-slate-200 bg-white p-4">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                                                    <div><p class="text-slate-500">Reference</p><p class="font-semibold text-slate-800">{{ $loan->loan_reference }}</p></div>
                                                    <div><p class="text-slate-500">Applicant</p><p class="font-semibold text-slate-800">{{ $loan->user->fname ?? 'N/A' }} {{ $loan->user->lname ?? '' }}</p></div>
                                                    <div><p class="text-slate-500">Loan Type</p><p class="font-semibold text-slate-800">{{ $loan->loanType->name ?? 'N/A' }}</p></div>
                                                    <div><p class="text-slate-500">Status</p><p class="font-semibold text-slate-800">{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</p></div>
                                                    <div><p class="text-slate-500">Amount</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->amount, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Duration</p><p class="font-semibold text-slate-800">{{ $loan->duration_months }} months</p></div>
                                                    <div><p class="text-slate-500">Interest Rate</p><p class="font-semibold text-slate-800">{{ number_format($loan->interest_rate, 2) }}%</p></div>
                                                    <div><p class="text-slate-500">Monthly Installment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->monthly_installment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Interest</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_interest ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Total Repayment</p><p class="font-semibold text-slate-800">₹{{ number_format($loan->total_repayment ?? 0, 2) }}</p></div>
                                                    <div><p class="text-slate-500">Rejected At</p><p class="font-semibold text-slate-800">{{ optional($loan->rejected_at)->format('Y-m-d H:i') ?? '-' }}</p></div>
                                                    <div><p class="text-slate-500">Remarks</p><p class="font-semibold text-slate-800">{{ $loan->remarks ?: '-' }}</p></div>
                                                </div>
                                                <div class="mt-3 border-t border-slate-100 pt-3 text-xs">
                                                    <p class="text-slate-500">Purpose</p>
                                                    <p class="text-slate-800">{{ $loan->purpose ?: 'No purpose provided' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">No applications</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('loan-action-alert');
            if (alertBox) {
                setTimeout(function () {
                    alertBox.remove();
                }, 4000);
            }

            document.querySelectorAll('.js-loan-view-toggle').forEach(function (button) {
                button.addEventListener('click', function () {
                    const targetId = button.getAttribute('data-target');
                    const row = document.getElementById(targetId);
                    if (!row) return;

                    const isHidden = row.classList.contains('hidden');
                    row.classList.toggle('hidden');
                    button.setAttribute('aria-expanded', isHidden ? 'true' : 'false');

                    const label = button.querySelector('.js-toggle-label');
                    if (label) {
                        label.textContent = isHidden ? 'Hide' : 'View';
                    }
                });
            });
        });
    </script>
</x-Account-sidebar>
