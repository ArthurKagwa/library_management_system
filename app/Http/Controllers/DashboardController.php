<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Checkout;
use App\Models\Librarian;
use App\Models\Reservation;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
{
    $recentBooks = Book::latest()->take(10)->get(); // Fetch the 10 most recent books
    return view('member.dashboard', compact('recentBooks'));
}
}
