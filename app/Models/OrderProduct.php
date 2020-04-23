<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public $incrementing = false;

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function price() {
        $price = 0;

        if ($this->quantity >= 50 && $this->quantity < 100) {
            $price  = $this->product->price_a;
        } elseif ($this->quantity >= 100 && $this->quantity < 1000) {
            $price  = $this->product->price_b;
        } else {
            $price  = $this->product->price_c;
        }

        return $price;
    }

    public function total() {
        $total = 0;

        if ($this->special_price) {
            $total  = $this->quantity * $this->special_price;
        } else {
            if ($this->quantity >= 50 && $this->quantity < 100) {
                $total  = $this->quantity * $this->product->price_a;
            } elseif ($this->quantity >= 100 && $this->quantity < 1000) {
                $total  = $this->quantity * $this->product->price_b;
            } else {
                $total  = $this->quantity * $this->product->price_c;
            }
        }

        return $total;
    }
}
