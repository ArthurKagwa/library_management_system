<?php

namespace App\Http\Controllers;

use App\Models\BookCopy;
use Illuminate\Http\Request;
use App\Models\LendingFee;

class LendingFeeController extends Controller
{
    public static function calculateBaseFee($copyId, $duration)
    {
        $category = BookCopy::find($copyId)->book->category;
        $baseFee = LendingFee::where('category', $category)
            ->where('duration_days', $duration)
            ->value('fee_amount');
        return $baseFee;

    }
}
