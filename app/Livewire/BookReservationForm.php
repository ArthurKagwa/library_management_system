<?php
// app/Http/Livewire/BookReservationForm.p

namespace App\Livewire;


use Livewire\Component;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;

class BookReservationForm extends Component
{
    public $bookId;
    public $userId;
    public $pickupDate;
    public $returnDate;

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
        'pickupDate' => 'required|date|after_or_equal:today',
        'returnDate' => 'required|date|after:pickupDate',
    ];

    public function mount($bookId = null)
    {
        $this->bookId = $bookId ;
        $this->pickupDate = now()->format('Y-m-d');
        $this->returnDate = now()->addWeek()->format('Y-m-d');

        if ($bookId) {
            $this->selectedBook = Book::find($bookId);
        }
    }

    public function submit()
    {
        $this->validate();

        // Check if the book is already reserved or checked out by this user
        $existingReservation = Transaction::where('book_id', $this->bookId)
            ->where('user_id', $this->userId)
            ->whereIn('status', ['reserved', 'checked_out'])
            ->exists();

        if ($existingReservation) {
            return back()->with('error', 'You already have this book reserved or checked out.');
        }

        // Check if the book is available for reservation
        $book = Book::findOrFail($this->bookId);
        $isBookAvailableForReservation = !Transaction::where('book_id', $this->bookId)
            ->where('status', 'checked_out')
            ->exists();

        if (!$isBookAvailableForReservation) {
            // Create reservation for when book is returned
            $reservation = Transaction::create([
                'user_id' =>$this->userId,
                'book_id' => $this->bookId,
                'pick_up_date' => $this->pickupDate,
                'checked_out_at' => null,
                'due_date' => null,
                'returned_at' => null,
                'status' => 'reserved',
            ]);

            return redirect()->route('librarian.dashboard')
                ->with('success', 'Book has been reserved and will be available when returned.');
        } else {
            // Book is available, allow immediate checkout
            return redirect()->route('librarian.dashboard', ['book_id' => $this->pickupDate, 'user_id' => $this->userId])
                ->with('info', 'This book is currently available. You can check it out now.');
        }

    }
    public function render()
    {
        return view('livewire.book-reservation-form');
    }
}
