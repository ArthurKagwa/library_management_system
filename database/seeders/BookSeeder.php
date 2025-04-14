<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780446310789',
                'edition' => 'First Edition',
                'pages' => 281,
                'category' => 'Fiction',
                'description' => 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it.',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'edition' => 'Reprint',
                'pages' => 328,
                'category' => 'Fiction',
                'description' => 'A dystopian novel by English novelist George Orwell about a society ruled by totalitarian government surveillance.',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'edition' => 'Scribner',
                'pages' => 180,
                'category' => 'Fiction',
                'description' => 'The story of eccentric millionaire Jay Gatsby and his passion for the beautiful Daisy Buchanan.',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'isbn' => '9780141439518',
                'edition' => 'Revised',
                'pages' => 432,
                'category' => 'Romance',
                'description' => 'The story follows the main character, Elizabeth Bennet, as she deals with issues of manners, upbringing, morality, education, and marriage.',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'isbn' => '9780547928227',
                'edition' => 'Reprint',
                'pages' => 366,
                'category' => 'Fantasy',
                'description' => 'The unlikely tale of Bilbo Baggins\' adventure with dwarves to reclaim their treasure from a dragon.',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'isbn' => '9780316769488',
                'edition' => 'Little, Brown and Company',
                'pages' => 277,
                'category' => 'Fiction',
                'description' => 'The story of Holden Caulfield, a teenage boy dealing with alienation and loss.',
            ],
            [
                'title' => 'Python Crash Course',
                'author' => 'Eric Matthes',
                'isbn' => '9781593279288',
                'edition' => 'Second Edition',
                'pages' => 544,
                'category' => 'Programming',
                'description' => 'A hands-on, project-based introduction to programming with Python.',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9780132350884',
                'edition' => 'First Edition',
                'pages' => 464,
                'category' => 'Programming',
                'description' => 'A handbook of agile software craftsmanship.',
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '9780553380163',
                'edition' => 'Updated and Expanded',
                'pages' => 212,
                'category' => 'Science',
                'description' => 'A landmark volume in science writing by one of the great minds of our time.',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '9780062316097',
                'edition' => 'First U.S. Edition',
                'pages' => 443,
                'category' => 'History',
                'description' => 'A bold, provocative history of humans from a renowned historian and professor.',
            ],
        ];

        foreach ($books as $book) {
            // generate random quantity between 15 and 20
            $book['quantity'] = rand(15, 20);
            Book::create($book);
        }
    }
}
