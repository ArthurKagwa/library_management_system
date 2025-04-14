<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public static function available(mixed $book_id)
    {
        // Check if the book is available
        $book = self::find($book_id);
        if ($book) {
            // Check if the book is available
            //if the number of copies is greater than the number of reservations and
        }
        return false;
    }
}
