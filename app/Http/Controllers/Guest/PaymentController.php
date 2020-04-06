<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->path         = storage_path('app/public/invoices');
        $this->dimentions   = ['245', '300', '500'];
    }

    public function index()
    {
        return view('pages.guest.payment.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice'       => 'required|max:100',
            'account_name'  => 'required|max:100',
            'account_number'=> 'required|max:100',
            'nominal'       => 'required',
            'image'         => 'required|mimes:jpeg,jpg'
        ]);
    
        try {
            $order  = Order::where( 'invoice', $request->invoice )->first();
    
            if ( !$order ) {
                return redirect( '/payment' )->with('info', 'Invoice not found!');
            }
    
            $payment    = Payment::updateOrCreate([
                'order_id'      => $order->id,
            ],[
                'id'            => Str::uuid(),
                'account_name'  => $request->account_name,
                'account_number'=> $request->account_number,
                'nominal'       => $request->nominal,
                'note'          => $request->note
            ]);
    
            $fileName   = $this->uploadImage( $request->file('image'), $payment->account_name . '_' . $payment->account_number );

            $payment->paymentImage()->create([
                'id'            => Str::uuid(),
                'payment_id'    => $payment->id,
                'name'          => $fileName,
                'dimentions'    => implode( '|', $this->dimentions ),
                'path'          => $this->path
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    
        return redirect( '/payment' )->with('success', "Payment $payment->account_name successful send it!");
    }
}
