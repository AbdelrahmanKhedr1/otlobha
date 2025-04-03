<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'store_id',
        'product_id',
        'category_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_item');
    }

    public function unit(){
        return $this->hasMany(Unit::class);
    }
    public function scopeActive($query){
        return $query->whereHas('store.subscription',function($q){
            $q->where('end_at','>=',now());
        });
    }
}
