<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $fillable = [
        'store_id',
        'end_at',
        'start_at',
        'summation',

    ];

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
}
