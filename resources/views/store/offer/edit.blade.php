@extends('store.master')
@section('title', ' تعديل العرض ' . $offer->title)
@section('offer-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 style="text-align: center;"> تعديل العرض</h2>
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form method="post" action="{{ route('offer.update', $offer->id) }}" enctype="multipart/form-data" style=""
                class="mt-3 col-lg-6 col-sm-12">
                @csrf
                @method('PUT')

                <x-dashboard.input type="text" name="title" value="{{ $offer->title }}" label="الاسم :" />
                <x-dashboard.input type="number" name="price" value="{{ $offer->price }}" label="السعر :" />
                <x-dashboard.input type="date" name="start_date" value="{{ $offer->start_date }}" label="بدايه العرض:" />
                <x-dashboard.input type="date" name="end_date" value="{{ $offer->end_date }}" label="نهايه العرض:" />
                <x-dashboard.input type="hidden" style="display: none" name="store_id" value="{{ $store->id }}" />
                <x-dashboard.textarea name="description" value="{{ $offer->description }}" label="الوصف :" />

                <input type="submit" value="تعديل" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
