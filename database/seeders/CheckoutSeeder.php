<?php

namespace Database\Seeders;

use App\Models\BookCopy;
use App\Models\Checkout;
use App\Models\LendingFee;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CheckoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get available book copies
        $availableCopies = BookCopy::where('status', 'available')->get();

        // Get some checked out copies to create return records
        $checkedOutCopies = BookCopy::where('status', 'checked_out')->get();

        // Get picked-up reservations
        $pickedUpReservations = Reservation::where('status', 'picked_up')->get();

        // Get users with member and librarian roles using Spatie
        $members = User::role('member')->get();
        $staff = User::role('librarian')->get();

        $checkouts = [];

        // Create checkouts from picked-up reservations
        foreach ($pickedUpReservations as $reservation) {
            // Find an available copy of the reserved book
            $bookCopy = BookCopy::where('book_id', $reservation->book_id)
                ->where('status', 'available')
                ->first();

            if (!$bookCopy) {
                continue;
            }

            // Set the copy to checked out
            $bookCopy->status = 'checked_out';
            $bookCopy->save();

            // Get a random duration from lending fees
            $lendingFee = LendingFee::where('category', $bookCopy->book->category)
                ->whereNull('effective_to')
                ->inRandomOrder()
                ->first();

            $duration = $lendingFee ? $lendingFee->duration_days : 14;
            $fee = $lendingFee ? $lendingFee->fee_amount : 2.00;

            $checkoutDate = $reservation->actual_pickup_date;
            $dueDate = Carbon::parse($checkoutDate)->addDays($duration);

            Checkout::create([
                'user_id' => $reservation->user_id,
                'book_copy_id' => $bookCopy->id,
                'reservation_id' => $reservation->id,
                'staff_id' => $staff->random()->id,
                'checkout_date' => $checkoutDate,
                'due_date' => $dueDate,
                'return_date' => null,
                'checkout_condition' => $bookCopy->condition,
                'return_condition' => null,
                'base_fee' => $fee,
                'renewal_count' => 0,
            ]);
        }

        // Create some checkouts without reservations (directly from available copies)
        $checkoutCount = min(15, count($availableCopies));
        for ($i = 0; $i < $checkoutCount; $i++) {
            $bookCopy = $availableCopies[$i];

            // Set the copy to checked out
            $bookCopy->status = 'checked_out';
            $bookCopy->save();

            // Get a random duration from lending fees
            $lendingFee = LendingFee::where('category', $bookCopy->book->category)
                ->whereNull('effective_to')
                ->inRandomOrder()
                ->first();

            $duration = $lendingFee ? $lendingFee->duration_days : 14;
            $fee = $lendingFee ? $lendingFee->fee_amount : 2.00;

            $checkoutDate = Carbon::now()->subDays(rand(1, $duration));
            $dueDate = Carbon::parse($checkoutDate)->addDays($duration);

            Checkout::create([
                'user_id' => $members->random()->id,
                'book_copy_id' => $bookCopy->id,
                'reservation_id' => null,
                'staff_id' => $staff->random()->id,
                'checkout_date' => $checkoutDate,
                'due_date' => $dueDate,
                'return_date' => null,
                'checkout_condition' => $bookCopy->condition,
                'return_condition' => null,
                'base_fee' => $fee,
                'renewal_count' => rand(0, 2),
            ]);
        }

        // Create some returned checkouts
        $returnCount = min(10, count($checkedOutCopies));
        for ($i = 0; $i < $returnCount; $i++) {
            $bookCopy = $checkedOutCopies[$i];

            // Get a random duration from lending fees
            $lendingFee = LendingFee::where('category', $bookCopy->book->category)
                ->whereNull('effective_to')
                ->inRandomOrder()
                ->first();

            $duration = $lendingFee ? $lendingFee->duration_days : 14;
            $fee = $lendingFee ? $lendingFee->fee_amount : 2.00;

            $checkoutDate = Carbon::now()->subDays(rand($duration, $duration + 20));
            $dueDate = Carbon::parse($checkoutDate)->addDays($duration);

            // Some returns will be late
            $returnDate = rand(0, 10) < 7
                ? Carbon::parse($dueDate)->subDays(rand(1, 5)) // On time
                : Carbon::parse($dueDate)->addDays(rand(1, 10)); // Late

            // Determine if condition changed
            $conditions = ['new', 'good', 'fair', 'poor', 'damaged'];
            $checkoutConditionIdx = array_search($bookCopy->condition, $conditions);

            // Most returns have same condition, some are worse
            $returnConditionIdx = rand(0, 10) < 8
                ? $checkoutConditionIdx
                : min(count($conditions) - 1, $checkoutConditionIdx + rand(1, 2));

            $returnCondition = $conditions[$returnConditionIdx];

            // Set the copy to available
            $bookCopy->status = 'available';
            $bookCopy->condition = $returnCondition; // Update to return condition
            $bookCopy->save();

            Checkout::create([
                'user_id' => $members->random()->id,
                'book_copy_id' => $bookCopy->id,
                'reservation_id' => null,
                'staff_id' => $staff->random()->id,
                'checkout_date' => $checkoutDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'checkout_condition' => $conditions[$checkoutConditionIdx],
                'return_condition' => $returnCondition,
                'base_fee' => $fee,
                'renewal_count' => rand(0, 2),
            ]);
        }
    }
}
