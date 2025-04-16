<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Checkout;
use App\Models\Librarian;
use App\Models\Reservation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'available_books' => BookCopy::where('status', BookCopy::STATUS_AVAILABLE)
                ->count(),

            // Count books that are currently checked out (regardless of transaction status)
            'checked_out' => BookCopy::where('status', BookCopy::STATUS_CHECKED_OUT)->count(),

            // Count overdue transactions (where due_date passed and not returned)
            'overdue' => Checkout::whereNull('return_date')
                ->where('due_date', '<', now())
                ->count()
        ];

        $recentTransactions = Reservation::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $books = Book::paginate(20);

        return view('librarian.dashboard', [
            'stats' => $stats,
            'recentTransactions' => $recentTransactions,
            'books' => $books,

        ]);
    }
    public function libraryBooks()
{
    $books = Book::with('copies')->paginate(10);
    return view('librarian.library-books', compact('books'));
}

public function storeBook(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'isbn' => 'required|string|unique:books,isbn',
        'quantity' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'published_date' => 'nullable|date',
    ]);

    // Create the book
    $book = Book::create($validated);

    // Create the specified number of copies
    for ($i = 1; $i <= $validated['quantity']; $i++) {
        BookCopy::create([
            'book_id' => $book->id,
            'copy_number' => $i,
            'status' => 'available',
            'condition' => 'good',
            'acquisition_date' => now(),
            'location' => 'Main Shelf'
        ]);
    }

    return redirect()->route('librarian.books.index')
        ->with('success', 'Book and copies added successfully');
}

public function destroyBook(Book $book)
{
    // Check if any copies are checked out before deletion
    if ($book->copies()->where('status', '!=', 'available')->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete book - some copies are still checked out or reserved');
    }

    // Delete all copies first
    $book->copies()->delete();
    
    // Then delete the book
    $book->delete();

    return redirect()->route('librarian.books.index')
        ->with('success', 'Book and all copies deleted successfully');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Librarian $librarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Librarian $librarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Librarian $librarian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Librarian $librarian)
    {
        //
    }

    /**
     * Route to books management page
     */
    public function books(){
        $books = Book::all();
        return view('librarian.books', [
            'books' => $books,
        ]);
    }

    /**
     * Route to delete a book
     */
    public function deleteBook(Request $request){
        $bookId = $request->input('book_id');
        Book::destroy($bookId);
    }
    /**
     * Route to reserve a book
     */

    public function reserveBookPage(Request $request)
    {
        $bookId = $request->query('book_id'); // Get book_id from query string if present

        return view('reservations.reserve', [
            'bookId' => $bookId,
            // Add any other data needed for your form
        ]);
    }

}
