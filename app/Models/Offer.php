<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'store_id',
        'title',
        'description',
        'price',
        'end_date',
        'start_date',
    ];
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function imageOffer(){
        return $this->hasMany(ImageOffer::class);
    }
    public function scopeActive($query){
        return $query->whereHas('store.subscription',function($q){
            $q->where('end_at','>=',now());
        });
    }
}
