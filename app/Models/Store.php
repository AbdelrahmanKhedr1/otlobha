<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use Notifiable;
    protected $fillable = [
        'name',
        'mobile',
        'image',
        'active',
        'status',
        'address',
        'lng',
        'lat',
        'start_time',
        'end_time',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function offer()
    {
        return $this->hasMany(Offer::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
    public function unit()
    {
        return $this->hasMany(Unit::class);
    }

    public function subscription()
    {
        return $this->hasMany(subscription::class);
    }
    public function rates()
    {
        return $this->hasMany(StoreRate::class);
    }
    public function getAverageRatingAttribute()
    {
        return $this->rates()->avg('rate') ?? 0;
    }
    public function getRatingCustomersCountAttribute()
    {
        return $this->rates()->distinct('customer_id')->count('customer_id');
    }
    public function scopeActive($query)
    {
        return $query->whereHas('subscription', function ($q) {
            $q->where('end_at', '>=', now());
        });
    }
    public function getIsOpenAttribute()
    {
        $now = Carbon::now()->format('H:i:s');
        // dd($now);
        $start = $this->start_time;
        $end = $this->end_time;


        if ($start <= $end) {
            return ($now >= $start && $now <= $end) ? 1 : 0;
        } else {
            return ($now >= $start || $now <= $end) ? 1 : 0;
        }
    }
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
    // public function latestMessage(){
    //     return $this->hasOne(Message::class)->latestOfMany();
    // }
}
