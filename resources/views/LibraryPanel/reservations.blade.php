<x-Libray-sidebar>
    <x-slot name="title">Reservation</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Reservations</h1>
            <p class="text-sm text-slate-500 mt-1">Manage book holds and waitlists</p>
        </div>
        <button
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Reservation
        </button>
    </div>

    <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Active Holds</p>
                <p class="text-2xl font-bold text-slate-900">47</p>
            </div>
        </article>

        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Ready for Pickup</p>
                <p class="text-2xl font-bold text-slate-900">8</p>
            </div>
        </article>

        <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.6 20h14.8a2 2 0 001.72-3.34l-7.4-12.8a2 2 0 00-3.43 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Expiring Soon</p>
                <p class="text-2xl font-bold text-slate-900">3</p>
            </div>
        </article>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <article class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-900">All Reservations</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-3">Book</th>
                            <th class="px-6 py-3">Member</th>
                            <th class="px-6 py-3">Queue</th>
                            <th class="px-6 py-3">Reserved</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="Sapiens" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Sapiens</p>
                                        <p class="text-xs text-slate-500">Yuval Noah Harari</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/150?u=4" alt="Emma Davis"
                                        class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Emma Davis</p>
                                        <p class="text-xs text-slate-500">Grade 9</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">1 of 3</td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 11</td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">Ready</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                        title="Fulfill">✓</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Cancel">✕</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1592496431122-2349e0fbc666?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="Atomic Habits" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Atomic Habits</p>
                                        <p class="text-xs text-slate-500">James Clear</p>
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
                            <td class="px-6 py-3 text-sm text-slate-600">1 of 2</td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 10</td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">Ready</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                        title="Fulfill">✓</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Cancel">✕</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="Dune" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Dune</p>
                                        <p class="text-xs text-slate-500">Frank Herbert</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/150?u=2" alt="Sarah Williams"
                                        class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Sarah Williams</p>
                                        <p class="text-xs text-slate-500">Grade 12</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">2 of 4</td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 09</td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">Waiting</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                        title="Fulfill">✓</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Cancel">✕</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="The Great Gatsby" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">The Great Gatsby</p>
                                        <p class="text-xs text-slate-500">F. Scott Fitzgerald</p>
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
                            <td class="px-6 py-3 text-sm text-slate-600">3 of 5</td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 08</td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">Waiting</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                        title="Fulfill">✓</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Cancel">✕</button></div>
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
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=16"
                                        alt="Mia Thompson" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Mia Thompson</p>
                                        <p class="text-xs text-slate-500">Grade 11</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">2 of 3</td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 07</td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">Waiting</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors"
                                        title="Fulfill">✓</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Cancel">✕</button></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </article>

        <article class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                <h2 class="text-base font-semibold text-slate-900">Pickup Queue</h2>
                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-0.5 rounded-full">4</span>
            </div>
            <div class="flex-1 p-3 space-y-1">
                <div class="p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://i.pravatar.cc/150?u=4" alt="Emma Davis"
                            class="w-9 h-9 rounded-full border border-slate-200" />
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Emma Davis</p>
                            <p class="text-xs text-slate-500 truncate">Sapiens</p>
                        </div>
                        <span
                            class="text-[10px] font-medium text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1 shrink-0">⌚
                            2d</span>
                    </div>
                    <button
                        class="w-full py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">Mark
                        Picked Up</button>
                </div>
                <div class="p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://i.pravatar.cc/150?u=3" alt="Michael Chen"
                            class="w-9 h-9 rounded-full border border-slate-200" />
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Michael Chen</p>
                            <p class="text-xs text-slate-500 truncate">Atomic Habits</p>
                        </div>
                        <span
                            class="text-[10px] font-medium text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1 shrink-0">⌚
                            3d</span>
                    </div>
                    <button
                        class="w-full py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">Mark
                        Picked Up</button>
                </div>
                <div class="p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://i.pravatar.cc/150?u=20" alt="Isabella Walker"
                            class="w-9 h-9 rounded-full border border-slate-200" />
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Isabella Walker</p>
                            <p class="text-xs text-slate-500 truncate">Educated</p>
                        </div>
                        <span
                            class="text-[10px] font-medium text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1 shrink-0">⌚
                            1d</span>
                    </div>
                    <button
                        class="w-full py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">Mark
                        Picked Up</button>
                </div>
                <div class="p-3 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="https://i.pravatar.cc/150?u=14" alt="Olivia Martinez"
                            class="w-9 h-9 rounded-full border border-slate-200" />
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Olivia Martinez</p>
                            <p class="text-xs text-slate-500 truncate">Brave New World</p>
                        </div>
                        <span
                            class="text-[10px] font-medium text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded flex items-center gap-1 shrink-0">⌚
                            4d</span>
                    </div>
                    <button
                        class="w-full py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition-colors">Mark
                        Picked Up</button>
                </div>
            </div>
        </article>
    </section>

</x-Libray-sidebar>
