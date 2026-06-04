<x-Libray-sidebar>
    <x-slot name="title">Catalog</x-slot>

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold">Book Catalog</h1>
            <p class="text-sm text-slate-500 mt-1">Browse and manage your library's collection</p>
        </div>
        <button
            type="button"
            data-open-add-book-modal
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-brand-600 text-white text-sm font-medium rounded-lg hover:bg-brand-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Book
        </button>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 mb-6 flex flex-col lg:flex-row gap-3">
        <form method="GET" action="{{ route('library.catalog') }}" class="contents">
        <div class="relative flex-1">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, author, or ISBN..."
                class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" />
        </div>

        <select name="category" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
            @endforeach
        </select>

        <select name="status" class="bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm">
            <option value="all">All status</option>
            <option value="available" @selected(request('status') === 'available')>Available</option>
            <option value="unavailable" @selected(request('status') === 'unavailable')>Checked out</option>
        </select>

        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm">Filter</button>
            <a href="{{ route('library.catalog') }}" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Reset</a>
        </div>

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
        </form>
    </div>

    <div class="text-xs text-slate-500 mb-4">{{ $bookCount }} books found</div>

    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse ($books as $book)
            <article
                class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
                <div class="aspect-[2/3] bg-slate-100 overflow-hidden">
                    <img src="{{ $book->cover_url ?: 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800' }}"
                        alt="{{ $book->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                </div>
                <div class="p-3">
                    <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                        {{ $book->title }}</p>
                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ $book->author }}</p>
                    <div class="flex items-center justify-between mt-2.5">
                        <span class="text-[10px] font-medium text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">{{ $book->category?->name ?? 'Uncategorized' }}</span>
                        <div class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full {{ $book->available_copies > 0 ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                            <span class="text-[10px] text-slate-500">{{ $book->available_copies }}/{{ $book->total_copies }}</span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                No books found. Add the first catalog entry to get started.
            </div>
        @endforelse
    </section>

    <div class="mt-6">
        {{ $books->links() }}
    </div>

    @include('LibraryPanel.Catalog.modals.add-catalog', ['categories' => $categories])

    <script>
        (function () {
            var openButton = document.querySelector('[data-open-add-book-modal]');
            var modal = document.querySelector('[data-add-book-modal]');

            if (!openButton || !modal) {
                return;
            }

            var closeButtons = modal.querySelectorAll('[data-close-add-book-modal]');
            var dialog = modal.querySelector('[data-add-book-dialog]');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
                var firstField = modal.querySelector('input, select, textarea, button');
                if (firstField) {
                    firstField.focus();
                }
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            openButton.addEventListener('click', openModal);

            closeButtons.forEach(function (button) {
                button.addEventListener('click', closeModal);
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            if (dialog) {
                dialog.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            }
        })();
    </script>

</x-Libray-sidebar>
