<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'total',
        'unit_id',
        'item_id',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
