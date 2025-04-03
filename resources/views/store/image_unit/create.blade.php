@extends('store.master')
@section('title', 'اضافة صور ل ' . $unit->title)
@section('product-active', 'active')
@section('content')
    <h2 style="text-align: center;">اضافة صور ل {{ $unit->title }}</h2>
    <div class="col-12" style="display: flex;">
        <div class="col-lg-3 col-sm-0"></div>
        <form method="post" action="{{ route('image-unit.store') }}" enctype="multipart/form-data"
            class="mt-3 col-lg-6 col-sm-12">
            @csrf
            <x-dashboard.input-file name="images[]" label="الصور:" multiple="true" />
            <x-dashboard.input type="hidden" name="unit_id" value="{{ $unit->id }}" />
            <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
        </form>
    </div>
@endsection
