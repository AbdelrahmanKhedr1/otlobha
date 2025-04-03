<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitRate extends Model
{
    protected $fillable = [
        'rate',
        'message',
        'unit_id',
        'customer_id',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

}
