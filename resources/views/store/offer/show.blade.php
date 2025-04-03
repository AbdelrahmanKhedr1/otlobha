@extends('store.master')
@section('title', ' عرض ' . $offer->title)
@section('offer-active', 'active')
@section('content')

    <div class="content_data p-4">
        <div class="row col-12">
            <div class="show_data col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span  style="font-weight: bold">الاسم :</span>
                        <p>{{ $offer->title }}</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">السعر :</span>
                        <p> {{ $offer->price }} $</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span  style="font-weight: bold">الستور :</span>
                        <p>{{ $offer->store->name }}</p>
                    </div>
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data ">
                        <span  style="font-weight: bold">بداية العرض :</span>
                        <p>{{ $offer->start_date }}</p>
                    </div>
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data ">
                        <span  style="font-weight: bold">نهاية العرض :</span>
                        <p>{{ $offer->end_date }}</p>
                    </div>
                    <div class="col-12 pe-3 pt-1 mb-2 card card_data big_card">
                        <span  style="font-weight: bold">الوصف:</span>
                        <p>{{ $offer->description }}.</p>
                    </div>
                </div>

            </div>
            <div class="container">
                <div class="row mt-4">
                    @forelse ($image_offer as $image_offer)
                        <div style="transform:scale(0.95); border-radius: 8px; background-position:center; background-image: url('{{ asset($image_offer->image) }}'); height: 400px; background-size: 100%; margin-bottom: 1px; position: relative; background-size: cover;"
                            class="imgs col-3">
                        </div>
                    @empty
                        <p class="text-center mt-5">لايوجد صور</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
