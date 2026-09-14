<x-Teacher-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="max-w-7xl mx-auto">
            <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm mb-6 border-l-4 border-indigo-600">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded"><i class="bi bi-list"></i></button>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-indigo-800">Enrollment Analytics</h1>
                            <p class="text-sm text-gray-500 mt-1">Application pipeline for your school</p>
                        </div>
                    </div>
                    <a href="{{ route('teacher.studentenrollment.applicants') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View applicants</a>
                </div>
            </header>

            <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                @foreach([
                    ['label' => 'Pending Review', 'value' => $stats['pending'], 'icon' => 'bi-hourglass-split', 'bg' => 'bg-amber-50'],
                    ['label' => 'Approved for Exam', 'value' => $stats['approved'], 'icon' => 'bi-check-circle', 'bg' => 'bg-green-50'],
                    ['label' => 'Rejected', 'value' => $stats['rejected'], 'icon' => 'bi-x-circle', 'bg' => 'bg-red-50'],
                ] as $kpi)
                <div class="p-4 {{ $kpi['bg'] }} rounded-lg shadow-sm flex items-center gap-3">
                    <div class="p-2 bg-white rounded-full text-indigo-600"><i class="bi {{ $kpi['icon'] }}"></i></div>
                    <div>
                        <div class="text-sm text-gray-500">{{ $kpi['label'] }}</div>
                        <div class="text-2xl font-semibold text-indigo-800">{{ $kpi['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </section>

            <div class="bg-white p-6 rounded-lg shadow-sm text-sm text-gray-500">
                <i class="bi bi-graph-up text-indigo-400 mr-1"></i>
                Detailed charts (by grade, month, conversion rate) can be added when exam workflow is wired.
            </div>
        </div>
    </main>

</x-Teacher-sidebar>
