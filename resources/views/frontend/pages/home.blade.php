@extends('frontend.master.master')
@section('css')
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')


<!-- carousel_area -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="image2.jpg" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="image3.jpg" alt="Image 3">
        </div>
    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- end_carousel_area -->

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">4536+ Jobs listed</h5>
                        <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Find your Dream Job</h3>
                        <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">We provide online instant
                            cash loans with quick approval that suit your term length</p>
                        <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                            <a href="#" class="boxed-btn3">Upload your Resume</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
        <img src="{{ asset('frontend/img/banner/illustration.png') }}" alt="">
    </div>
</div>
<!-- slider_area_end -->

<!-- catagory_area -->
<div class="catagory_area">
    <div class="container">
        <form action="{{ route('posts.recruitment.list') }}" method="get">
            <div class="row cat_search">
                @csrf
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <input type="text" name="keyword" placeholder="Search keyword">
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide" name="filter_address" id="filter_address">
                            <option value="">All</option>
                            @foreach (config('63-tinh-vn') as $k => $v)
                            <option value="{{ $k }}" {{ request()->filter_address == $k ? 'selected' : '' }}>
                                {{ $v }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        $('#filter_address').select2();
                    </script>
                </div> -->
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide" name="filter_job_nature" id="filter_job_nature">
                            <option value="">All</option>
                            <option value="Full-time" {{ request()->filter_job_nature == 'Full-time' ? 'selected' : '' }}>Full
                                time
                            </option>
                            <option value="Part-time" {{ request()->filter_job_nature == 'Part-time' ? 'selected' : '' }}>Part
                                time
                            </option>
                            <option value="Freelancer" {{ request()->filter_job_nature == 'Freelancer' ? 'selected' : '' }}>
                                Freelancer
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="job_btn">
                        <button type="sumit" class="boxed-btn3">Find Job</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_search d-flex align-items-center">
                    <span>Popular Search:</span>
                    <ul>
                        @foreach ($tags as $tag)
                        <li>
                            <a href="{{ route('posts.recruitment.list', ['tag' => $tag->tag_key]) }}">
                                {{ $tag->tag_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ catagory_area -->

<!-- job_listing_area_start  -->
<div class="job_listing_area pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section_title">
                    <h3>Job Listing</h3>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="brouse_job text-right">
                    <a href="{{ route('posts.recruitment.list') }}" class="boxed-btn4">Browse More Job</a>
                </div>
            </div>
        </div>
        <div class="job_lists" id="home_job_lists">
            <ul class="row">
                @if (count($recruitment_post_list) > 0)
                @foreach ($recruitment_post_list as $post)
                <li class="col-lg-12 col-md-12 item_list_jobs">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center col-8">
                            <div class="thumb">
                                <img src="{{ asset('storage/' . $post->post_image) }}" alt="">
                            </div>
                            <div class="jobs_conetent">
                                <a href="{{ route('posts.recruitment.details', $post->id) }}">
                                    <h4 class="job-title-item">{{ $post->post_title }}</h4>
                                </a>
                                <div>
                                    <h6> {{ $post->author }}</h6>
                                </div>
                                <div class="links_locat d-flex align-items-center" style="gap: 28px;">
                                    <div class="location">
                                        <p class="address"> <i class="fa fa-map-marker"></i>
                                            {{ $post->recruitment_address }}
                                        </p>
                                    </div>
                                    <div class="location">
                                        <p> <i class="fa fa-clock-o"></i>
                                            {{ $post->recruitment_job_nature }}
                                        </p>
                                    </div>
                                    <div class="location">
                                        <p> <i class="fa fa-eye"></i>
                                            {{ $post->post_view }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                @if (Auth::check())
                                <a class="heart_mark" href="javascript:void(0);" onclick="change_favotire({{ $post->id }},{{ Auth::user()->id }}, this)">
                                    @if (Auth::user()->is_post_favorite($post->id))
                                    <i class="fa fa-heart"></i>
                                    @else
                                    <i class="ti-heart"></i>
                                    @endif
                                </a>
                                @endif
                                <a href="{{ route('posts.recruitment.details', $post->id) }}/#apply_job" class="boxed-btn3">Apply Now</a>
                            </div>
                            <div class="date">
                                <p>Deadline:
                                    {{ $post->recruitment_deadline ? date('H:i d/m/Y', strtotime($post->recruitment_deadline)) : 'None' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                @else
                <h3>Not found post</h3>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->

<!-- featured_candidates_area_start  -->
<div class="featured_candidates_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-40">
                    <h3>Featured Candidates</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="candidate_active owl-carousel">
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/1.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/2.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/3.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/4.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/5.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/6.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/7.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/8.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/9.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/9.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/10.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/3.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/candiateds/4.png') }}" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured_candidates_area_end  -->

<div class="top_companies_area">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-lg-6 col-md-6">
                <div class="section_title">
                    <h3>Top Companies</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="{{ asset('frontend/img/svg_icon/5.svg') }}" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="{{ asset('frontend/img/svg_icon/4.svg') }}" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="{{ asset('frontend/img/svg_icon/3.svg') }}" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="{{ asset('frontend/img/svg_icon/1.svg') }}" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- testimonial_area  -->
<div class="testimonial_area  ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-40">
                    <h3>Testimonial</h3>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="testmonial_active owl-carousel">
                    <div class="single_carousel">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="single_testmonial d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/img/testmonial/author.png') }}" alt="">
                                        <div class="quote_icon">
                                            <i class="Flaticon flaticon-quote"></i>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <p>"Working in conjunction with humanitarian aid agencies, we have supported
                                            programmes to help alleviate human suffering through animal welfare when
                                            people might depend on livestock as their only source of income or food.</p>
                                        <span>- Micky Mouse</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_carousel">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="single_testmonial d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/img/testmonial/author.png') }}" alt="">
                                        <div class="quote_icon">
                                            <i class=" Flaticon flaticon-quote"></i>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <p>"Working in conjunction with humanitarian aid agencies, we have supported
                                            programmes to help alleviate human suffering through animal welfare when
                                            people might depend on livestock as their only source of income or food.</p>
                                        <span>- Micky Mouse</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_carousel">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="single_testmonial d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/img/testmonial/author.png') }}" alt="">
                                        <div class="quote_icon">
                                            <i class="Flaticon flaticon-quote"></i>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <p>"Working in conjunction with humanitarian aid agencies, we have supported
                                            programmes to help alleviate human suffering through animal welfare when
                                            people might depend on livestock as their only source of income or food.</p>
                                        <span>- Micky Mouse</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /testimonial_area  -->
@endsection
@section('js')
@endsection