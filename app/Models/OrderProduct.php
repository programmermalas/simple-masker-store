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
}
