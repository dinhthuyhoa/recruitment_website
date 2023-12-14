@extends('frontend.master.master')
@section('css')
    <title>Checkout</title>

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

        .form_payment {
            /* background: linear-gradient(135deg, #F5BA54F0, #C6812C); */
            padding: 20px; 
            background-color: #e3e3e3;
        }
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
            color: #030d4e;
        }

        .col-md-4, .col-sm-6 {
            padding-right: 35px !important;
            padding-left: 35px !important;
        }

        .pricingTable{
            background-color: #f5f4f1;
            /* border: 2px solid #e3e3e3; */
            text-align: center;
            position: relative;
            padding-bottom: 20px;
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
            border-right: 2px solid #030d4e;
            border-left: 2px solid #030d4e;
            transform: scaleY(0);
            transform-origin: 100% 0 0;
        }

        .pricingTable:after{
            border-bottom: 2px solid #030d4e;
            border-top: 2px solid #030d4e;
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
            background: #ffffff;
            color: #030d4e;
            margin: -2px -2px;
            /* padding: 30px 0; */
            padding-bottom: 18px;
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
            /* margin-bottom: 30px; */
        }

        .pricingTable .pricing-content li{
            padding-left: 15px;
            /* font-size: 14px; */
            color: #000000;
            line-height: 35px;
            padding-right: 15px;
        }

        .check_out {
            width: 75% !important;
            border: 2px #030d4e solid;
            background: none;
            color: #030d4e;
            
        }

        .check_out:hover {
            /* width: 65% !important;
            border: 2px #c07f00 solid; */
            background: #030d4e;
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

        .custom-radio input[type="radio"] {
            display: none; 
        }

        .custom-radio input[type="radio"] + .check-payment:before {
            content: "";
            display: inline-block;
            width: 12px; 
            height: 12px; 
            /* margin-right: 10px;  */
            border: 2px solid #030d4e; 
            border-radius: 50%; 
        }

        .custom-radio input[type="radio"]:checked + .check-payment:before {
            background-color: #030d4e; 
        }

        @media screen and (max-width: 990px){
            .pricingTable{ margin-bottom: 25px; }
        }
    body{background-color:#eee;}



        /*PRICE COLOR CODE START*/
        #generic_price_table .generic_content{
            background-color: #030d4e;
        }

        #generic_price_table .generic_content .generic_head_price{
            background-color: #f6f6f6;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg{
            border-color: #e4e4e4 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #e4e4e4;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head span{
            color: #525252;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign{
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency{
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent{
            color: #414141;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .month{
            color: #414141;
        }

        #generic_price_table .generic_content .generic_feature_list ul li{	
            color: #a7a7a7;
        }

        #generic_price_table .generic_content .generic_feature_list ul li span{
            color: #414141;
        }
        #generic_price_table .generic_content .generic_feature_list ul li:hover{
            background-color: #E4E4E4;
            border-left: 5px solid #030d4e;
        }

        #generic_price_table .generic_content .generic_price_btn a{
            border: 1px solid #030d4e; 
            color: #030d4e;
        } 

        #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg,
        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg{
            border-color: #030d4e rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #030d4e;
            color: #fff;
        }

        #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span,
        #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span{
            color: #fff;
        }

        #generic_price_table .generic_content:hover .generic_price_btn a,
        #generic_price_table .generic_content.active .generic_price_btn a{
            background-color: #030d4e;
            color: #fff;
        } 
        #generic_price_table{
            /* margin: 50px 0 50px 0; */
            font-family: 'Raleway', sans-serif;
        }
        .row .table{
            padding: 28px 0;
        }

        /*PRICE BODY CODE START*/

        #generic_price_table .generic_content{
            overflow: hidden;
            position: relative;
            text-align: center;
        }

        #generic_price_table .generic_content .generic_head_price {
            margin: 0 0 20px 0;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content{
            margin-top: 30px;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg{
            border-style: solid;
            background-color: #030d4e;
            border-width: 50px 950px 0px 0px;
            position: absolute;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head{
            padding-top: 8px;
            position: relative;
            z-index: 1;
        }

        #generic_price_table .generic_content .generic_head_price .generic_head_content .head span{
            font-family: "Raleway",sans-serif;
            font-size: 20px;
            font-weight: 400;
            letter-spacing: 2px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }
        
        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency{
            font-family: "Lato",sans-serif;
            /* font-size: 60px; */
            font-weight: 300;
            letter-spacing: -2px;
            line-height: 60px;
            padding: 0;
            vertical-align: middle;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent{
            display: inline-block;
            font-family: "Lato",sans-serif;
            font-size: 24px;
            font-weight: 400;
            vertical-align: bottom;
        }

        #generic_price_table .generic_content .generic_head_price .generic_price_tag .month{
            font-family: "Lato",sans-serif;
            font-size: 18px;
            font-weight: 400;
            letter-spacing: 3px;
            vertical-align: bottom;
        }

    </style>
@endsection

@section('content')

    <form class="form_payment" action="{{ route('momo.payment') }}" method="post" id="paymentForm">
    @csrf
        
        <div id="generic_price_table" class="demo">   
            <section>
                <div class="container">
                    <div class="alert alert-danger" id="alertMessage" style="display: none;">
                        {{trans('auth.alert_message_checked')}}
                    </div>
                    <div class="row">
                    @foreach($packages as $package)
                        <div class="col-md-4 col-sm-6">
                            <div class="generic_content clearfix">
                                <div class="generic_head_price clearfix">
                                    <div class="generic_head_content clearfix">
                                        <div class="head_bg"></div>
                                        <div class="head">
                                            <span>{{ $package['title_package'] }}</span>
                                        </div>
                                        
                                    </div>
                                    
                                </div>    


                            <div class="pricingTable">
                                <div class="pricingTable-header">
                               
                                    <h3 class="heading"></h3>
                                    <span class="price-value"> {{ number_format($package['value_package'], 0, ',', '.') }} VND /</span>
                                    <span class="month">{{ $package['package_date'] }} mo</span>
                                </div>
                                <ul class="pricing-content text-left" style="white-space: pre-line;">
                                    <li class="px-4">{{ $package['package_content'] }}</li>
                                </ul>

                                <div class="wrap-input100 validate-input" data-validate="Payment">
                                    <label class="custom-radio">
                                        <input class="selected_package" type="radio" name="selected_package" value="{{ json_encode($package) }}" >
                                        <span class="check-payment">&nbsp; {{trans('auth.confirm_pay')}}</span>
                                    </label>
                                </div>
                                <div class="button-payment btn">
                                    <button type="submit" form="paymentForm" class="btn boxed-btn3 w-100 my-3 filter-job text-white" name="redirect">{{trans('auth.pay')}}</button>
                                </div>
                                
                            </div>
                            </div>
                        </div>            
                    @endforeach
                    
                </div>
            </div>
        </div>

    </form>

@endsection

@section('js')
<script>
        $(document).ready(function () {
            $("#paymentForm").submit(function (event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

            function validateForm() {
                var selected_package = $(".selected_package:checked").val();
                if (!selected_package) {
                    $("#alertMessage").fadeIn();

                    setTimeout(function () {
                        $("#alertMessage").fadeOut();
                    }, 10000);

                    return false;
                }
                return true;
            }
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/login/js/main.js') }}"></script>
    
    
@endsection
