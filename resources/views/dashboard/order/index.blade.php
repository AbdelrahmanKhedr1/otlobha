@extends('dashboard.master')
@section('title', 'الاوردر ' . $store->name)
@section('store'.$store->category->id.'-active', 'active')
@section('content')
@livewire('dashboard.order.data',['store'=>$store])
@endsection
