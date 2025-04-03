<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'delivery_id',
        'lat',
        'lng',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function delivery(){
        return $this->belongsTo(Customer::class,'delivery_id');
    }
}
