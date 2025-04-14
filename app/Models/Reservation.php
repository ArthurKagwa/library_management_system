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
        'book_copy_id',
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

//get stats for reservations depending on status and also total reservations
    public static function getStats()
    {
        return [
            [
                'title' => 'Total Reservations',
                'value' => self::count(),
                'icon' => 'fas fa-book',
                'color' => 'blue',
            ],
            [
                'title' => 'Pending',
                'value' => self::where('status', 'pending')->count(),
                'icon' => 'fas fa-clock',
                'color' => 'yellow',
            ],
            [
                'title' => 'Ready for Pickup',
                'value' => self::where('status', 'ready_for_pickup')->count(),
                'icon' => 'fas fa-inbox',
                'color' => 'green',
            ],
            [
                'title' => 'Picked Up',
                'value' => self::where('status', 'picked_up')->count(),
                'icon' => 'fas fa-check-circle',
                'color' => 'indigo',
            ],
            [
                'title' => 'Expired',
                'value' => self::where('status', 'expired')->count(),
                'icon' => 'fas fa-times-circle',
                'color' => 'red',
            ],
            [
                'title' => 'Cancelled',
                'value' => self::where('status', 'cancelled')->count(),
                'icon' => 'fas fa-ban',
                'color' => 'gray',
            ]
        ];
    }



}
