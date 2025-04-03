<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'customer_id',
        'admin_id',
        'store_id',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }
    public function message(){
        return $this->hasMany(Message::class);
    }
    public function latestMessage(){
        return $this->hasOne(Message::class)->latestOfMany();
    }
}
