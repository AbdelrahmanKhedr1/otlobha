<div class="col-12 pe-5 ps-5 pt-3 pb-3">

    <table class="table table-bordered text-center">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الرسالة</th>
                <th class="control_th_con" scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey;">
            @foreach ($conversations as $conversation)
                <tr>
                    <td>
                        {{ $conversation->store->name  ?? $conversation->customer->name }}
                    </td>
                    <td>{{ $conversation->latestMessage->text ?? 'لا توجد رسائل بعد' }}</td>
                    <td style="display: flex; justify-content:center;">
                        <a id="itemsList" style="text-decoration:none;" href="{{ route('conversation.show', $conversation->id) }}">
                            <button
                                @if (!$conversation->latestMessage || (!$conversation->latestMessage->is_read && !$conversation->latestMessage->is_admin))
                                class="btn btn-danger btn-sm m-1"
                                @else
                                class="btn btn-success btn-sm m-1"
                                @endif
                                >
                                @if (!$conversation->latestMessage || (!$conversation->latestMessage->is_read && !$conversation->latestMessage->is_admin))
                                    غير مقروءة
                                @else
                                     تم الرد
                                @endif
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        {{ $conversations->links() }}
</div>
