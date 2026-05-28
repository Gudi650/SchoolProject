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
                            <h1 class="text-lg md:text-2xl font-bold text-indigo-800">Assignments</h1>
                            <p class="hidden sm:block text-sm text-gray-500 mt-1">Publish class assignments for students to view in their portal.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 text-right">Good morning, {{ $teacher->fname ?? 'Teacher' }}</div>
                        <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700">
                            <i class="bi bi-journal-text text-xl"></i>
                        </div>
                    </div>
                </div>
            </header>

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <section class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
                <div class="xl:col-span-1 bg-white rounded-lg shadow-sm p-5">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Create Assignment</h2>
                        <p class="text-sm text-gray-500">Choose a class, add instructions, and publish it for students.</p>
                    </div>

                    <form action="{{ route('teacher.assignments.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="title">Title</label>
                            <input id="title" name="title" type="text" value="{{ old('title') }}" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm" placeholder="e.g. Algebra Practice 1">
                            @error('title')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="class_id">Class</label>
                            <select id="class_id" name="class_id" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm bg-white">
                                <option value="">Select class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" @selected(old('class_id') == $class->id)>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="due_date">Due date</label>
                            <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm bg-white">
                            @error('due_date')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="attachment">Attachment</label>
                            <input id="attachment" name="attachment" type="file" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm bg-white">
                            @error('attachment')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="description">Description</label>
                            <textarea id="description" name="description" rows="7" class="w-full rounded-md border border-gray-200 px-3 py-2 text-sm" placeholder="Write the assignment instructions here...">{{ old('description') }}</textarea>
                            @error('description')<div class="mt-1 text-xs text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700">
                            Publish Assignment
                        </button>
                    </form>
                </div>

                <div class="xl:col-span-2 bg-white rounded-lg shadow-sm p-5">
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Recent Assignments</h2>
                            <p class="text-sm text-gray-500">Students will see these in their assignments page once published.</p>
                        </div>
                        <div class="text-sm text-gray-500">{{ $assignments->count() }} posted</div>
                    </div>

                    <div class="space-y-4">
                        @forelse ($assignments as $assignment)
                            <article class="rounded-lg border border-gray-100 bg-gray-50 p-4">
                                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                    <div class="min-w-0">
                                        <h3 class="text-base font-semibold text-gray-800 truncate">{{ $assignment->title }}</h3>
                                        <div class="mt-1 text-sm text-gray-500 flex flex-wrap gap-x-3 gap-y-1">
                                            <span>Class: {{ $assignment->classAvailable->name ?? 'N/A' }}</span>
                                            <span>Due: {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="text-sm text-indigo-700 bg-indigo-50 rounded-full px-3 py-1 self-start">Published</div>
                                </div>

                                <p class="mt-3 text-sm text-gray-700 whitespace-pre-line">{{ $assignment->description }}</p>

                                <div class="mt-4 flex flex-wrap items-center gap-3 text-sm">
                                    <span class="text-gray-500">Teacher: {{ $teacher->fname ?? 'Teacher' }} {{ $teacher->lname ?? '' }}</span>

                                    @if ($assignment->attachment)
                                        <a href="{{ asset('storage/' . $assignment->attachment) }}" target="_blank" class="inline-flex items-center gap-2 text-indigo-600 hover:underline">
                                            <i class="bi bi-paperclip"></i>
                                            View attachment
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="rounded-lg border border-dashed border-gray-200 bg-gray-50 p-8 text-center">
                                <div class="mx-auto mb-3 h-12 w-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                    <i class="bi bi-journal-text text-2xl"></i>
                                </div>
                                <h3 class="text-base font-semibold text-gray-800">No assignments yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Use the form on the left to publish your first class assignment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </main>

</x-Teacher-sidebar>
