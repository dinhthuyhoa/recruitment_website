@extends('admin.master.master')

@section('content')


@if(session('successMessage'))
    <div id="successModalPost" class="modal" style="display: none;">
        <div class="modal-content modal-content-post">
            <span class="close" onclick="closeModal()">
                &times;
            </span>
            <h4 class="title-message">{{trans('admin-auth.title_message_success')}}</h4>
            <p class="message-success">{{trans('admin-auth.create_successful')}}</p>
        </div>
    </div>
    @php
        session()->forget('successMessage');
    @endphp
@endif
@if(session('successMessageUpdate'))
    <div id="successModalPostUpdate" class="modal" style="display: none;">
        <div class="modal-content modal-content-post">
            <span class="close" onclick="closeModalUpdate()">
                &times;
            </span>
            <h4 class="title-message">{{trans('admin-auth.title_message_success')}}</h4>
            <p class="message-success">{{trans('admin-auth.update_successful')}}</p>
        </div>
    </div>
    @php
        session()->forget('successMessageUpdate');
    @endphp
@endif


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form id="frmUpdateCruitmentPost" method="POST"
                    action="{{ route('admin.posts.recruitment.update', $post->id) }}" enctype="multipart/form-data"
                    onsubmit="return checkSubmit(); openModalUpdate();">
                    @csrf
                    <h5 class="card-header">{{trans('admin-auth.edit_post')}}</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-sm-center gap-4">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('storage/' . $post->post_image) }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">{{trans('admin-auth.upload')}}</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>

                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">{{trans('admin-auth.reset')}}</span>
                                    </button>

                                    <p class="text-muted mb-0">{{trans('admin-auth.upload_img_post')}}</p>
                                </div>
                            </div>
                            @if (Auth::check() && (Auth::user()->role == \App\Enums\UserRole::Administrator
                                                    || Auth::user()->role == \App\Enums\UserRole::SubAdmin))
                                <div class="mb-3 col-md-6">
                                    <label for="title" class="form-label">{{trans('admin-auth.status')}}</label>
                                    <select name="post_status" id="post_status" class="form-control">
                                        <option value="publish" {{ $post->post_status == 'publish' ? 'selected' : '' }}>
                                        {{trans('admin-auth.publish')}}
                                        </option>
                                        <option value="pendding" {{ $post->post_status == 'pendding' ? 'selected' : '' }}>
                                        {{trans('admin-auth.pending')}}
                                        </option>
                                        <option value="draft" {{ $post->post_status == 'draft' ? 'selected' : '' }}>
                                        {{trans('admin-auth.draft')}}
                                        </option>
                                    </select>
                                </div>
                            @endif

                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">{{trans('admin-auth.title')}} *</label>
                                <input class="form-control" type="text" id="title" name="title"
                                    value="{{ $post->post_title }}" autofocus required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">{{trans('admin-auth.location_recruitment')}} *</label>
                                <input class="form-control" type="text" name="address" id="address"
                                    value="{{ $post->recruitment_address }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.email')}} *</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $post->recruitment_email }}" placeholder="Enter email..." required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">{{trans('admin-auth.phone')}} *</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $post->recruitment_phone }}" placeholder="Phone" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="deadline" class="form-label">{{trans('admin-auth.deadline')}} *</label>
                                <input class="form-control" type="datetime-local" id="deadline" name="deadline"
                                    value="{{ date('Y-m-d\TH:i', strtotime($post->recruitment_deadline)) }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="vacancy" class="form-label">{{trans('admin-auth.vacancy')}} *</label>
                                <input class="form-control" type="number" min="1" id="vacancy" name="vacancy"
                                    placeholder="10" value="{{ $post->recruitment_vacancy }}" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="position" class="form-label">{{ trans('admin-auth.position') }} *</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="intern" {{ $post->recruitment_position  === 'intern' ? 'selected' : '' }}>
                                        {{ trans('admin-auth.intern') }}
                                    </option>
                                    <option value="fresher" {{ $post->recruitment_position  === 'fresher' ? 'selected' : '' }}>
                                        {{ trans('admin-auth.fresher') }}
                                    </option>
                                    <option value="junior" {{ $post->recruitment_position  === 'junior' ? 'selected' : '' }}>
                                        {{ trans('admin-auth.junior') }}
                                    </option>
                                    <option value="senior" {{ $post->recruitment_position  === 'senior' ? 'selected' : '' }}>
                                        {{ trans('admin-auth.senior') }}
                                    </option>
                                </select>
                            </div>


                            <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">{{ trans('admin-auth.salary') }} (VND) *</label>
                                <select class="form-select" id="salary" name="salary" required>
                                    <option value="1000000-3000000" {{ $post->recruitment_salary === '1000000-3000000' ? 'selected' : '' }}>1,000,000 - 3,000,000</option>
                                    <option value="3500000-5000000" {{ $post->recruitment_salary === '3500000-5000000' ? 'selected' : '' }}>3,500,000 - 5,000,000</option>
                                    <option value="5500000-7000000" {{ $post->recruitment_salary === '5500000-7000000' ? 'selected' : '' }}>5,500,000 - 7,000,000</option>
                                    <option value="7500000-9000000" {{ $post->recruitment_salary === '7500000-9000000' ? 'selected' : '' }}>7,500,000 - 9,000,000</option>
                                    <option value="10000000+" {{ $post->recruitment_salary === '10000000+' ? 'selected' : '' }}>
                                        {{ trans('all-jobs.over') }} 10,000,000
                                    </option>

                                    <option value="negotiable" {{ $post->recruitment_salary === 'negotiable' ? 'selected' : '' }}>{{trans('all-jobs.negotiable')}}</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="experience" class="form-label">{{trans('admin-auth.experience')}} *</label>
                                <input class="form-control" type="text" id="experience" name="experience"
                                    placeholder="1 year" value="{{ $post->recruitment_experience }}" required />
                            </div>
                            <!-- <div class="mb-3 col-md-6">
                                <label for="job_nature" class="form-label">{{trans('admin-auth.job_nature')}} *</label>
                                <input class="form-control" type="text" id="job_nature" name="job_nature"
                                    placeholder="Full-time" value="{{ $post->recruitment_job_nature }}" required />
                            </div> -->
                            <div class="mb-3 col-md-6">
                                <label for="job_nature" class="form-label">{{trans('admin-auth.job_nature')}} *</label>
                                <select class="form-select" id="job_nature" name="job_nature" required>
                                    <option value="Full-time" {{ $post->recruitment_job_nature == 'Full-time' ? 'selected' : '' }}>
                                        {{trans('admin-auth.full_time')}}
                                    </option>
                                    <option value="Part-time" {{ $post->recruitment_job_nature == 'Part-time' ? 'selected' : '' }}>
                                        {{trans('admin-auth.part_time')}}
                                    </option>
                                    <option value="Freelancer" {{ $post->recruitment_job_nature == 'Freelancer' ? 'selected' : '' }}>
                                        {{trans('admin-auth.freelancer')}}
                                    </option>
                                </select>
                            </div>

                            <style>
                                .ck.ck-content {
                                    min-height: 10em !important;
                                }
                            </style>
                            <div class="mb-3 col-12">
                                <label for="content" class="form-label">{{trans('admin-auth.content')}} *</label>
                                <textarea class="form-control" id="content" rows="8" placeholder="Post content" name="content">{!! $post->post_content !!}</textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmUpdateCruitmentPost"
                                class="btn btn-primary me-2">{{trans('admin-auth.save_changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{trans('admin-auth.cancle')}}</button>
                        </div>

                    </div>
                    <!-- /Account -->
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- CK_Editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.error(error);
            });
    </script>

    {{-- Input mask --}}
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>

    <script>
        Inputmask().mask("input");
    </script>
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
        .modal-content-post {
            background-color: #fefefe;
            margin: 30% 75% auto; 
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

    <script>
        // Function to open the modal
        function openModal() {
            $('#successModalPost').show();
            setTimeout(function () {
                    closeModal();
                }, 15000);
        }

        function closeModal() {
            $('#successModalPost').hide();

        }

        $(document).ready(function () {
            openModal();
        });

    </script>
        <script>
        // Function to open the modal
        function openModalUpdate() {
            $('#successModalPostUpdate').show();            
            setTimeout(function () {
                closeModalUpdate();
                }, 15000);
        }

        function closeModalUpdate() {
            $('#successModalPostUpdate').hide();

        }

        $(document).ready(function () {
                openModalUpdate();
        });

    </script>
@endsection
