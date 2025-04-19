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
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }
        
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->select('id', 'title')
            ->orderBy('title')
            ->limit(10)
            ->get();
            
        return response()->json($books);
    }


}
