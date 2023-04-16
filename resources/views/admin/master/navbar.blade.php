<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <li class="nav-item lh-1 me-3 dropdown">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (Lang::locale() == 'en')
                            <span class="flag-icon flag-icon-us"> </span>
                            English
                        @else
                            <span class="flag-icon flag-icon-vn"> </span>
                            Tiếng Việt
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="{!! route('settings.change-language', ['en']) !!}">
                            <span class="flag-icon flag-icon-us"> </span>
                            English
                        </a>
                        <a class="dropdown-item" href="{!! route('settings.change-language', ['vi']) !!}">
                            <span class="flag-icon flag-icon-vn"> </span>
                            Tiếng Việt
                        </a>
                    </ul>
                </div>
            </li>

            @if (Auth::check())
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt
                                class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                        <small
                                            class="text-muted">{{ \App\Enums\UserRole::getKey(Auth::user()->role) }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            @endif
        </ul>
    </div>
</nav>
