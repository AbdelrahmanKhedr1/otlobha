<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'customer_id',
        'driver_id',
        'discount_value',
        'delivary_value',
        'tax_value',
        'sub_total',
        'summation',
        'status',
        'receipt_type',
        'time',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function driver(){
        return $this->belongsTo(Driver::class,'driver_id');
    }
    public function orderUnit(){
        return $this->hasMany(orderUnit::class);
    }

}
