<x-Teacher-sidebar>
    <main class="flex-1 md:ml-64 p-6 md:p-10 min-w-0 overflow-x-auto">
        <div class="w-full min-w-0 space-y-6">
            <header class="relative bg-white p-4 md:p-6 rounded-lg shadow-sm">
                <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-lg bg-indigo-800 opacity-25"></div>

                <div class="flex items-center justify-between gap-4 relative pl-3 md:pl-4">
                    <div class="flex items-center gap-3">
                        <button id="sidebarToggle" aria-label="Open sidebar" class="md:hidden p-2 bg-indigo-600 text-white rounded">
                            <i class="bi bi-list"></i>
                        </button>

                        <div>
                            <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Submitted Assignments</h1>
                            <p class="hidden sm:block text-sm text-gray-500 mt-1">Select an assignment to review the files submitted by students.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 text-right">Good morning, {{ $teacher->fname ?? 'Teacher' }}</div>
                        <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700">
                            <i class="bi bi-folder2-open text-xl"></i>
                        </div>
                    </div>
                </div>
            </header>

            <section class="bg-white rounded-lg shadow-sm p-5 space-y-5">
                <form method="GET" action="{{ route('teacher.assignments.delivered') }}" class="flex flex-col md:flex-row md:items-end gap-4">
                    <div class="flex-1">
                        <label for="assignment_id" class="block text-sm font-medium text-gray-700 mb-1">Select assignment</label>
                        <select id="assignment_id" name="assignment_id" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm bg-white">
                            <option value="">All assignments</option>
                            @foreach ($assignments as $assignment)
                                <option value="{{ $assignment->id }}" @selected((string) $selectedAssignmentId === (string) $assignment->id)>
                                    {{ $assignment->title }}
                                    @if ($assignment->subject)
                                        - {{ $assignment->subject->subject_name }}
                                    @endif
                                    @if ($assignment->classAvailable)
                                        - {{ $assignment->classAvailable->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700">
                        View submissions
                    </button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Class</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Assignment</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Submitted</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">File</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($submissions as $submission)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-800">
                                        {{ $submission->student->fname ?? 'Student' }} {{ $submission->student->lname ?? '' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $submission->assignment->classAvailable->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $submission->assignment->title ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ optional($submission->submitted_at)->format('M d, Y h:i A') ?? $submission->created_at->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if ($submission->attachment)
                                            <a href="{{ asset('storage/' . $submission->attachment) }}" target="_blank" class="text-indigo-600 hover:underline">Open file</a>
                                        @else
                                            <span class="text-gray-400">No file</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $submission->remarks ?? 'No remarks' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500">
                                        No student submissions found for the selected assignment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</x-Teacher-sidebar>