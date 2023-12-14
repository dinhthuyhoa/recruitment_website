@extends('frontend.master.master')


@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (Auth::check() && Auth::user()->id == $user->id)
<div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text ">
                        <h3 class="text-uppercase text-white">{{ __('profile.profile') }} {{ $user->name }}</h3>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--/ bradcam_area  -->
@endif
    <div class="container-fluid bootstrap snippe job_listing_area" >
        <div class="profile-area">
            <div class="row p-5">
                <div class="col-sm-4">
                    <div class="text-center">
                    @if (Auth::check() && Auth::user()->id == $user->id)
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar img-thumbnail"
                            alt="avatar" style="width:300px; height:300px !important; border-radius: 25%" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('avatar-default.png') }}" class="avatar img-thumbnail"
                            alt="avatar" style="width:300px; height:300px !important; border-radius: 25%" id="uploadedAvatar">
                    @endif


                            <h5 class="m-4 text-white">{{ __('profile.upload-a-different-photo') }}</h5>
                            <div class="button-wrapper d-flex justify-content-center align-items-center d-grid g-3">
                                <label for="upload" class="btn upload-button mx-2" tabindex="0">
                                    <span class="d-none d-sm-block text-white">{{ __('profile.upload-new-photo') }}</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                </label>

                                @if (Auth::check() && Auth::user()->id == $user->id && Auth::user()->role == 'candidate')
                                <div id="option-section" class="d-flex">
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-style" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ trans('profile.add_info') }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eduModal">
                                                <b>{{ trans('profile.education_modal_title') }}</b>
                                            </li>
                                            <hr class="dropdown-divider">
                                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#workModal">
                                                <b>{{ trans('profile.work_modal_title') }}</b>
                                            </li>
                                            <hr class="dropdown-divider">
                                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#volunModal">
                                                <b>{{ trans('profile.volun_modal_title') }}</b>
                                            </li>
                                            <hr class="dropdown-divider">
                                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#skillModal">
                                                <b>{{ trans('profile.skill_modal_title') }}</b>
                                            </li>
                                            <hr class="dropdown-divider">
                                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#hobbyModal">
                                                <b>{{ trans('profile.hobby_modal_title') }}</b>
                                            </li>
                                        </ul>
                                    </div>


                                    <div class="modal fade" id="eduModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.education_modal_title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>



                                                <form id="eduForm" action="{{ route('save.edu', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="schoolName"><b>{{ trans('profile.school_name') }}:</b></label>
                                                            <input type="text" class="form-control" id="schoolName" name="schoolName" value="{{ $educationInfo ? $educationInfo->school_name : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="schoolAdd"><b>{{ trans('profile.school_location') }}:</b></label>
                                                            <input type="text" class="form-control" id="schoolAdd" name="schoolAdd" value="{{ $educationInfo ? $educationInfo->school_location : '' }}">
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="startSchool"><b>{{ trans('profile.start_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="startSchool" name="startSchool" value="{{ $educationInfo ? $educationInfo->start_date : '' }}" >
                                                                <div id="error-message-start-date" class="text-danger"></div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="endSchool"><b>{{ trans('profile.end_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="endSchool" name="endSchool" value="{{ $educationInfo ? $educationInfo->end_date : '' }}">
                                                                <div id="error-message-end-date" class="text-danger"></div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="gpa"><b>{{ trans('profile.gpa') }}:</b></label>
                                                            <input type="text" class="form-control" id="gpa" name="gpa" value="{{ $educationInfo ? $educationInfo->gpa : '' }}">
                                                            <small id="err-gpa" class="text-danger"></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ttichEdu"><b>{{ trans('profile.achievements') }}:</b></label>
                                                            <textarea class="form-control" id="ttichEdu" name="ttichEdu" rows="8">{{ $educationInfo ? $educationInfo->achievements : '' }}</textarea>
                                                        </div>

                                                        <div class="dp-flex-juscenter mt-3">
                                                            <button type="submit" class="btn upload-button">
                                                                <span>{{ trans('profile.save_button') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
    <!-- workModal -->
                                    <div class="modal fade" id="workModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.work_modal_title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="workForm" action="{{ route('save.work', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="workPosition"><b>{{ trans('profile.work_position') }}:</b></label>
                                                            <input type="text" class="form-control" id="workPosition" name="workPosition" value="{{ $workInfo ? $workInfo->work_position : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="company"><b>{{ trans('profile.company') }}:</b></label>
                                                            <input type="text" class="form-control" id="company" name="company" value="{{ $workInfo ? $workInfo->company : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="workAdd"><b>{{ trans('profile.work_address') }}:</b></label>
                                                            <input type="text" class="form-control" id="workAdd" name="workAdd" value="{{ $workInfo ? $workInfo->work_address : '' }}">
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="startWork"><b>{{ trans('profile.start_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="startWork" name="startWork" value="{{ $workInfo ? $workInfo->start_date : '' }}">
                                                                <div id="error-work-start-date" class="text-danger"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="endWork"><b>{{ trans('profile.end_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="endWork" name="endWork" value="{{ $workInfo ? $workInfo->end_date : '' }}">
                                                                <div id="error-work-end-date" class="text-danger"></div>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ttichWork"><b>{{ trans('profile.achievements') }}:</b></label>
                                                            <textarea class="form-control" id="ttichWork" name="ttichWork" rows="8">{{ $workInfo ? $workInfo->achievements : '' }}</textarea>
                                                        </div>

                                                        <div class="dp-flex-juscenter mt-3">
                                                            <button type="submit" class="btn upload-button">
                                                                <span>{{ trans('profile.save_button') }}</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                <!-- volunModal -->
                                    <div class="modal fade" id="volunModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.volun_modal_title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="volunForm" action="{{ route('save.volun', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="volunPosition"><b>{{ trans('profile.volun_position') }}:</b></label>
                                                            <input type="text" class="form-control" id="volunPosition" name="volunPosition" value="{{ $volunInfo ? $volunInfo->position : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="volunEvent"><b>{{ trans('profile.organization_name') }}:</b></label>
                                                            <input type="text" class="form-control" id="volunEvent" name="volunEvent" value="{{ $volunInfo ? $volunInfo->organization_name : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="volunAdd"><b>{{ trans('profile.location') }}:</b></label>
                                                            <input type="text" class="form-control" id="volunAdd" name="volunAdd" value="{{ $volunInfo ? $volunInfo->location : '' }}">
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="startVolun"><b>{{ trans('profile.start_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="startVolun" name="startVolun" value="{{ $volunInfo ? $volunInfo->start_date : '' }}">
                                                                <div id="error-vol-start-date" class="text-danger"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="endVolun"><b>{{ trans('profile.end_date') }}:</b></label>
                                                                <input type="date" class="form-control" id="endVolun" name="endVolun" value="{{ $volunInfo ? $volunInfo->end_date : '' }}">
                                                                <div id="error-vol-end-date" class="text-danger"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ttichVolun"><b>{{ trans('profile.achievements') }}:</b></label>
                                                            <textarea class="form-control" id="ttichVolun" name="ttichVolun" rows="8">{{ $volunInfo ? $volunInfo->achievements : '' }}</textarea>

                                                        </div>

                                                        <div class="dp-flex-juscenter mt-3">
                                                            <button type="submit" class="btn upload-button">
                                                                <span>{{ trans('profile.save_button') }}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                                    <!-- skillModal -->
                                    <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.skill_modal_title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="skillForm" action="{{ route('save.skill', $user->id) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="skillName"><b>{{ trans('profile.skill_name') }}:</b></label>
                                                            <input type="text" class="form-control" id="skillName" name="skillName" value="{{ $skillInfo ? $skillInfo->name : '' }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="levelSkill"><b>{{ trans('profile.level') }}:</b></label>
                                                            <select id="levelSkill" name="levelSkill" class="select2 form-select" style="font-size: 14px;">
                                                                <option value="Average" {{ $skillInfo && $skillInfo->description == 'Average' ? 'selected' : '' }}>{{ trans('profile.average') }}</option>
                                                                <option value="Good" {{ $skillInfo && $skillInfo->description == 'Good' ? 'selected' : '' }}>{{ trans('profile.good') }}</option>
                                                                <option value="Excellent" {{ $skillInfo && $skillInfo->description == 'Excellent' ? 'selected' : '' }}>{{ trans('profile.excellent') }}</option>
                                                                <option value="Masterful" {{ $skillInfo && $skillInfo->description == 'Masterful' ? 'selected' : '' }}>{{ trans('profile.masterful') }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="dp-flex-juscenter mt-3">
                                                            <button type="submit" class="btn upload-button">
                                                                <span>{{ trans('profile.save_button') }}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                    <!-- hobbyModal -->
                                    <div class="modal fade" id="hobbyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('profile.hobby_modal_title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="hobbyForm" action="{{ route('save.hobby', $user->id) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="hobbyName"><b>{{ trans('profile.hobby_name') }}:</b></label>
                                                            <textarea class="form-control" id="hobbyName" name="hobbyName" rows="8">{{ $hobbyInfo ? $hobbyInfo->name : '' }}</textarea>

                                                        </div>

                                                        <div class="dp-flex-juscenter mt-3">
                                                            <button type="submit" class="btn upload-button">
                                                                <span>{{ trans('profile.save_button') }}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                    @endif
                    </div>
            </div>

                <!--/col-3-->
                @if (Auth::check() && Auth::user()->id == $user->id)
                    <div class="col-sm-7 info-user mb-5">
                        <ul class="nav nav-tabs ">
                            <li class="active fs-3 fw-bold"><a data-toggle="tab" href="#home">{{ __('profile.profile') }}</a></li>
                            @if (Auth::check() && Auth::user()->id == $user->id && Auth::user()->role == 'candidate')
                                <li class="fs-3 fw-bold"><a data-toggle="tab" href="#post-favorite">{{ __('profile.post-favorite') }}</a></li>
                                <li class="fs-3 fw-bold"><a data-toggle="tab" href="#apply">{{ __('profile.apply') }}</a></li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">

                                <div class="my-5">
                                    <form id="form-update-profile" method="POST" action="{{ route('profile.update', $user) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="upload"
                                            class="account-file-input text-center center-block file-upload" hidden
                                            accept="image/png, image/jpeg" name="avatar" />
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="phone" class="form-label fw-bold text-black">{{ __('profile.phone') }}</label>
                                                <input class="form-control" type="text" name="phone" id="phone"
                                                    value="{{ $user->phone }}" readonly />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label fw-bold text-black">{{ __('profile.email') }}</label>
                                                <input class="form-control" readonly type="text" id="email"
                                                    name="email" value="{{ $user->email }}" placeholder="{{ __('profile.email') }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="fullname" class="form-label fw-bold text-black">{{ __('profile.fullname') }}</label>
                                                <input class="form-control" type="text" id="fullname" name="name"
                                                    value="{{ $user->name }}" autofocus />
                                            </div>
                                            @if(Auth::user()->role != 'recruiter')
                                            <div class="mb-3 col-md-6">
                                                <label for="gender" class="form-label fw-bold text-black">{{ __('profile.gender') }}</label>
                                                <select id="gender" name="gender" class="select2 form-select" style="padding: 3% 0 3% 2%; font-size:14px">
                                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>{{ __('profile.male') }}
                                                    </option>
                                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                        {{ __('profile.female') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="birthday" class="form-label fw-bold text-black">{{ __('profile.birthday') }}</label>
                                                <input class="form-control" type="date" id="birthday" name="birthday"
                                                    placeholder="dd/mm/yyyy"
                                                    value={{ date('Y-m-d', strtotime($user->birthday)) }} />
                                            </div>
                                            @endif
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label fw-bold text-black">{{ __('profile.address') }}</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ $user->address }}" placeholder="{{ __('profile.address') }}" />
                                            </div>
                                            
                                        </div>
                                        <div class="mt-2 d-flex justify-content-end align-items-center d-grid gap-3">
                                            <button type="submit" form="form-update-profile"
                                                class="btn upload-button mx-2">{{ __('profile.save-changes') }}</button>
                                            <button type="reset" class="btn btn-secondary">{{ __('profile.reset') }}</button>
                                        </div>
                                    </form>
                                </div>
                               

                            </div>
                    
                            @if (Auth::check() && Auth::user()->id == $user->id )
                                <!--/tab-pane-->
                                <div class="tab-pane" id="post-favorite">
                                    <div class=" plus_padding">
                                        <div class="container" style="width: 100% !important;">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <div class="job_lists m-0">
                                                        <div class="row mt-4" id="paginated-list" data-current-page="1"
                                                            aria-live="polite">
                                                            @if (count($posts) > 0)
                                                            @foreach ($postMetas as $postMeta)
                                                            <li class="col-lg-12 col-md-12 item_list_jobs">
                                                                <div class="single_jobs white-bg d-flex justify-content-between" style="height: 100px;">
                                                                    <div class="jobs_left d-flex align-items-center col-8">
                                                                        <div class="thumb">
                                                                            <img src="{{ asset('storage/' . $postMeta['post']->post_image) }}" alt="">
                                                                        </div>
                                                                        <div class="jobs_conetent">
                                                                            <a href="{{ route('posts.recruitment.details', $postMeta['post']->id) }}">
                                                                                <h4 class="job-title-item" style="font-size: 18px;">
                                                                                    {{ $postMeta['post']->post_title }}
                                                                                </h4>
                                                                            </a>
                                                                            <div class="date">
                                                                                <p>Deadline:
                                                                                    {{ $postMeta['meta']['recruitment_deadline'] ? date('H:i d/m/Y', strtotime($postMeta['meta']['recruitment_deadline'])) : 'None' }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="jobs_right">
                                                                        <div class="apply_now">
                                                                            @if (Auth::check())
                                                                                <a class="heart_mark"
                                                                                    href="javascript:void(0);"
                                                                                    onclick="change_favorite({{ $postMeta['post']->id }},{{ Auth::user()->id }}, this)">
                                                                                    @if (Auth::user()->is_post_favorite($postMeta['post']->id))
                                                                                        <i class="fa fa-heart"></i>
                                                                                    @else
                                                                                        <i class="ti-heart"></i>
                                                                                    @endif
                                                                                </a>
                                                                            @endif
                                                                            <a href="{{ route('posts.recruitment.details', $postMeta['post']->id) }}/#apply_job"
                                                                                class="boxed-btn3">Apply Now</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach

                                                            @else
                                                                <h3>Not found post</h3>
                                                            @endif

                                                        </div>

                                                        @if (count($posts) > 5)
                                                            <nav class="pagination-container">
                                                                <button class="pagination-button" id="prev-button"
                                                                    aria-label="Previous page" title="Previous page">
                                                                    &lt;
                                                                </button>

                                                                <div id="pagination-numbers">

                                                                </div>

                                                                <button class="pagination-button" id="next-button"
                                                                    aria-label="Next page" title="Next page">
                                                                    &gt;
                                                                </button>
                                                            </nav>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::check() && Auth::user()->id == $user->id )
                                <!--/tab-pane-->
                                <div class="tab-pane" id="apply">
                                    <div class=" plus_padding">
                                        <div class="container" style="width: 100% !important;">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <div class="job_lists m-0">
                                                        <div class="row mt-4" id="paginated-list" data-current-page="1"
                                                            aria-live="polite">
                                                            @if (count($posts) > 0)
                                                            @foreach($appliedPosts as $appliedPost)
                                                                <li class="col-lg-12 col-md-12 item_list_jobs">
                                                                    <div class="single_jobs white-bg d-flex justify-content-between" style="height: 100px;">
                                                                        <div class="jobs_left d-flex align-items-center col-8">
                                                                            <div class="thumb">
                                                                                <img src="{{ asset('storage/' . $appliedPost->post_image) }}" alt="">
                                                                            </div>
                                                                            <div class="jobs_conetent">
                                                                                <a href="{{ route('posts.recruitment.details', $appliedPost->id) }}">
                                                                                    <h4 class="job-title-item" style="font-size: 18px;">
                                                                                        {{ $appliedPost->post_title }}
                                                                                    </h4>
                                                                                </a>
                                                                                <div class="date">
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="jobs_right">
                                                                            <div class="apply_now">
                                                                                @if (Auth::check())
                                                                                    <a class="heart_mark"
                                                                                        href="javascript:void(0);"
                                                                                        onclick="change_favorite({{ $appliedPost->id }},{{ Auth::user()->id }}, this)">
                                                                                        @if (Auth::user()->is_post_favorite($appliedPost->id))
                                                                                            <i class="fa fa-heart"></i>
                                                                                        @else
                                                                                            <i class="ti-heart"></i>
                                                                                        @endif
                                                                                    </a>
                                                                                @endif
                                                                                <a href="{{ route('posts.recruitment.details', $appliedPost->id) }}/#apply_job"
                                                                                    class="boxed-btn3">Apply Now</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach


                                                            @else
                                                                <h3>Not found post</h3>
                                                            @endif

                                                        </div>

                                                        @if (count($posts) > 5)
                                                            <nav class="pagination-container">
                                                                <button class="pagination-button" id="prev-button"
                                                                    aria-label="Previous page" title="Previous page">
                                                                    &lt;
                                                                </button>

                                                                <div id="pagination-numbers">

                                                                </div>

                                                                <button class="pagination-button" id="next-button"
                                                                    aria-label="Next page" title="Next page">
                                                                    &gt;
                                                                </button>
                                                            </nav>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--/tab-pane-->
                    </div>
                                
                    @else
                    <section class="bg-light mt-5 container">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div class="card card-style1 border-0">
                                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                            <div class="row align-items-center">
                                                <div class="col-lg-5 mb-4 mb-lg-0 d-flex justify-content-center">
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar img-thumbnail"  alt="avatar" style="width:300px; height:300px !important; border-radius: 25%" >
                                                    <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="..."> -->
                                                </div>
                                                <div class="col-lg-7 px-xl-10">
                                                    <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded w-100">
                                                        <h3 class="h2 text-white mb-0">{{ __('profile.profile') }} {{ $user->name }}</h3>
                                                    </div>
                                                    <ul class="list-unstyled mb-1-9">
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">{{ __('profile.birthday') }}:</span> {{ date('d/m/Y', strtotime($user->birthday)) }}</li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">{{ __('profile.email') }}:</span> {{ $user->email }}</li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">{{ __('profile.phone') }}:</span> {{ $user->phone }}</li>
                                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">{{ __('profile.address') }}:</span> {{ $user->address }}</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">{{ trans('profile.education_modal_title') }}</span>
                                        @if($educationInfo)
                                            <ul class="list-unstyled mb-1-9">
                                                @foreach ([
                                                    'school_name' => trans('profile.school_name'),
                                                    'school_location' => trans('profile.school_location'),
                                                    'start_date' => trans('profile.start_date'),
                                                    'end_date' => trans('profile.end_date'),
                                                    'gpa' => trans('profile.gpa'),
                                                    'achievements' => trans('profile.achievements'),
                                                ] as $field => $label)
                                                    <li class="mb-2 mb-xl-3 display-28">
                                                        <span class="display-26 text-secondary me-2 font-weight-600">{{ $label }}:</span>
                                                        {{ $educationInfo->$field ? ($field === 'start_date' || $field === 'end_date' ? date('d/m/Y', strtotime($educationInfo->$field)) : $educationInfo->$field) : trans('profile.updating') }}
                                                    </li>
                                                @endforeach
                                            </ul>

                                        @else
                                        <ul class="list-unstyled mb-1-9">
                                            <li class="mb-2 mb-xl-3 display-28">
                                                <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.updating') }}</span>
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">{{trans('profile.work_modal_title')}}</span>
                                        @if($workInfo)
                                        <ul class="list-unstyled mb-1-9">
                                            @foreach (['work_position', 'company', 'work_address', 'start_date', 'end_date', 'achievements'] as $field)
                                                <li class="mb-2 mb-xl-3 display-28">
                                                    <span class="display-26 text-secondary me-2 font-weight-600">{{ trans("profile.$field") }}:</span>
                                                    {{ $workInfo->$field ? ($field === 'start_date' || $field === 'end_date' ? date('d/m/Y', strtotime($workInfo->$field)) : $workInfo->$field) : trans('profile.updating') }}
                                                    
                                                </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <ul class="list-unstyled mb-1-9">
                                            <li class="mb-2 mb-xl-3 display-28">
                                                <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.updating') }}</span>
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">{{trans('profile.volun_modal_title')}}</span>
                                        
                                        @if($volunInfo)
                                            <ul class="list-unstyled mb-1-9">
                                                @foreach (['volun_position', 'organization_name', 'location', 'start_date', 'end_date', 'achievements'] as $field)
                                                    <li class="mb-2 mb-xl-3 display-28">
                                                        <span class="display-26 text-secondary me-2 font-weight-600">{{ trans("profile.$field") }}:</span>
                                                        {{ $volunInfo->$field ? ($field === 'start_date' || $field === 'end_date' ? date('d/m/Y', strtotime($volunInfo->$field)) : $volunInfo->$field) : trans('profile.updating') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <ul class="list-unstyled mb-1-9">
                                                <li class="mb-2 mb-xl-3 display-28">
                                                    <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.updating') }}</span>
                                                </li>
                                            </ul>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">{{trans('profile.skill_modal_title')}}</span>
                                        <!-- Kỹ năng -->
                                        @if($skillInfo)
                                            <ul class="list-unstyled mb-1-9">
                                                @foreach (['name', 'description'] as $field)
                                                    <li class="mb-2 mb-xl-3 display-28">
                                                        <span class="display-26 text-secondary me-2 font-weight-600">{{ trans("profile.skill_$field") }}:</span>
                                                        {{ $skillInfo->$field ?? trans('profile.updating') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <ul class="list-unstyled mb-1-9">
                                                <li class="mb-2 mb-xl-3 display-28">
                                                    <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.updating') }}</span>
                                                </li>
                                            </ul>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">{{trans('profile.hobby_modal_title')}}</span>
                                        @if($hobbyInfo)
                                            <ul class="list-unstyled mb-1-9">

                                                <li class="mb-2 mb-xl-3 display-28">
                                                    <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.hobby_name') }}:</span>
                                                    {{ $hobbyInfo->name ?? trans('profile.updating')}}
                                                </li>
                                            
                                            </ul>
                                            @else
                                            <ul class="list-unstyled mb-1-9">
                                                <li class="mb-2 mb-xl-3 display-28">
                                                    <span class="display-26 text-secondary me-2 font-weight-600">{{ trans('profile.updating') }}</span>
                                                    
                                                </li>
                                            </ul>
                                                
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                  @endif
                <!--/tab-content-->
                </div>
            <!--/col-9-->
            </div>
        </div>
    </div>           
</div>
<!--/tab-content-->


    

@endsection
@section('css')    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    /* profile */
    
.header-cv {
  background-color: #FFC800;
}

.profile-edit {
  position: absolute;
  right: 10px;
  top: 10px;
}

.section-cv {
  position: relative;
  margin: 10px 0px;
  border-radius: 5px;
  background-color: rgb(246, 246, 246);
  padding: 10px;
}

.section-cv h4 {
  display: flex;
  align-items: center;
  font-size: 20px;
  font-weight: 700;
}

.icon-section {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  background-color: #0c2d50;
  color: #fff;
  font-size: 15px;
  margin-right: 20px;
}

.address-date {
  font-size: 13px;
  font-weight: 700;
  opacity: .4;
  margin-top: -5px;
}

.info-element {
  position: relative;
  left: 20px;
  margin-right: 20px;
  line-height: 1;
}

#profile-section .img-profile {
  display: inline-block;
  vertical-align: middle;
  width: 170px;
  height: 170px;
  font-family: Helvetica, Arial, sans-serif;
  margin-top: 12px;
}

#profile-section .img-profile img {
  max-width: 100%;
  width: 170px;
  height: 170px;
}

#profile-section p {
  margin: 5px 0px;
}

#profile-section i {
  margin-right: 10px;
}

/* SAVE----------------------------------------- */
#main-save {
  width: 100%;
}

#main-save table {
  width: 1024px;
  border: 1px solid #ccc;
  margin: 0 auto;
}

.modal-title {
    font-weight: bold;
}
.dropdown-style {
  background-color: #030d4e;
  border: 1px solid #030d4e;
}

.dropdown-style:active, .dropdown-style:hover, .dropdown-style:focus {
  background-color: #20285A !important;
  border: 1px solid #20285A !important;
  color: #fff;
}

.dropdown-menu {
  z-index: 1;
}

b {
  color: #030d4e;
  text-align: left;
}

a {
  color: #030d4e;
}

a:hover {
  text-decoration: none;    
}

.form-group {
  text-align: start;
}
.modal {
  /* z-index: 2; */
}

.modal-header {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1rem;
  border-bottom: 1px solid #dee2e6;
  border-top-left-radius: calc(.3rem - 1px);
  border-top-right-radius: calc(.3rem - 1px);
}

.modal-content {
  margin-top: 15%;
}

.upload-button {
  background-color: #c07f00;
  border: 1px solid #c07f00;
  color: #fff;
}

.upload-button:hover {
  background-color: #5D4007;
  border: 1px solid #c07f00;
  color: #fff;

}

.upload-button:focus, .upload-button:active {
  outline: none !important;
  background-color: #705A2D;
  border: 1px solid #705A2D;
  color: #fff;

}

.info-user {
  background-color: floralwhite;
  /* border-radius: 10%; */
  border: 1px solid #c07f00;
}

.nav-tabs {
  margin-top: 5%;
}

.mt-custom {
  margin-top: 10%;
}

.profile-area .form-control, .profile-area select {
  height: 50px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
}

section {
    padding: 120px 0;
    overflow: hidden;
    background: #fff;
}
.mb-2-3, .my-2-3 {
    margin-bottom: 2.3rem;
}

.section-title {
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}
.text-primary {
    color: #ceaa4d !important;
}
.text-secondary {
    color: #15395A !important;
}
.font-weight-600 {
    font-weight: 600;
}
.display-26 {
    font-size: 1.3rem;
}

@media screen and (min-width: 992px){
    .p-lg-7 {
        padding: 4rem;
    }
}
@media screen and (min-width: 768px){
    .p-md-6 {
        padding: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .p-sm-2-3 {
        padding: 2.3rem;
    }
}
.p-1-9 {
    padding: 1.9rem;
}

.bg-secondary {
    background: #15395A !important;
}
@media screen and (min-width: 576px){
    .pe-sm-6, .px-sm-6 {
        padding-right: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .ps-sm-6, .px-sm-6 {
        padding-left: 3.5rem;
    }
}
.pe-1-9, .px-1-9 {
    padding-right: 1.9rem;
}
.ps-1-9, .px-1-9 {
    padding-left: 1.9rem;
}
.pb-1-9, .py-1-9 {
    padding-bottom: 1.9rem;
}
.pt-1-9, .py-1-9 {
    padding-top: 1.9rem;
}
.mb-1-9, .my-1-9 {
    margin-bottom: 1.9rem;
}
@media (min-width: 992px){
    .d-lg-inline-block {
        display: inline-block!important;
    }
}
.rounded {
    border-radius: 0.25rem!important;
}
</style>
@endsection

@section('js')
<script>
    document.getElementById('eduForm').addEventListener('submit', function(event) {
        var startSchool = document.getElementById('startSchool').value;
        var endSchool = document.getElementById('endSchool').value;
        var currentDate = new Date().toISOString().split('T')[0];
        var errorMessageStartElement = document.getElementById('error-message-start-date');
        var errorMessageEndElement = document.getElementById('error-message-end-date');
        
        errorMessageStartElement.style.display = 'none';
        errorMessageEndElement.style.display = 'none';

        
        if (startSchool > currentDate) {
            errorMessageStartElement.textContent = 'Ngày bắt đầu không thể lớn hơn ngày hiện tại.';
            errorMessageStartElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        
        if (endSchool && endSchool <= startSchool) {
            errorMessageEndElement.textContent = 'Ngày kết thúc phải lớn hơn ngày bắt đầu.';
            errorMessageEndElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        var gpa = document.getElementById('gpa').value;

        if (parseFloat(gpa) < 0) {
            document.getElementById('err-gpa').innerText = 'GPA không được âm';
            event.preventDefault(); 
        } else {
            document.getElementById('err-gpa').innerText = ''; 
        }

        return true;
    });

    document.getElementById('workForm').addEventListener('submit', function(event) {
        var startWork = document.getElementById('startWork').value;
        var endWork = document.getElementById('endWork').value;
        var currentDate = new Date().toISOString().split('T')[0];
        var errorVolStartElement = document.getElementById('error-work-start-date');
        var errorVolEndElement = document.getElementById('error-work-end-date');
        
        errorVolStartElement.style.display = 'none';
        errorVolEndElement.style.display = 'none';

        
        if (startWork > currentDate) {
            errorVolStartElement.textContent = 'Ngày bắt đầu không thể lớn hơn ngày hiện tại.';
            errorVolStartElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        
        if (endWork && endWork <= startWork) {
            errorVolEndElement.textContent = 'Ngày kết thúc phải lớn hơn ngày bắt đầu.';
            errorVolEndElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        return true;
    });

    document.getElementById('volunForm').addEventListener('submit', function(event) {
        var startVolun = document.getElementById('startVolun').value;
        var endVolun = document.getElementById('endVolun').value;
        var currentDate = new Date().toISOString().split('T')[0];
        var errorVolStartElement = document.getElementById('error-vol-start-date');
        var errorVolEndElement = document.getElementById('error-vol-end-date');
        
        errorVolStartElement.style.display = 'none';
        errorVolEndElement.style.display = 'none';

        
        if (startVolun > currentDate) {
            errorVolStartElement.textContent = 'Ngày bắt đầu không thể lớn hơn ngày hiện tại.';
            errorVolStartElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        
        if (endVolun && endVolun <= startVolun) {
            errorVolEndElement.textContent = 'Ngày kết thúc phải lớn hơn ngày bắt đầu.';
            errorVolEndElement.style.display = 'block';
            event.preventDefault(); 
            return false;
        }

        return true;
    });
</script>

<script>
    document.getElementById('upload').addEventListener('change', function (e) {
        // Get the selected file
        var file = e.target.files[0];

        // Validate if a file is selected
        if (file) {
            // Create a FileReader to read the file
            var reader = new FileReader();

            // Set a callback function to execute when the file is loaded
            reader.onload = function (e) {
                // Update the src attribute of the image to display the selected image
                document.getElementById('uploadedAvatar').src = e.target.result;
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
   
@endsection
