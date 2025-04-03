@extends('dashboard.master')
@section('title', '  اضافة صورة ل ' . $item->title)
@section('store'.$item->category->id.'-active', 'active')
@section('content')
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form method="post" action="{{ route('image-item.store') }}" enctype="multipart/form-data" style="" class="mt-3 col-lg-6 col-sm-12">
                @csrf
                <x-dashboard.input-file name="image" label=" الصوره:" />
                <x-dashboard.input type="hidden" style="display: none" name="item_id" value="{{ $item->id }}" />
                <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
@endsection
