@extends('dashboard.master')
@section('title', 'الاعلانات')
@section('dashoffer-active', 'active')
@section('content')
@livewire('dashboard.dash-offers.data')
<livewire:dashboard.delete />
@endsection
