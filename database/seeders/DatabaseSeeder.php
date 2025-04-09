<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // in DatabaseSeeder.php
        Role::create(['name' => 'member']);
        Role::create(['name' => 'librarian']);
        Role::create(['name' => 'manager']);

        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J. B. Lippincott & Co.',
                'publication_year' => '1960',
                'isbn' => '9780061120084',
                'image' => 'mockingbird.jpg',
                'location' => 'Fiction Aisle, Shelf 12',
                'quantity' => 5,
                'pages' => 281,
                'status' => 'available',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'publication_year' => '1949',
                'isbn' => '9780451524935',
                'image' => '1984.jpg',
                'location' => 'Classics Section, Shelf 7',
                'quantity' => 3,
                'pages' => 328,
                'status' => 'available',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Charles Scribner\'s Sons',
                'publication_year' => '1925',
                'isbn' => '9780743273565',
                'image' => 'gatsby.jpg',
                'location' => 'Classics Section, Shelf 5',
                'quantity' => 4,
                'pages' => 180,
                'status' => 'available',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'publisher' => 'T. Egerton, Whitehall',
                'publication_year' => '1813',
                'isbn' => '9780141439518',
                'image' => 'pride.jpg',
                'location' => 'Romance Aisle, Shelf 3',
                'quantity' => 2,
                'pages' => 279,
                'status' => 'available',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'George Allen & Unwin',
                'publication_year' => '1937',
                'isbn' => '9780547928227',
                'image' => 'hobbit.jpg',
                'location' => 'Fantasy Section, Shelf 9',
                'quantity' => 6,
                'pages' => 310,
                'status' => 'available',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'publisher' => 'Little, Brown and Company',
                'publication_year' => '1951',
                'isbn' => '9780316769488',
                'image' => 'catcher.jpg',
                'location' => 'Fiction Aisle, Shelf 15',
                'quantity' => 1,
                'pages' => 234,
                'status' => 'reserved',
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'George Allen & Unwin',
                'publication_year' => '1954',
                'isbn' => '9780544003415',
                'image' => 'lotr.jpg',
                'location' => 'Fantasy Section, Shelf 10',
                'quantity' => 0,
                'pages' => 1178,
                'status' => 'lost',
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'publication_year' => '1997',
                'isbn' => '9780747532743',
                'image' => 'harrypotter.jpg',
                'location' => 'Children\'s Section, Shelf 1',
                'quantity' => 8,
                'pages' => 223,
                'status' => 'available',
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'publisher' => 'Doubleday',
                'publication_year' => '2003',
                'isbn' => '9780307474278',
                'image' => 'davinci.jpg',
                'location' => 'Thriller Aisle, Shelf 8',
                'quantity' => 3,
                'pages' => 454,
                'status' => 'available',
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'publisher' => 'HarperTorch',
                'publication_year' => '1988',
                'isbn' => '9780061122415',
                'image' => 'alchemist.jpg',
                'location' => 'Inspiration Section, Shelf 4',
                'quantity' => 7,
                'pages' => 197,
                'status' => 'available',
            ],
        ];

        foreach ($books as $book) {
            Book::factory()->create($book);
        }
    }
}
