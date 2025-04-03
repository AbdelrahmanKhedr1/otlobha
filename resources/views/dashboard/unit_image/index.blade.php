@extends('dashboard.master')
@section('title', ' صور الصنف ' . $unit->title)
@section('store' . $unit->category->id . '-active', 'active')
@section('content')
<div class="col-12 pe-5 ps-5 pt-3 pb-3">

    <div class="col-12">
        <div style="transform: scale(0.98)" class="row">
            @forelse ($unit_images as $image)
                <div style="border-radius: 8px; background-position:center; background-image: url({{ asset($image->image) }}); height: 400px; transform:scale(0.95); background-size: 100%; margin-bottom: 1px; position: relative; background-size: cover;"
                    class="imgs col-lg-3 col-md-6 col-sm-12">
                </div>
            @empty
                <p class="text-center mt-5">لا يوجد صور</p>
            @endforelse
        </div>
    </div>
    {{$unit_images->links()}}
</div>
@endsection
