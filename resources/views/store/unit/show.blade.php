@extends('store.master')
@section('title', ' تفاصيل الوحدة: ' . $unit->title)
@section('product-active', 'active')
@section('content')
    <style>
        .info-box {
            transform: scale(0.95);
            font-size: 14px;
            border-radius: 6px;
            background: #f4f4f4;
            color: black;
            padding: 10px;
            margin-bottom: 10px;
        }

        .image-box {
            transform: scale(0.95);
            border-radius: 8px;
            background-position: center;
            background-size: cover;
            height: 400px;
            margin-bottom: 10px;
        }
    </style>
    <div class="content_data p-4">
        <div class="row col-12">
            <div class="show_data col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-4 card card_data">
                        <span>الاسم:</span>
                        <p>{{ $unit->title }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>السعر:</span>
                        <p>{{ number_format($unit->price, 2) }} $</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>الضريبة:</span>
                        <p>{{ $unit->taxValue }} %</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>المتجر:</span>
                        <p>{{ $unit->store->name }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>الفئة:</span>
                        <p>{{ $unit->category->name }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>المنتج:</span>
                        <p>{{ $unit->product->title }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>الكمية المتاحة:</span>
                        <p>{{ $unit->stock_quantity }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>تاريخ الإنتاج:</span>
                        <p>{{ $unit->pro_date }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>تاريخ الانتهاء:</span>
                        <p>{{ $unit->exp_date }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>الوقت المستغرق من:</span>
                        <p>{{ $unit->from_time }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span> الوقت المستغرق الي:</span>
                        <p>{{ $unit->to_time }}</p>
                    </div>
                    <div class="col-4 card card_data">
                        <span>الخصم:</span>
                        <p>
                            @if ($unit->is_percentage)
                                {{ $unit->discount }} %
                            @else
                                {{ number_format($unit->discount, 2) }} $
                            @endif
                        </p>
                    </div>
                    <div class="col-12 card desc_card">
                        <span>الوصف:</span>
                        <p>{{ $unit->description }}</p>
                    </div>
                </div>
            </div>

            {{-- عرض جميع الصور الخاصة بالـ Unit --}}
            <div class="container">
                <div class="row mt-4">
                    @forelse ($unit_images as $image)
                        <div class="col-lg-3 col-md-6 col-sm-12 image-box"
                            style="background-image: url({{ asset($image->image) }})">
                        </div>
                    @empty
                        <p class="text-center mt-5">لا يوجد صور</p>
                    @endforelse
                </div>
                {{$unit_images->links()}}
            </div>
        </div>
    </div>

@endsection