@extends('dashboard.master')
@section('title', ' عمليات دفع ' . $store->category->title . ' ' . $store->name)
@section('store' . $store->category->id . '-active', 'active')
@section('content')
    @livewire('dashboard.payment.data', ['store' => $store])
    <livewire:dashboard.delete />
@endsection
