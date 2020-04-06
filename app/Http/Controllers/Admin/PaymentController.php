<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $payments   = Payment::all();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return view( 'pages.admin.payment.index', compact('payments') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view( 'pages.admin.payment.edit', compact('payment') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'id'    => 'required'
        ]);

        
        try {
            $order  = Order::with( 'orderProducts.product' )->where( 'id', $request->id )->first();

            foreach ( $order->orderProducts as $orderProduct ) {
                $subQuantity = $orderProduct->product->stock - $orderProduct->quantity;

                if ( $subQuantity < 0 ) {
                    $subQuantity = 0;
                }

                $orderProduct->product->update([
                    'stock' => $subQuantity
                ]);
            }

            $order->update([
                'status'    => 'paid'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with( 'error', $e->getMessage() );
        }

        return redirect()->back()->with( 'info', 'Payment received!' );
    }
}
