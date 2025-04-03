@extends('store.master')
@section('title', ' تعديل الوحدة ' . $unit->title)
@section('product-active', 'active')

@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 style="text-align: center;"> تعديل الوحدة {{ $unit->title }} </h2>
        <div class="col-12" style="display: flex;">
            <div class="col-lg-3 col-sm-0"></div>
            <form method="post" action="{{ route('unit.update', $unit->id) }}" enctype="multipart/form-data" class="mt-3 col-lg-6 col-sm-12">
                @csrf
                @method('PUT')

                <x-dashboard.input type="text" name="title" label="الوحدة :" value="{{ $unit->title }}" />
                <x-dashboard.input type="number" name="price" label="السعر :" value="{{ $unit->price }}" />
                <x-dashboard.input type="number" name="from_time" label="الوقت المستغرق من :" value="{{ $unit->from_time }}" />
                <x-dashboard.input type="number" name="to_time" label="الوقت المستغرق الي :" value="{{ $unit->to_time }}" />
                <x-dashboard.input type="number" name="stock_quantity" label=" العدد في المخزن :" value="{{ $unit->stock_quantity }}" />
                <x-dashboard.input type="date" name="pro_date" label=" بدايه الصلاحيه :" id="pro_date" value="{{ $unit->pro_date }}" />
                <x-dashboard.input type="date" name="exp_date" label=" نهايه الصلاحيه :" id="exp_date" value="{{ $unit->exp_date }}" />
                <x-dashboard.input type="number" name="taxValue" label="قيمه الضريبه  :" value="{{ $unit->taxValue }}" />

                <x-dashboard.select id='selectOption' onchange="handleSelectChange()"
                    :options="[0 => 'لايوجد خصم', 1 => 'بالجنيه', 2 => 'بالنسبه المئويه علي سعر المنتج']"
                    name="is_percentage" label=" خصم" selected="{{ $unit->is_percentage }}" />

                <x-dashboard.input id='inputField' style="{{ $unit->is_percentage ? 'display: block' : 'display: none' }}"
                    type="number" name="discount" label="قيمه الخصم :" value="{{ $unit->discount }}" />

                <x-dashboard.input type="hidden" style="display: none" name="item_id" value="{{ $unit->item_id }}" />
                <x-dashboard.input type="hidden" style="display: none" name="product_id" value="{{ $unit->product_id }}" />
                <x-dashboard.input type="hidden" style="display: none" name="store_id" value="{{ $unit->store_id }}" />
                <x-dashboard.input type="hidden" style="display: none" name="category_id" id="category_id" value="{{ $unit->category_id }}" />

                <x-dashboard.textarea name="description" label="الوصف :" value="{{ $unit->description }}" />
    
                <input type="submit" value="تحديث" class="form-control btn btn-outline-primary mt-3">
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function handleSelectChange() {
            const select = document.getElementById('selectOption');
            const inputField = document.getElementById('inputField');
            if (select.value == 1 || select.value == 2) {
                inputField.style.display = "block";
            } else {
                inputField.style.display = "none";
            }
        }

        function handleCategoryCheck() {
            const categoryId = document.getElementById('category_id').value;
            const proDate = document.getElementById('pro_date');
            const expDate = document.getElementById('exp_date');

            if (categoryId == 3) {
                proDate.style.display = "none";
                expDate.style.display = "none";
            } else {
                proDate.style.display = "block";
                expDate.style.display = "block";
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            handleCategoryCheck();
            handleSelectChange();
        });
    </script>
@endsection
