<x-Teacher-sidebar>
    <x-slot name="title">Loan Application Dashboard</x-slot>

    <main class="p-4 sm:p-6 bg-slate-50 min-h-screen ml-0 md:ml-64">
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-6">
            <div class="bg-white rounded-xl p-4 sm:p-6 border border-indigo-100 shadow-sm flex flex-col items-center">
                <i data-lucide="file-text" class="w-8 h-8 text-indigo-600 mb-2"></i>
                <p class="text-sm text-slate-600 mb-1">Current Application Status</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-700 mb-2">No
                    Application Yet</span>
                <p class="text-xs text-slate-500 text-center">You have not started a loan application. Click "Apply for
                    Loan" to begin.</p>
            </div>
            <div class="bg-white rounded-xl p-4 sm:p-6 border border-green-100 shadow-sm flex flex-col items-center">
                <i data-lucide="badge-check" class="w-8 h-8 text-green-600 mb-2"></i>
                <p class="text-sm text-slate-600 mb-1">Eligibility</p>
                <span
                    class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 mb-2">Eligible</span>
                <p class="text-xs text-slate-500 text-center">You meet the basic requirements for staff loan
                    application.</p>
            </div>
            <div class="bg-white rounded-xl p-4 sm:p-6 border border-blue-100 shadow-sm flex flex-col items-center">
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

        <!-- Apply for Loan Modal (vanilla JS) -->
        <div id="apply-modal-overlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
            style="display:none;">
            <div id="apply-modal" class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative">
                <button id="close-apply-modal" type="button"
                    class="absolute top-3 right-3 text-slate-400 hover:text-red-500">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
                <h3 class="text-lg font-semibold text-slate-900 mb-2 flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-5 h-5 text-indigo-600"></i>
                    Apply for Loan
                </h3>
                <form id="apply-loan-form" class="space-y-4 mt-4">
                    <div>
                        <label for="loan-type" class="block text-sm font-medium text-slate-700 mb-1">Loan Type</label>
                        <select id="loan-type"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select loan type</option>
                            <option>Personal Loan</option>
                            <option>Education Loan</option>
                            <option>Emergency Loan</option>
                        </select>
                    </div>
                    <div>
                        <label for="loan-amount" class="block text-sm font-medium text-slate-700 mb-1">Amount
                            (₹)</label>
                        <input id="loan-amount" type="number" min="1000" step="100" placeholder="Enter amount"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label for="loan-purpose" class="block text-sm font-medium text-slate-700 mb-1">Purpose</label>
                        <textarea id="loan-purpose" rows="2" placeholder="Describe the purpose"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" id="cancel-apply-modal"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--end of application modal-->

    </main>

    <script>
        // Modal open/close logic
        document.addEventListener('DOMContentLoaded', function() {
            // Open modal from main button
            var openBtn = document.getElementById('open-apply-modal');
            // Open modal from table buttons
            var openBtns = document.querySelectorAll('.open-apply-modal');
            var overlay = document.getElementById('apply-modal-overlay');
            var closeBtn = document.getElementById('close-apply-modal');
            var cancelBtn = document.getElementById('cancel-apply-modal');
            var modal = document.getElementById('apply-modal');
            var form = document.getElementById('apply-loan-form');

            function openModal() {
                overlay.style.display = 'flex';
                if (window.lucide && typeof window.lucide.createIcons === 'function') window.lucide.createIcons();
            }

            function closeModal() {
                overlay.style.display = 'none';
            }

            if (openBtn) openBtn.addEventListener('click', openModal);

            openBtns.forEach(function(btn) {
                btn.addEventListener('click', openModal);
            });

            if (closeBtn) closeBtn.addEventListener('click', closeModal);

            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

            // Click outside modal closes
            if (overlay) overlay.addEventListener('mousedown', function(e) {

                if (e.target === overlay) closeModal();

            });

            // Prevent form submit (demo only)
            if (form) form.addEventListener('submit', function(e) {
                e.preventDefault();
                closeModal();
            });
        });
    </script>

</x-Teacher-sidebar>
