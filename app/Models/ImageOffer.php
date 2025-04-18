<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageOffer extends Model
{
    protected $fillable = [
        'image',
        'offer_id',
    ];
    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }
}
