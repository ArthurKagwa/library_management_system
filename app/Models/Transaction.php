<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'checked_out_at',
        'due_date',
        'returned_at',
        'status',
        'pick_up_date',

    ];

    protected $dates = [
        'checked_out_at',
        'due_date',
        'returned_at'
    ];

    // Relationship to Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //reserve book

}
