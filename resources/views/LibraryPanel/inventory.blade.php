<x-Libray-sidebar>
    <x-slot name="title">Inventory</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Inventory</h1>
            <p class="text-sm text-slate-500 mt-1">Track copies, conditions, and locations</p>
        </div>
        <button
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Stock
        </button>
    </div>

    <div class="space-y-6">
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" viewBox="0 0 24 24"
                fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.6 20h14.8a2 2 0 001.72-3.34l-7.4-12.8a2 2 0 00-3.43 0z" />
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium text-amber-900">3 titles are running low on stock</p>
                <button
                    type="button"
                    data-tab-button="low-stock"
                    class="text-xs font-medium text-amber-700 hover:text-amber-900 underline underline-offset-2 mt-0.5">View
                    low stock items</button>
            </div>
            <button class="p-1 text-amber-600 hover:bg-amber-100 rounded-md transition-colors">✕</button>
        </div>

        <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0v10l-8 4m8-14l-8 4m-8-4v10l8 4m0-10v10" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Copies</p>
                    <p class="text-2xl font-bold text-slate-900">15,420</p>
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
                    <p class="text-sm font-medium text-slate-500">Low Stock</p>
                    <p class="text-2xl font-bold text-slate-900">3</p>
                </div>
            </article>

            <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 rounded-lg bg-red-50 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Damaged</p>
                    <p class="text-2xl font-bold text-slate-900">34</p>
                </div>
            </article>

            <article class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.983 5.5l1.867-1.867 2.384 2.384-1.867 1.867m-2.384-2.384L6.25 11.233m0 0L4.5 18l6.767-1.75m-5.017-5.017l5.017 5.017" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">In Repair</p>
                    <p class="text-2xl font-bold text-slate-900">8</p>
                </div>
            </article>
        </section>

        <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="border-b border-slate-200 flex overflow-x-auto">
                <button
                    type="button"
                    data-tab-button="all"
                    class="px-5 py-3 text-sm font-medium border-b-2 border-indigo-600 text-indigo-700 whitespace-nowrap">All
                    Stock <span class="ml-1 text-xs text-slate-400">(12)</span></button>
                <button
                    type="button"
                    data-tab-button="low-stock"
                    class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 whitespace-nowrap">Low
                    Stock <span class="ml-1 text-xs text-slate-400">(3)</span></button>
                <button
                    type="button"
                    data-tab-button="damaged"
                    class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 whitespace-nowrap">Damaged
                    <span class="ml-1 text-xs text-slate-400">(2)</span></button>
                <button
                    type="button"
                    data-tab-button="repair"
                    class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 whitespace-nowrap">In
                    Repair <span class="ml-1 text-xs text-slate-400">(2)</span></button>
            </div>

            <div class="overflow-x-auto" data-tab-panel="all">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-xs font-medium text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-3">Book</th>
                            <th class="px-6 py-3">ISBN</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Available</th>
                            <th class="px-6 py-3">Location</th>
                            <th class="px-6 py-3">Condition</th>
                            <th class="px-6 py-3">Last Audit</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=200"
                                        alt="To Kill a Mockingbird" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <p class="text-sm font-medium text-slate-900">To Kill a Mockingbird</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600 font-mono">978-0061120084</td>
                            <td class="px-6 py-3 text-sm text-slate-600">5</td>
                            <td class="px-6 py-3"><span class="text-sm font-medium text-slate-700">2</span></td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded">A-12-03</span>
                            </td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-blue-50 text-blue-700">Good</span>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 02, 2023</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Edit">✎</button><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Move">⇄</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Mark damaged">⨯</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1535905557558-afc4877a26fc?auto=format&fit=crop&q=80&w=200"
                                        alt="1984" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <p class="text-sm font-medium text-slate-900">1984</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600 font-mono">978-0451524935</td>
                            <td class="px-6 py-3 text-sm text-slate-600">6</td>
                            <td class="px-6 py-3"><span class="text-sm font-medium text-amber-600">1</span></td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded">A-12-04</span>
                            </td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-700">Fair</span>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 01, 2023</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Edit">✎</button><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Move">⇄</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Mark damaged">⨯</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&q=80&w=200"
                                        alt="The Great Gatsby" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <p class="text-sm font-medium text-slate-900">The Great Gatsby</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600 font-mono">978-0743273565</td>
                            <td class="px-6 py-3 text-sm text-slate-600">4</td>
                            <td class="px-6 py-3"><span class="text-sm font-medium text-red-600">0</span></td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded">A-12-05</span>
                            </td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-red-50 text-red-700">Damaged</span>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">Sep 28, 2023</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Edit">✎</button><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Move">⇄</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Mark damaged">⨯</button></div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3"><img
                                        src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=200"
                                        alt="Sapiens" class="w-9 h-12 object-cover rounded shadow-sm" />
                                    <p class="text-sm font-medium text-slate-900">Sapiens</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600 font-mono">978-0062316097</td>
                            <td class="px-6 py-3 text-sm text-slate-600">4</td>
                            <td class="px-6 py-3"><span class="text-sm font-medium text-slate-700">3</span></td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded">C-04-12</span>
                            </td>
                            <td class="px-6 py-3"><span
                                    class="text-xs font-medium px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">Excellent</span>
                            </td>
                            <td class="px-6 py-3 text-sm text-slate-600">Oct 05, 2023</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-1"><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Edit">✎</button><button
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors"
                                        title="Move">⇄</button><button
                                        class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors"
                                        title="Mark damaged">⨯</button></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="hidden" data-tab-panel="low-stock">
                @include('LibraryPanel.inventory.low-stock')
            </div>

            <div class="hidden" data-tab-panel="damaged">
                @include('LibraryPanel.inventory.damaged')
            </div>

            <div class="hidden p-6 text-sm text-slate-500" data-tab-panel="repair">
                Items sent for repair will appear here.
            </div>
        </section>
    </div>

    <script>
        (function () {
            var tabButtons = document.querySelectorAll('[data-tab-button]');
            var tabPanels = document.querySelectorAll('[data-tab-panel]');

            function activateTab(tabName) {
                tabButtons.forEach(function (button) {
                    var isActive = button.getAttribute('data-tab-button') === tabName;
                    button.classList.toggle('border-indigo-600', isActive);
                    button.classList.toggle('text-indigo-700', isActive);
                    button.classList.toggle('border-transparent', !isActive);
                    button.classList.toggle('text-slate-500', !isActive);
                });

                tabPanels.forEach(function (panel) {
                    panel.classList.toggle('hidden', panel.getAttribute('data-tab-panel') !== tabName);
                });
            }

            tabButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    activateTab(button.getAttribute('data-tab-button'));
                });
            });

            activateTab('all');
        })();
    </script>

</x-Libray-sidebar>
