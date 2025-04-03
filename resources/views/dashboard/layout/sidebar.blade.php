<div class="sidebar">
    <div class="logo_side col-12">
        <h2>@yield('title')</h2>
    </div>
    <ul>
        <li>
            <a class="@yield('home-active') hover-link" href="{{ route('dashboard.index') }}">
                <i class="fa-solid fa-home i_sidebar"></i>
                <p>الرئيسية</p>
            </a>
        </li>
        <li>
            <a class="@yield('store1-active') hover-link" href="{{ route('store.index', '1') }}">
                <i class="fas fa-utensils i_sidebar"></i>
                <p>المطاعم</p>
            </a>
        </li>
        <li>
            <a class="@yield('store2-active') hover-link" href="{{ route('store.index', '2') }}">
                <i class="fas fa-capsules i_sidebar"></i>
                <p>الصيدليات</p>
            </a>
        </li>
        <li>
            <a class="@yield('store3-active') hover-link" href="{{ route('store.index', '3') }}">
                <i class="fas fa-store i_sidebar"></i>
                <p>المتاجر</p>
            </a>
        </li>
        <li>
            <a class="@yield('subscription-active') hover-link" href="{{ route('subscription.index') }}">
                <i  class="fas fa-bell i_sidebar"></i>
                <p>الاشتراكات</p>
            </a>
        </li>

        <li>
            <a class="@yield('company-active') hover-link" href="{{ route('company.index') }}">
                <i class="fas fa-building i_sidebar"></i>
                <p> الشركات</p>
            </a>
        </li>
        <li>
            <a class="@yield('product-active') hover-link" href="{{ route('product.index') }}">
                <i class="fas fa-shopping-basket i_sidebar"></i>
                <p> المنتجات</p>
            </a>
        </li>
        <li>
            <a class="@yield('conversation-active') hover-link" href="{{ route('conversation.inbox') }}">
                <i class="fas fa-envelope i_sidebar"></i>
                <p> الدعم الفني</p>
            </a>
        </li>
        <li>
            <a class="@yield('dashoffer-active') hover-link" href="{{ route('dashoffer.index') }}">
                <i class="fas fa-ad i_sidebar"></i>
                <p>الاعلانات</p>
            </a>
        </li>
        <li>
            <a class="@yield('city-active') hover-link" href="{{ route('city.index') }}">
                <i class="fas fa-map-marker-alt i_sidebar"></i>
                <p>المحافظات</p>
            </a>
        </li>
        <li>
            <a class="@yield('tag-active') hover-link" href="{{ route('tag.index') }}">
                <i class="fa-solid fa-star i_sidebar"></i>
                <p>التاجز</p>
            </a>
        </li>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <li>
                <a class="hover-link log_hover" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out i_sidebar"></i>
                    {{ __('الخروج') }}
                </a>
            </li>
        </form>
    </ul>
</div>
