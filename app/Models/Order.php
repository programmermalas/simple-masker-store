<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function orderProducts() {
        return $this->hasMany('App\Models\OrderProduct', 'order_id');
    }

    public function orderConfirmation() {
        return $this->hasOne('App\Models\OrderConfirm', 'order_id');
    }

    public function bill() {
        return $this->hasOne('App\Models\Bill', 'order_id');
    }

    public function province() {
        return $this->belongsTo('App\Models\Province');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function subDistrict() {
        return $this->belongsTo('App\Models\SubDistrict', 'subdistrict_id');
    }

    public function weight() {
        $weight = 0;

        foreach ($this->orderProducts as $orderProduct) {
            $weight += $orderProduct->product->weight * $orderProduct->quantity;
        }

        return $weight;
    }

    public function total() {
        $total = 0;

        foreach ($this->orderProducts as $orderProduct) {
            $total  += $orderProduct->total();
        }

        return $total;
    }

    public function cost($courier, $service) {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=5490&originType=subdistrict&destination=".$this->subDistrict->id."&destinationType=subdistrict&weight=".$this->weight()."&courier=".$courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . env('API_KEY_RAJAONGKIR', null)
            ),
        ));
    
        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            return "cURL Error #:" . $err;
        }

        $shipping = 0;

        foreach ($response['rajaongkir']['results'][0]['costs'] as $cost) {
            if (($cost['description']."(".$cost['service'].")") == $service) {
                $shipping = $cost['cost'][0]['value'];
                break;
            }
        }

        return $shipping;
    }
}
