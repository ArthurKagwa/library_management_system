<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    
public function index()
{
    $totalBooks = Book::count();
    $totalMembers = User::count();
    $totalReservations = Reservation::count();
    $overdueBooks = Reservation::where('due_date', '<', now())->count();

    return view('dashboard', compact('totalBooks', 'totalMembers', 'totalReservations', 'overdueBooks'));
}
    //
}
