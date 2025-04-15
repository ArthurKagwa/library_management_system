<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
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
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }

    /**
     * Show the form for reserving a book.
     */
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

    public function updateReservationPage(Request $request, $reservationId)
    {

         $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return redirect()->route('member.reservations.index')->with('error', 'Reservation not found.');
        }
        return view('reservations.update-reservation', ['reservation' => $reservation]);

    }

    public function myReservations()
    {
        $stats = Reservation::memberReservationStats(auth()->id());
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reservations.my-reservations', ['reservations' => $reservations, 'stats' => $stats]);
    }
}
