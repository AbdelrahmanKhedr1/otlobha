<?php

namespace App\Http\Controllers\Store;

use App\Events\ChatSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Get or create conversation for the store
        $conversation = Conversation::firstOrCreate(
            ['store_id' => Auth::id()],
            ['store_id' => Auth::id()]
        );

        // Get messages for the conversation
        $messages = Message::where('conversation_id', $conversation->id)->get();

        // If no messages exist, create an empty collection
        if ($messages->isEmpty()) {
            $messages = collect();
        }

        return view('store.chat.index', compact('conversation', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $conversation = Conversation::firstOrCreate(
            ['store_id' => Auth::id()],
            ['store_id' => Auth::id()]
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

}
