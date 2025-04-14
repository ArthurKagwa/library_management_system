<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LendingFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Fiction', 'Romance', 'Fantasy', 'Programming', 'Science', 'History', 'Reference'];
        $durations = [7, 14, 30];

        $fees = [];

        foreach ($categories as $category) {
            foreach ($durations as $duration) {
                // Base fee calculation - more popular categories or longer durations cost more
                $baseFee = 0;

                // Popular categories have higher fees
                if (in_array($category, ['Fiction', 'Fantasy'])) {
                    $baseFee += 2.00;
                } elseif (in_array($category, ['Programming', 'Reference'])) {
                    $baseFee += 3.00;
                } else {
                    $baseFee += 1.50;
                }

                // Longer durations cost more
                if ($duration == 7) {
                    $baseFee += 1.00;
                } elseif ($duration == 14) {
                    $baseFee += 2.00;
                } else {
                    $baseFee += 3.50;
                }

                $fees[] = [
                    'category' => $category,
                    'duration_days' => $duration,
                    'fee_amount' => $baseFee,
                    'effective_from' => now()->subMonths(3),
                    'effective_to' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Add some historical rates for demonstration
        $fees[] = [
            'category' => 'Fiction',
            'duration_days' => 7,
            'fee_amount' => 2.50,
            'effective_from' => now()->subMonths(12),
            'effective_to' => now()->subMonths(3)->subDay(),
            'created_at' => now()->subMonths(12),
            'updated_at' => now()->subMonths(3),
        ];

        DB::table('lending_fees')->insert($fees);
    }
}
