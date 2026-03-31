<x-Teacher-sidebar>
    <x-slot name="title">Loan Application Dashboard</x-slot>

    <main class="p-2 sm:p-6 bg-slate-50 min-h-screen ml-0 md:ml-64 w-full">

        <!-- Loan Notification Banner (UI/UX Example) -->
        <div id="loan-notification-banner" class="flex items-center gap-3 mb-6 px-4 py-3 rounded-lg border border-yellow-200 bg-yellow-50 text-yellow-900 relative shadow">
            <i class="bi bi-exclamation-circle-fill text-yellow-500 text-xl"></i>
            <div class="flex-1">
                <span class="font-semibold">Notice:</span> The interest rate for your <span class="font-bold">Education Loan</span> has changed. Please review your updated repayment schedule.
            </div>
            <button id="close-loan-notification" class="absolute top-2 right-2 text-yellow-400 hover:text-yellow-700" aria-label="Dismiss notification">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    <script>
        // Dismiss notification banner
        document.addEventListener('DOMContentLoaded', function() {
            var closeBtn = document.getElementById('close-loan-notification');
            var banner = document.getElementById('loan-notification-banner');
            if (closeBtn && banner) {
                closeBtn.addEventListener('click', function() {
                    banner.style.display = 'none';
                });
            }
        });
    </script>

        <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Welcome to Your Loan Dashboard</h1>
                    <p class="text-xs sm:text-sm text-slate-700 mt-1">Apply for staff loans, track your application
                        status, and view available loan options.</p>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 pt-3">
                    <button id="open-apply-modal" type="button"
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        Apply for Loan
                    </button>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards: 3 on top, 3 on bottom -->
        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 xl:gap-8">
            <!-- Total Loans Card -->
            <div class="flex flex-col items-center bg-white border border-indigo-100 rounded-xl p-6 shadow group hover:shadow-lg transition h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 mb-3">
                    <i class="bi bi-collection text-indigo-600 text-2xl"></i>
                </div>
                <div class="text-xs text-slate-500 mb-1">Total Active Loans</div>
                <div class="text-3xl font-bold text-indigo-700 mb-1">2</div>
                <div class="flex flex-wrap gap-2 justify-center">
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full px-3 py-1">Personal: 1</span>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full px-3 py-1">Education: 1</span>
                </div>
            </div>
            <!-- Outstanding Balance Card -->
            <div class="flex flex-col items-center bg-white border border-amber-100 rounded-xl p-6 shadow group hover:shadow-lg transition h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-50 mb-3">
                    <i class="bi bi-cash-stack text-amber-500 text-2xl"></i>
                </div>
                <div class="text-xs text-slate-500 mb-1">Total Outstanding</div>
                <div class="text-3xl font-bold text-amber-600 mb-1">₹1,20,000</div>
                <div class="text-xs text-slate-500">Across all active loans</div>
            </div>
            <!-- Total Repaid Card -->
            <div class="flex flex-col items-center bg-white border border-green-100 rounded-xl p-6 shadow group hover:shadow-lg transition h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-50 mb-3">
                    <i class="bi bi-check2-circle text-green-600 text-2xl"></i>
                </div>
                <div class="text-xs text-slate-500 mb-1">Total Repaid</div>
                <div class="text-3xl font-bold text-green-700 mb-1">₹80,000</div>
                <div class="text-xs text-slate-500">All time</div>
            </div>
        </div>
        <div class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 xl:gap-8">
            <!-- Current Application Status Card -->
            <div class="flex flex-col items-center bg-white border border-indigo-100 rounded-xl p-6 shadow-sm h-full">
                <i data-lucide="file-text" class="w-8 h-8 text-indigo-600 mb-2"></i>
                <p class="text-sm text-slate-600 mb-1">Current Application Status</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-700 mb-2">No Application Yet</span>
                <p class="text-xs text-slate-500 text-center">You have not started a loan application. Click "Apply for Loan" to begin.</p>
            </div>
            <!-- Eligibility Card -->
            <div class="flex flex-col items-center bg-white border border-green-100 rounded-xl p-6 shadow-sm h-full">
                <i data-lucide="badge-check" class="w-8 h-8 text-green-600 mb-2"></i>
                <p class="text-sm text-slate-600 mb-1">Eligibility</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 mb-2">Eligible</span>
                <p class="text-xs text-slate-500 text-center">You meet the basic requirements for staff loan application.</p>
            </div>
            <!-- Loan Options Card -->
            <div class="flex flex-col items-center bg-white border border-blue-100 rounded-xl p-6 shadow-sm h-full">
                <i data-lucide="info" class="w-8 h-8 text-blue-600 mb-2"></i>
                <p class="text-sm text-slate-600 mb-1">Loan Options</p>
                <ul class="text-xs text-slate-700 list-disc list-inside mb-2">
                    <li>Personal Loan (up to ₹2,00,000)</li>
                    <li>Education Loan (up to ₹1,50,000)</li>
                    <li>Emergency Loan (up to ₹1,00,000)</li>
                </ul>
                <p class="text-xs text-slate-500 text-center">Select a loan type when applying.</p>
            </div>
        </div>

        <!--
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-6">
            <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                <span class="w-1 h-6 bg-indigo-600 rounded"></span>
                Recent Loan Applications
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-indigo-50 border-b border-indigo-100">
                        <tr>
                            <th class="px-4 py-3 font-medium text-indigo-900">Date</th>
                            <th class="px-4 py-3 font-medium text-indigo-900">Loan Type</th>
                            <th class="px-4 py-3 font-medium text-indigo-900">Amount</th>
                            <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
                            <th class="px-4 py-3 font-medium text-indigo-900">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="px-4 py-3 text-slate-500">-</td>
                            <td class="px-4 py-3 text-slate-500">-</td>
                            <td class="px-4 py-3 text-slate-500">-</td>
                            <td class="px-4 py-3"><span
                                    class="px-2 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-500">No
                                    Data</span></td>
                            <td class="px-4 py-3"><button type="button"
                                    class="open-apply-modal text-indigo-600 hover:text-indigo-800 text-xs font-medium flex items-center gap-1"><i
                                        data-lucide="plus-circle" class="w-4 h-4"></i>Apply</button></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div> -->

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-6">
			<h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
				<span class="w-1 h-6 bg-indigo-600 rounded"></span>
				Recent Repayment Activity
			</h2>
			<div class="space-y-3">
				<div class="flex items-center justify-between p-3 rounded-lg bg-green-50 border border-green-100">
					<div>
						<p class="text-sm font-medium text-slate-900">Installment Paid • #6</p>
						<p class="text-xs text-slate-500">2026-03-04 • Payroll deduction</p>
					</div>
					<span class="text-sm font-semibold text-green-700">₹12,000</span>
				</div>
				<div class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 border border-indigo-100">
					<div>
						<p class="text-sm font-medium text-slate-900">Partial Payment</p>
						<p class="text-xs text-slate-500">2026-02-04 • Manual payment</p>
					</div>
					<span class="text-sm font-semibold text-indigo-700">₹5,000</span>
				</div>
				<div class="flex items-center justify-between p-3 rounded-lg bg-red-50 border border-red-100">
					<div>
						<p class="text-sm font-medium text-slate-900">Late Penalty Added</p>
						<p class="text-xs text-slate-500">2026-02-10 • 6 days late</p>
					</div>
					<span class="text-sm font-semibold text-red-700">₹900</span>
				</div>
			</div>
		</div>

        <div
            class="bg-indigo-100 border border-indigo-200 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-indigo-900 mb-1">Need Help?</h3>
                <p class="text-sm text-indigo-800">Contact the accounts office for assistance with your loan
                    application.</p>
            </div>
            <a href="#"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <i data-lucide="phone" class="w-4 h-4"></i>
                Contact Support
            </a>
        </div>

        <!-- Apply for Loan Modal (imported) -->
        @include('TeacherPanel.loan.applyLoan_modal')
        <!-- End of imported modal -->
    </main>

    <script>
        // Modal open/close logic for new modal
        document.addEventListener('DOMContentLoaded', function() {
            var openBtn = document.getElementById('open-apply-modal');
            var modal = document.getElementById('applyLoanModal');
            if (openBtn && modal) {
                openBtn.addEventListener('click', function() {
                    modal.classList.remove('hidden');
                    if (window.lucide && typeof window.lucide.createIcons === 'function') window.lucide.createIcons();
                });
            }
        });
    </script>

</x-Teacher-sidebar>
