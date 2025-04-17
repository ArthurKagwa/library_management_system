<?php

    namespace App\Livewire;

    use App\Models\BookCopy;
    use App\Models\Checkout;
    use App\Models\Reservation;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class CheckoutForm extends Component
    {
        protected $listeners = ['reservationSelected' => 'setReservationId'];

        public $reservationId;
        public $selectedReservation = null;
        public $checkoutDate;
        public $dueDate;

        public $staff_id;
        public $checkoutCondition = 'good';
        public $baseFee = 2000; // Default fee in cents
        public $successMessage = '';
        public $errorMessage = '';

        public function mount()
        {
            $this->checkoutDate = now()->format('Y-m-d');
            $this->dueDate = now()->addDays(14)->format('Y-m-d');
            $this->staff_id = Auth::id();
        }

        public function setReservationId($reservationId)
        {
            $this->reservationId = $reservationId;
            $this->loadReservation();
            $this->resetMessages();
        }

        protected function loadReservation()
        {
            if ($this->reservationId) {
                $this->selectedReservation = Reservation::with(['user', 'book'])->find($this->reservationId);
            }
        }

        protected function resetMessages()
        {
            $this->successMessage = '';
            $this->errorMessage = '';
        }

        public function completeCheckout()
        {
            $this->resetMessages();

            if (!$this->selectedReservation) {
                $this->errorMessage = 'No reservation selected.';
                return;
            }

            // Validate reservation status
            if (!in_array($this->selectedReservation->status, ['ready_for_pickup', 'pending'])) {
                $this->errorMessage = 'Reservation is not ready for checkout.';
                return;
            }

            try {
                // Create the checkout record
                $checkout = new Checkout();
                $checkout->book_copy_id = $this->selectedReservation->book_copy_id;


// To this implementation that ensures the status is updated
                $bookCopy = BookCopy::find($this->selectedReservation->book_copy_id);
                if (!$bookCopy) {
                    $this->errorMessage = 'Error processing checkout: Book copy not found';
                    return;
                }

// Update the status
                $bookCopy->status = 'checked_out';
                $bookCopy->save();

                $checkout->user_id = $this->selectedReservation->user_id;
                $checkout->checkout_date = $this->checkoutDate;
                $checkout->due_date = $this->dueDate;
                $checkout->checkout_condition = $this->checkoutCondition;
                $checkout->base_fee = $this->baseFee;
                $checkout->reservation_id = $this->reservationId;
                $checkout->staff_id = $this->staff_id;
                $checkout->save();

                // Update reservation status
                $this->selectedReservation->status = "picked_up";
                $this->selectedReservation->actual_pickup_date = now();
                $this->selectedReservation->save();

               // Update book copy status - with null check
//                $bookCopy = BookCopy::find($this->selectedReservation->book_copy_id);
//                if ($bookCopy) {
//                    $bookCopy->status = 'checked_out';
//                    $bookCopy->save();
//                } else {
//                    // Log this issue or add to error message
//                    \Log::warning('Book copy not found: ' . $this->selectedReservation->book_copy_id);
//                    $this->errorMessage = 'Error processing checkout: Book copy not found';
//                    return;
//                }



                $this->successMessage = 'Book successfully checked out!';
                $this->reset(['reservationId', 'selectedReservation', 'checkoutCondition']);
                $this->mount(); // Reset dates

            } catch (\Exception $e) {
                $this->errorMessage = 'Error processing checkout: ' . $e->getMessage();
            }
        }

        public function render()
        {
            return view('livewire.checkout-form');
        }
    }
