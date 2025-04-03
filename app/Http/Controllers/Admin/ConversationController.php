<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Events\AdminChatSent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function inbox(){
        $conversations = Conversation::all();
        return view('dashboard.conversation.inbox',compact('conversations'));
    }
    public function show($id) {
        $conversation = Conversation::findOrFail($id);

        $messages = Message::where('conversation_id',$id)->get();
        return view('dashboard.conversation.show',compact('messages','conversation'));

    }

    public function sendMessage(Request $request,$conversationId)
    {

        $data = $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'conversation_id' => $conversationId,
            'text' => $data['text'],
            'is_admin' => true,
            'is_read' => false
        ]);

        Message::where('conversation_id', $conversationId)
        ->where('is_admin', false)
        ->where('is_read', false)
        ->update(['is_read' => true]);

        // event(new ChatSent($message));
        AdminChatSent::dispatch($message);

        return response()->json(['message' => $message]);

    }
}
