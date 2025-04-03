@extends('store.master')
@section('title', ' وحدات صنف ' . $item->title)
@section('product-active', 'active')
@section('content')
    @livewire('store.unit.data', ['item' => $item])
    <livewire:dashboard.delete />
@endsection
