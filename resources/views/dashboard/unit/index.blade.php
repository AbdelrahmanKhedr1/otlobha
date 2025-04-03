@extends('dashboard.master')
@section('title', ' وحدات صنف ' . $item->product->title)
@section('store' . $item->category->id . '-active', 'active')
@section('content')
    @livewire('dashboard.unit.data', ['item' => $item])
@endsection
