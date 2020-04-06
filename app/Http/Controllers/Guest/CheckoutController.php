<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index() {
        if ( Cart::getTotalQuantity() < 100 ) {
            return redirect()->back()->with('info', 'Minimal order 100!');
        }

        $carts  = Cart::getContent();
        $weight = 0;

        foreach ( $carts as $cart ) {
            $weight += $cart->attributes['weight'] * $cart->quantity;
        }

        return view( 'pages.guest.checkout.index', compact('weight') );
    }
}
