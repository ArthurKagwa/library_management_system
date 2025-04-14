<?php
// app/Http/Livewire/BookReservationForm.p

namespace App\Livewire;


use App\Models\Reservation;
use Livewire\Component;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;

class BookReservationForm extends Component
{
    public $bookId;
    public $userId;
    public $reservationDate;
    public $selectedBook = null;
    public $selectedUser = null;

    protected $listeners = ['userSelected' => 'setUserId','bookSelected'=>'setBookId']; // Add listenerprotected $listeners = ['userSelected' => 'setUserId']; // Add listener


    // Add this method to BookReservationForm.php
    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->selectedUser = User::find($userId);
    }

// Similarly, you need a setBookId method
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        $this->selectedBook = Book::find($bookId);
    }
    protected $rules = [
        'bookId' => 'required|exists:books,id',
        'userId' => 'required|exists:users,id',
        'reservationDate' => 'required|date|after_or_equal:today',
    ];

    public function mount($bookId = null)
    {
        $this->bookId = $bookId ;
        $this->reservationDate = now()->format('Y-m-d');

        if ($bookId) {
            $this->selectedBook = Book::find($bookId);
        }
    }

    public function submit()
    {
        $this->validate();

        // Check if the book is already reserved or checked out by this user
        $existingReservation = Reservation::where('book_id', $this->bookId)
            ->where('user_id', $this->userId)
            ->whereIn('status', ['reserved', 'checked_out'])
            ->exists();

        if ($existingReservation) {
            return back()->with('error', 'You already have this book reserved or checked out.');
        }

        // Check if the book is available for reservation
        $isBookAvailableForReservation = Book::available('book_id');

        if (!$isBookAvailableForReservation) {
            // Create reservation for when book is returned
            $reservation = Reservation::create([
                'user_id' =>$this->userId,
                'book_id' => $this->bookId,
                'reservation_date' => $this->reservationDate,
            ]);

            return redirect()->route('librarian.reservations.index')
                ->with('success', 'Book has been reserved and will be available when returned.');
        } else {
            // Book is available, allow immediate checkout
            return redirect()->route('librarian.dashboard', ['book_id' => $this->reservationDate, 'user_id' => $this->userId])
                ->with('info', 'This book is currently available. You can check it out now.');
        }

    }
    public function render()
    {
        return view('livewire.book-reservation-form');
    }
}
