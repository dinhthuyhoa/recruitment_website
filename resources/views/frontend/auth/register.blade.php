<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-flower.ico') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/bootstrap/css/bootstrap.min.c') }}ss">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.c') }}ss">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/animate/animate.c') }}ss">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/login/vendor/css-hamburgers/hamburgers.min.c') }}ss">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/select2/select2.min.c') }}ss">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/util.c') }}ss">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/main.c') }}ss">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('frontend/login/images/img-01.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <span class="login100-form-title">
                        Login
                    </span>
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
                    <div class="wrap-input100 validate-input"
                        data-validate="Valid username is required: email or phone">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    {{-- <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div> --}}

                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('register') }}">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/js/main.js') }}"></script>

</body>

</html>
