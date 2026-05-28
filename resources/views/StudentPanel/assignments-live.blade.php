<x-Student-sidebar>

    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="w-full min-w-0 space-y-6">
            <header class="bg-white p-4 rounded-lg shadow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <button id="sidebarToggle" class="md:hidden p-2 bg-indigo-600 text-white rounded">
                            <i class="bi bi-list"></i>
                        </button>
                        <div>
                            <h1 class="text-xl font-semibold text-gray-800">Assignments</h1>
                            <p class="text-sm text-gray-500">Assignments published by your teacher for your class.</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">{{ $assignments->count() }} available</div>
                </div>
            </header>

            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-4">
                    @forelse ($assignments as $assignment)
                        <article class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $assignment->title }}</h3>
                                    <div class="text-sm text-gray-500 mt-1">
                                        {{ $assignment->classAvailable->name ?? 'Class' }} • Due {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                                    </div>
                                </div>

                                <div class="text-sm text-indigo-700 bg-indigo-50 rounded-full px-3 py-1 self-start">New</div>
                            </div>

                            <p class="text-sm text-gray-700 mt-3 whitespace-pre-line">{{ $assignment->description }}</p>

                            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm">
                                <span class="text-gray-500">Posted by {{ $assignment->teacher->fname ?? 'Teacher' }} {{ $assignment->teacher->lname ?? '' }}</span>

                                @if ($assignment->attachment)
                                    <a href="{{ asset('storage/' . $assignment->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-indigo-600 hover:underline">
                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                        Download attachment
                                    </a>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="bg-white rounded-lg shadow-sm border border-dashed border-gray-200 p-8 text-center">
                            <div class="mx-auto mb-3 h-12 w-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <i class="bi bi-journal-check text-2xl"></i>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">No assignments yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Your teacher has not posted any assignments for this class yet.</p>
                        </div>
                    @endforelse
                </div>

                <aside class="space-y-6">
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h4 class="font-semibold mb-2 text-gray-800">Your class</h4>
                        <div class="text-sm text-gray-600">
                            {{ $student?->classAvailables?->name ?? 'Not assigned' }}
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h4 class="font-semibold mb-2 text-gray-800">Tip</h4>
                        <p class="text-sm text-gray-600">Open each assignment and download any attached file before starting your work.</p>
                    </div>
                </aside>
            </section>
        </div>
    </main>

</x-Student-sidebar>
