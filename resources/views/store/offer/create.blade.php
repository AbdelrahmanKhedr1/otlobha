@extends('store.master')
@section('title', ' اضافه عرض ل   ' . $store->category->name .' '. $store->name)
@section('offer-active', 'active')
@section('content')
<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <h2 style="text-align: center;"> اضافة عرض ل {{$store->category->name .' '. $store->name}} </h2>
    <div class="col-12" style="display: flex;">
        <div class="col-lg-3 col-sm-0"></div>
        <form method="post" action="{{ route('offer.store') }}" enctype="multipart/form-data" class="mt-3 col-lg-6 col-sm-12">
            @csrf
            <x-dashboard.input type="text" name="title" label="الاسم :" />
            <x-dashboard.input type="number" name="price" label="السعر :" />
            <x-dashboard.input type="date" name="start_date" label="بدايه العرض:" />
            <x-dashboard.input type="date" name="end_date" label="نهايه العرض:" />
            <x-dashboard.textarea name="description" label="الوصف :" />
            <x-dashboard.input type="hidden" style="display: none" name="store_id" value="{{ $store->id }}" />

            <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
        </form>
    </div>
    </div>
@endsection
