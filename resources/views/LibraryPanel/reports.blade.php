<x-Libray-sidebar>
    <x-slot name="title">Reports</x-slot>

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold">Reports & Analytics</h1>
            <p class="text-sm text-slate-500">Insights into library usage</p>
        </div><button class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium">Export</button>
    </div>
    <section class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <article class="rounded-xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Total Checkouts</p>
            <p class="text-2xl font-bold">2,418</p>
            <p class="text-xs text-emerald-600">+12.4%</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Unique Borrowers</p>
            <p class="text-2xl font-bold">892</p>
            <p class="text-xs text-emerald-600">+5.2%</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Avg Loan Duration</p>
            <p class="text-2xl font-bold">8.4d</p>
            <p class="text-xs text-slate-500">-0.3d</p>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-5">
            <p class="text-sm text-slate-500">Return Rate</p>
            <p class="text-2xl font-bold">94.2%</p>
            <p class="text-xs text-emerald-600">+1.1%</p>
        </article>
    </section>
    <section class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-base font-semibold">Monthly Checkouts</h2>
            <div class="grid h-52 grid-cols-12 items-end gap-2">
                <div class="rounded-t bg-indigo-200" style="height:62%"></div>
                <div class="rounded-t bg-indigo-300" style="height:36%"></div>
                <div class="rounded-t bg-indigo-300" style="height:67%"></div>
                <div class="rounded-t bg-indigo-400" style="height:75%"></div>
                <div class="rounded-t bg-indigo-500" style="height:84%"></div>
                <div class="rounded-t bg-indigo-500" style="height:79%"></div>
                <div class="rounded-t bg-indigo-300" style="height:61%"></div>
                <div class="rounded-t bg-indigo-200" style="height:34%"></div>
                <div class="rounded-t bg-indigo-200" style="height:29%"></div>
                <div class="rounded-t bg-indigo-300" style="height:46%"></div>
                <div class="rounded-t bg-indigo-500" style="height:88%"></div>
                <div class="rounded-t bg-indigo-600" style="height:95%"></div>
            </div>
        </article>
        <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-base font-semibold">Top Genres</h2>
            <ul class="space-y-3 text-sm">
                <li class="flex justify-between"><span>Fiction</span><span class="font-semibold">4,230</span></li>
                <li class="flex justify-between"><span>Science</span><span class="font-semibold">2,104</span></li>
                <li class="flex justify-between"><span>History</span><span class="font-semibold">1,840</span></li>
                <li class="flex justify-between"><span>Biography</span><span class="font-semibold">1,205</span></li>
                <li class="flex justify-between"><span>Reference</span><span class="font-semibold">840</span></li>
            </ul>
        </article>
    </section>

</x-Libray-sidebar>
