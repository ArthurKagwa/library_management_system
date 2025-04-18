<?php

    namespace App\Livewire;

    use App\Http\Controllers\LendingFeeController;
    use App\Models\BookCopy;
    use App\Models\Checkout;
    use App\Models\Reservation;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Livewire\Component;

    class CheckoutForm extends Component
    {
        protected $listeners = ['reservationSelected' => 'setReservationId'];

        public $reservationId;
        public $selectedReservation = null;
        public $checkoutDate;

        public $staff_id;
        public $successMessage = '';
        public $errorMessage = '';
        public $duration;

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
                $checkout->due_date = now()->addDays($this->duration)->format('Y-m-d');
                $checkout->checkout_condition = $bookCopy->condition;
                $checkout->base_fee = LendingFeeController::calculateBaseFee($copyId, $this->duration);
                $checkout->reservation_id = $this->reservationId;
                $checkout->staff_id = $this->staff_id;
                $checkout->save();
                $this->updateReservationStatus();

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
