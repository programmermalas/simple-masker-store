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
use App\Models\Province;
use App\Models\City;
use App\Models\SubDistrict;
use App\Models\Courier;
use App\User;

class OrderController extends Controller
{
    public function index()
    {
        return abort(404);
    }

    public function getSubDistrict($city, $subdistrict)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$city&id=$subdistrict",
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
            return json_decode($response, true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|max:25',
            'last_name'     => 'required|max:25',
            'recipients'    => 'max:50',
            'province'      => 'required',
            'city'          => 'required',
            'subdistrict'   => 'required',
            'code_courier'  => 'required',
            'name_courier'  => 'required',
            'name_service'  => 'required',
            'street'        => 'required|max:150',
            'postcode'      => 'required|max:10',
            'phone'         => 'required|max:15',
            'email'         => 'required|email',
            'shipping'      => 'required',
            'weight'        => 'required',
            'total'         => 'required'
        ]);
    
        try {
            if (Cart::getTotalQuantity() < 100) {
                return redirect()->back()->with('info', 'Minimal order 100!');
            }
            
            $count      = Order::withTrashed()->count();
            $invoice    = Carbon::now()->format('d/m/Y/') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

            $user = null;

            if ($request->marketing) {
                $user   = User::where('name', $request->marketing)->first();

                if (!$user) {
                    return redirect()->back()->with('info', 'User marketing not found!');
                }
            }
            
            $dataSubDistrict   = $this->getSubDistrict($request->city, $request->subdistrict);

            $province   = Province::firstOrCreate([
                'id'    => $dataSubDistrict['rajaongkir']['results']['province_id'],
                'name'  => $dataSubDistrict['rajaongkir']['results']['province']
            ]);

            $city   = City::firstOrCreate([
                'id'    => $dataSubDistrict['rajaongkir']['results']['city_id'],
                'name'  => $dataSubDistrict['rajaongkir']['results']['city']
            ]);

            $subdistrict   = SubDistrict::firstOrCreate([
                'id'    => $dataSubDistrict['rajaongkir']['results']['subdistrict_id'],
                'name'  => $dataSubDistrict['rajaongkir']['results']['subdistrict_name']
            ]);
        
            $courier    = Courier::firstOrCreate([
                'code'      => $request->code_courier,
                'name'      => $request->name_courier,
                'service'   => $request->name_service
            ]);

            $order = Order::create([
                'id'            => Str::uuid(),
                'user_id'       => $user ? $user->id : null,
                'invoice'       => $invoice,
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'recipients'    => $request->recipients_name,
                'province_id'   => $province->id,
                'city_id'       => $city->id,
                'subdistrict_id'=> $subdistrict->id,
                'street'        => $request->street,
                'postcode'      => $request->postcode,
                'phone'         => $request->phone,
                'email'         => $request->email,
            ]);
        
            Bill::create([
                'id'        => Str::uuid(),
                'order_id'  => $order->id,
                'courier_id'=> $courier->id,
                'shipping'  => $request->shipping,
                'weight'    => $request->weight,
                'total'     => $request->total
            ]);
        
            $items  = Cart::getContent();
        
            foreach ($items as $item) {
                OrderProduct::create([
                    'id'        => Str::uuid(),
                    'order_id'  => $order->id,
                    'product_id'=> $item->id,
                    'quantity'  => $item->quantity
                ]);
            }
    
            $items  = Cart::clear();
    
            Mail::to($order->email)->send(new OrderMail($order));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    
        return view('pages.guest.order.index', compact('order'));
    }

    public function getWaybill($resi, $courier) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "waybill=$resi&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . env('API_KEY_RAJAONGKIR', null)
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function detail(Request $request)
    {
        if ($request->invoice) {
            $order  = Order::where('invoice', $request->invoice)->first();
        
            if (!$order) {
                return redirect('/order/detail')->with('info', 'Order not found!');
            }

            $wayBill = null;

            if ($order->bill->courier) { 
                $wayBill    = $this->getWaybill($order->resi, $order->bill->courier->code);
            }
        }

        return view('pages.guest.order.detail', compact('order', 'wayBill'));
    }
}
