<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'published_date',
    ];

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function availableCopies()
    {
        return $this->copies()->where('status', 'available');
    }


    public static function available(mixed $book_id)
    {
        // Check if the book is available
        $book = self::find($book_id);
        if ($book) {
            // Check if the book is available
            //if the number of copies is greater than their is a copy of the book whose status is available
            $availableCopies = BookCopy::where('book_id', $book->id)
                ->where('status', 'available')
                ->count();

            return $availableCopies>0;

        }
        return false;
    }

}
