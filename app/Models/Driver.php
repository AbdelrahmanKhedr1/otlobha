<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'address',
        'image',
        'id_image',
        'status',
    ];
    protected $hidden = ['password', 'remember_token'];
    public function order(){
        return $this->hasMany(Order::class);
    }
}
