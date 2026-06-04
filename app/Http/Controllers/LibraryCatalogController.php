<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\LibraryBookCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LibraryCatalogController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureDefaultCategories();

        $categories = LibraryBookCategory::query()
            ->orderBy('name')
            ->get();

        $books = LibraryBook::query()
            ->with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->string('category')->toString());
                });
            })
            ->when($request->filled('status') && $request->string('status')->toString() !== 'all', function ($query) use ($request) {
                $status = $request->string('status')->toString();

                if ($status === 'available') {
                    $query->where('available_copies', '>', 0);
                }

                if ($status === 'unavailable') {
                    $query->where('available_copies', '<=', 0);
                }
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $bookCount = LibraryBook::query()->count();

        return view('LibraryPanel.catalog', compact('categories', 'books', 'bookCount'));
    }

    public function store(Request $request)
    {

        // put a try and catch block as well
        try {

            $validated = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'author' => ['required', 'string', 'max:255'],
                'isbn' => ['nullable', 'string', 'max:50', 'unique:library_books,isbn'],
                'category_id' => ['required', 'exists:library_book_categories,id'],
                'publisher' => ['nullable', 'string', 'max:255'],
                'publication_year' => ['nullable', 'integer', 'min:1500', 'max:2100'],
                'shelf_location' => ['nullable', 'string', 'max:100'],
                'total_copies' => ['required', 'integer', 'min:1'],
                'description' => ['nullable', 'string'],
                'cover_url' => ['nullable', 'string', 'max:2048'],
                'status' => ['required', Rule::in(['available', 'reference', 'checked-out'])],
            ]);

            $validated['available_copies'] = $validated['total_copies'];

            try {

                LibraryBook::create($validated);

                return redirect()->route('library.catalog')->with('status', 'Book added successfully.');

            } catch (\Throwable $th) {

                // trow an exception error
                return redirect()->back()
                    ->with('error', 'Something went wrong. Please try again.')
                    ->withInput();

            }

        } catch (\Throwable $th) {

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();

        }

        /*try catch block
        try {

            LibraryBook::create($validated);
            return redirect()->route('library.catalog')->with('status', 'Book added successfully.');

        } catch (\Throwable $th) {

            //trow an exception error
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();

        } */

    }

    public function update(Request $request, LibraryBook $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:50', Rule::unique('library_books', 'isbn')->ignore($book->id)],
            'category_id' => ['required', 'exists:library_book_categories,id'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'publication_year' => ['nullable', 'integer', 'min:1500', 'max:2100'],
            'shelf_location' => ['nullable', 'string', 'max:100'],
            'total_copies' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'cover_url' => ['nullable', 'string', 'max:2048'],
            'status' => ['required', Rule::in(['available', 'reference', 'checked-out'])],
        ]);

        $validated['available_copies'] = min($book->available_copies, $validated['total_copies']);

        $book->update($validated);

        return redirect()->route('library.catalog')->with('status', 'Book updated successfully.');
    }

    public function destroy(LibraryBook $book)
    {
        $book->delete();

        return redirect()->route('library.catalog')->with('status', 'Book removed successfully.');
    }

    private function ensureDefaultCategories(): void
    {
        $defaults = [
            'Fiction',
            'Science',
            'History',
            'Biography',
            'Reference',
        ];

        foreach ($defaults as $categoryName) {
            LibraryBookCategory::firstOrCreate(
                ['slug' => str()->slug($categoryName)],
                ['name' => $categoryName]
            );
        }
    }
}
