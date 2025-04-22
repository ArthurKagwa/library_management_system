<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LendingFee extends Model
{
//id
//category
//duration_days
//fee_amount
//effective_from
//effective_to
//created_at
//updated_at

    protected $table = 'lending_fees';
    protected $fillable = [
        'category',
        'duration_days',
        'fee_amount',
        'effective_from',
        'effective_to',
    ];
    protected $casts = [
        'effective_from' => 'datetime',
        'effective_to' => 'datetime',
    ];




}
