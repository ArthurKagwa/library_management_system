<?php

namespace Database\Seeders;

use App\Models\Checkout;
use App\Models\Penalty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get completed checkouts (has return_date)
        $completedCheckouts = Checkout::whereNotNull('return_date')->get();

        // Get librarians with Spatie roles
        $staff = User::role('librarian')->get();

        $penalties = [];

        foreach ($completedCheckouts as $checkout) {
            // Check for late returns
            $dueDate = Carbon::parse($checkout->due_date);
            $returnDate = Carbon::parse($checkout->return_date);

            if ($returnDate->gt($dueDate)) {
                // Calculate days late
                $daysLate = $returnDate->diffInDays($dueDate);

                // $1 per day late
                $amount = $daysLate * 1.00;

                // Create late penalty
                $latePenalty = [
                    'checkout_id' => $checkout->id,
                    'penalty_type' => 'delay',
                    'amount' => $amount,
                    'description' => "Book returned {$daysLate} days late",
                    'status' => rand(0, 10) < 7 ? 'paid' : 'pending',
                    'issue_date' => $returnDate,
                    'payment_date' => null,
                    'payment_reference' => null,
                    'staff_id' => $staff->random()->id,
                    'created_at' => $returnDate,
                    'updated_at' => $returnDate,
                ];

                // Set payment date for paid penalties
                if ($latePenalty['status'] === 'paid') {
                    $latePenalty['payment_date'] = Carbon::parse($returnDate)->addDays(rand(1, 5));
                    $latePenalty['payment_reference'] = 'PAY-' . strtoupper(substr(md5(rand()), 0, 10));
                    $latePenalty['updated_at'] = $latePenalty['payment_date'];
                }

                $penalties[] = $latePenalty;
            }

            // Check for damage
            $checkoutConditionIdx = array_search($checkout->checkout_condition,
                ['new', 'good', 'fair', 'poor', 'damaged']);
            $returnConditionIdx = array_search($checkout->return_condition,
                ['new', 'good', 'fair', 'poor', 'damaged']);

            // If condition worsened significantly (2+ levels)
            if ($returnConditionIdx - $checkoutConditionIdx >= 2) {
                // Damage penalty based on severity
                $damageSeverity = $returnConditionIdx - $checkoutConditionIdx;
                $amount = $damageSeverity * 5.00;

                // Create damage penalty
                $damagePenalty = [
                    'checkout_id' => $checkout->id,
                    'penalty_type' => 'damage',
                    'amount' => $amount,
                    'description' => "Book condition degraded from {$checkout->checkout_condition} to {$checkout->return_condition}",
                    'status' => rand(0, 10) < 5 ? 'paid' : 'pending',
                    'issue_date' => $returnDate,
                    'payment_date' => null,
                    'payment_reference' => null,
                    'staff_id' => $staff->random()->id,
                    'created_at' => $returnDate,
                    'updated_at' => $returnDate,
                ];

                // Set payment date for paid penalties
                if ($damagePenalty['status'] === 'paid') {
                    $damagePenalty['payment_date'] = Carbon::parse($returnDate)->addDays(rand(1, 10));
                    $damagePenalty['payment_reference'] = 'PAY-' . strtoupper(substr(md5(rand()), 0, 10));
                    $damagePenalty['updated_at'] = $damagePenalty['payment_date'];
                }

                $penalties[] = $damagePenalty;
            }
        }

        // Insert all penalties
        foreach ($penalties as $data) {
            Penalty::create($data);
        }
    }
}
