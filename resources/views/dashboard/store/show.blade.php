@extends('dashboard.master')
@section('title', $store->name)
@section('store' . $store->category->id . '-active', 'active')
@section('content')

    <div class="col-12 pe-3 ps-5 pt-3 pb-3">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                @if (!is_null($store->image))
                    <div style="background-image: url({{ asset($store->image) }});"class="store_img">
                        @if ($store->is_open == 1)
                            <button style="position: absolute; left:5px; top:5px;"
                                class="btn btn-success btn-sm">مفتوح</button>
                        @else
                            <button style="position: absolute; left:5px; top:5px;" class="btn btn-danger btn-sm">مغلق</button>
                        @endif
                    </div>
                @else
                    <p class="text-center mt-5">لايوجد صوره</p>
                @endif
            </div>
            <div class="col-lg-9 col-sm-12 pt-2">
                <div class="row">
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data big_card">
                        <span style="font-weight: bold">ايميل المستخدم :</span>
                        <p>{{ $store->user->email }}</p>
                    </div>
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data big_card">
                        <span style="font-weight: bold">اسم المستخدم :</span>
                        <p>{{ $store->user->name }}</p>
                    </div>
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data big_card">
                        <span style="font-weight: bold">اسم ال{{ $store->category->name }} :</span>
                        <p>{{ $store->name }}</p>
                    </div>
                    <div class="col-6 pe-3 pt-1 mb-2 card card_data big_card">
                        <span style="font-weight: bold">التقيم :</span>
                        <p>
                            {{-- {{$store->average_rating}} --}}

                            @php
                            $stars = round($store->average_rating / 20);
                        @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $stars)
                                    <i class="fas fa-star text-warning"></i> {{-- نجمة ممتلئة --}}
                                @else
                                    <i class="far fa-star text-muted"></i> {{-- نجمة فارغة --}}
                                @endif
                            @endfor
                        </p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">عدد العملاء الذين قيموا المتجر :</span>
                        <p>
                            {{ $store->ratingCustomersCount }}
                        </p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">رقم الموبايل :</span>
                        <p> {{ $store->mobile }} </p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">تكلفة التوصيل بالكيلومتر :</span>
                        <p>{{ $store->delivary_value_km }}</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">العنوان :</span>
                        <p>{{ $store->address }}</p>
                    </div>

                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">مغلق / مفتوح :</span>
                        <p>{{ $store->is_open }}</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">بداية العمل :</span>
                        <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $store->start_time)->format('h:i A') }}</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">نهاية العمل :</span>
                        <p>{{ \Carbon\Carbon::createFromFormat('H:i:s', $store->end_time)->format('h:i A') }} </p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <span style="font-weight: bold">نوع الخدمة :</span>
                        <p>{{ $store->category->name }}</p>
                    </div>
                    <div class="col-4 pe-3 pt-1 mb-2 card card_data">
                        <div class="row">
                            <div class="col-6">
                                <span style="font-weight: bold">الحالة :</span>
                            </div>
                            @livewire('dashboard.store.store-active', ['store' => $store])
                        </div>
                    </div>




                </div>

            </div>

        </div>
        <div style="height: calc(100vh - 400px);" class="col-12 pe-2">
            <iframe width="100%" height="100%" style="border:0; border-radius:6px;" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q={{ $store->lat }},{{ $store->lng }}&hl=es;z=14&output=embed">
            </iframe>
        </div>
    </div>

@endsection
