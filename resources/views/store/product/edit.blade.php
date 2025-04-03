@extends('store.master')
@section('title', ' تعديل منتج ' . $product->title)
@section('product-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 style="text-align: center;"> تعديل منتج</h2>
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data"
                style="" class="mt-3 col-lg-6 col-sm-12">
                @csrf
                @method('PUT')
                <x-dashboard.input type="text" name="title" value="{{ $product->title }}" label="الاسم :" />
                <x-dashboard.textarea name="description" value="{{ $product->description }}" label="الوصف :" />

                <div class="row mt-3">
                    <x-dashboard.input-file class=" col-8" name="image" label="الصورة:" />
                    @if (!empty($product->image))
                        <div class="col-4">
                            <img style="width: 100%;" src="{{ asset($product->image) }}" alt="صورة المتجر">
                        </div>
                    @endif
                </div>
                <x-dashboard.input type="hidden" style="display: none" name="category_id"
                    value="{{ $store->category->id }}" />
                <x-dashboard.input type="hidden" style="display: none" name="store_id" value="{{ $store->id }}" />

                <input type="submit" value="تعديل" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>
@endsection
