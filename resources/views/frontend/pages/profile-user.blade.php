@extends('frontend.master.master')

@section('css')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag --------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        
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
        border-radius: 10%;
        border: 1px solid #c07f00;
    }

    .nav-tabs {
        margin-top: 5%;
    }

    .mt-custom {
        margin-top: 10%;
    }
    </style>
@endsection

@section('content')
<div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text ">
                        <h3 class="text-uppercase text-dark">{{ __('profile.profile') }}</h3>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--/ bradcam_area  -->

    <div class="container bootstrap snippet" >
        <div class="row py-5">
            <div class="col-sm-10">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!--left col-->

                <div class="text-center">
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar img-thumbnail"
                        alt="avatar" style="width:200px; height:200px !important; border-radius: 25%" id="uploadedAvatar">
                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <h6>{{ __('profile.upload-a-different-photo') }}</h6>
                        <div class="button-wrapper d-flex justify-content-center align-items-center d-grid g-3">
                            <label for="upload" class="btn upload-button mx-2" tabindex="0">
                                <span class="d-none d-sm-block text-white">{{ __('profile.upload-new-photo') }}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                            </label>
                            <div id="option-section" class="d-flex">
                            
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-style" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Thêm thông tin
                        </button>
                        <ul class="dropdown-menu">

                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eduModal">
                                <b>Học vấn</b>
                            </li>
                            <hr class="dropdown-divider">

                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#workModal">
                                <b>Kinh nghiệm làm việc</b>
                            </li>

                            <hr class="dropdown-divider">

                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#volunModal">
                                <b>Tình nguyện & Hoạt động cộng đồng</b>
                            </li>

                            <hr class="dropdown-divider">

                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#skillModal">
                                <b>Kỹ năng</b>
                            </li>

                            <hr class="dropdown-divider">

                            <li class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#hobbyModal">
                                <b>Sở thích</b>
                            </li>
                        </ul>
                    </div>

                    <div class="modal fade" id="eduModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg mt-custom">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="exampleModalLabel">Học vấn</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                
                                    @if (session()->has('successMessageEduUpdate'))
                                        <div class="alert alert-success">{{ session('successMessageEduUpdate') }}</div>
                                    @endif
                                    @if (session()->has('successMessageEduCreate'))
                                        <div class="alert alert-success">{{ session('successMessageEduCreate') }}</div>
                                    @endif

                                    <form id="eduForm" action="{{ route('save.edu', $user->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="schoolName"><b>Tên trường (Cấp 3, đại học, ...):</b></label>
                                                <input type="text" class="form-control" id="schoolName" name="schoolName" value="{{ $educationInfo ? $educationInfo->school_name : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="schoolAdd"><b>Địa điểm:</b></label>
                                                <input type="text" class="form-control" id="schoolAdd" name="schoolAdd" value="{{ $educationInfo ? $educationInfo->school_location : '' }}">
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="startSchool"><b>Từ:</b></label>
                                                    <input type="date" class="form-control" id="startSchool" name="startSchool" value="{{ $educationInfo ? $educationInfo->start_date : '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="endSchool"><b>Đến:</b></label>
                                                    <input type="date" class="form-control" id="endSchool" name="endSchool" value="{{ $educationInfo ? $educationInfo->end_date : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="gpa"><b>GPA:</b></label>
                                                <input type="text" class="form-control" id="gpa" name="gpa" value="{{ $educationInfo ? $educationInfo->gpa : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="ttichEdu"><b>Thành tích:</b></label>
                                                <input type="text" class="form-control" id="ttichEdu" name="ttichEdu" value="{{ $educationInfo ? $educationInfo->achievements : '' }}">
                                            </div>

                                            <div class="dp-flex-juscenter mt-3">
                                                <button type="submit" class="btn upload-button">
                                                    <span>Lưu</span>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Kinh nghiệm làm việc</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                    <form id="workForm" action="{{ route('save.work', $user->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="workPosition"><b>Vị trí/ Chuyên môn:</b></label>
                                                <input type="text" class="form-control" id="workPosition" name="workPosition" value="{{ $workInfo ? $workInfo->work_position : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="company"><b>Công ty/ Tổ chức:</b></label>
                                                <input type="text" class="form-control" id="company" name="company" value="{{ $workInfo ? $workInfo->company : '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="workAdd"><b>Địa điểm:</b></label>
                                                <input type="text" class="form-control" id="workAdd" name="workAdd" value="{{ $workInfo ? $workInfo->work_address : '' }}">
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="startWork"><b>Từ:</b></label>
                                                    <input type="date" class="form-control" id="startWork" name="startWork" value="{{ $workInfo ? $workInfo->start_date : '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="endWork"><b>Đến:</b></label>
                                                    <input type="date" class="form-control" id="endWork" name="endWork" value="{{ $workInfo ? $workInfo->end_date : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="ttichWork"><b>Thành tích:</b></label>
                                                <input type="text" class="form-control" id="ttichWork" name="ttichWork" value="{{ $workInfo ? $workInfo->achievements : '' }}">
                                            </div>

                                            <div class="dp-flex-juscenter mt-3">
                                                <button type="submit" class="btn upload-button">
                                                    <span>Lưu</span>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Hoạt động tình nguyện</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="volunForm" action="{{ route('save.volun', $user->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="volunPosition"><b>Vị trí/ Vai trò:</b></label>
                                            <input type="text" class="form-control" id="volunPosition" name="volunPosition" value="{{ $volunInfo ? $volunInfo->position : '' }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="volunEvent"><b>Tên tổ chức/ Sự kiện:</b></label>
                                            <input type="text" class="form-control" id="volunEvent" name="volunEvent" value="{{ $volunInfo ? $volunInfo->organization_name : '' }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="volunAdd"><b>Địa điểm:</b></label>
                                            <input type="text" class="form-control" id="volunAdd" name="volunAdd" value="{{ $volunInfo ? $volunInfo->location : '' }}">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="startVolun"><b>Từ:</b></label>
                                                <input type="date" class="form-control" id="startVolun" name="startVolun" value="{{ $volunInfo ? $volunInfo->start_date : '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="endVolun"><b>Đến:</b></label>
                                                <input type="date" class="form-control" id="endVolun" name="endVolun" value="{{ $volunInfo ? $volunInfo->end_date : '' }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ttichVolun"><b>Thành tích:</b></label>
                                            <input type="text" class="form-control" id="ttichVolun" name="ttichVolun" value="{{ $volunInfo ? $volunInfo->achievements : '' }}">
                                        </div>

                                        <div class="dp-flex-juscenter mt-3">
                                            <button type="submit" class="btn upload-button">
                                                <span>Lưu</span>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Kỹ năng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="skillForm" action="{{ route('save.skill', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="skillName"><b>Tên kỹ năng:</b></label>
                                            <input type="text" class="form-control" id="skillName" name="skillName" value="{{ $skillInfo ? $skillInfo->name : '' }}">
                                        </div>

                                            <div class="form-group">
                                                <label for="skillName"><b>Level:</b></label>
                                                <select id="levelSkill" name="levelSkill"class="select2 form-select" style="font-size: 14px;">
                                                    <option value="Average" {{ $skillInfo && $skillInfo->description == 'Average' ? 'selected' : '' }}>Trung bình</option>
                                                    <option value="Good" {{ $skillInfo && $skillInfo->description == 'Good' ? 'selected' : '' }}>Khá</option>
                                                    <option value="Excellent" {{ $skillInfo && $skillInfo->description == 'Excellent' ? 'selected' : '' }}>Giỏi</option>
                                                    <option value="Masterful" {{ $skillInfo && $skillInfo->description == 'Masterful' ? 'selected' : '' }}>Thành thạo</option>
                                                </select>
                                            </div>



                                        <div class="dp-flex-juscenter mt-3">
                                            <button type="submit" class="btn upload-button">
                                                <span>Lưu</span>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Sở thích</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="hobbyForm" action="{{ route('save.hobby', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="hobbyName"><b>Sở thích:</b></label>
                                            <input type="text" class="form-control" id="hobbyName" name="hobbyName" value="{{ $hobbyInfo ? $hobbyInfo->name : '' }}">
                                        </div>

                                        <div class="dp-flex-juscenter mt-3">
                                            <button type="submit" class="btn upload-button">
                                                <span>Lưu</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
                        </div>
                    @endif
                </div>


            <!--/col-3-->
            <div class="col-sm-8 info-user mb-5">
                <ul class="nav nav-tabs ">
                    <li class="active"><a data-toggle="tab" href="#home">{{ __('profile.profile') }}</a></li>
                    @if (Auth::check() && Auth::user()->id == $user->id && Auth::user()->role == 'candidate')
                        <li><a data-toggle="tab" href="#post-favorite">{{ __('profile.post-favorite') }}</a></li>
                    @endif
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <div class="my-5">
                                <form id="form-update-profile" method="POST" action="{{ route('profile.update', $user) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="upload"
                                        class="account-file-input text-center center-block file-upload" hidden
                                        accept="image/png, image/jpeg" name="avatar" />
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">{{ __('profile.phone') }}</label>
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                value="{{ $user->phone }}" readonly />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">{{ __('profile.email') }}</label>
                                            <input class="form-control" readonly type="text" id="email"
                                                name="email" value="{{ $user->email }}" placeholder="{{ __('profile.email') }}" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="fullname" class="form-label">{{ __('profile.fullname') }}</label>
                                            <input class="form-control" type="text" id="fullname" name="name"
                                                value="{{ $user->name }}" autofocus />
                                        </div>
                                        @if(Auth::user()->role != 'recruiter')
                                        <div class="mb-3 col-md-6">
                                            <label for="gender" class="form-label">{{ __('profile.gender') }}</label>
                                            <select id="gender" name="gender" class="select2 form-select" style="padding: 3% 0 3% 2%; font-size:14px">
                                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>{{ __('profile.male') }}
                                                </option>
                                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                    {{ __('profile.female') }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="birthday" class="form-label">{{ __('profile.birthday') }}</label>
                                            <input class="form-control" type="date" id="birthday" name="birthday"
                                                placeholder="dd/mm/yyyy"
                                                value={{ date('Y-m-d', strtotime($user->birthday)) }} />
                                        </div>
                                        @endif
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">{{ __('profile.address') }}</label>
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
                        @else
                            <div class="my-5">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.fullname') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.gender') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->gender == 'Male' ? __('profile.male') : __('profile.female') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.birthday') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ date('d/m/Y', strtotime($user->birthday)) }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.birthday') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.phone') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>{{ __('profile.address') }}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    @if (Auth::check() && Auth::user()->id == $user->id )
                        <!--/tab-pane-->
                        <div class="tab-pane" id="post-favorite">
                            <div class="job_listing_area plus_padding">
                                <div class="container" style="width: 100% !important;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="job_lists m-0">
                                                <div class="row" id="paginated-list" data-current-page="1"
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
                </div>
                <!--/tab-pane-->
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>

</div>
            
</div>
<!--/tab-content-->

<div class="section-cv d-none" id="edu-section">
    <h4>
        <div class="icon-section btn-circle"><i class="fas fa-graduation-cap"></i></div> HỌC VẤN
    </h4>
    <div class="profile-edit">
        <i class="fas fa-plus icon-gray" data-bs-toggle="modal" data-bs-target="#eduModal"></i>
    </div>
    <!-- insert-info -->
</div>

<div class="section-cv d-none" id="work-section">
    <h4>
        <div class="icon-section btn-circle"><i class="fas fa-suitcase"></i></div> KINH NGHIỆM LÀM VIỆC
    </h4>
    <div class="profile-edit">
        <i class="fas fa-plus icon-gray" data-bs-toggle="modal" data-bs-target="#workModal"></i>
    </div>
</div>

<div class="section-cv d-none" id="volun-section">
    <h4>
        <div class="icon-section btn-circle"><i class="fas fa-globe"></i></div> 
        TÌNH NGUYỆN & HOẠT ĐỘNG CỘNG ĐỒNG
    </h4>
    <div class="profile-edit">
        <i class="fas fa-plus icon-gray" data-bs-toggle="modal" data-bs-target="#volunModal"></i>
    </div>
</div>

<div class="section-cv d-none" id="skill-section">
    <h4>
        <div class="icon-section btn-circle"><i class="fas fa-cog"></i></div> KỸ NĂNG
    </h4>
    <div class="profile-edit">
        <i class="fas fa-plus icon-gray" data-bs-toggle="modal" data-bs-target="#skillModal"></i>
    </div>
</div>

<div class="section-cv d-none" id="hobby-section">
    <h4>
        <div class="icon-section btn-circle"><i class="fas fa-music"></i></div> SỞ THÍCH
    </h4>
    <div class="profile-edit">
        <i class="fas fa-plus icon-gray" data-bs-toggle="modal" data-bs-target="#hobbyModal"></i>
    </div>
</div>

    

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
   
@endsection
