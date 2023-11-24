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
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">{{trans('admin-auth.new_news')}}</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset('avatar-default.png') }}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar" />
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
                        <div id="alertMessage" class="alert-message border rounded-3">
                            <span>{{trans('admin-auth.message_image_upload')}}</span>
                            <!-- <button id="closeAlert" class="border rounded-3 ms-3">{{trans('admin-auth.button_close')}}</button> -->
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreateNewsPost" method="POST" action="{{ route('admin.posts.news.store') }}"
                        enctype="multipart/form-data" onsubmit="return checkSubmit()">
                        @csrf
                        <div id="alertMessageInfo" class="alert-message border rounded-3">
                            <span>{{trans('admin-auth.message_unfill_field')}}</span>
                            <!-- <button id="closeAlertInfo" class="border rounded-3 ms-3">{{trans('admin-auth.button_close')}}</button> -->
                        </div>
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">{{trans('admin-auth.title')}} *</label>
                                <input class="form-control" type="text" id="title" name="title" value=""
                                    autofocus  />
                            </div>

                            <div class="mb-3 col-12">
                                <label for="description" class="form-label">{{trans('admin-auth.description')}} *</label>
                                <textarea class="form-control" id="description" rows="8" placeholder="{{trans('admin-auth.description')}}" name="description"></textarea>
                            </div>

                            <style>
                                .ck.ck-content {
                                    min-height: 10em !important;
                                }
                            </style>
                            <div class="mb-3 col-12">
                                <label for="content" class="form-label">{{trans('admin-auth.content')}} *</label>
                                <textarea class="form-control" id="content" rows="8" placeholder="{{trans('admin-auth.content_de')}}" name="content"></textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmCreateNewsPost"
                                class="btn btn-primary me-2">{{trans('admin-auth.create_post')}}</button>
                            <button type="submit" name="submit" value="continue-create" form="frmCreateNewsPost"
                                class="btn btn-primary me-2">{{trans('admin-auth.keep_creating')}}</button>
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

        $(document).ready(function () {
            $("#frmCreateNewsPost").submit(function (event) {
                if (!validateFormNews()) {
                    event.preventDefault();
                }
            });

            function validateFormNews() {
                var avatarValue = $("#upload").val();

                var title = $("#title").val();
                var content = $("#content").val();
                var description = $("#description").val();

                if (!avatarValue) {
                    $("#alertMessage").fadeIn();

                    setTimeout(function () {
                        $("#alertMessage").fadeOut();
                    }, 10000);
                    // $("#closeAlert").click(function () {
                    //     $("#alertMessage").fadeOut();
                    // });
                    event.preventDefault();
                    return false;
                }

                if (!title || !content || !description) {

                    $("#alertMessageInfo").fadeIn();

                    setTimeout(function () {
                        $("#alertMessageInfo").fadeOut();
                    }, 10000);

                    // $("#closeAlertInfo").click(function () {
                    //     $("#alertMessageInfo").fadeOut();
                    // });
                    return false;
                }

                return true;
            }
        });


    </script>
@endsection
