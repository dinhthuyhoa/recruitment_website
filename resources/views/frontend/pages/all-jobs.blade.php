@extends('frontend.master.master')

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ count($posts)-1 }}+ Jobs Available</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filter</h3>
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Location">Location</option>
                                                <option value="1">Rangpur</option>
                                                <option value="2">Dhaka </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Category">Category</option>
                                                <option value="1">Category 1</option>
                                                <option value="2">Category 2 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Experience">Experience</option>
                                                <option value="1">Experience 1</option>
                                                <option value="2">Experience 2 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Job type">Job type</option>
                                                <option value="1">full time 1</option>
                                                <option value="2">part time 2 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Qualification">Qualification</option>
                                                <option value="1">Qualification 1</option>
                                                <option value="2">Qualification 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide">
                                                <option data-display="Gender">Gender</option>
                                                <option value="1">male</option>
                                                <option value="2">female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="range_wrap">
                            <label for="amount">Price range:</label>
                            <div id="slider-range"></div>
                            <p>
                                <input type="text" id="amount" readonly
                                    style="border:0; color:#7A838B; font-size: 14px; font-weight:400;">
                            </p>
                        </div>
                        <div class="reset_btn">
                            <button class="boxed-btn3 w-100" type="submit">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Job Listing</h4>
                                </div>

                                <div class="col-md-6">
                                    <div class="serch_cat d-flex justify-content-end">
                                        <div class="single_field">
                                            <input type="text" placeholder="Search keyword">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="single_jobs white-bg d-flex justify-content-between">
                                            <div class="jobs_left d-flex align-items-center col-8">
                                                <div class="thumb">
                                                    <img src="{{ asset('storage/' . $post->recruitment_image) }}"
                                                        alt="">
                                                </div>
                                                <div class="jobs_conetent">
                                                    <a href="{{ route('posts.recruitment.details', $post->id) }}">
                                                        <h4>{{ $post->post_title }}</h4>
                                                    </a>
                                                    <div class="links_locat d-flex align-items-center" style="gap: 28px;">
                                                        <div class="location">
                                                            <p class="address"> <i class="fa fa-map-marker"></i>
                                                                {{ $post->recruitment_address }}</p>
                                                        </div>
                                                        <div class="location">
                                                            <p> <i class="fa fa-clock-o"></i>
                                                                {{ $post->recruitment_job_nature }}</p>
                                                        </div>
                                                        <div class="location">
                                                            <p> <i class="fa fa-eye"></i> {{ $post->post_view }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jobs_right">
                                                <div class="apply_now">
                                                    @if (Auth::check())
                                                        <a class="heart_mark" href="javascript:void(0);"
                                                            onclick="change_favotire({{ $post->id }},{{ Auth::user()->id }}, this)">
                                                            @if (Auth::user()->is_post_favorite($post->id))
                                                                <i class="fa fa-heart"></i>
                                                            @else
                                                                <i class="ti-heart"></i>
                                                            @endif
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('posts.recruitment.details', $post->id) }}/#apply_job"
                                                        class="boxed-btn3">Apply Now</a>
                                                </div>
                                                <div class="date">
                                                    <p>Deadline:
                                                        {{ $post->recruitment_deadline ? date('H:i d/m/Y', strtotime($post->recruitment_deadline)) : 'None' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h3>Not found post</h3>
                            @endif

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination_wrap">
                                    <ul>
                                        <li><a href="#"> <i class="ti-angle-left"></i> </a></li>
                                        <li><a href="#"><span>01</span></a></li>
                                        <li><a href="#"><span>02</span></a></li>
                                        <li><a href="#"> <i class="ti-angle-right"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->
@endsection
