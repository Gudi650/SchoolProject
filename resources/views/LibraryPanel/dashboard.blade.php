<x-Libray-sidebar>
    <x-slot name="title">Dashboard</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Good morning, Ms. Carter</h1>
            <p class="text-sm text-slate-500 mt-1">Saturday, May 30, 2026</p>
        </div>
        <a href="./loans.html"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
            </svg>
            Check out book
        </a>
    </div>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
        <article class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between">
            <h3 class="text-sm font-medium text-slate-500">Total Books</h3>
            <div class="mt-2 flex items-baseline gap-3">
                <span class="text-3xl font-bold text-slate-900">12,847</span>
                <span class="text-xs font-medium flex items-center gap-0.5 text-emerald-600">▲ 124 this month</span>
            </div>
        </article>
        <article class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between">
            <h3 class="text-sm font-medium text-slate-500">Active Loans</h3>
            <div class="mt-2 flex items-baseline gap-3">
                <span class="text-3xl font-bold text-slate-900">342</span>
                <span class="text-xs font-medium flex items-center gap-0.5 text-emerald-600">▲ 12 this week</span>
            </div>
        </article>
        <article
            class="bg-white rounded-xl p-5 border shadow-sm flex flex-col justify-between border-amber-200 bg-amber-50/30">
            <h3 class="text-sm font-medium text-slate-500">Overdue</h3>
            <div class="mt-2 flex items-baseline gap-3">
                <span class="text-3xl font-bold text-amber-600">28</span>
                <span class="text-xs font-medium flex items-center gap-0.5 text-slate-500">▼ 3 since yesterday</span>
            </div>
        </article>
        <article class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between">
            <h3 class="text-sm font-medium text-slate-500">Active Members</h3>
            <div class="mt-2 flex items-baseline gap-3">
                <span class="text-3xl font-bold text-slate-900">1,204</span>
                <span class="text-xs font-medium flex items-center gap-0.5 text-emerald-600">▲ 8 this month</span>
            </div>
        </article>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
        <article
            class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm flex flex-col h-full min-h-[350px] lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-base font-semibold text-slate-900">Borrowing Trends</h2>
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button
                        class="px-3 py-1 text-xs font-medium rounded-md text-slate-500 hover:text-slate-700">Week</button>
                    <button
                        class="px-3 py-1 text-xs font-medium rounded-md bg-white text-slate-900 shadow-sm">Month</button>
                    <button
                        class="px-3 py-1 text-xs font-medium rounded-md text-slate-500 hover:text-slate-700">Year</button>
                </div>
            </div>
            <div class="flex-1 w-full h-full min-h-[250px]">
                <svg viewBox="0 0 600 240" class="w-full h-full">
                    <defs>
                        <linearGradient id="checkoutsFill" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stop-color="#4f46e5" stop-opacity="0.1" />
                            <stop offset="95%" stop-color="#4f46e5" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient id="returnsFill" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stop-color="#94a3b8" stop-opacity="0.1" />
                            <stop offset="95%" stop-color="#94a3b8" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <g stroke="#e2e8f0" stroke-dasharray="3 3">
                        <line x1="40" y1="30" x2="560" y2="30" />
                        <line x1="40" y1="80" x2="560" y2="80" />
                        <line x1="40" y1="130" x2="560" y2="130" />
                        <line x1="40" y1="180" x2="560" y2="180" />
                    </g>
                    <path d="M40 160 L120 120 L200 145 L280 100 L360 135 L440 110 L520 85 L560 92 L560 210 L40 210 Z"
                        fill="url(#checkoutsFill)" />
                    <path d="M40 145 L120 155 L200 105 L280 140 L360 130 L440 150 L520 135 L560 140" fill="none"
                        stroke="#4f46e5" stroke-width="3" />
                    <path d="M40 178 L120 185 L200 170 L280 160 L360 165 L440 158 L520 150 L560 155" fill="none"
                        stroke="#94a3b8" stroke-width="3" />
                    <g fill="#64748b" font-size="12">
                        <text x="28" y="214">0</text>
                        <text x="25" y="164">1k</text>
                        <text x="22" y="114">2k</text>
                        <text x="22" y="64">3k</text>
                        <text x="38" y="230">Jan</text><text x="122" y="230">Feb</text><text x="204"
                            y="230">Mar</text><text x="288" y="230">Apr</text><text x="370" y="230">May</text><text
                            x="454" y="230">Jun</text>
                    </g>
                </svg>
            </div>
        </article>

        <article class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm h-full">
            <h2 class="text-base font-semibold text-slate-900 mb-6">Top Categories</h2>
            <div class="space-y-5">
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm"><span
                            class="font-medium text-slate-700">Fiction</span><span class="text-slate-500">4,230</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width:85%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm"><span
                            class="font-medium text-slate-700">Science</span><span class="text-slate-500">2,104</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width:60%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm"><span
                            class="font-medium text-slate-700">History</span><span class="text-slate-500">1,840</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width:45%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm"><span
                            class="font-medium text-slate-700">Biography</span><span
                            class="text-slate-500">1,205</span></div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width:30%"></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center text-sm"><span
                            class="font-medium text-slate-700">Reference</span><span class="text-slate-500">840</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width:15%"></div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
        <article class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200 flex justify-between items-center">
                <h2 class="text-base font-semibold text-slate-900">Recent Checkouts</h2>
                <button class="text-sm font-medium text-indigo-600 hover:text-indigo-700">View all</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-3">Book</th>
                            <th class="px-6 py-3">Borrower</th>
                            <th class="px-6 py-3">Checked Out</th>
                            <th class="px-6 py-3">Due Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="To Kill a Mockingbird"
                                        class="w-10 h-14 object-cover rounded shadow-sm" />
                                    <div>
                                        <p
                                            class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            To Kill a Mockingbird</p>
                                        <p class="text-xs text-slate-500">Harper Lee</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=1"
                                        alt="Alex Johnson" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Alex Johnson</p>
                                        <p class="text-xs text-slate-500">Grade 10</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">Today, 09:41 AM</td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 24, 2023</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="The Great Gatsby" class="w-10 h-14 object-cover rounded shadow-sm" />
                                    <div>
                                        <p
                                            class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            The Great Gatsby</p>
                                        <p class="text-xs text-slate-500">F. Scott Fitzgerald</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=2"
                                        alt="Sarah Williams" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Sarah Williams</p>
                                        <p class="text-xs text-slate-500">Grade 12</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">Today, 08:30 AM</td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 24, 2023</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1535905557558-afc4877a26fc?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="1984" class="w-10 h-14 object-cover rounded shadow-sm" />
                                    <div>
                                        <p
                                            class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            1984</p>
                                        <p class="text-xs text-slate-500">George Orwell</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=3"
                                        alt="Michael Chen" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Michael Chen</p>
                                        <p class="text-xs text-slate-500">Grade 11</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">Yesterday</td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 23, 2023</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="Sapiens" class="w-10 h-14 object-cover rounded shadow-sm" />
                                    <div>
                                        <p
                                            class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            Sapiens</p>
                                        <p class="text-xs text-slate-500">Yuval Noah Harari</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=4"
                                        alt="Emma Davis" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">Emma Davis</p>
                                        <p class="text-xs text-slate-500">Grade 9</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">Yesterday</td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 23, 2023</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors cursor-pointer group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=100&h=150"
                                        alt="Dune" class="w-10 h-14 object-cover rounded shadow-sm" />
                                    <div>
                                        <p
                                            class="text-sm font-medium text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            Dune</p>
                                        <p class="text-xs text-slate-500">Frank Herbert</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3"><img src="https://i.pravatar.cc/150?u=5"
                                        alt="James Wilson" class="w-8 h-8 rounded-full border border-slate-200" />
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">James Wilson</p>
                                        <p class="text-xs text-slate-500">Grade 12</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 08, 2023</td>
                            <td class="px-6 py-4 text-sm text-slate-600">Oct 22, 2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </article>

        <article class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col h-full">
            <div class="p-6 border-b border-slate-200 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <h2 class="text-base font-semibold text-slate-900">Overdue Returns</h2><span
                        class="bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded-full">28</span>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-2">
                <div
                    class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-lg transition-colors group">
                    <div class="flex items-center gap-3 overflow-hidden"><img src="https://i.pravatar.cc/150?u=11"
                            alt="David Miller" class="w-10 h-10 rounded-full border border-slate-200 shrink-0" />
                        <div class="overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">David Miller</p>
                            <p class="text-xs text-slate-500 truncate">The Catcher in the Rye</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0 ml-2"><span
                            class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-md">12d
                            late</span><button
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                            title="Send reminder">↗</button></div>
                </div>
                <div
                    class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-lg transition-colors group">
                    <div class="flex items-center gap-3 overflow-hidden"><img src="https://i.pravatar.cc/150?u=12"
                            alt="Sophia Taylor" class="w-10 h-10 rounded-full border border-slate-200 shrink-0" />
                        <div class="overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Sophia Taylor</p>
                            <p class="text-xs text-slate-500 truncate">Brave New World</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0 ml-2"><span
                            class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-md">8d
                            late</span><button
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                            title="Send reminder">↗</button></div>
                </div>
                <div
                    class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-lg transition-colors group">
                    <div class="flex items-center gap-3 overflow-hidden"><img src="https://i.pravatar.cc/150?u=13"
                            alt="Lucas Anderson" class="w-10 h-10 rounded-full border border-slate-200 shrink-0" />
                        <div class="overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Lucas Anderson</p>
                            <p class="text-xs text-slate-500 truncate">Lord of the Flies</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0 ml-2"><span
                            class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-md">5d
                            late</span><button
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                            title="Send reminder">↗</button></div>
                </div>
                <div
                    class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-lg transition-colors group">
                    <div class="flex items-center gap-3 overflow-hidden"><img src="https://i.pravatar.cc/150?u=14"
                            alt="Olivia Martinez" class="w-10 h-10 rounded-full border border-slate-200 shrink-0" />
                        <div class="overflow-hidden">
                            <p class="text-sm font-medium text-slate-900 truncate">Olivia Martinez</p>
                            <p class="text-xs text-slate-500 truncate">Fahrenheit 451</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0 ml-2"><span
                            class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-md">2d
                            late</span><button
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                            title="Send reminder">↗</button></div>
                </div>
            </div>
            <div class="p-4 border-t border-slate-200"><button
                    class="w-full py-2 text-sm font-medium text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors border border-slate-200">View
                    all overdue</button></div>
        </article>
    </section>

    <section class="pt-2">
        <h2 class="text-sm font-semibold text-slate-900 mb-4 uppercase tracking-wider">Quick Actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="./loans.html"
                class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-xl shadow-sm transition-all hover:bg-indigo-50 hover:border-indigo-200 group">
                <div
                    class="p-3 rounded-xl bg-indigo-50 text-indigo-600 mb-3 group-hover:scale-110 transition-transform">
                    ⇄</div><span class="text-sm font-medium text-slate-700">Check Out</span>
            </a>
            <a href="./loans.html"
                class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-xl shadow-sm transition-all hover:bg-emerald-50 hover:border-emerald-200 group">
                <div
                    class="p-3 rounded-xl bg-emerald-50 text-emerald-600 mb-3 group-hover:scale-110 transition-transform">
                    ↩</div><span class="text-sm font-medium text-slate-700">Return Book</span>
            </a>
            <a href="./catalog.html"
                class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-xl shadow-sm transition-all hover:bg-blue-50 hover:border-blue-200 group">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mb-3 group-hover:scale-110 transition-transform">+
                </div><span class="text-sm font-medium text-slate-700">Add to Catalog</span>
            </a>
            <a href="./members.html"
                class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-xl shadow-sm transition-all hover:bg-purple-50 hover:border-purple-200 group">
                <div
                    class="p-3 rounded-xl bg-purple-50 text-purple-600 mb-3 group-hover:scale-110 transition-transform">
                    ◎</div><span class="text-sm font-medium text-slate-700">Register Member</span>
            </a>
        </div>
    </section>


</x-Libray-sidebar>
