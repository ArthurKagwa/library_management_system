<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //
    protected $fillable = [
        'book_copy_id',
        'user_id',
        'checkout_date',
        'due_date',
        'return_date',
        'checkout_condition',
        'base_fee',
        'reservation_id'
    ];

    protected $casts = [
        'checkout_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function book()
    {
        return $this->hasOneThrough(Book::class, BookCopy::class, 'id', 'id', 'book_copy_id', 'book_id');
    }

    // In App\Models\Checkout.php
    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class, 'book_copy_id');
    }

    // Checkout method
    public function checkout($checkoutData)
    {
        $this->book_copy_id = $checkoutData['book_copy_id'];
        $this->user_id = $checkoutData['user_id'];
        $this->checkout_date = now();
        $this->due_date = now()->addDays(14); // Example: 14 days from checkout
        $this->checkout_condition = $checkoutData['checkout_condition'];
        $this->base_fee = 2000; // Set base fee as needed
        $this->save();
    }
}
