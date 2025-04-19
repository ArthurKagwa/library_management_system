<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function viewBook($bookId)
    {
        $book = Book::with(['copies'])->findOrFail($bookId);
        $available=Book::available($bookId);
        return view('books.view', compact('book', 'available'));
    }



}
