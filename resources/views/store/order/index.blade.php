@extends('store.master')
@section('title', 'الاوردر ' . $store->name)
@section('order-active', 'active')
@section('content')
@livewire('store.order.data', ['store' => $store])
@endsection
