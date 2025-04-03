<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'company_id',
        'image',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function item(){
        return $this->hasMany(Item::class);
    }

    public function scopeActive($query){
        return $query->whereHas('store.subscription',function($q){
            $q->where('end_at','>=',now());
        });
    }
}
