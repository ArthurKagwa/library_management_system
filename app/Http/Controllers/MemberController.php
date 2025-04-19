<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Checkout;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }
    public function myBooks()
    {
        $checkedOutBooks = Checkout::with(['bookCopy.book'])
            ->where('user_id', Auth::id())
            ->whereNull('return_date')
            ->get();
        // Get all reservations
            $reservations = Reservation::with('book')
            ->where('user_id', Auth::id())
            ->whereNotIn('status', ['picked_up'])

            ->get();

            return view('member.my-books', compact('checkedOutBooks', 'reservations'));
    }
    public function explore(Request $request)
{
    $query = Book::query();
    
    // Apply title search filter
    if ($request->has('search') && !empty($request->search)) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
    
    // Apply rating filter
    if ($request->has('rating') && !empty($request->rating)) {
        $query->where('average_rating', '>=', $request->rating);
    }
    
    // Get books with pagination
    $books = $query->paginate(12);
    
    return view('member.explore', compact('books'));
}


    public function reserveBookPage()
    {

        return view('reservations.reserve');
    }

    public function reserveBook(Request $request)
    {
        $bookId = $request->query('book_id'); // Get book_id from query string if present

        return view('reservations.reserve', [
            'bookId' => $bookId,
            // Add any other data needed for your form
        ]);
    }

    public function checkouts()
    {
        $checkouts= Checkout::with(['bookCopy.book'])
            ->where('user_id', Auth::id())
            ->whereNull('return_date')
            ->get();

return view('member.checkouts', compact('checkouts'));
    }

    public function updateReservationPage(Request $request, $reservationId)
    {

         $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return redirect()->route('member.my-reservations')->with('error', 'Reservation not found.');
        }
        return view('reservations.update-reservation', ['reservation' => $reservation])->with('success', 'Reservation updated successfully.');

    }

    public function myReservations()
    {
        $stats = Reservation::memberReservationStats(Auth::user()->id);
        $reservations = Reservation::where('user_id', Auth::user()->id)
            ->with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reservations.my-reservations', ['reservations' => $reservations, 'stats' => $stats]);
    }



    /*public function explore()
    {
        $books = Book::inRandomOrder()->limit(5)->get();
        return view('member.explore', compact('books'));
    }*/
}
