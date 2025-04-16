<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'book_copy_id',
        'transaction_type',
        'checkout_date',
        'due_date',
        'return_date',
        'fine_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class);
    }
}