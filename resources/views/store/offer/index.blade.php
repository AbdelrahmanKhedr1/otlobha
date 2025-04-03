@extends('store.master')
@section('title', ' عروض ' . $store->category->title . ' ' . $store->name)
@section('offer-active', 'active')
@section('content')
    @livewire('store.offer.data', ['store' => $store])
    <livewire:dashboard.delete />
@endsection
