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
        return $this->belongsTo('App\User');
    }

    public function orderProducts() {
        return $this->hasMany('App\Models\OrderProduct');
    }

    public function orderConfirmation() {
        return $this->hasOne('App\Models\OrderConfirm');
    }

    public function bill() {
        return $this->hasOne('App\Models\Bill');
    }

    public function province() {
        return $this->belongsTo('App\Models\Province');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
