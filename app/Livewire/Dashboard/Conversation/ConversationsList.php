<?php

namespace App\Livewire\Dashboard\Conversation;

use App\Models\Conversation;
use Livewire\Component;
use Livewire\WithPagination;

class ConversationsList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshConversations' => '$refresh']; // تحديث الجدول تلقائيًا

    public function render()
    {
        $conversations = Conversation::with(['store', 'customer', 'latestMessage'])
            ->orderByDesc('updated_at')
            ->paginate(10); // 10 محادثات في كل صفحة

        return view('dashboard.conversation.conversations-list', compact('conversations'));
    }

}
