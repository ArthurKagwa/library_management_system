<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'user_id',
        'book_copy_id',
        'reservation_id',
        'staff_id',
        'checkout_date',
        'due_date',
        'return_date',
        'checkout_condition',
        'return_condition',
        'base_fee',
        'renewal_count'
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

    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}