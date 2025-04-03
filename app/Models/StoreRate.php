<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreRate extends Model
{
    protected $fillable = [
        'rate',
        'message',
        'store_id',
        'customer_id',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    

}
