@extends('dashboard.master')
@section('title', 'اضافه اعلان')
@section('dashoffer-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form style="" action="{{ route('dashoffer.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-3 col-lg-6 col-sm-12">
                @csrf
                <x-dashboard.input type="text" name="title" label="الوحدة :" />
                <x-dashboard.input type="text" name="description" label="الوصف :" />
                <x-dashboard.input-file name="image" label=" الصوره:" />
                <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
