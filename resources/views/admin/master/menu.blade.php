<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" target="_blank" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo-flower.png') }}" alt="" width="50" height="50">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Flower</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'open active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manager</span>
        </li>

        <li class="menu-item {{ request()->is('admin/users*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div data-i18n="User List">User List</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/users/create') ? 'active' : '' }}">
                    <a href="{{ route('users.create') }}" class="menu-link">
                        <div data-i18n="New User">New User</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->is('admin/posts/recruitment*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-library"></i>
                <div data-i18n="Recruitment Posts">Recruitment Posts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/posts/recruitment') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.recruitment.list') }}" class="menu-link">
                        <div data-i18n="Post list">Post list</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/posts/recruitment/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.recruitment.create') }}" class="menu-link">
                        <div data-i18n="Create post">Create post</div>
                    </a>
                </li>
            </ul>
        </li>
        @if (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Administrator)
            <li class="menu-item {{ request()->is('admin/posts/news*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="News Posts">News Posts</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/posts/news') ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.news.list') }}" class="menu-link">
                            <div data-i18n="Post list">Post list</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/posts/news/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.news.create') }}" class="menu-link">
                            <div data-i18n="Create post">Create post</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="menu-item {{ request()->is('admin/job-apply*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon bx bxs-calendar-event'></i>
                <div data-i18n="Job Apply">Job Apply</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/job-apply/list') ? 'active' : '' }}">
                    <a href="{{ route('admin.job_apply.list') }}" class="menu-link">
                        <div data-i18n="Post list">Post list</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
