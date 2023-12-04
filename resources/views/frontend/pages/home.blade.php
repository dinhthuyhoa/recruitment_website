@extends('frontend.master.master')
@section('css')
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.4); /* Black with a little bit of opacity */
    }

    /* Style for the modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 48% 75% auto; 
        width: 20%; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style for the close button */
    .close {
        border: 1px solid #030d4e;
        opacity: 1;
        background-color: #030d4e;
        padding-right: 2%;
        padding-bottom: 2%;
        text-align: end;
        float: right;
        font-size: 28px;
        font-weight: bold;
        text-align: end;
    }

    .close:hover,
    .close:focus {
        opacity: 1;
        background-color: #030d4e;
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .title-message {
        color: #030d4e;
        padding-left: 3%;
        padding-top: 5%;
        font-size: 20px;
    }
    .message-success {
        font-size: 14px;
        padding: 0 1% 0 3%;
        line-height: 1.5;
    }
</style>
@endsection

@if(isset($successMessage))
    <div id="successModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">
                &times;
            </span>
            <h4 class="title-message">{{trans('home.title_message')}}</h4>
            <p class="message-success">{{trans('home.message_success')}}</p>
        </div>
    </div>
@endif

@section('content')
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft" > {{trans('home.title_banner')}}</h5>
                        <h3 class="wow fadeInLeft" >{{trans('home.description_banner_1')}}</h3>
                        <p class="wow fadeInLeft" style="font-size: 24px;">{{trans('home.description_banner_2')}}</p>
                        @if (Auth::check() && Auth::user()->role == 'candidate')
                        <div class="sldier_btn wow fadeInLeft" >
                            <a href="{{route('posts.recruitment.list')}}" class="boxed-btn3" style="background-color: #c07f00; border: 1px solid #c07f00">{{trans('home.find_now')}}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_3">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #c07f00;">{{trans('home.big_upgrade')}}</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_big_upgrade_1')}}
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_big_upgrade_2')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<!-- slider_area_end -->

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">{{trans('home.new_feature')}}</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_new_feature_1')}}
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_new_feature_2')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">{{trans('home.about_us')}}</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_about_us_1')}}
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_about_us_2')}}
                        </p>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_about_us_3')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_6">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft fw-bold" style="color: #010624;">{{trans('home.mission')}}</h5>
                        <p class="wow fadeInLeft" style="font-size: 14px;">
                        {{trans('home.description_mission_1')}}
                        <br>
                        {{trans('home.description_mission_2')}}
                        <br>
                        {{trans('home.description_mission_3')}}
                        <br>
                        {{trans('home.description_mission_4')}}

                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="slider">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="top_companies_area">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-lg-12 col-md-6">
                <div class="section_title">
                <h5 class="fw-bold" style="font-size: 30px; color: #010624;">{{trans('home.overview')}}</h5>
                <p class="text-white" style="font-size: 14px;">
                {{trans('home.description_overview_1')}}
                    <br>
                    {{trans('home.description_overview_2')}}
                    <br>
                    {{trans('home.description_overview_3')}}
                </p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-40">
            <div class="col-lg-12 col-md-6">
                <div class="section_title">
                    <h5 class="fw-bold" style="font-size: 30px; color: #010624;">{{trans('home.partner')}}</h5>
                    <div class="slider_area">
                        <div class="single_slider  d-flex align-items-center slider_bg_7">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    // Function to open the modal
    function openModal() {
        $('#successModal').show();
        setTimeout(function () {
                closeModal();
            }, 15000);
    }

    function closeModal() {
        $('#successModal').hide();
    }

    $(document).ready(function () {
        openModal();
    });
</script>
@endsection