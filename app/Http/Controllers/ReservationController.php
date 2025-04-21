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
    $reservations = Reservation::with(['user', 'book'])->paginate(20);
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
                    'staff_id' => 'required'
                ]);
            } else {
                $validated = $request->validate([
                    'reservation_date' => 'required|date|after:now',
                    'status' => 'in:pending,cancelled',
                    'notification_sent' => 'boolean',
                ]);
            }


            try {
                $bookCopy = BookCopy::find($request->book_copy_id);

                if (!$bookCopy) {
                    // Log error if the book copy is not found
                    \Log::error('Book copy not found', [
                        'book_copy_id' => $request->book_copy_id,
                        'reservation_id' => $reservation->id ?? null,
                    ]);
                    return redirect()->back()->with('error', 'Book copy not found. Please select a valid book copy.');
                }

                // Log the current details of the book copy
                \Log::info('Attempting to update book copy', [
                    'book_copy_id' => $bookCopy->id,
                    'current_status' => $bookCopy->status,
                ]);

                // Update the book copy status
                $bookCopy->status = 'reserved';
                $bookCopy->save();

                // Log success
                \Log::info('Book copy status updated successfully', [
                    'book_copy_id' => $bookCopy->id,
                    'new_status' => $bookCopy->status,
                ]);
            } catch (\Exception $e) {
                // Log the exception details
                \Log::error('Error updating book copy', [
                    'book_copy_id' => $request->book_copy_id,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                // Prevent further progress
                return redirect()->back()->with('error', 'An error occurred while updating the book copy: ' . $e->getMessage());
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


    public function reserveBook($bookId)
    {
        // Check if the book exists
        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        // Check if the book is available for reservation
        $availableCopy = $book->copies()->where('status', 'available')->first();
        if (!$availableCopy) {
            return redirect()->back()->with('error', 'No available copies for this book.');
        }

        // Reserve the book copy
        $availableCopy->status = 'reserved';
        $availableCopy->save();

        // Create a new reservation
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'reservation_date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('member.my-reservations')->with('success', 'Reservation created successfully.');
    }

public function pickup(Reservation $reservation)
{
    if ($reservation->status !== 'reserved') {
        return redirect()->back()->with('error', 'This reservation is not ready for pickup.');
    }

    $reservation->status = 'picked_up';
    $reservation->save();

    return redirect()->route('member.my-reservations')->with('success', 'Book picked up successfully.');
}
public function cancel(Reservation $reservation)
{
    if ($reservation->status === 'pending') {
        return redirect()->back()->with('error', 'You cannot cancel a pending reservation.');
    }

    $reservation->status = 'cancelled';
    $reservation->save();

    return redirect()->route('member.my-reservations')->with('success', 'Reservation cancelled successfully.');
}
}
