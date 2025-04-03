<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'address',
        'lng',
        'lat',
        'password',
        'email',
        'phone',
    ];
    protected $hidden = ['password', 'remember_token'];

    public function orderUnits(){
        return $this->hasMany(OrderUnit::class);
    }

}
