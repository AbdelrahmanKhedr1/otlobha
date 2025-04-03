@extends('dashboard.master')
@section('title', 'التاجز')
@section('tag-active', 'active')
@section('content')

        @livewire('dashboard.tag.data')
        <livewire:dashboard.delete />
@endsection
