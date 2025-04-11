<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Librarian;
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
            'available_books' => Book::where('status', Book::STATUS_AVAILABLE)
                ->where('quantity', '>', 0)
                ->count(),

            // Count books that are currently checked out (regardless of transaction status)
            'checked_out' => Book::where('status', Book::STATUS_CHECKED_OUT)->count(),

            // Count overdue transactions (where due_date passed and not returned)
            'overdue' => Transaction::whereNull('returned_at')
                ->where('due_date', '<', now())
                ->count()
        ];

        $recentTransactions = Transaction::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $books = Book::all();

        return view('librarian.dashboard', [
            'stats' => $stats,
            'recentTransactions' => $recentTransactions,
            'books' => $books,

        ]);
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
    public function reserveBook(Request $request)
    {
        $bookId = $request->input('book_id');

        Transaction::reserveBook($bookId, auth()->user()->id);
        return redirect()->route('librarian.books')->with('success', 'Book reserved successfully.');
    }

    public function reserveBookPage(Request $request)
    {
        $bookId = $request->input('book_id');
        $book = Book::find($bookId);

        return view('librarian.reserve', [
            'book' => $book,
        ]);
    }


}
