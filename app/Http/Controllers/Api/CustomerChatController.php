<?php

namespace App\Http\Controllers\Api;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $conversation = Conversation::firstOrCreate(
            ['customer_id' => Auth::id()],
            ['customer_id' => Auth::id()]
        );

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'text' => $data['text'],
            'is_admin' => false,
            'is_read' => false
        ]);
        Message::where('conversation_id', $conversation->id)
        ->where('is_admin', true)
        ->where('is_read', false)
        ->update(['is_read' => true]);
        // event(new ChatSent($message));
        ChatSent::dispatch($message);

        return response()->json(['message' => $message]);

    }
    public function getMessages()
    {
        // Get all conversations for the authenticated customer
        $conversations = Conversation::where('customer_id', Auth::id())->get();

        // Get all messages from these conversations
        $messages = Message::whereIn('conversation_id', $conversations->pluck('id'))
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }

}
