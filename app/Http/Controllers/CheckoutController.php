<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function view($checkoutId){

        $checkout = Checkout::with('book')->find($checkoutId);

        if (!$checkout) {
            abort(404, 'Checkout not found');
        }
//        dd($checkout);

        return view('member.view-checkout', compact('checkout'));
    }
}
