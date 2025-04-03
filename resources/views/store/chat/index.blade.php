@extends('store.master')
@section('title', 'الرسائل الجديده')
@section('chat-active', 'active')
@section('content')
    <div class="col-12 ">
        <div class="col-12 pe-5 ps-5">
            <div class="page">
                <div class="marvel-device nexus5">
                    <div class="screen">
                        <div class="screen-container">
                            <div class="chat">
                                <div class="chat-container">
                                    <div class="user-bar">
                                        <div class="back">
                                            <i class="zmdi zmdi-arrow-left"></i>
                                        </div>
                                        <div class="avatar">
                                            <img src="{{ asset('image/1.jpeg') }}" alt="Avatar">
                                        </div>
                                        <div class="name">
                                            <span>{{ $conversation->store->name }}</span>
                                        </div>
                                        <div class="actions more">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </div>
                                        <div class="actions attachment">
                                            <i class="zmdi zmdi-attachment-alt"></i>
                                        </div>
                                        <div class="actions">
                                            <i class="zmdi zmdi-phone"></i>
                                        </div>
                                    </div>
                                    <div class="conversation">
                                        <div class="conversation-container" id="conversationContainer">
                                            @if ($messages->isEmpty())
                                                <div class="no-messages text-center py-4">
                                                    <i class="fas fa-comments fa-3x mb-3 text-muted"></i>
                                                    <p class="text-muted">لا توجد رسائل بعد. ابدأ المحادثة الآن!</p>
                                                </div>
                                            @else
                                                {{-- @foreach ($messages as $message)
                                                    <div class="message  {{ $message->is_admin ? 'received' : 'sent' }}">
                                                        {{ $message->text }}
                                                        <span class="metadata">
                                                            <span class="time">
                                                                {{ $message->created_at->diffForHumans() }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                @endforeach --}}
                                                @foreach ($messages as $message)
                                                    <div
                                                        class="message {{ $message->is_admin == false ? 'sent' : 'received' }}">
                                                        {{ $message->text }}
                                                        <span class="metadata">
                                                            <span
                                                                class="time">{{ $message->created_at->diffForHumans() }}</span>
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <form class="conversation-compose">
                                            <input id="inputText" type="text" class="form-control mb-3 mt-3 me-2"
                                                placeholder="Type To Write . . ." required=""
                                                style="border-radius: 100px; height: 50px;">
                                            <button id="printButton" type="submit" class="send mb-3">
                                                <div class="circle">
                                                    <i class="fas fa-paper-plane"></i>
                                                </div>
                                            </button>
                                        </form>

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            const conversationId = {{ $conversation->id }};

            window.Echo.private(`chat.store.${conversationId}`)
                .listen('.adminChatEvent', (data) => {
                    const messageClass = data.message.is_admin == true ? 'received' : 'sent';
                    const messageHtml = `
                        <div class="message ${messageClass}">
                            ${data.message.text}
                            <span class="metadata">
                                <span class="time">
                                    ${new Date(data.message.created_at).toLocaleTimeString()}
                                </span>
                            </span>
                        </div>`;
                    $('#conversationContainer').append(messageHtml);
                    scrollToBottom();

                });

            function scrollToBottom() {
                var container = $('#conversationContainer');
                container.scrollTop(container[0].scrollHeight);
            }

            $('.conversation-compose').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('store.chat.send') }}',
                    method: 'POST',
                    headers: {
                        'X-Socket-Id': window.Echo.socketId()
                    },
                    data: {
                        text: $('#inputText').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        const messageHtml = `
                            <div class="message sent">
                                ${$('#inputText').val()}
                                <span class="metadata">
                                    <span class="time">Just now</span>
                                </span>
                            </div>`;
                        $('#conversationContainer').append(messageHtml);
                        $('#inputText').val('');
                        scrollToBottom();
                    },
                    error: function() {
                        alert('حدث خطأ أثناء إرسال الرسالة');
                    }
                });
            });

            scrollToBottom();
        });
    </script>

@endsection
