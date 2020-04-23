<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

use App\Models\Product;

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
            $product    = Product::findOrFail($id);

            $price      = 0;
            $quantity   = (int) $request->quantities[$key];

            if ($quantity >= 50 && $quantity < 100) {
                $price  = $product->price_a;
            } elseif ($quantity >= 100 && $quantity < 1000) {
                $price  = $product->price_b;
            } elseif ($quantity >= 1000) {
                $price  = $product->price_c;
            }

            Cart::update($product->id, [
                'price'     => $price,
                'quantity'  => [
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
