<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //attributes
//id
//user_id
//book_id
//staff_id
//status
//reservation_date
//ready_for_pickup_date
//pickup_deadline
//actual_pickup_date
//notification_sent
//created_at
//updated_at

    protected $fillable = [
        'user_id',
        'book_id',
        'staff_id',
        'status',
        'reservation_date',
        'ready_for_pickup_date',
        'pickup_deadline',
        'actual_pickup_date',
        'notification_sent'
    ];
    protected $casts = [
        'reservation_date' => 'datetime',
        'ready_for_pickup_date' => 'datetime',
        'pickup_deadline' => 'datetime',
        'actual_pickup_date' => 'datetime',
        'notification_sent' => 'boolean'
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

//    public function staff()
//    {
//        return $this->belongsTo(Librarian::class, 'staff_id');
//    }

}
