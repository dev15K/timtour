<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('home') ? 'active' : 'collapsed' }}"
               href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Trang quản trị</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.app.setting.index') ? '' : 'collapsed' }}"
               href="{{ route('admin.app.setting.index') }}">
                <i class="bi bi-gear"></i>
                <span>Cài đặt website</span>
            </a>
        </li><!-- End Setting Page Nav -->

        <li class="nav-heading">Trang</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.profile.index') ? '' : 'collapsed' }}"
               href="">
                <i class="bi bi-person"></i>
                <span>Trang cá nhân</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('auth.logout') ? '' : 'collapsed' }}"
               href="{{ route('auth.logout') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Đăng xuất</span>
            </a>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside>
