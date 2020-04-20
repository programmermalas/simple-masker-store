<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function courier() {
        return $this->belongsTo('App\Models\Courier', 'courier_id');
    }
}
