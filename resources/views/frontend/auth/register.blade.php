<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-flower.png') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/main.css') }}">
    <!--===============================================================================================-->

    <style>
        .login100-form-btn {
            background-color: #d7a50c;
        }

        .login100-form-title {
            font-size: 50px;
            padding-bottom: 40px;

        }

        .login100-pic {
            padding-top: 55px;
        }

        .container-login100 {
            background: linear-gradient(-135deg, #ffd800, #5d3b00);
        }

        .input100:focus+.focus-input100+.symbol-input100 {
            color: #d7a50c;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="https://media.istockphoto.com/id/1302836754/vector/symbol-of-people-connect-among-themselves-concept-of-teamwork-connection-communication-group.jpg?s=612x612&w=0&k=20&c=ooKtt0YbOmdYva872YZxQ-Upz-XEfaF7fOeQ2y7u7T8="
                        alt="IMG">
                </div>

                <form class="login100-form validate-form" action="{{ route('register.submit') }}" method="post">
                    @csrf
                    <span class="login100-form-title">
                        {{ __('auth.register') }}
                        <span class="d-block text-secondary fs-24 m-t-10">- {{ __('auth.candidate') }} -</span>

                    </span>
                    <input type="hidden" name="redirect_to" value="{{ request()->redirect_to }}">
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
                    <div class="wrap-input100 validate-input" data-validate="Valid fullname is required">
                        <input class="input100" type="text" name="fullname" placeholder="{{ __('auth.fullname') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid Phone is required: phone number">
                        <input class="input100" type="text" name="phone" placeholder="{{ __('auth.phone') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid Email is required: email address">
                        <input class="input100" type="text" name="email" placeholder="{{ __('auth.email') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="{{ __('auth.password') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password verify is required">
                        <input class="input100" type="password" name="password_verify" placeholder="{{ __('auth.password-verify') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{ __('auth.register') }}
                        </button>
                    </div>

                    <div class="text-center p-t-10">
                        <a class="txt2" href="{{ route('login') }}">
                            {{ __('auth.login') }}
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="text-center p-t-10">
                        <a class="txt2" href="{{ route('register.recruiter') }}">
                            {{ __('auth.become-a-recruiter') }}
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
