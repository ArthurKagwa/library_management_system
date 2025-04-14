<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users with member and librarian roles using Spatie
        $members = User::role('member')->get();
        $staff = User::role('librarian')->get();
        $books = Book::all();

        // Generate a random set of reservations with various statuses
        $reservationData = [];

        // Create some pending reservations
        for ($i = 0; $i < 8; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(1, 5));

            $reservation = [
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'staff_id' => null,
                'status' => 'pending',
                'reservation_date' => $reservationDate,
                'ready_for_pickup_date' => null,
                'pickup_deadline' => null,
                'actual_pickup_date' => null,
                'notification_sent' => false,
                'created_at' => $reservationDate,
                'updated_at' => $reservationDate,
            ];

            $reservationData[] = $reservation;
        }

        // Create some ready for pickup reservations
        for ($i = 0; $i < 5; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(5, 10));
            $readyDate = Carbon::now()->subDays(rand(1, 3));

            $reservation = [
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'staff_id' => $staff->random()->id,
                'status' => 'ready_for_pickup',
                'reservation_date' => $reservationDate,
                'ready_for_pickup_date' => $readyDate,
                'pickup_deadline' => $readyDate->copy()->addDays(3),
                'actual_pickup_date' => null,
                'notification_sent' => true,
                'created_at' => $reservationDate,
                'updated_at' => $readyDate,
            ];

            $reservationData[] = $reservation;
        }

        // Create some picked up reservations
        for ($i = 0; $i < 10; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(10, 20));
            $readyDate = $reservationDate->copy()->addDays(rand(1, 3));
            $pickupDate = $readyDate->copy()->addDays(rand(0, 2));

            $reservation = [
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'staff_id' => $staff->random()->id,
                'status' => 'picked_up',
                'reservation_date' => $reservationDate,
                'ready_for_pickup_date' => $readyDate,
                'pickup_deadline' => $readyDate->copy()->addDays(3),
                'actual_pickup_date' => $pickupDate,
                'notification_sent' => true,
                'created_at' => $reservationDate,
                'updated_at' => $pickupDate,
            ];

            $reservationData[] = $reservation;
        }

        // Create some expired reservations
        for ($i = 0; $i < 3; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(15, 30));
            $readyDate = $reservationDate->copy()->addDays(rand(1, 3));
            $pickupDeadline = $readyDate->copy()->addDays(3);
            $expiredDate = $pickupDeadline->copy()->addDays(1);

            $reservation = [
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'staff_id' => $staff->random()->id,
                'status' => 'expired',
                'reservation_date' => $reservationDate,
                'ready_for_pickup_date' => $readyDate,
                'pickup_deadline' => $pickupDeadline,
                'actual_pickup_date' => null,
                'notification_sent' => true,
                'created_at' => $reservationDate,
                'updated_at' => $expiredDate,
            ];

            $reservationData[] = $reservation;
        }

        // Create some cancelled reservations
        for ($i = 0; $i < 2; $i++) {
            $reservationDate = Carbon::now()->subDays(rand(5, 15));
            $cancelDate = $reservationDate->copy()->addDays(rand(1, 3));

            $reservation = [
                'user_id' => $members->random()->id,
                'book_id' => $books->random()->id,
                'staff_id' => $staff->random()->id,
                'status' => 'cancelled',
                'reservation_date' => $reservationDate,
                'ready_for_pickup_date' => null,
                'pickup_deadline' => null,
                'actual_pickup_date' => null,
                'notification_sent' => false,
                'created_at' => $reservationDate,
                'updated_at' => $cancelDate,
            ];

            $reservationData[] = $reservation;
        }

        // Insert all reservations
        foreach ($reservationData as $data) {
            Reservation::create($data);
        }
    }
}
