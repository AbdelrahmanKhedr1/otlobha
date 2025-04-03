<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageUnit extends Model
{
    protected $fillable = [
        'image',
        'unit_id',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
