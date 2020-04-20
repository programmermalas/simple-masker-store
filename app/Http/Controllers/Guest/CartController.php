<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index() {
        $carts  = Cart::getContent();
        
        return view('pages.guest.cart.index', compact('carts'));
    }

    public function update(Request $request) {
        if (!$request->has('ids')) {
            return redirect()->back()->with('warning', 'Cart is empty!');
        }

        foreach ($request->ids as $key => $id) {
            Cart::update($id, [
                'quantity' => [
                    'relative'  => false,
                    'value'     => $request->quantities[$key]
                ]
            ]);
        }
    
        return redirect()->back()->with('info', 'Cart updated!');
    }

    public function destroy($id) {
        $carts  = \Cart::remove($id);

        return redirect()->back()->with('warning', 'Item removed in cart');
    }
}
