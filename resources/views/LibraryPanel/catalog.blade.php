<x-Libray-sidebar>
    <x-slot name="title">Catalog</x-slot>

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold">Book Catalog</h1>
            <p class="text-sm text-slate-500 mt-1">Browse and manage your library's collection</p>
        </div>
        <button
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-brand-600 text-white text-sm font-medium rounded-lg hover:bg-brand-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Book
        </button>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 mb-6 flex flex-col lg:flex-row gap-3">
        <div class="relative flex-1">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <input type="text" placeholder="Search by title, author, or ISBN..."
                class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" />
        </div>

        <select class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm">
            <option>All</option>
            <option>Fiction</option>
            <option>Science</option>
            <option>History</option>
            <option>Biography</option>
        </select>

        <select class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm">
            <option value="all">All status</option>
            <option value="available">Available</option>
            <option value="unavailable">Checked out</option>
        </select>

        <div class="flex bg-slate-100 p-1 rounded-lg">
            <button class="p-1.5 rounded-md transition-colors bg-white shadow-sm text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <button class="p-1.5 rounded-md text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4h18v6H3zM3 10h18v10H3z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="text-xs text-slate-500 mb-4">18 books found</div>

    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800"
                    alt="To Kill a Mockingbird"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
            </div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    To Kill a Mockingbird</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">Harper Lee</p>
                <div class="flex items-center justify-between mt-2.5">
                    <span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Fiction</span>
                    <div class="flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span class="text-[10px] text-slate-500">2/5</span>
                    </div>
                </div>
            </div>
        </article>

        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden"><img
                    src="https://images.unsplash.com/photo-1535905557558-afc4877a26fc?auto=format&fit=crop&q=80&w=800"
                    alt="1984"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /></div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    1984</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">George Orwell</p>
                <div class="flex items-center justify-between mt-2.5"><span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Fiction</span>
                    <div class="flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-amber-500"></span><span
                            class="text-[10px] text-slate-500">1/6</span></div>
                </div>
            </div>
        </article>

        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden"><img
                    src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=800"
                    alt="Sapiens"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /></div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    Sapiens</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">Yuval Noah Harari</p>
                <div class="flex items-center justify-between mt-2.5"><span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">History</span>
                    <div class="flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span
                            class="text-[10px] text-slate-500">3/4</span></div>
                </div>
            </div>
        </article>

        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden"><img
                    src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?auto=format&fit=crop&q=80&w=800"
                    alt="Dune"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /></div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    Dune</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">Frank Herbert</p>
                <div class="flex items-center justify-between mt-2.5"><span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Fiction</span>
                    <div class="flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span
                            class="text-[10px] text-slate-500">2/3</span></div>
                </div>
            </div>
        </article>

        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden"><img
                    src="https://images.unsplash.com/photo-1592496431122-2349e0fbc666?auto=format&fit=crop&q=80&w=800"
                    alt="Atomic Habits"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /></div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    Atomic Habits</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">James Clear</p>
                <div class="flex items-center justify-between mt-2.5"><span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Reference</span>
                    <div class="flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span
                            class="text-[10px] text-slate-500">4/6</span></div>
                </div>
            </div>
        </article>

        <article
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
            <div class="aspect-[2/3] bg-slate-100 overflow-hidden"><img
                    src="https://images.unsplash.com/photo-1531901599143-df5010ab9438?auto=format&fit=crop&q=80&w=800"
                    alt="Educated"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /></div>
            <div class="p-3">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    Educated</p>
                <p class="text-xs text-slate-500 truncate mt-0.5">Tara Westover</p>
                <div class="flex items-center justify-between mt-2.5"><span
                        class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Biography</span>
                    <div class="flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-red-500"></span><span
                            class="text-[10px] text-slate-500">0/3</span></div>
                </div>
            </div>
        </article>
    </section>

</x-Libray-sidebar>
