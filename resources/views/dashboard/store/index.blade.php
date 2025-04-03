@extends('dashboard.master')
@section('title', $category->name)
@section('store'.$id.'-active', 'active')
@section('content')
    @livewire('dashboard.store.data',['id'=>$id,'category'=>$category])
@endsection
