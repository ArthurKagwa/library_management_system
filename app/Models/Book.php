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
            //if the number of copies is greater than their is a copy of the book whose status is available
            $availableCopies = BookCopy::where('book_id', $book->id)
                ->where('status', 'available')
                ->count();

            return $availableCopies>0;

        }
        return false;
    }

}
