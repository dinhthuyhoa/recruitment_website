<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('logo-flower.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ route('home') }}">home</a></li>
                                        <li><a href="jobs.html">Browse Job</a></li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="candidate.html">Candidates </a></li>
                                                <li><a href="job_details.html">job details </a></li>
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="d-none d-lg-block">
                                    <div class="dropdown mx-4">
                                        <button class="btn btn-light bg-transparent border-0 text-light dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            @if (Lang::locale() == 'en')
                                                <span class="flag-icon flag-icon-us"> </span>
                                                English
                                            @else
                                                <span class="flag-icon flag-icon-vn"> </span>
                                                Tiếng Việt
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{!! route('settings.change-language', ['en']) !!}">
                                                <span class="flag-icon flag-icon-us"> </span>
                                                English
                                            </a>
                                            <a class="dropdown-item" href="{!! route('settings.change-language', ['vi']) !!}">
                                                <span class="flag-icon flag-icon-vn"> </span>
                                                Tiếng Việt
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone_num d-none d-xl-block">
                                    @if (Auth::check())
                                        <!-- User -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="javascript:void(0);" id="navbardrop"
                                                data-toggle="dropdown">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt
                                                        class="w-px-40 h-auto rounded-circle" width="40"
                                                        height="40" />
                                                </div>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                                                    alt class="w-px-40 h-auto rounded-circle"
                                                                    width="40" height="40"
                                                                    style="margin-right: 10px;" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <span
                                                                class="text-dark fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                            <small
                                                                class="text-dark text-muted">{{ \App\Enums\UserRole::getKey(Auth::user()->role) }}</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-dark" href="#">Change Passowrd</a>
                                                <a class="dropdown-item text-dark"
                                                    href="{{ route('logout') }}">Logout</a>
                                            </div>
                                        </li>
                                        <!--/ User -->
                                    @else
                                        <a href="{{ route('login') }}">Log in</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
