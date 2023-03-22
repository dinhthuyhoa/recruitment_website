<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{ asset('frontend/img/logo.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">home</a></li>
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
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="d-none d-lg-block">
                                    <div class="dropdown mx-4">
                                        <button class="btn btn-light dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
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
                                    <a href="#">Log in</a>
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
