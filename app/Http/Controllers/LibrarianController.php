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

        return view('librarian.dashboard', [
            'stats' => $stats,
            'recentTransactions' => $recentTransactions
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
}
