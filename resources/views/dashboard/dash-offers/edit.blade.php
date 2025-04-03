@extends('dashboard.master')
@section('title', 'تعديل اعلان')
@section('dashoffer-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form style=""  action="{{ route('dashoffer.update',$dashboardOffer->id) }}" method="POST" enctype="multipart/form-data" class="mt-3 col-lg-6 col-sm-12">
                @csrf
                @method('PUT')
                <x-dashboard.input type="text" value="{{ $dashboardOffer->title }}" name="title" label="الوحدة :" />
                <x-dashboard.input type="text" value="{{ $dashboardOffer->description }}" name="description"
                    label="الوصف :" />
                <x-dashboard.input-file name="image" value="{{ $dashboardOffer->image }}" label=" الصوره:" />
                @if ($dashboardOffer->image)
                    <img src="{{ asset($dashboardOffer->image) }}" alt="" width="100px">
                @endif
                <input type="submit" value="تعديل" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
