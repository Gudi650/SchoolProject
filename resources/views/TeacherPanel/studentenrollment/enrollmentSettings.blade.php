<x-Teacher-sidebar>

    <style>
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-in;
        }
    </style>
    
    <!-- Fallback university color utilities -->
    <style>
        :root{
            --univ-burgundy: #5B4BFF;
            --univ-gold: #B8860B;
            --univ-cream: #FDFBF7;
            --univ-gray: #F4F4F4;
            --univ-text: #2D2D2D;
        }
        .bg-university-cream{ background-color:var(--univ-cream) !important; }
        .text-university-text{ color:var(--univ-text) !important; }
        .bg-university-burgundy{ background-color:var(--univ-burgundy) !important; }
        .text-university-burgundy{ color:var(--univ-burgundy) !important; }
        .bg-university-gray{ background-color:var(--univ-gray) !important; }
        .border-university-gold{ border-color:var(--univ-gold) !important; }
        .bg-university-gold\/10{ background-color: rgba(184,134,11,0.10) !important; }
        .bg-university-burgundy\/10{ background-color: rgba(91,75,255,0.10) !important; }
        .bg-university-burgundy\/50{ background-color: rgba(91,75,255,0.50) !important; }
        .font-sans { font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial !important; }
        .bg-gray-50{ background-color:#F9FAFB !important; }
        /* fallback for red button styles */
        .bg-red-100{ background-color:#FEE2E2 !important; }
        .bg-red-200{ background-color:#FECACA !important; }
        .text-red-700{ color:#B91C1C !important; }
        </style>

        <!-- Main Content -->
        <main class="flex-1 w-full overflow-y-auto h-screen md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
            <div class="w-full max-w-7xl mx-auto">
                <div class="w-full">
                    <!-- Page Header (styled banner like example) -->
                    <div class="mb-8">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex items-center justify-between gap-4 border-l-4 border-university-burgundy">

                            <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded"> 
                            <i class="bi bi-list"></i> 
                            </button>

                            <div>

                                <h1 class="text-2xl font-serif font-bold text-university-burgundy">Settings</h1>
                                <p class="text-sm text-gray-500 mt-1">Manage academic parameters, tuition structures, and enrollment capacities.</p>

                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-right hidden sm:block">
                                    <p class="text-xs text-gray-500 uppercase">Today</p>
                                    <p class="text-sm font-medium text-gray-600">
                                        {{ now()->format('M j, Y') }}
                                    </p>
                                </div>
                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-university-burgundy text-white font-medium shadow-sm">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 20c0-3.31 2.69-6 6-6s6 2.69 6 6" />
                                    </svg>
                                    Profile
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Form (mirrors html/settings.html) -->
                    <form id="settings-form" class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 space-y-6">
                        <!-- Enrollment -->
                        <div>
                            <h2 class="text-lg font-semibold text-university-text mb-4">Enrollment Capacity</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-university-text mb-1">Maximum Student Capacity</label>
                                    <input id="capacity" type="number" value="1500" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                                    <p class="mt-1 text-xs text-gray-500">Total headcount including all departments.</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-university-text mb-1">Waitlist Buffer (%)</label>
                                    <input id="waitlist" type="number" value="15" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                                </div>
                            </div>
                        </div>

                        

                        <!-- Application Submission Pricing -->
                        <div>
                            <h2 class="text-lg font-semibold text-university-text mb-4">Application Submission</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="require-payment" class="block text-sm font-medium text-university-text mb-1">Require Payment Before Submission</label>
                                    <div class="flex items-center gap-3">
                                        <input id="require-payment" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-university-burgundy focus:ring-university-burgundy" checked>
                                        <span class="text-sm text-gray-600">Applicants must pay before submitting applications.</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="submission-fee" class="block text-sm font-medium text-university-text mb-1">Submission Fee per Student</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><span class="text-gray-500 sm:text-sm">$</span></div>
                                        <input id="submission-fee" type="number" min="0" step="1" value="50" class="w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Amount charged per student to submit an application.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="pt-4 border-t border-gray-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                        <button id="discard" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-800 font-medium rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            Discard Changes
                                        </button>
                                <div class="text-sm">
                                    <span id="success-message" class="text-green-600 font-medium animate-fade-in hidden">Settings saved successfully!</span>
                                </div>
                            </div>
                            <div>
                                <button id="save-btn" type="submit" class="inline-flex items-center justify-center bg-university-burgundy hover:bg-university-burgundy/90 text-white px-6 py-2 rounded-md shadow-sm font-medium gap-2 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V7l-4-4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M7 3v4h6V3" />
                                    </svg>
                                    Save Configuration
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>


    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Form submission
        const settingsForm = document.getElementById('settings-form');
        const saveBtn = document.getElementById('save-btn');
        const successMessage = document.getElementById('success-message');

        settingsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            saveBtn.disabled = true;
            saveBtn.innerHTML = `
                <span class="flex items-center gap-2">
                    <div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                    Saving...
                </span>
            `;

            // Simulate API call
            setTimeout(() => {
                // Reset button
                saveBtn.disabled = false;
                saveBtn.innerHTML = `
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Save Changes
                `;

                // Show success message
                successMessage.classList.remove('hidden');

                // Hide success message after 3 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 3000);
            }, 1000);
        });
    </script>

</x-Teacher-sidebar>