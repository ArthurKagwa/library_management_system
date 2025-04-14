<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First seed users with roles
        $this->call(UserRoleSeeder::class);

        // Then seed books and copies
        $this->call(BookSeeder::class);
        $this->call(BookCopySeeder::class);

        // Seed fee structure
        $this->call(LendingFeeSeeder::class);

        // Seed transactions in logical order
//        $this->call(ReservationSeeder::class);
        $this->call(CheckoutSeeder::class);
        $this->call(PenaltySeeder::class);
    }
}
