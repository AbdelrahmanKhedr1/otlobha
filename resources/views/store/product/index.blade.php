@extends('store.master')
@section('title', ' منتجات ')
@section('product-active', 'active')
@section('content')
    @livewire('store.product.data', ['store' => $store])
    <livewire:dashboard.delete />

@endsection
