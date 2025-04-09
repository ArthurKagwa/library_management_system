<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'publication_year' => $this->faker->year,
            'isbn' => $this->generateValidISBN(),
            'image' => 'book-' . $this->faker->numberBetween(1, 10) . '.jpg',
            'location' => 'Shelf ' . $this->faker->randomLetter . $this->faker->numberBetween(1, 20),
            'quantity' => $this->faker->numberBetween(0, 10),
            'pages' => $this->faker->numberBetween(100, 800),
            'status' => $this->faker->randomElement(['available', 'reserved', 'lost']),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }

    public function available()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'available',
                'quantity' => $this->faker->numberBetween(1, 10),
            ];
        });
    }

    public function reserved()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'reserved',
                'quantity' => $this->faker->numberBetween(0, 5),
            ];
        });
    }

    public function lost()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'lost',
                'quantity' => 0,
            ];
        });
    }

    public function withSpecificAuthor(string $author)
    {
        return $this->state(function (array $attributes) use ($author) {
            return [
                'author' => $author,
            ];
        });
    }

    private function generateValidISBN(): string
    {
        $prefix = '978';
        $group = (string) $this->faker->numberBetween(0, 5);
        $publisher = (string) $this->faker->numberBetween(200, 699);
        $title = (string) $this->faker->numberBetween(100000, 999999);
        $checkDigit = $this->faker->numberBetween(0, 9);

        return "{$prefix}-{$group}-{$publisher}-{$title}-{$checkDigit}";
    }
}
