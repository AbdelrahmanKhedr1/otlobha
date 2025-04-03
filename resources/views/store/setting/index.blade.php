@extends('store.master')
@section('title', 'الإعدادات')
@section('setting-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <h2 class="text-center">الإعدادات</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-12 d-flex justify-content-center">

            <form method="post" action="{{ route('setting.updateOrCreateStore') }}" enctype="multipart/form-data"
                class="mt-3 col-lg-6 col-sm-12">

                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-dashboard.input type="text" name="name" value="{{ old('name', $store->name ?? '') }}"
                    label="الاسم :" />
                <x-dashboard.input type="tel" name="mobile" value="{{ old('mobile', $store->mobile ?? '') }}"
                    pattern="[0-9]{12}" label="رقم الموبايل:" />
                <x-dashboard.input type="text" name="address" value="{{ old('address', $store->address ?? '') }}"
                    label="العنوان:" />
                <x-dashboard.input type="time" name="start_time"
                    value="{{ old('start_time', $store->start_time ?? '') }}" label="بداية العمل:" />
                <x-dashboard.input type="time" name="end_time" value="{{ old('end_time', $store->end_time ?? '') }}"
                    label="نهاية العمل:" />

                <div class="row mt-3">
                    <x-dashboard.input-file class=" col-8" name="image" label="الصورة:" />
                    @if (!empty($store->image))
                        <div class="col-4">
                            <img style="width: 100%;" src="{{ asset($store->image) }}" alt="صورة المتجر">
                        </div>
                    @endif
                </div>


                @if (!Auth::user()->store)
                    <x-dashboard.select_m selected="{{ old('category_id', $store->category_id ?? '') }}" :options="\App\Models\Category::all()"
                        name="category_id" label="اختر نوع الخدمة " /> 
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">

                    <button type="button" class="btn btn-primary mt-2" onclick="getLocation()">احصل على موقعي</button>
                    <p id="location-status" class="mt-2 text-muted"></p>
                @endif

                <input type="submit" value="حفظ التعديلات" class="form-control btn btn-outline-success mt-3">
            </form>
        </div>
    </div>



@endsection
@section('script')
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                document.getElementById("location-status").innerText = "جاري تحديد الموقع...";
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true, // زيادة دقة تحديد الموقع
                    timeout: 10000, // مدة الانتظار قبل الفشل (10 ثوانٍ)
                    maximumAge: 0 // عدم استخدام موقع قديم مخزن
                });
            } else {
                document.getElementById("location-status").innerText = "المتصفح لا يدعم تحديد الموقع.";
            }
        }

        function showPosition(position) {
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("lng").value = position.coords.longitude;
            document.getElementById("location-status").innerText = "تم تحديد الموقع بنجاح!";
        }

        function showError(error) {
            let message = "";
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    message = "تم رفض طلب تحديد الموقع. يرجى السماح بالوصول للموقع من إعدادات المتصفح.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    message = "الموقع غير متاح. تأكد من تشغيل GPS أو جرب متصفحًا آخر.";
                    break;
                case error.TIMEOUT:
                    message = "انتهى وقت طلب تحديد الموقع. حاول مرة أخرى في مكان مفتوح.";
                    break;
                default:
                    message = "حدث خطأ غير معروف.";
            }
            document.getElementById("location-status").innerText = message;
        }
    </script>

@endsection
