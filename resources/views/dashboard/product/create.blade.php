@extends('dashboard.master')
@section('title', 'اضافة منتج')
@section('product-active', 'active')
@section('content')

<div class="col-12 pe-3 ps-5 pt-3 pb-3">
    <div class="col-12" style="display: flex;">
        <div class="col-lg-3 col-sm-0"></div>
        <form method="POST" action="{{ route('product.store') }}" class="mt-3 col-lg-6 col-sm-12" enctype="multipart/form-data">
            @csrf

            <x-dashboard.input type="text" name="title" label="الاسم :" />
            <x-dashboard.input type="text" name="description" label="الوصف :" />

            <!-- اختيار فئة المنتج -->
            <x-dashboard.select id="categorySelect" onchange="toggleCompanyField()" :options="[1 => 'مطعم', 2 => 'صيدلية', 3 => 'متجر']" name="category_id" label="فئة المنتج :" />

            <!-- الشركة المصنعة (تظهر فقط إذا كان المنتج صيدلية) -->
            <div id="companyField" style="display: none;">
                <x-dashboard.select :options="$companys->pluck('title', 'id')" name="company_id" label="الشركة المصنعة :" />
            </div>

            <x-dashboard.input-file name="image" label="إضافة صورة :" />

            <input type="submit" value="اضافة" class="form-control btn btn-outline-success mt-3">
        </form>
    </div>
</div>

@endsection

@section('script')

<script>
    function toggleCompanyField() {
        const categorySelect = document.getElementById('categorySelect');
        const companyField = document.getElementById('companyField');
        const companySelect = document.querySelector('[name="company_id"]');

        if (categorySelect.value == "2") {
            companyField.style.display = "block";
            companySelect.disabled = false; // تفعيل الحقل عند الحاجة
        } else {
            companyField.style.display = "none";
            companySelect.disabled = true; // تعطيل الحقل حتى لا يتم إرساله مع الفورم
        }
    }
</script>

@endsection
