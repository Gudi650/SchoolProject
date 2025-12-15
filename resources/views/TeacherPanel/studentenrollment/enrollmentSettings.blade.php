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

                            <!--toogle sidebar button-->
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

                        <!-- Academic Calendar -->
                        <div class="pt-6">
                            <h2 class="text-lg font-semibold text-university-text mb-4">Academic Calendar</h2>

                            <!-- Hidden JSON payload -->
                            <input type="hidden" name="academic_calendar" id="academic-calendar-json" />

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-university-text mb-1">Academic Year</label>
                                    <input id="academic-year" type="text" placeholder="2025-2026" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                                    <p class="mt-1 text-xs text-gray-500">Example: 2025-2026</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-university-text mb-1">Default Timezone</label>
                                    <input id="academic-timezone" type="text" value="UTC" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
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
    // Simple state
    let terms = [];
    let events = [];

    // Elements
    const termsList = document.getElementById('terms-list');
    const eventsList = document.getElementById('events-list');
    const addTermBtn = document.getElementById('add-term-btn');
    const addEventBtn = document.getElementById('add-event-btn');
    const academicYearEl = document.getElementById('academic-year');
    const academicTimezoneEl = document.getElementById('academic-timezone');
    const calendarJsonEl = document.getElementById('academic-calendar-json');
    const formEl = document.getElementById('settings-form');
    const discardBtn = document.getElementById('discard');

    function renderTerms() {
        termsList.innerHTML = terms.map((t, i) => `
            <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end border border-gray-200 rounded-md p-3">
                <div class="md:col-span-2">
                    <label class="block text-xs text-gray-600 mb-1">Term Name</label>
                    <input type="text" data-type="term" data-field="name" data-index="${i}" value="${t.name || ''}" placeholder="e.g., Fall" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Start Date</label>
                    <input type="date" data-type="term" data-field="start" data-index="${i}" value="${t.start || ''}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">End Date</label>
                    <input type="date" data-type="term" data-field="end" data-index="${i}" value="${t.end || ''}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div class="flex md:justify-end">
                    <button type="button" class="px-3 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md text-sm" onclick="removeTerm(${i})">Remove</button>
                </div>
            </div>
        `).join('') || `<div class="text-sm text-gray-500">No terms added yet.</div>`;
    }

    function renderEvents() {
        eventsList.innerHTML = events.map((e, i) => `
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3 items-end border border-gray-200 rounded-md p-3">
                <div class="md:col-span-2">
                    <label class="block text-xs text-gray-600 mb-1">Title</label>
                    <input type="text" data-type="event" data-field="title" data-index="${i}" value="${e.title || ''}" placeholder="e.g., Winter Break" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Date</label>
                    <input type="date" data-type="event" data-field="date" data-index="${i}" value="${e.date || ''}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Type</label>
                    <select data-type="event" data-field="type" data-index="${i}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border">
                        <option ${e.type==='Holiday'?'selected':''}>Holiday</option>
                        <option ${e.type==='Break'?'selected':''}>Break</option>
                        <option ${e.type==='Exam'?'selected':''}>Exam</option>
                        <option ${e.type==='Orientation'?'selected':''}>Orientation</option>
                        <option ${e.type==='Other'?'selected':''}>Other</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs text-gray-600 mb-1">Notes</label>
                    <input type="text" data-type="event" data-field="notes" data-index="${i}" value="${e.notes || ''}" placeholder="Optional details" class="w-full rounded-md border-gray-300 shadow-sm focus:border-university-burgundy focus:ring-university-burgundy sm:text-sm p-2 border" />
                </div>
                <div class="flex md:justify-end">
                    <button type="button" class="px-3 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md text-sm" onclick="removeEvent(${i})">Remove</button>
                </div>
            </div>
        `).join('') || `<div class="text-sm text-gray-500">No events added yet.</div>`;
    }

    // Public remove ops
    window.removeTerm = (i) => { terms.splice(i,1); renderTerms(); };
    window.removeEvent = (i) => { events.splice(i,1); renderEvents(); };

    // Add ops
    addTermBtn?.addEventListener('click', () => {
        terms.push({ name: '', start: '', end: '' });
        renderTerms();
    });
    addEventBtn?.addEventListener('click', () => {
        events.push({ title: '', date: '', type: 'Holiday', notes: '' });
        renderEvents();
    });

    // Change delegation
    document.addEventListener('input', (e) => {
        const el = e.target;
        const type = el.getAttribute('data-type');
        const field = el.getAttribute('data-field');
        const index = parseInt(el.getAttribute('data-index'), 10);
        if (type === 'term' && !Number.isNaN(index)) {
            terms[index][field] = el.value;
        }
        if (type === 'event' && !Number.isNaN(index)) {
            events[index][field] = el.value;
        }
    });

    // Basic validation
    function validateTerms() {
        for (const t of terms) {
            if (!t.name || !t.start || !t.end) return false;
            if (t.end < t.start) return false;
        }
        return true;
    }

    // Submit: pack JSON
    formEl?.addEventListener('submit', () => {
        const payload = {
            academicYear: academicYearEl?.value?.trim() || '',
            timezone: academicTimezoneEl?.value?.trim() || 'UTC',
            terms,
            events
        };
        // optionally ensure validity; you can add blocking logic if needed
        calendarJsonEl.value = JSON.stringify(payload);
    });

    // Discard: reset the calendar section
    discardBtn?.addEventListener('click', () => {
        academicYearEl.value = '';
        academicTimezoneEl.value = 'UTC';
        terms = [];
        events = [];
        renderTerms();
        renderEvents();
    });

    // Initialize defaults
    (function init() {
        // If editing existing data, parse it
        try {
            const existing = calendarJsonEl.value ? JSON.parse(calendarJsonEl.value) : null;
            if (existing) {
                academicYearEl.value = existing.academicYear || '';
                academicTimezoneEl.value = existing.timezone || 'UTC';
                terms = Array.isArray(existing.terms) ? existing.terms : [];
                events = Array.isArray(existing.events) ? existing.events : [];
            }
        } catch {}
        // Seed with one empty row if none
        if (!terms.length) terms = [{ name: 'Fall', start: '', end: '' }];
        if (!events.length) events = [{ title: 'Winter Break', date: '', type: 'Break', notes: '' }];
        renderTerms();
        renderEvents();
    })();
</script>

</x-Teacher-sidebar>