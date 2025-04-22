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
        return $this->belongsTo(User::class, 'user_id');
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

    // calclate fine
    public function calculateFine($returnCondition)
    {
        $conditions = ['new', 'good', 'fair', 'poor', 'damaged'];
        $checkoutIndex = array_search($this->checkout_condition, $conditions);
        $returnIndex = array_search($returnCondition, $conditions);

        if ($returnIndex === false || $checkoutIndex === false) {
            return 0; // Invalid condition, no fine
        }

        $levelsBelow = $returnIndex - $checkoutIndex;

        if ($levelsBelow > 0) {
           $finePerLevel = Penalty::where('type', 'fine_per_damage_level')->value('base_amount');
            return $levelsBelow * $finePerLevel;
        }

        return 0; // No fine if the condition is the same or better
    }
}
