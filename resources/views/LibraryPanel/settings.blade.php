<x-Libray-sidebar>
    <x-slot name="title">Settings</x-slot>

    <div class="mb-8">
        <h1 class="text-2xl font-bold">Settings</h1>
        <p class="text-sm text-slate-500">Manage account and library preferences</p>
    </div>
    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 flex overflow-x-auto text-sm">
            <button
                class="px-5 py-3 text-sm font-medium border-b-2 border-indigo-600 text-indigo-700 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="3"></circle>
                    <path d="M20.24 20.24a8 8 0 0 0-16.48 0"></path>
                </svg>
                Profile
            </button>
            <button class="px-5 py-3 text-sm text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="14" rx="2"></rect>
                </svg>
                Library
            </button>
            <button class="px-5 py-3 text-sm text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8a6 6 0 0 0-12 0"></path>
                    <path d="M6 20h12"></path>
                </svg>
                Notifications
            </button>
            <button class="px-5 py-3 text-sm text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <path d="M7 10l5-3 5 3"></path>
                </svg>
                Loan Rules
            </button>
            <button class="px-5 py-3 text-sm text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 20h5V10"></path>
                    <path d="M2 20h5V4"></path>
                </svg>
                Members
            </button>
            <button class="px-5 py-3 text-sm text-slate-500 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10h-6"></path>
                    <path d="M3 6h18"></path>
                </svg>
                Integrations
            </button>
        </div>

        <div class="p-6 lg:p-8 max-w-2xl">
            <!-- Profile tab (active) -->
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="avatar"
                        class="w-16 h-16 rounded-full border border-slate-200" />
                    <div class="flex items-center gap-3">
                        <button
                            class="px-3 py-1.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">Change
                            photo</button>
                        <span
                            class="inline-block text-xs font-medium text-indigo-700 bg-indigo-50 px-2 py-1 rounded">Head
                            Librarian</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Full name</label>
                    <input type="text" value="Ms. Carter"
                        class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="email" value="carter@school.edu"
                        class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                    <div><span
                            class="inline-block text-xs font-medium text-indigo-700 bg-indigo-50 px-2 py-1 rounded">Head
                            Librarian</span></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Language</label>
                    <select
                        class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        <option>English</option>
                        <option>Spanish</option>
                        <option>French</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Timezone</label>
                    <select
                        class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        <option>America/New_York</option>
                        <option>America/Los_Angeles</option>
                        <option>Europe/London</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <button
                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Save
                        changes</button>
                </div>
            </div>

</x-Libray-sidebar>
