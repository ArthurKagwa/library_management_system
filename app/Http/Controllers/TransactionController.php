<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Transaction $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transactions)
    {
        //
    }
    public function reserveBook(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'pick_up_date' => 'required|date|after:now',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // Check if the book is already reserved or checked out by this user
        $existingReservation = Transaction::where('book_id', $validated['book_id'])
            ->where('user_id', $validated['user_id'])
            ->whereIn('status', ['reserved', 'checked_out'])
            ->exists();

        if ($existingReservation) {
            return back()->with('error', 'You already have this book reserved or checked out.');
        }

        // Check if the book is available for reservation
        $book = Book::findOrFail($validated['book_id']);
        $isBookAvailableForReservation = !Transaction::where('book_id', $validated['book_id'])
            ->where('status', 'checked_out')
            ->exists();

        if (!$isBookAvailableForReservation) {
            // Create reservation for when book is returned
            $reservation = Transaction::create([
                'user_id' => $validated['user_id'],
                'book_id' => $validated['book_id'],
                'pick_up_date' => $validated['pick_up_date'],
                'checked_out_at' => null,
                'due_date' => null,
                'returned_at' => null,
                'status' => 'reserved',
            ]);

            return redirect()->route('librarian.dashboard')
                ->with('success', 'Book has been reserved and will be available when returned.');
        } else {
            // Book is available, allow immediate checkout
            return redirect()->route('librarian.checkout', ['book_id' => $validated['book_id'], 'user_id' => $validated['user_id']])
                ->with('info', 'This book is currently available. You can check it out now.');
        }
    }}
