<div class="p-4 border-b border-slate-200">
    <div class="relative max-w-md">
        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
        <input type="text" placeholder="Search overdue loans..."
            class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500" />
    </div>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-medium text-slate-500 uppercase tracking-wider">
                <th class="px-6 py-3">Book</th>
                <th class="px-6 py-3">Borrower</th>
                <th class="px-6 py-3">Checked Out</th>
                <th class="px-6 py-3">Due Date</th>
                <th class="px-6 py-3">Days Late</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
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
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/150?u=11" alt="David Miller" class="w-8 h-8 rounded-full border border-slate-200" />
                        <div>
                            <p class="text-sm font-medium text-slate-900">David Miller</p>
                            <p class="text-xs text-slate-500">Grade 9</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-3 text-sm text-slate-600">Sep 28</td>
                <td class="px-6 py-3 text-sm text-slate-600">Oct 12</td>
                <td class="px-6 py-3 text-sm text-red-600">21</td>
                <td class="px-6 py-3"><span class="text-xs font-medium px-2 py-0.5 rounded-md bg-red-50 text-red-700">Overdue</span></td>
                <td class="px-6 py-3">
                    <div class="flex items-center justify-end gap-1">
                        <button class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors" title="Send reminder">⚑</button>
                        <button class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors" title="Mark returned">✓</button>
                    </div>
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
                        <img src="https://i.pravatar.cc/150?u=7" alt="Sara Lee" class="w-8 h-8 rounded-full border border-slate-200" />
                        <div>
                            <p class="text-sm font-medium text-slate-900">Sara Lee</p>
                            <p class="text-xs text-slate-500">Grade 12</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-3 text-sm text-slate-600">Sep 20</td>
                <td class="px-6 py-3 text-sm text-slate-600">Oct 02</td>
                <td class="px-6 py-3 text-sm text-red-600">31</td>
                <td class="px-6 py-3"><span class="text-xs font-medium px-2 py-0.5 rounded-md bg-red-50 text-red-700">Overdue</span></td>
                <td class="px-6 py-3">
                    <div class="flex items-center justify-end gap-1">
                        <button class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors" title="Send reminder">⚑</button>
                        <button class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors" title="Mark returned">✓</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
