@extends('frontend.master.master')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-flower.ico') }}">
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

        .form_payment {
            /* background: linear-gradient(135deg, #F5BA54F0, #C6812C); */
            padding: 20px; 
            background-color: #e3e3e3;
        }
        .demo
        {
            padding: 100px 0;
        }

        .heading {
            color: #fff;
        }

        .col-md-4, .col-sm-6 {
            padding-right: 35px !important;
            padding-left: 35px !important;
        }

        .pricingTable{
            background-color: #E3E0D9;
            border: 2px solid #e3e3e3;
            text-align: center;
            position: relative;
            padding-bottom: 40px;
            transform: translateZ(0px);
        }

        .pricingTable:before,
        .pricingTable:after{
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            bottom: -2px;
            right: -2px;
            z-index: -1;
            transition: all 0.5s ease 0s;
        }

        .pricingTable:before{
            border-right: 2px solid #c07f00;
            border-left: 2px solid #c07f00;
            transform: scaleY(0);
            transform-origin: 100% 0 0;
        }

        .pricingTable:after{
            border-bottom: 2px solid #c07f00;
            border-top: 2px solid #c07f00;
            transform: scaleX(0);
            transform-origin: 0 100% 0;
        }

        .pricingTable:hover:before{
            transform: scaleY(1);
        }

        .pricingTable:hover:after{
            transform: scaleX(1);
        }

        .pricingTable .pricingTable-header{
            background: #c07f00;
            color: #fff;
            margin: -2px -2px 35px;
            padding: 30px 0;
        }

        .pricingTable .heading{
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }

        .pricingTable .subtitle{
            font-size: 14px;
            display: block;
        }

        .pricingTable .price-value{
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;
            position: relative;
            display: inline-block;
        }

        .pricingTable .currency{
            font-size: 45px;
            font-weight: normal;
            position: absolute;
            top: 2px;
            left: -30px;
        }

        .pricingTable .month{
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;

        }

        .pricingTable .pricing-content{
            list-style: none;
            padding: 0;
            margin-bottom: 30px;
        }

        .pricingTable .pricing-content li{
            padding-left: 15px;
            font-size: 14px;
            color: #7a7e82;
            line-height: 35px;
            padding-right: 15px;
        }

        .check_out {
            width: 75% !important;
            border: 2px #c07f00 solid;
            background: none;
            color: #c07f00;
            
        }

        .check_out:hover {
            /* width: 65% !important;
            border: 2px #c07f00 solid; */
            background: #c07f00;
            color: #fff;
        }

        .button-payment{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .check-payment {
            font-size: 14px;
        }

        .custom-checkbox input[type="checkbox"] {
            display: none; 
        }

        .custom-checkbox input[type="checkbox"] + .check-payment:before {
            content: "";
            display: inline-block;
            width: 12px; 
            height: 12px; 
            /* margin-right: 10px;  */
            border: 2px solid #c07f00; 
            border-radius: 50%; 
        }

        .custom-checkbox input[type="checkbox"]:checked + .check-payment:before {
            background-color: #c07f00; 
        }

        @media screen and (max-width: 990px){
            .pricingTable{ margin-bottom: 25px; }
        }
    </style>
</head>

<body>

    <form class="form_payment" action="{{ route('vnpay.payment') }}" method="post">
        <div class="demo">
            <div class="container">
                <div class="row">
                    @foreach($packages as $package)
                        <div class="col-md-4 col-sm-6">
                            <div class="pricingTable">
                                <div class="pricingTable-header">
                                @csrf
                                    <h3 class="heading">{{ $package['name'] }}</h3>
                                    <span class="price-value">{{ number_format($package['price']) }} VND /</span>
                                    <span class="month">{{ $package['timeout'] }} mo</span>
                                </div>
                                <ul class="pricing-content">
                                    <!-- Add details for this package here -->
                                    <li>Log in to the system as an employer.</li>
                                    <li>Post job openings.</li>
                                    <li>Manage job postings.</li>
                                    <li>View candidate information.</li>
                                    <li>Contact candidates for interviews.</li>
                                    <li>Notify candidates of results.</li>
                                </ul>
                                <div class="wrap-input100 validate-input" data-validate="Payment">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="selected_package" value="{{ json_encode($package) }}">
                                        <span class="check-payment">&nbsp; I agree to make the payment</span>
                                    </label>
                                </div>
                                <div class="button-payment">
                                    <button type="submit" class="login100-form-btn check_out" name="redirect">Payment VNPAY</button>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </form>
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
