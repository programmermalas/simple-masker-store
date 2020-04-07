<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use PDF;
use Carbon\Carbon;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        try {
            $orders = Order::where( 'invoice', 'LIKE', '%' . $request->search . '%' )
                ->orWhere( 'first_name', 'LIKE', '%' . $request->search . '%' )
                ->orWhere( 'last_name', 'LIKE', '%' . $request->search . '%' )
                ->orWhere( 'status', 'LIKE', '%' . $request->search . '%' )
                ->orderByDesc('created_at')
                ->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('pages.admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.order.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('pages.admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('pages.admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'resi'      => 'max:30',
            'status'    => 'required',
        ]);

        try {
            $order->update([
                'resi'      => $request->resi,
                'status'    => $request->status
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.order.index')->with('info', "Order $order->invoice updated!");
    }

    public function print( Request $request ) {
        $request->validate([
            'date'      => 'date_format:d/m/Y',
            'status'    => 'required'
        ]);

        try {
            $date   = Carbon::createFromFormat('d/m/Y', $request->date);
            $datas  = Order::with('orderProducts')->whereDate('created_at', $date)->where('status', $request->status)->get();

            $pdf    = PDF::loadView('pdfs.order', compact('datas', 'date'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return $pdf->stream('Order ' . $date->format('d-m-Y'));
    }
}
