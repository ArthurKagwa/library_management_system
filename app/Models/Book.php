<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    const STATUS_CHECKED_OUT = 'checked_out';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'image',
        'location',
        'quantity',
        'pages',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publication_year' => 'integer',
        'quantity' => 'integer',
        'pages' => 'integer'
    ];

    /**
     * Status options for the book
     */
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_LOST = 'lost';

    /**
     * Get the status options for the book
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_RESERVED => 'Reserved',
            self::STATUS_LOST => 'Lost'
        ];
    }

    public static function count(): int
    {
        return Book::all()->count();
    }


    /**
     * Scope a query to only include available books.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable(Builder $query)
    {
        return $query->where('status', self::STATUS_AVAILABLE)
            ->where('quantity', '>', 0);
    }

    /**
     * Get the image URL for the book
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/books/' . $this->image);
        }
        return asset('images/default-book.jpg');
    }

    /**
     * Relationship with transactions (loans)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Check if the book is available for borrowing
     *
     * @return bool
     */
    public function isAvailable()
    {
        return $this->status === self::STATUS_AVAILABLE && $this->quantity > 0;
    }

    /**
     * Validation rules for the book
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer|min:1800|max:' . "(date('Y') + 1)",
            'isbn' => 'required|string|unique:books,isbn',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:100',
            'quantity' => 'required|integer|min:0',
            'pages' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved,lost'
        ];
    }
}
