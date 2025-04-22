<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Checkout;
use App\Models\Transaction;
use App\Models\Member;
class ExploreController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Fetch all books from the database
        return view('member.explore', compact('books'));
    }
}
