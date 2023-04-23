@extends('frontend.master.master')

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $post->post_title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{ asset('storage/' . $post->recruitment_image) }}" alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $post->post_title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $post->recruitment_address }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $post->recruitment_job_nature }}</p>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        {!! $post->post_content !!}
                    </div>
                    <div id="apply_job">
                        <div class="apply_job_form white-bg">
                            <h4>Apply for the job</h4>
                            <form action="{{ route('job_apply.apply') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input_field">
                                            <input type="text" placeholder="Your name" name="fullname"
                                                value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input_field">
                                            <select name="gender" id="gender" class="w-100" style="height: 60px;"
                                                required>
                                                <option value="Male"
                                                    {{ Auth::check() && Auth::user()->gender == 'Male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="Female"
                                                    {{ Auth::check() && Auth::user()->gender == 'Female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input_field">
                                            <input type="text" placeholder="Email" name="email"
                                                value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input_field">
                                            <input type="text" placeholder="Phone" name="phone"
                                                value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <input type="text" placeholder="Your address" name="address"
                                                value="{{ Auth::check() ? Auth::user()->address : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <input type="date" placeholder="Your address" name="birthday"
                                                value="{{ Auth::check() ? date('Y-m-d', strtotime(Auth::user()->birthday)) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="inputGroupFileAddon03"><i
                                                        class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile03"
                                                    aria-describedby="inputGroupFileAddon03" name="attachment"
                                                    accept=".pdf,.doc,.docx,image/*">
                                                <label class="custom-file-label" for="inputGroupFile03">Upload CV</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <textarea name="candidate_note" id="candidate_note" cols="30" rows="10" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="submit_btn">
                                            <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on: <span>{{ $post->post_date }}</span></li>
                                <li>Updated on: <span>{{ $post->post_date_update }}</span></li>
                                <li>Vacancy: <span>{{ $post->recruitment_vacancy }} Position</span></li>
                                <li>Salary: <span>{{ $post->recruitment_salary }}</span></li>
                                <li>Location: <span>{{ $post->recruitment_address }}</span></li>
                                <li>Job Nature: <span>{{ $post->recruitment_job_nature }}</span></li>
                                <li>Exprience: <span>{{ $post->recruitment_experience }}</span></li>
                                <li>Deadline: <span>{{ date('H:i d/m/Y', strtotime($post->recruitment_deadline)) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex flex-column tags_list">
                        <span>Tag:</span>
                        <ul class="py-3">
                            @if (count($post->tags) > 0)
                                @foreach ($post->tags as $tag)
                                    <li><a href="#"> {{ $tag->tag_name }}</a> </li>
                                @endforeach
                            @else
                                <li>No tags.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
