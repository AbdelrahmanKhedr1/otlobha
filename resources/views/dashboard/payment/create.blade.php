@extends('dashboard.master')
@section('title', ' اضافه عمليه دفع ل   ' . $store->category->title .' '. $store->name)
@section('store'.$store->category->id.'-active', 'active')
@section('content')
<div style="position: relative;" class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="col-12" style="display: flex;">
        <div class="col-lg-3 col-sm-0"></div>
        <form method="post" action="{{ route('payment.store') }}" enctype="multipart/form-data" style="" class="mt-3 col-lg-6 col-sm-12">
            @csrf
            <x-dashboard.input type="number" name="amount" label="المبلغ :" />
            <x-dashboard.input type="text" name="note" label="الملاحظه :" />
            <x-dashboard.input type="hidden" style="display: none" name="store_id" value="{{ $store->id }}" />

            <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
        </form>
    </div>
</div>
@endsection
