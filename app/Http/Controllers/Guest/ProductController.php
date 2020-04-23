<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

use App\Models\Product;

class ProductController extends Controller
{
    public function detail($slug) {
        $product    = Product::where('slug', $slug)->first();

        return view('pages.guest.product.detail', compact('product'));
    }

    public function store(Request $request, $slug) {
        $product    = Product::where('slug', $slug)->first();

        $cart       = Cart::get($product->id);
        $price      = 0;
        $quantity   = $request->quantity;

        if ($cart) {
            $quantity   = $cart->quantity + $request->quantity;
        }

        if ($quantity >= 1000) {
            $price  = $product->price_c;
        } elseif ($quantity >= 100 && $quantity < 1000) {
            $price  = $product->price_b;
        } else {
            $price  = $product->price_a;
        }

        Cart::add([
            'id'            => $product->id,
            'name'          => $product->title,
            'price'         => $price,
            'quantity'      => $request->quantity,
            'attributes'    => [
                'weight'    => $product->weight
            ]
        ]);

        return redirect()->back()->with('success', 'Item added to cart');
    }
}
