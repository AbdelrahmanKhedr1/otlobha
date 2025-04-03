@extends('store.master')
@section('title', ' اضافة صوره ' . $offer->title)
@section('offer-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 style="text-align: center;">اضافة صوره {{ $offer->title }} </h2>
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form style="" action="{{ route('image-offer.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-3 col-lg-6 col-sm-12">
                @csrf
                <div class="form-group">
                    <x-dashboard.input type="hidden" style="display: none" name="offer_id" value="{{ $offer->id }}" />
                    <x-dashboard.input-file name="images[]" label="الصور:" multiple="true" />

                </div>
                <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
