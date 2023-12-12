@extends('admin.master.master')
@section('css')
    <style>
        .alert-message {
            width: 20%;
            margin-left: 35%;
            padding: 75%;
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #c07f00;
            color: white;
            padding: 15px;
            text-align: center;
            z-index: 1;
            margin-top: 40%;
        }

        #closeAlert, #closeAlertInfo {
            background-color: white;
            color: #020c26;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
@endsection
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
                <h5 class="card-header">{{trans('admin-auth.edit_post')}} {{ $post->post_title }}</h5>
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
                       
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreateNewsPost" method="POST" action="{{ route('admin.posts.news.update', $post->id) }}" enctype="multipart/form-data" onsubmit="return checkSubmit()" onreset="hideAlert()">


                        @csrf
                        <div id="alert" class="alert-message border rounded-3" style="display: none;">
                            <span>{{trans('admin-auth.message_unfill_field')}}</span>
                        </div>
                        @if (Auth::check() &&
                                (Auth::user()->role == \App\Enums\UserRole::Administrator))
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">{{trans('admin-auth.status')}}</label>
                                <select name="post_status" id="post_status" class="form-control">
                                    <option value="publish" {{ $post->post_status == 'publish' ? 'selected' : '' }}>
                                    {{trans('admin-auth.publish')}}
                                    </option>
                                    <option value="pending" {{ $post->post_status == 'pending' ? 'selected' : '' }}>
                                    {{trans('admin-auth.pending')}}
                                    </option>
                                    <!-- <option value="draft" {{ $post->post_status == 'draft' ? 'selected' : '' }}>
                                    {{trans('admin-auth.draft')}} -->
                                    </option>
                                </select>
                            </div>
                        @endif
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">{{trans('admin-auth.title')}} *</label>
                                <input class="form-control" type="text" id="title" name="title"
                                    value="{{ $post->post_title }}" autofocus  />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="event_category" class="form-label">{{trans('admin-auth.category')}} *</label>
                                <select class="form-select" id="event_category" name="event_category" >
                                    <option value="Su-kien" {{ $post->post_category === 'Su-kien' ? 'selected' : '' }}>
                                        {{trans('admin-auth.su_kien')}}
                                    </option>
                                    <option value="Hoc-bong" {{ $post->post_category === 'Hoc-bong' ? 'selected' : '' }}>
                                        {{trans('admin-auth.hoc_bong')}}
                                    </option>
                                    <option value="Cuoc-thi" {{ $post->post_category === 'Cuoc-thi' ? 'selected' : '' }}>
                                        {{trans('admin-auth.cuoc_thi')}}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="title" class="form-label">{{trans('admin-auth.description')}} *</label>
                                <textarea class="form-control" id="description" name="description" >{!! $post->post_description !!}</textarea>
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
                            <button type="submit" name="submit" value="redirect" form="frmCreateNewsPost"
                                class="btn btn-primary me-2">{{trans('admin-auth.save_changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{trans('admin-auth.cancle')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
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
    <script>

        function checkSubmit() {
            var title = document.getElementById('title').value;
            var eventCategory = document.getElementById('event_category').value;
            var description = document.getElementById('description').value;
            var content = document.getElementById('content').value;

            if (title === '' || eventCategory === '' || description === '' || content === '') {
                $("#alert").fadeIn();

                setTimeout(function () {
                    $("#alert").fadeOut();
                }, 3000);

                return false;
            }

            return true;
        }

        function hideAlert() {
            $("#alert").hide();
        }
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
