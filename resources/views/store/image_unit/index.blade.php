@extends('store.master')
@section('title', ' صور الصنف ' . $unit->title)
@section('product-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 style="text-align: center;">صور العرض {{ $unit->title }} </h2>

        <div class="col-12">
            <a href="{{ route('image-unit.create', $unit->id) }}">
                <button class="btn btn-success btn-sm">اضافة صورة</button>
            </a>
            <div style="transform: scale(0.98)" class="row">
                @forelse ($image_unit as $image)
                    <div style="border-radius: 8px; background-position:center; background-image: url({{ asset($image->image) }}); height: 400px; transform:scale(0.95); background-size: 100%; margin-bottom: 1px; position: relative; background-size: cover;"
                        class="imgs col-lg-3 col-md-6 col-sm-12">
                        <form action="{{ route('image-unit.destroy', $image->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a style="text-decoration:none; position: absolute; left: 5px; top: 5px;"
                                href="{{ route('image-unit.destroy', $image->id) }}">
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </a>
                        </form>
                    </div>
                @empty
                    <p class="text-center mt-5">لا يوجد صور</p>
                @endforelse
            </div>
        </div>
        {{$image_unit->links()}}
    </div>

@endsection
