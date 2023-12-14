<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-flower.png') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/login/css/main.css') }}">
    <!--===============================================================================================-->
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">
    <style>
        html {
            font-family: math !important;
        }

        .login100-form-btn {
            background-color: #d7a50c;
        }

        .login100-form-title {
            font-size: 50px;
            padding-bottom: 40px;
            font-family: math !important;

        }

        .login100-pic {
            padding-top: 55px;
        }

        .container-login100 {
            background: linear-gradient(-135deg, #ffd800, #5d3b00);
        }

        input {
            font-family: math !important;
        }
        .wrap-login100 {
            width: 900px !important;
        }

        .login100-form {
            width: 390px !important;
        }
    </style>
</head>

<body>

    <div class="limiter">

        <div class="container-login100">

            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="https://media.istockphoto.com/id/1302836754/vector/symbol-of-people-connect-among-themselves-concept-of-teamwork-connection-communication-group.jpg?s=612x612&w=0&k=20&c=ooKtt0YbOmdYva872YZxQ-Upz-XEfaF7fOeQ2y7u7T8=" alt="IMG">
                </div>
                
                <form class="login100-form validate-form" action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <span class="login100-form-title">
                        {{ __('auth.login') }}
                    </span>

                    @if (\Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (\Session::has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {!! \Session::get('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(isset($message_error))
                        <div id="errorAlert" class="alert alert-danger">
                            <p>{{trans('auth.message_error')}}</p>
                        </div>
                    @endif
                    @if(isset($errorMessagePending))
                    
                    <div id="$errorMessagePending" class="alert alert-danger">
                        <p>{{trans('auth.message_account_pending')}}</p>
                    </div>
                    @endif
                    <div class="wrap-input100 validate-input" data-validate="Valid username is required: email or phone">
                            <input class="input100" type="text" name="username" placeholder="{{ __('auth.username') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="{{ __('auth.password') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="ml-2" type="checkbox" id="remember-me" name="remember" />
                        <label class="ml-2" for="remember-me"> {{ __('auth.remember-me') }} </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{ __('auth.login') }}
                        </button>
                    </div>

                    <div class="text-center p-t-30">
                        <a class="txt2" href="{{ route('register.recruiter') }}">
                            {{ __('auth.create-your-account') }}
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
    <script>
        // Hide the alert after 5 seconds
        setTimeout(function() {
            $('#errorMessagePending').fadeOut('slow');
        }, 3000);
        setTimeout(function() {
            $('#errorAlert').fadeOut('slow');
        }, 5000);
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/js/main.js') }}"></script>

</body>

</html>