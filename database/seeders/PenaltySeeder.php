<?php

namespace Database\Seeders;

use App\Models\Checkout;
use App\Models\Penalty;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penalties')->insert([
            [
                'type' => 'fine_per_damage_level',
                'description' => 'Fee charged when a book is returned in worse condition than when checked out',
                'base_amount' => 5000,
                'is_daily_rate' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'fine_per_day_exceeded',
                'description' => 'Fee charged for each day the book is returned after the due date',
                'base_amount' => 2000,
                'is_daily_rate' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
