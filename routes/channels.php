<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;
use App\Models\Admin;
use App\Models\Store;
use App\Models\Customer;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel('new-message', function ($admin) {
//     return true ;
// },['guards'=>['admin']]);

Broadcast::channel('chat.store.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);
    return Store::where('id', $user->id)->exists() && $user->id === $conversation->store_id ||
        Customer::where('id', $user->id)->exists() && $user->id === $conversation->customer_id ||
        Admin::where('id', $user->id)->exists();
}, ['guards' => ['admin', 'web', 'customer']]);
