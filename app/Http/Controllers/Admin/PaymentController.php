<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DataTables;

use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.payment.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('pages.admin.payment.edit', compact('payment'));
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
            $order  = Order::with('orderProducts.product')->where('id', $request->id)->first();

            if ($order->status == 'paid') {
                return redirect()->back()->with('info', 'Payment already paid!');
            }

            if ($order->status == 'sended') {
                return redirect()->back()->with('info', 'Payment already sended!');
            }

            if ($order->status == 'delivered') {
                return redirect()->back()->with('info', 'Payment already delivered!');
            }

            if ($order->status == 'canceled') {
                return redirect()->back()->with('info', 'Payment already canceled!');
            }

            foreach ($order->orderProducts as $orderProduct) {
                $subQuantity = $orderProduct->product->stock - $orderProduct->quantity;

                if ($subQuantity < 0) {
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
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('info', 'Payment received!');
    }

    public function table(Request $request) {
        $data   = Payment::with('order')->whereHas('order', function ($order) {
                $order->where('status', 'payment_confirmation');
            })
            ->orderByDesc('created_at')
            ->get();

        $table  = Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('invoice', function ($payment) {
                return $payment->order->invoice;
            })
            ->addColumn('nominal', function ($payment) {
                return 'Rp ' . number_format($payment->nominal, 0, '.', ',');
            })
            ->addColumn('date', function ($payment) {
                return $payment->created_at->diffForHumans();
            })
            ->addColumn('action', function($payment) {
                    $btn = '
                        <a href="' . route('admin.payment.edit', $payment->id) . '" class="btn btn-sm btn-primary rounded-circle">
                            <i class="fas fa-edit"></i>
                        </a>
                    ';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $table;
    }
}
