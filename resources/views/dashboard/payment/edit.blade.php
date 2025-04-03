@extends('dashboard.master')
@section('title', ' تعديل عمليه دفع  '. $store->name)
@section('store'.$store->category->id.'-active', 'active')
@section('content')
    <div class="col-12" style="display: flex;">
        <div class="col-lg-3 col-sm-0"></div>
        <form method="post" action="{{ route('payment.update', $payment->id) }}" enctype="multipart/form-data" style=""
            class="mt-3 col-lg-6 col-sm-12">
            @csrf
            @method('PUT')
            <x-dashboard.input type="number" value="{{$payment->amount}}" name="amount" label="المبلغ :" />
            <x-dashboard.input type="text" value="{{$payment->note}}" name="note" label="الملاحظه :" />

            <input type="submit" value="تعديل" class="form-control btn btn-outline-success mt-3">
        </form>
    </div>
@endsection
