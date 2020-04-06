<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;

use App\Models\Product;

class ProductController extends Controller
{
    public function detail( $slug ) {
        $product    = Product::where( 'slug', $slug )->first();

        return view( 'pages.guest.product.detail', compact('product') );
    }

    public function store( Request $request, $slug ) {
        $product    = Product::where( 'slug', $slug )->first();

        Cart::add(array(
            'id'            => $product->id,
            'name'          => $product->title,
            'price'         => $product->price,
            'quantity'      => $request->quantity,
            'attributes'    => [
                'weight'    => $product->weight
            ]
        ));

        return redirect()->back()->with('success', 'Item added to cart');
    }
}
