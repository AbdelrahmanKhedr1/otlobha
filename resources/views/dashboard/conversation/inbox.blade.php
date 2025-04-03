@extends('dashboard.master')
@section('title', ' الدعم الفني ')
@section('conversation-active', 'active')

@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        @livewire('dashboard.conversation.conversations-list')
    </div>
@endsection
