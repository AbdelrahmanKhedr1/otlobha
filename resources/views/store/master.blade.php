<!DOCTYPE html>
<html>
@include('store.layout.header')

<!-- ==================Sidebar========================================== -->


<!-- ==============Content===================================================== -->
<div class="content d-flex">
    @include('store.layout.sidebar')
    
    <div class="data_all pt-3">
        @yield('content')
    </div>
</div>


@include('store.layout.footer')
