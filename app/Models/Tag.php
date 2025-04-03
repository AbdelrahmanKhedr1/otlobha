<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'tag_item');
    }
}
