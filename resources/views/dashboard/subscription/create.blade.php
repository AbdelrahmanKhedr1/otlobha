@extends('dashboard.master')
@section('title', 'اضافه اشتراك')
@section('subscription-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form action="{{ route('subscription.store') }}" method="post" style="" class="mt-3 col-lg-6 col-sm-12">
                @csrf
                <x-dashboard.select_m :options="\App\Models\Store::all()" name="store_id" label=" اسم المشترك" />
                <x-dashboard.input type="number" name="summation" label=" قيمه الاشتراك  :" />
                <x-dashboard.input type="date" name="start_at" label=" بدايه الاشترك :" />
                <x-dashboard.input type="date" name="end_at" label=" نهاسه الاشتراك :" />

                <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
