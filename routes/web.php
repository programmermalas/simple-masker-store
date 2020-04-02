<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products   = App\Models\Product::with('productImage')->get();

    return view( 'welcome', compact('products') );
});

Route::get('/product/{product}', function ( $product ) {
    $product    = App\Models\Product::where( 'slug', $product )->first();

    return view( 'product', compact('product') );
});

Route::post('/product/{product}', function ( Request $request, $product ) {
    $product    = App\Models\Product::where( 'slug', $product )->first();

    \Cart::add(array(
        'id' => $product->id,
        'name' => $product->title,
        'price' => $product->price,
        'quantity' => $request->quantity,
    ));

    return redirect()->back()->with('success', 'Item added to cart');
});

Route::get('/cart', function () {
    $carts  = \Cart::getContent();

    return view('cart', compact('carts'));
});

Route::post('/cart', function ( Request $request ) {
    foreach ( $request->ids as $key => $id ) {
        Cart::update($id, [
            'quantity' => [
                'relative'  => false,
                'value'     => $request->quantities[$key]
            ]
        ]);
    }

    return redirect()->back()->with('info', 'Cart updated!');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/order', function () {
    return view('order');
});

Auth::routes([
    'register'  => false,
    'reset'     => false,
]);

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/', 'Admin\HomeController@index')->name('home');

        Route::resource('product', 'Admin\ProductController');

        Route::resource('order', 'Admin\OrderController')->except([
            'store', 'destroy'
        ]);
    });
});
