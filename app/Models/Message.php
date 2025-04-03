<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'is_read',
        'is_admin',
        'text',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
