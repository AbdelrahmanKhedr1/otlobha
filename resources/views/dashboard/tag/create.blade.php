@extends('dashboard.master')
@section('title', 'التاجز')
@section('tag-active', 'active')
@section('content')
    <div class="col-12 pe-3 ps-5 pt-3 pb-3">
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form style="" method="POST" action="{{ route('tag.store') }}" class="mt-3 col-lg-6 col-sm-12"
                enctype="multipart/form-data">
                @csrf
                <x-dashboard.input type="text" name="name_ar" label="  الاسم بالعربية : " />
                <x-dashboard.input type="text" name="name_en" label="الاسم بالانجليزيه :" />
                <x-dashboard.select id="categorySelect" :options="[1 => 'مطعم', 2 => 'صيدلية', 3 => 'متجر']" name="category_id" label="فئة التاج :" />

                <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
