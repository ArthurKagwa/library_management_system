<?php

    namespace App\Livewire;

    use App\Http\Controllers\LendingFeeController;
    use App\Models\BookCopy;
    use App\Models\Checkout;
    use App\Models\Reservation;
    use App\Notifications\CheckoutNotification;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Livewire\Component;

    class CheckoutForm extends Component
    {
        protected $listeners = ['reservationSelected' => 'setReservationId'];

        public $reservationId;
        public $selectedReservation= null;
        public $checkoutDate;

        public $staff_id;
        public $successMessage = '';
        public $errorMessage = '';
        public $duration;

        public $base_fee = 0; // Initialize base fee

        protected $rules = [
            'duration' => 'required|integer|min:1',
            'reservationId' => 'required|exists:reservations,id',
        ];

        protected $messages = [
            'duration.required' => 'Please select a loan duration.',
            'duration.integer' => 'The duration must be a valid number.',
            'duration.min' => 'The duration must be at least 1 day.',
            'reservationId.required' => 'No reservation selected.',
            'reservationId.exists' => 'The selected reservation does not exist.',
        ];

        // Method to calculate base fee
        protected function calculateBaseFee()
        {
            if($this->selectedReservation) {
                $this->base_fee = LendingFeeController::calculateBaseFee($this->selectedReservation->book_copy_id, $this->duration);
            }
            else{
                $this->base_fee = 0; // Reset base fee if no reservation is selected
            }

        }

        // Update base fee when duration changes
        public function updatedDuration()
        {
            $this->calculateBaseFee();
        }


        public function mount()
        {
            $this->selectedReservation = null;
            $this->checkoutDate = now()->format('Y-m-d');
            $this->dueDate = now()->addDays(14)->format('Y-m-d');
            $this->staff_id = Auth::id();
            $this->duration = 0; // Default duration

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

            $this->validate();


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
                $copyId = $this->selectedReservation->book_copy_id;
                try {
                    $bookCopy = BookCopy::find($copyId);

                    if (!$bookCopy) {
                        Log::error('Book copy not found', ['book_copy_id' => $copyId]);
                        return;
                    }

                    // Ensure status is logged as a string
                    Log::info('Current book copy status', [
                        'book_copy_id' => $bookCopy->id,
                        'current_status' => (string) $bookCopy->status,
                    ]);

                    if ($bookCopy->status !== BookCopy::STATUS_CHECKED_OUT) {
                        $bookCopy->status = BookCopy::STATUS_CHECKED_OUT;
                        $bookCopy->save();

                        Log::info('Book copy status updated successfully', [
                            'book_copy_id' => $bookCopy->id,
                            'new_status' => $bookCopy->status,
                            'was_saved' => $bookCopy->wasChanged('status'),
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error updating book copy', [
                        'book_copy_id' => $copyId,
                        'message' => $e->getMessage(),
                    ]);
                }
                $checkout->user_id = $this->selectedReservation->user_id;
                //add duration selected to now
                $checkout->checkout_date = now()->format('Y-m-d');
                $checkout->due_date = now()->addDays((int) $this->duration)->format('Y-m-d');
                $checkout->checkout_condition = $bookCopy->condition;


                //calculate base fee
                $checkout->base_fee = $this->base_fee;
                $checkout->reservation_id = $this->reservationId;
                $checkout->staff_id = $this->staff_id;
                $checkout->save();

                // Notify the user
                $this->selectedReservation->user->notify(new CheckoutNotification($checkout));


                $this->updateReservationStatus();
                // Process checkout logic here...
                $this->successMessage = 'Book successfully checked out!';
                $this->reset(['reservationId', 'selectedReservation']);
                $this->mount(); // Reset dates
            } catch (\Exception $e) {
                $this->errorMessage = 'Error processing checkout: ' . $e->getMessage();
            }
        }

        public function render()
        {
            return view('livewire.checkout-form');
        }

        /**
         * @return void
         */
        public function updateReservationStatus(): void
        {
            $this->selectedReservation->status = "picked_up";
            $this->selectedReservation->actual_pickup_date = now();
            $this->selectedReservation->save();
        }
    }
