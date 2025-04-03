@extends('dashboard.master')
@section('title', 'المنتجات')
@section('product-active', 'active')
@section('content')
        @livewire('dashboard.product.data')
        <livewire:dashboard.delete />
@endsection
