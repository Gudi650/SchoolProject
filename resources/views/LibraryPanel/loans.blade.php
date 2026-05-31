<x-Libray-sidebar>
    <x-slot name="title">Loans</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Loans & Returns</h1>
            <p class="text-sm text-slate-500 mt-1">Track active loans, returns, and overdue items</p>
        </div>
        <div class="flex gap-2">
            <button
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h7l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                </svg>
                Return Book
            </button>
            <button
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Check Out
            </button>
        </div>
    </div>

    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0l-8 5-8-5m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Active Loans</p>
                <p class="text-2xl font-bold text-slate-900">342</p>
            </div>
        </article>

        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m5-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Due Today</p>
                <p class="text-2xl font-bold text-slate-900">18</p>
            </div>
        </article>

        <article
            class="bg-white p-5 rounded-xl border shadow-sm flex items-center gap-4 border-amber-200 bg-amber-50/30">
            <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.6 20h14.8a2 2 0 001.72-3.34l-7.4-12.8a2 2 0 00-3.43 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Overdue</p>
                <p class="text-2xl font-bold text-amber-600">28</p>
            </div>
        </article>

        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-slate-100 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Returned Today</p>
                <p class="text-2xl font-bold text-slate-900">47</p>
            </div>
        </article>
    </section>

    <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="border-b border-slate-200 flex">
            <button class="px-5 py-3 text-sm font-medium border-b-2 border-indigo-600 text-indigo-700">All</button>
            <button
                class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700">Active</button>
            <button
                class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700">Overdue</button>
            <button
                class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700">Returned</button>
        </div>

        <div class="p-4 border-b border-slate-200">
            <div class="relative max-w-md">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <input type="text" placeholder="Search book or borrower..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-xs font-medium text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3">Book</th>
                        <th class="px-6 py-3">Borrower</th>
                        <th class="px-6 py-3">Checked Out</th>
                        <th class="px-6 py-3">Due Date</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=100&h=150"
                                    alt="To Kill a Mockingbird" class="w-9 h-12 object-cover rounded shadow-sm" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">To Kill a Mockingbird</p>
                                    <p class="text-xs text-slate-500">Harper Lee</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?u=1" alt="Alex Johnson"
                                    class="w-8 h-8 rounded-full border border-slate-200" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Alex Johnson</p>
                                    <p class="text-xs text-slate-500">Grade 10</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 10</td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 24</td>
                        <td class="px-6 py-3"><span
                                class="text-xs font-medium px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">Active</span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-1"><button
                                    class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                    title="Return">↩</button><button
                                    class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                    title="Renew">↻</button></div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://images.unsplash.com/photo-1535905557558-afc4877a26fc?auto=format&fit=crop&q=80&w=100&h=150"
                                    alt="1984" class="w-9 h-12 object-cover rounded shadow-sm" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">1984</p>
                                    <p class="text-xs text-slate-500">George Orwell</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?u=3" alt="Michael Chen"
                                    class="w-8 h-8 rounded-full border border-slate-200" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Michael Chen</p>
                                    <p class="text-xs text-slate-500">Grade 11</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 09</td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 23</td>
                        <td class="px-6 py-3"><span
                                class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">Due
                                Soon</span></td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-1"><button
                                    class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                    title="Return">↩</button><button
                                    class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                    title="Renew">↻</button></div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=100&h=150"
                                    alt="The Catcher in the Rye" class="w-9 h-12 object-cover rounded shadow-sm" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">The Catcher in the Rye</p>
                                    <p class="text-xs text-slate-500">J.D. Salinger</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=11"
                                    alt="David Miller" class="w-8 h-8 rounded-full border border-slate-200" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">David Miller</p>
                                    <p class="text-xs text-slate-500">Grade 9</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-slate-600">Sep 28</td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 12</td>
                        <td class="px-6 py-3"><span
                                class="text-xs font-medium px-2 py-0.5 rounded-md bg-red-50 text-red-700">Overdue</span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-1"><button
                                    class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                    title="Return">↩</button><button
                                    class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                    title="Renew">↻</button><button
                                    class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                    title="Send reminder">⚑</button></div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3"><img
                                    src="https://images.unsplash.com/photo-1621351183012-e2f9972dd9bf?auto=format&fit=crop&q=80&w=100&h=150"
                                    alt="The Hobbit" class="w-9 h-12 object-cover rounded shadow-sm" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">The Hobbit</p>
                                    <p class="text-xs text-slate-500">J.R.R. Tolkien</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=15"
                                    alt="Noah Brown" class="w-8 h-8 rounded-full border border-slate-200" />
                                <div>
                                    <p class="text-sm font-medium text-slate-900">Noah Brown</p>
                                    <p class="text-xs text-slate-500">Grade 7</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-sm text-slate-600">Sep 25</td>
                        <td class="px-6 py-3 text-sm text-slate-600">Oct 09</td>
                        <td class="px-6 py-3"><span
                                class="text-xs font-medium px-2 py-0.5 rounded-md bg-slate-100 text-slate-600">Returned</span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-1"><button
                                    class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                    title="Return">↩</button><button
                                    class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                    title="Renew">↻</button></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

</x-Libray-sidebar>
