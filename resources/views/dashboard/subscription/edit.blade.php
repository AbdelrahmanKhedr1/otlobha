@extends('dashboard.master')
@section('title', 'تعديل اشتراك ' . $subscription->store->name)
@section('subscription-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form action="{{ route('subscription.update', $subscription->id) }}" method="post" style=""
                class="mt-3 col-lg-6 col-sm-12">
                @csrf
                @method('PUT')

                <x-dashboard.input type="number" value="{{ $subscription->summation }}" name="summation"
                    label=" قيمه الاشتراك  :" />
                <x-dashboard.input type="date" name="start_at" value="{{ $subscription->start_at }}"
                    label=" بدايه الاشترك :" />
                <x-dashboard.input type="date" name="end_at" value="{{ $subscription->end_at }}"
                    label=" نهاسه الاشتراك :" />

                <input type="submit" value="تعديل" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
