<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //

    // In App\Models\Checkout.php
    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class, 'book_copy_id');
    }
}
