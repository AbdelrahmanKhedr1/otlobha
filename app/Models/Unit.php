<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [

        'title',
        'price',
        'description',
        'pro_date',
        'exp_date',
        'stock_quantity',
        'from_time',
        'to_time',
        'is_percentage',
        'discount',
        'taxValue',
        'store_id',
        'category_id',
        'product_id',
        'item_id',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function unitImages()
    {
        return $this->hasMany(ImageUnit::class);
    }
    public function getUnitTagsAttribute()
    {
        return $this->item ? $this->item->tags : collect();
    }

    public function rates()
    {
        return $this->hasMany(UnitRate::class);
    }

    public function getRatingCustomersCountAttribute()
    {
        return $this->rates()->distinct('customer_id')->count('customer_id');
    }
    public function getAverageRatingAttribute()
    {
        return $this->rates()->avg('rate') ?? 0;
    }
    public function scopeActive($query)
    {
        return $query->whereHas('store.subscription', function ($q) {
            $q->where('end_at', '>=', now());
        });
    }
}
