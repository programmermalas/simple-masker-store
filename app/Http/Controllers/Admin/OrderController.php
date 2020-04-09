<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use PDF;
use Carbon\Carbon;
use DataTables;

use App\Models\Order;
use App\Models\Province;
use App\Models\City;

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
    public function index()
    {
        return view('pages.admin.order.index');
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

    public function table( Request $request ) {
        $data   = Order::where(function ( $order ) use ($request) {
                $date = $request->date ? Carbon::createFromFormat( 'd/m/Y', $request->date ) : null;

                if ( $request->date && $request->status ) {
                    return $order->whereDate('created_at', $date)->where('status', $request->status);
                } elseif ( $request->date ) {
                    return $order->whereDate('created_at', $date);
                } elseif ( $request->status ) {
                    return $order->where('status', $request->status);
                }
            })
            ->where('status', '!=', 'canceled')
            ->orderByDesc('created_at')
            ->get();

        $table  = Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('buyer', function ( $order ) {
                return $order->first_name . ' ' . $order->last_name;
            })
            ->addColumn('province', function ( $order ) {
                return $order->province->name;
            })
            ->addColumn('city', function ( $order ) {
                return $order->city->name;
            })
            ->addColumn('quantity', function ( $order ) {
                return $order->orderProducts()->sum('quantity');
            })
            ->addColumn('date', function ( $order ) {
                return $order->created_at->diffForHumans();
            })
            ->addColumn('action', function( $order ) {
                    $btn = '
                        <a href="' . route( 'admin.order.edit', $order->id ) . '" class="btn btn-sm btn-primary rounded-circle">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="' . route( 'admin.order.show', $order->id ) . '" class="btn btn-sm btn-primary rounded-circle">
                            <i class="fas fa-eye"></i>
                        </a>
                    ';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $table;
    }

    public function print( Request $request ) {
        try {
            $date = null;

            $datas  = Order::with('orderProducts')
                ->where(function ( $order ) use ( $request ) {
                    if ( $request->date ) {
                        $date   = Carbon::createFromFormat('d/m/Y', $request->date);
                        $order->whereDate('created_at', $date);
                    }
                })
                ->where(function ( $order ) use ( $request ) {
                    if ( $request->status ) {
                        $order->where( 'status', $request->status );
                    }
                })
                ->where('status', '!=', 'canceled')
                ->get();

            $pdf    = PDF::loadView('pdfs.order', compact('datas', 'date'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return $pdf->stream('Order ' . ($date ? $date->format('d-m-Y') : 'All Date'));
    }

    public function getCity( $id )
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
                "key: " . env('API_KEY_RAJAONGKIR', null)
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode( $response, true );
        }
    }

    public function fix() {
        $orders = Order::all();

        foreach ($orders as $order) {
            $dataCity   = $this->getCity( $order->city_id );

            $province   = Province::firstOrCreate([
                'id'    => $dataCity['rajaongkir']['results']['province_id'],
                'name'  => $dataCity['rajaongkir']['results']['province']
            ]);

            $city   = City::firstOrCreate([
                'id'    => $dataCity['rajaongkir']['results']['city_id'],
                'name'  => $dataCity['rajaongkir']['results']['city_name']
            ]);

            $order->update([
                'province_id'   => $province->id,
                'city_id'       => $city->id
            ]);
        }

        return 'fixed';
    }
}
