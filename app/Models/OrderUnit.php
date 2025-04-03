<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderUnit extends Model
{
    protected $fillable = [
        'total',
        'store_id',
        'quantity',
        'unit_id',
        'customer_id',
        'order_id',
        'item_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
