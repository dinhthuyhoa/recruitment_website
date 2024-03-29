<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin_template/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-flower.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin_template/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin_template/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin_template/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin_template/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('admin_template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin_template/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('admin_template/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin_template/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card" style="background-color: #C07F00;">
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {!! \Session::get('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {!! \Session::get('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('logo-flower.png') }}" alt="" style="width:50px">
                                </span>
                                <span class=" demo text-white fw-bolder text-uppercase ms-1">{{trans('admin-auth.recruitment_portal')}}</span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        @if(isset($message_error))
                            <div id="errorAlert" class="alert alert-danger">
                                <p>{{trans('auth.message_error')}}</p>
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3" action="{{ route('admin.login.submit') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label text-white">{{trans('admin-auth.info_login')}}</label>
                                <input type="text" class="form-control" id="email" name="username"
                                    placeholder="{{trans('admin-auth.fill_email')}}" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                {{-- <div class="d-flex justify-content-between">
                                    <label class="form-label text-white" for="password">{{trans('admin-auth.pass')}}</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>{{trans('admin-auth.forgot_pass')}}</small>
                                    </a>
                                </div> --}}
                                <label class="form-label text-white" for="password">{{trans('admin-auth.pass')}}</label>
                                <div class="input-group input-group-merge">
                                    
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me"
                                        name="remember" />
                                    <label class="form-check-label text-white" for="remember-me"> {{trans('admin-auth.remember')}}</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{trans('admin-auth.sign_in')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin_template/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_template/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_template/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin_template/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('admin_template/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
