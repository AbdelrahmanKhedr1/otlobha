@extends('dashboard.master')
@section('title', ' منتجات  ' . $store->category->title .' '. $store->name)
@section('store'.$store->category->id.'-active', 'active')
@section('content')
@livewire('dashboard.storeProduct.data',['id'=>$id,'store'=>$store])
@endsection
