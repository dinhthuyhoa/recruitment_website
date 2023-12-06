<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: #C07F00 !important;">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" target="_blank" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo-flower.png') }}" style="width:50px">
            </span>
            <span class=" demo text-white fw-bolder text-uppercase ms-1" style="font-size: 12px !important;">{{trans('admin-auth.recruitment_portal')}}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'open active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link text-white">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">{{trans('admin-auth.welcome')}}</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-white">{{trans('admin-auth.manager')}}</span>
        </li>
        @if (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Administrator)
            <li class="menu-item {{ request()->is('admin/users*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Users">{{trans('admin-auth.user')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="menu-link text-white">
                            <div data-i18n="User List">{{trans('admin-auth.user_list')}}</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/users/create') ? 'active' : '' }}">
                        <a href="{{ route('users.create') }}" class="menu-link text-white">
                            <div data-i18n="New User">{{trans('admin-auth.new_user')}}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Administrator)
            <li class="menu-item {{ request()->is('admin/payment-management*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                    <!-- <i class="menu-icon tf-icons bx bx-dock-top"></i> -->
                    <i class="fa-regular fa-credit-card menu-icon tf-icons"></i>
                    <div data-i18n="Payment management">{{trans('admin-auth.payment_management')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/payment-management') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment_management.list') }}" class="menu-link text-white">
                            <div data-i18n="Payment List">{{trans('admin-auth.payment_management_list')}}</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/payment-management/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment_management.create') }}" class="menu-link text-white">
                            <div data-i18n="New Payment">{{trans('admin-auth.new_payment')}}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role == \App\Enums\UserRole::Administrator)
            <li class="menu-item {{ request()->is('admin/payment-package-management*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                    <!-- <i class="menu-icon tf-icons bx bx-dock-top"></i> -->
                    <i class="fa-regular fa-credit-card menu-icon tf-icons"></i>
                    <div data-i18n="Payment Package management">{{trans('admin-auth.payment_package_management')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/payment-package-management') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment_package.list') }}" class="menu-link text-white">
                            <div data-i18n="Payment List">{{trans('admin-auth.payment_package_list')}}</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/payment-package-management/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment_package.create') }}" class="menu-link text-white">
                            <div data-i18n="New Payment">{{trans('admin-auth.new_payment')}}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="menu-item {{ request()->is('admin/posts/recruitment*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                <i class="menu-icon tf-icons bx bx-library"></i>
                <div data-i18n="Recruitment Posts">{{trans('admin-auth.recruitment_posts')}}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/posts/recruitment') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.recruitment.list') }}" class="menu-link text-white">
                        <div data-i18n="Post list">{{trans('admin-auth.post_list')}}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/posts/recruitment/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.recruitment.create') }}" class="menu-link text-white">
                        <div data-i18n="Create post">{{trans('admin-auth.create_post')}}</div>
                    </a>
                </li>
            </ul>
        </li>
        @if (Auth::check() && (Auth::user()->role == \App\Enums\UserRole::Administrator || Auth::user()->role == \App\Enums\UserRole::SubAdmin))
            <li class="menu-item {{ request()->is('admin/posts/news*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="News Posts">{{trans('admin-auth.new_post')}}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/posts/news') ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.news.list') }}" class="menu-link text-white">
                            <div data-i18n="Post list">{{trans('admin-auth.post_list')}}</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/posts/news/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.news.create') }}" class="menu-link text-white">
                            <div data-i18n="Create post">{{trans('admin-auth.create_post')}}</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="menu-item {{ request()->is('admin/job-apply*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-white">
                <i class='menu-icon bx bxs-calendar-event'></i>
                <div data-i18n="Job Apply">{{trans('admin-auth.job_apply')}}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/job-apply/list') ? 'active' : '' }}">
                    <a href="{{ route('admin.job_apply.list') }}" class="menu-link text-white">
                        <div data-i18n="Post list">{{trans('admin-auth.post_list')}}</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
