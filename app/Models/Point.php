<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'point',
        'customer_id',
        'order_id',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
