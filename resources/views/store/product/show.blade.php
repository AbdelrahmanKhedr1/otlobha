@extends('store.master')
@section('title', ' منتجات ' . $product->title)
@section('product-active', 'active')
@section('content')

    <div class="col-12 pe-3 ps-5 pt-3 pb-3">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                @if (!is_null($product->image))
                    <div style="transform:scale(0.95); border-radius: 8px; background-position:center; background-image: url({{ asset($product->image) }}); height: 300px; background-size: 100%; margin-bottom: 1px; position: relative; background-size: cover;"
                        class="imgs">
                    </div>
                @else
                    <p class="text-center mt-5">لايوجد صوره</p>
                @endif
            </div>
            <div class="col-lg-9 col-sm-12 pt-2">
                <div class="row">
                    <div style="height:60px; transform: scale(0.95); font-size: 14px; border-radius: 6px; background: #f4f4f4; color:black;"
                        class="col-4 pe-3 pt-1 mb-2">
                        <span style="font-weight: bold">الاسم :</span>
                        <p>{{ $product->title }}</p>
                    </div>
                    <div style="transform: scale(0.95); font-size: 14px; border-radius: 6px; height:60px; background: #f4f4f4; color:black;"
                        class="col-4 pe-3 pt-1 mb-2">
                        <span style="font-weight: bold">الكاتيجوري :</span>
                        <p> {{ $product->category->name }} </p>
                    </div>
                    <div style="transform: scale(0.95); font-size: 14px; border-radius: 6px; height:60px; background: #f4f4f4; color:black;"
                        class="col-4 pe-3 pt-1 mb-2">
                        <span style="font-weight: bold">الستور :</span>
                        <p>{{ $product->store->name }}</p>
                    </div>

                    <div style="transform: scale(0.988); font-size: 14px; border-radius: 6px; height: auto; background: #f4f4f4; color:black;"
                        class="pe-3 pt-1 mb-2">
                        <span style="font-weight: bold">الوصف:</span>
                        <br>
                        {{-- <p>vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv</p> --}}
                        <p>{{ $product->description }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
