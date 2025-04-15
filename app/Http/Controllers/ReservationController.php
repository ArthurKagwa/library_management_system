<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $stats = Reservation::getStats();

        // Fetch all reservations
        $reservations = Reservation::with(['user', 'book'])->get();

        return view('reservations.index', compact('reservations', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        // Show form to create a new reservation
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request){
//        // Validate and store the reservation
//       $request->validate([
//           'user_id' => 'required|exists:users,id',
//           'book_id' => 'required|exists:books,id',
//           'staff_id' => 'exists:users,id',
//           'reservation_date' => 'required|date|after:now',
//       ]);
//        // Check if the book is available for reservation
//
//        if(!Book::available($request->book_id)){
//            return redirect()->back()->with('error', 'Book is not available for reservation.');
//        }
//
//        Reservation::create($request->all());
//
//        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
//    }

    /**
     * edit reservation
     */
    public function edit(Reservation $reservation){

            $availableCopies=BookCopy::getAvailableCopies($reservation->book_id);
            // Return the edit view with the reservation data
            return view('reservations.update-reservation', compact('reservation', 'availableCopies'));
    }

    /**
     * update reservation
     */
public function update(Request $request, Reservation $reservation){
        try {
            // Validate the request data

            if (Auth::user()->hasRole('librarian') ){
                $validated = $request->validate([
                    'status' => 'in:ready_for_pickup,picked_up,expired,cancelled',
                    'ready_for_pickup_date' => 'required|date|after:now',
                    'pickup_deadline' => 'required|date|after:ready_for_pickup_date',
                    'actual_pickup_date' => 'nullable|date|after:ready_for_pickup_date',
                    'notification_sent' => 'boolean',
                    'book_copy_id' => 'required|exists:book_copies,id',
                ]);
            } else {
                $validated = $request->validate([
                    'reservation_date' => 'required|date|after:now',
                    'status' => 'in:pending,cancelled',
                    'notification_sent' => 'boolean',

                ]);
            }

            if($reservation->update($validated)) {
                if(Auth::user()->hasRole('librarian')){
                    return redirect()->route('librarian.reservations.index')->with('success', 'Reservation updated successfully.');
                }

                return redirect()->route('member.my-reservations')->with('success', 'Reservation updated successfully.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the reservation: ' . $e->getMessage())->withInput();
        }
    }

}
