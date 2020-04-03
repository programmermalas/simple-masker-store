<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        'id'            => $product->id,
        'name'          => $product->title,
        'price'         => $product->price,
        'quantity'      => $request->quantity,
        'attributes'    => [
            'weight'    => $product->weight
        ]
    ));

    return redirect()->back()->with('success', 'Item added to cart');
});

Route::get('/cart', function () {
    $carts  = \Cart::getContent();

    return view('cart', compact('carts', 'weight'));
});

Route::get('/cart/{id}/delete', function ( $id ) {
    $carts  = \Cart::remove( $id );

    return redirect()->back()->with('warning', 'Item removed in cart');
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
    $carts  = \Cart::getContent();
    $weight = 0;

    foreach ( $carts as $cart ) {
        $weight += $cart->attributes['weight'] * $cart->quantity;
    }

    return view('checkout', compact('weight'));
});

Route::post('/order', function ( Request $request ) {
    $request->validate([
        'first_name'    => 'required|max:25',
        'last_name'     => 'required|max:25',
        'province'      => 'required',
        'city'          => 'required',
        'street'        => 'required|max:100',
        'postcode'      => 'required|max:10',
        'phone'         => 'required|max:15',
        'email'         => 'required|email',
        'shipping'      => 'required',
        'weight'        => 'required',
        'total'         => 'required'
    ]);

    try {
        $count  = App\Models\Order::withTrashed()->count();
        $invoice    = Carbon\Carbon::now()->format('d/m/Y/') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    
        $order = App\Models\Order::create([
            'id'            => Str::uuid(),
            'invoice'       => $invoice,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'province_id'   => $request->province,
            'city_id'       => $request->city,
            'street'        => $request->street,
            'postcode'      => $request->postcode,
            'phone'         => $request->phone,
            'email'         => $request->email,
        ]);
    
        App\Models\Bill::create([
            'id'        => Str::uuid(),
            'order_id'  => $order->id,
            'shipping'  => $request->shipping,
            'weight'    => $request->weight,
            'total'     => $request->total
        ]);
    
        $items  = \Cart::getContent();
    
        foreach ( $items as $item ) {
            App\Models\OrderProduct::create([
                'id'        => Str::uuid(),
                'order_id'  => $order->id,
                'product_id'=> $item->id,
                'quantity'  => $item->quantity
            ]);
        }

        $items  = \Cart::clear();
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }

    return view('order', compact('order'));
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
            'create', 'store', 'destroy'
        ]);
    });
});
