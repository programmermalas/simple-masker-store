<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Cart;
use Carbon\Carbon;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Bill;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function index()
    {
        return abort(404);
    }

    public function store(Request $request)
    {
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
            $count      = Order::withTrashed()->count();
            $invoice    = Carbon::now()->format('d/m/Y/') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        
            $order = Order::create([
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
        
            Bill::create([
                'id'        => Str::uuid(),
                'order_id'  => $order->id,
                'shipping'  => $request->shipping,
                'weight'    => $request->weight,
                'total'     => $request->total
            ]);
        
            $items  = Cart::getContent();
        
            foreach ( $items as $item ) {
                OrderProduct::create([
                    'id'        => Str::uuid(),
                    'order_id'  => $order->id,
                    'product_id'=> $item->id,
                    'quantity'  => $item->quantity
                ]);
            }
    
            $items  = Cart::clear();
    
            Mail::to( $order->email )->send( new OrderMail( $order ) );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    
        return view( 'pages.guest.order.index', compact('order') );
    }

    public function detail( Request $request )
    {
        if ( $request->invoice ) {
            $order  = Order::where( 'invoice', $request->invoice )->first();
        
            if (!$order) {
                return redirect( '/order/detail' )->with('info', 'Order not found!');
            }
        }
    
        return view( 'pages.guest.order.detail', compact('order') );
    }
}
