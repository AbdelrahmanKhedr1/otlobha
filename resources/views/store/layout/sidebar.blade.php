<div class="sidebar">
    <div class="logo_side col-12">
        <h2>اطلبها</h2>
    </div>
    <ul>
        <li>
            <a class="@yield('home-active') hover-link" href="{{ route('store.dashboard') }}">
                <i class="fa-solid fa-home i_sidebar"></i>
                <p>الرئيسية</p>
            </a>
        </li>
        @if (Auth::user()->store)
            <li>
                <a class="@yield('product-active') hover-link" href="{{ route('store.product.index') }}">
                    <i class="fa-solid fa-table i_sidebar"></i>
                    <p>المنتجات</p>
                </a>
            </li>
            <li>
                <a class="@yield('offer-active') hover-link" href="{{ route('offer.index') }}">
                    <i class="fa-solid fa-table i_sidebar"></i>
                    <p>العروض</p>
                </a>
            </li>
            <li>
                <a class="@yield('order-active') hover-link" href="{{ route('order.index') }}">
                    <i class="fa-solid fa-table i_sidebar"></i>
                    <p>الاوردر</p>
                </a>
            </li>
            <li>
                <a class="@yield('chat-active') hover-link" href="{{ route('store.chat') }}">
                    <i class="fa-solid fa-table i_sidebar"></i>
                    <p>المحادثه </p>
                </a>
            </li>

        @endif
        <li>
            <a class="@yield('setting-active') hover-link" href="{{ route('setting.index') }}">
                <i class="fa-solid fa-table i_sidebar"></i>
                <p>الاعدادات</p>
            </a>
        </li>

        {{-- <li>
            <a class="@yield('store3-active') hover-link" href="{{ route('store.index', '3') }}">
                <i class="fa-solid fa-table i_sidebar"></i>
                <p>المتجر</p>
            </a>
        </li>
        <li>
            <a href="charts hover-link">
                <i class="fa-solid fa-chart-pie i_sidebar"></i>
                <p>الاحصائيات</p>
            </a>
        </li>
        <li>
            <a class="@yield('subscription-active') hover-link" href="{{ route('subscription.index') }}">
                <i class="fa-solid fa-star i_sidebar"></i>
                <p>الاشتراكات</p>
            </a>
        </li>
        <li>
            <a class="@yield('feedbacks-active') hover-link" href="{{ route('feedbacks.unread') }}">
                <i class="fa-solid fa-star i_sidebar"></i>
                <p>اراء العملاء</p>
            </a>
        </li>
        <li>
            <a class="@yield('dashoffer-active') hover-link" href="{{ route('dashoffer.index') }}">
                <i class="fa-solid fa-star i_sidebar"></i>
                <p>الاعلانات</p>
            </a>
        </li> --}}

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <li>
                <a class="hover-link log_hover" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out i_sidebar"></i>
                    {{ __('الخروج') }}
                </a>
            </li>
        </form>
    </ul>
</div>
