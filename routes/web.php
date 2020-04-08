<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderMail;

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

    return view( 'pages.guest.welcome', compact('products') );
});

Route::get('/product/{product}', 'Guest\ProductController@detail');

Route::post('/product/{product}', 'Guest\ProductController@store');

Route::get('/cart', 'Guest\CartController@index');

Route::post('/cart', 'Guest\CartController@update');

Route::get('/cart/{id}/delete', 'Guest\CartController@destroy');

Route::get('/checkout', 'Guest\CheckoutController@index');

Route::get('/order', 'Guest\OrderController@index');

Route::post('/order', 'Guest\OrderController@store');

Route::get('/order/detail', 'Guest\OrderController@detail');

Route::get('/payment', 'Guest\PaymentController@index');

Route::post('/payment', 'Guest\PaymentController@store');

Auth::routes([
    'register'  => false,
    'reset'     => false,
]);

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/', 'Admin\HomeController@index')->name('home');

        Route::resource('payment', 'Admin\PaymentController')->only([
            'index', 'edit', 'update'
        ]);

        Route::resource('product', 'Admin\ProductController');

        Route::get('/order/print', 'Admin\OrderController@print')->name('order.print');

        Route::get('/order/table', 'Admin\OrderController@table')->name('order.table');

        Route::resource('order', 'Admin\OrderController')->except([
            'create', 'store', 'destroy'
        ]);
    });
});
