<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCopy;
use Illuminate\Database\Seeder;

class BookCopySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();

        foreach ($books as $book) {
            // Create between 2 and 5 copies for each book
            $copyCount = rand(2, 5);

            $conditions = ['new', 'good', 'fair', 'poor', 'damaged'];
            $statuses = ['available', 'checked_out', 'reserved', 'in_repair'];
            $locations = ['Main Floor', 'Second Floor', 'Basement', 'Special Collection', 'Reference Section'];

            for ($i = 1; $i <= $copyCount; $i++) {
                // Weight the status distribution to make 'available' more common
                $statusIndex = mt_rand(1, 10) <= 6 ? 0 : mt_rand(0, 3);

                BookCopy::create([
                    'book_id' => $book->id,
                    'copy_number' => $i,
                    'status' => $statuses[$statusIndex],
                    'condition' => $conditions[mt_rand(0, 4)],
                    'acquisition_date' => now()->subDays(rand(10, 500)),
                    'location' => $locations[mt_rand(0, 4)],
                ]);
            }
        }
    }
}
