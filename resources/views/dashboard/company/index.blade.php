@extends('dashboard.master')
@section('title', 'الشركات')
@section('company-active', 'active')
@section('content')
    <livewire:dashboard.company.create />
    <livewire:dashboard.company.data />
    <livewire:dashboard.company.edit />
    <livewire:dashboard.delete />
@endsection
