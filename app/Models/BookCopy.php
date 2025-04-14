<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    // Attributes
//id,bigint unsigned
//book_id,bigint unsigned
//copy_number,varchar(191)
//status,"enum('available','checked_out','reserved','in_repair')"
//condition,"enum('new','good','fair','poor','damaged')"
//acquisition_date,date
//location,varchar(191)
//created_at,timestamp
//updated_at,timestamp

//create enumfor status
//create enumfor condition
    const STATUS_AVAILABLE = 'available';
    const STATUS_CHECKED_OUT = 'checked_out';
    public $status = [
        'available',
        'checked_out',
        'reserved',
        'in_repair'
    ];


    protected $fillable = [
        'book_id',
        'copy_number',
        'status',
        'condition',
        'acquisition_date',
        'location'
    ];

    protected $casts = [
        'acquisition_date' => 'date',
    ];

    // Define relationships
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /*
     * Select available copy of particular book given book_id
     */
    public static function getAvailableCopies($bookId)
        {
           return self::where('book_id', $bookId)
                                  ->where('status', 'available')
                                  ->get();
        }

}
