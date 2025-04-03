<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'note',
        'num_process',
        'date',
        'amount',
        'store_id',
    ];

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
}
