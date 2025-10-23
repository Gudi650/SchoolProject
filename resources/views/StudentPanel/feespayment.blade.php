<x-Student-sidebar>

<main class="flex-1 md:ml-64 p-6 md:p-10">
			<header class="mb-6">
				<h1 class="text-2xl font-semibold">Fees Payment</h1>
			</header>

			<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
				<div class="bg-white p-4 rounded shadow text-center">
					<i class="bi bi-cash-stack text-2xl text-green-500"></i>
					<div class="text-sm text-gray-500">Total Fees</div>
					<div class="text-2xl font-bold">$2,500</div>
					<div class="mt-2 text-sm text-gray-600">Paid: $1,500 • Balance: $1,000</div>
				</div>
				<div class="bg-white p-4 rounded shadow text-center">
					<i class="bi bi-calendar-event text-2xl text-yellow-500"></i>
					<div class="text-sm text-gray-500">Due Date</div>
					<div class="text-2xl font-bold">12/12/2025</div>
				</div>
				<div class="bg-white p-4 rounded shadow text-center">
									<i class="bi bi-check-circle text-2xl text-red-500"></i>
									<div class="text-sm text-gray-500">Payment Status</div>
									<div class="text-2xl font-bold">Partially Paid</div>
									<div class="mt-4">
										<button id="viewPaymentBtn" type="button" class="w-full md:inline-flex md:w-auto items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
											
											<span class="font-medium">View Payment Details</span>
										</button>
									</div>
				</div>
			</div>

			<section class="bg-white p-4 rounded shadow">
				<h2 class="text-lg font-semibold mb-3">Payment History</h2>
				<div class="overflow-x-auto">
					<table class="w-full text-left">
						<thead class="bg-gray-100"><tr><th class="p-2">Date</th><th class="p-2">Amount Paid</th><th class="p-2">Source</th><th class="p-2">Status</th></tr></thead>
						<tbody>
							<tr class="border-b"><td class="p-2">12/06/2025</td><td class="p-2">350,000</td><td class="p-2">Card</td><td class="p-2">Paid</td></tr>
						</tbody>
					</table>
				</div>
			</section>

			<!-- Payment Details Modal (hidden) -->
			<div id="paymentModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
				<div id="paymentModalOverlay" class="absolute inset-0 bg-black bg-opacity-50"></div>
				<!-- modal box: full width on small screens, constrained on larger, with max height and scroll -->
				<div class="relative w-full max-w-lg sm:max-w-3xl bg-white rounded-lg shadow-lg overflow-hidden z-10">
					<div class="flex items-start justify-between p-4 border-b">
						<h3 class="text-lg font-semibold">Payment Details</h3>
						<button id="closeModal" class="text-gray-500 hover:text-gray-700"><span class="sr-only">Close</span><i class="bi bi-x-lg text-xl"></i></button>
					</div>
					<div class="p-5 space-y-6 max-h-[80vh] overflow-y-auto">
						<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
							<div class="bg-gray-50 p-4 rounded">
								<p class="text-sm text-gray-500">Total Fees</p>
								<p class="text-xl font-bold">$2,500</p>
							</div>
							<div class="bg-gray-50 p-4 rounded">
								<p class="text-sm text-gray-500">Amount Paid</p>
								<p class="text-xl font-bold text-green-600">$1,500</p>
							</div>
							<div class="bg-gray-50 p-4 rounded">
								<p class="text-sm text-gray-500">Balance Due</p>
								<p class="text-xl font-bold text-red-600">$1,000</p>
							</div>
							<div class="bg-gray-50 p-4 rounded">
								<p class="text-sm text-gray-500">Due Date</p>
								<p class="text-xl font-bold">December 12, 2025</p>
							</div>
						</div>

						<div>
							<h4 class="font-medium mb-2">Payment Breakdown</h4>
							<div class="space-y-3">
								<div class="flex items-center justify-between bg-white border rounded p-3">
									<div>
										<div class="text-sm text-gray-600">Tuition Fee</div>
										<div class="font-medium">$1,800</div>
									</div>
									<div class="text-sm text-gray-600 text-right">
										<div>Paid: $1,200</div>
										<div>Remaining: $600</div>
									</div>
								</div>
								<div class="flex items-center justify-between bg-white border rounded p-3">
									<div>
										<div class="text-sm text-gray-600">Library Fee</div>
										<div class="font-medium">$200</div>
									</div>
									<div class="text-sm text-gray-600 text-right">
										<div>Paid: $200</div>
										<div>Remaining: $0</div>
									</div>
								</div>
								<div class="flex items-center justify-between bg-white border rounded p-3">
									<div>
										<div class="text-sm text-gray-600">Laboratory Fee</div>
										<div class="font-medium">$300</div>
									</div>
									<div class="text-sm text-gray-600 text-right">
										<div>Paid: $100</div>
										<div>Remaining: $200</div>
									</div>
								</div>
							</div>
						</div>

						<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 justify-end">
							<button class="btn-primary bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 focus:outline-none w-full sm:w-auto text-center" id="payBalanceBtn">Pay Remaining Balance</button>
							<button class="btn-secondary border border-gray-200 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-50 w-full sm:w-auto" id="downloadReceiptBtn">Download Receipt</button>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
		<script>
			(function(){
				// Sidebar toggle (keeps existing behaviour)
				const sidebar = document.getElementById('sidebar');
				const toggle = document.getElementById('sidebarToggle');
				if(toggle && sidebar) toggle.addEventListener('click', ()=> sidebar.classList.toggle('hidden'));

				// Modal wiring
				const modal = document.getElementById('paymentModal');
				const modalOverlay = document.getElementById('paymentModalOverlay');
				const viewPaymentBtn = document.getElementById('viewPaymentBtn');
				const closeModal = document.getElementById('closeModal');
				const payBalanceBtn = document.getElementById('payBalanceBtn');
				const downloadReceiptBtn = document.getElementById('downloadReceiptBtn');

				function openModal(){
					if(!modal) return;
					modal.classList.remove('hidden');
					modal.classList.add('flex');
					document.body.style.overflow = 'hidden';
				}

				function closeModalFn(){
					if(!modal) return;
					modal.classList.add('hidden');
					modal.classList.remove('flex');
					document.body.style.overflow = '';
				}

				if(viewPaymentBtn){
					viewPaymentBtn.addEventListener('click', function(e){
						e.preventDefault();
						openModal();
					});
				}

				if(closeModal){
					closeModal.addEventListener('click', closeModalFn);
				}

				if(modalOverlay){
					modalOverlay.addEventListener('click', closeModalFn);
				}

				document.addEventListener('keydown', function(e){
					if(e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModalFn();
				});

				if(payBalanceBtn){
					payBalanceBtn.addEventListener('click', function(){
						alert('Redirecting to payment gateway...\n\nThis would typically open a secure payment form or redirect to a payment processor.');
					});
				}

				if(downloadReceiptBtn){
					downloadReceiptBtn.addEventListener('click', function(){
						alert('Downloading payment receipt...\n\nThis would typically generate and download a PDF receipt.');
					});
				}

			})();
		</script>


</x-Student-sidebar>