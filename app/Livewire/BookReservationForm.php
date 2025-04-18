<?php
// app/Http/Livewire/BookReservationForm.p

namespace App\Livewire;


use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Book;
use App\Models\User;
use App\Models\Checkout;

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
        if(Auth::check()&& !Auth::user()->hasRole(['librarian'])){
            $this->userId = Auth::user()->id;
        }
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
            ->whereIn('status', ['reserved', 'checked_out','pending'])
            ->exists();


        if ($existingReservation) {
            if(Auth::user()->hasRole('librarian')){
                return redirect()->route('librarian.books.reserve', $this->bookId)
                    ->with('error', 'Member has already reserved or checked out this book.');
            }
            return redirect()->route('member.books.reserve', $this->bookId)
                ->with('error', 'You have already reserved or checked out this book.');
        }


        // Check if the book is available for reservation
        $isBookAvailableForReservation = Book::available($this->bookId);

        //check that this user doesn't have a copy of this book checked out
        $userHasBookCheckedOut = Checkout::where('user_id', $this->userId)
            ->whereNull('return_date')
            ->whereHas('bookCopy', function($query) {
                $query->where('book_id', $this->bookId);
            })
            ->exists();
        if ($isBookAvailableForReservation && !$userHasBookCheckedOut) {
            // Create reservation for when book is returned
            $reservation = Reservation::create([
                'user_id' => $this->userId,
                'book_id' => $this->bookId,
                'reservation_date' => $this->reservationDate,
            ]);

            if(Auth::check() && Auth::user()->hasRole('librarian')) {
                return redirect()->route('librarian.reservations.index')
                    ->with('success', 'Book has been reserved and will be available when returned.');
            }

            return redirect()->route('member.my-reservations')
                ->with('success', 'Book has been reserved and will be available when returned.');

        } else {
            // Book is available, allow immediate checkout
            if(Auth::check() && Auth::user()->hasRole('librarian')) {
                return redirect()->route('librarian.dashboard')
                    ->with('error', 'This book is currently unavailable.');
            }
            return redirect()->route('member.my-reservations')
                ->with('error', 'This book is already reserved.');
        }
    }
    public function render()
    {
        return view('livewire.book-reservation-form');
    }
}

