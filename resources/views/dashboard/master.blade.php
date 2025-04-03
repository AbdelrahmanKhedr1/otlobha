<!DOCTYPE html>
<html>
@include('dashboard.layout.header')

<!-- ==================Sidebar========================================== -->



<!-- ==============Content===================================================== -->

<div class="content d-flex">
    @include('dashboard.layout.sidebar')

    <div class="data_all pt-3">

        @yield('content')
    </div>
</div>


@include('dashboard.layout.footer')
