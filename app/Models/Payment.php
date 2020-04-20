<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public $incrementing = false;

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function paymentImage() {
        return $this->hasOne('App\Models\PaymentImage', 'payment_id');
    }
}
