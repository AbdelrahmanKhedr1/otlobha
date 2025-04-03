<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardOffer extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        // 'type_id',
        // 'store_id',
        // 'item_id',

    ];
    // public function store(){
    //     return $this->belongsTo(Store::class,'store_id');
    // }

    // public function item(){
    //     return $this->belongsTo(Item::class,'item_id');
    // }
}
