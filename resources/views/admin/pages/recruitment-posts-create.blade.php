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
                <h5 class="card-header">{{trans('admin-auth.new_post')}}</h5>
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
                            @if(isset($message_image))
                                <div class="alert alert-danger">
                                    <p>{{trans('admin-auth.message_image_upload')}}</p>
                                </div>
                            @endif
                            
                        </div>
                        <div id="alertMessage" class="alert-message border rounded-3">
                            <span>{{trans('admin-auth.message_image_upload')}}</span>
                            <!-- <button id="closeAlert" class="border rounded-3 ms-3">{{trans('admin-auth.button_close')}}</button> -->
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreatePost" method="POST" action="{{ route('admin.posts.recruitment.store') }}"
                        enctype="multipart/form-data">
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
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">{{trans('admin-auth.location_recruitment')}} *</label>
                                <input class="form-control" type="text" name="address" id="address" value=""
                                     />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.email')}} *</label>
                                <input class="form-control" type="email" id="email" name="email" value=""
                                    placeholder=""  />
                                    <small><span id="err-email" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">{{trans('admin-auth.phone')}} *</label>
                                <input type="text" class="form-control" id="phone" name="phone" value=""
                                    placeholder="Phone"  />
                                    <small><span id="err-phone" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="deadline" class="form-label">{{trans('admin-auth.deadline')}} *</label>
                                <input class="form-control" type="date" id="deadline" name="deadline"
                                    placeholder="dd/mm/yyyy" value="" min="{{ date('Y-m-d') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="vacancy" class="form-label">{{trans('admin-auth.vacancy')}} *</label>
                                <input class="form-control" type="number" min="1" id="vacancy" name="vacancy"
                                    placeholder="{{trans('admin-auth.vacancy_de')}}" value=""  />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="position" class="form-label">{{ trans('admin-auth.position') }} *</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="intern">{{ trans('admin-auth.intern') }}</option>
                                    <option value="fresher">{{ trans('admin-auth.fresher') }}</option>
                                    <option value="junior">{{ trans('admin-auth.junior') }}</option>
                                    <option value="senior">{{ trans('admin-auth.senior') }}</option>
                                </select>
                            </div>

                            <!-- <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">{{trans('admin-auth.salary')}} *</label>
                                <input class="form-control" type="number" id="salary" name="salary"
                                    placeholder="" min="1" value=""  />
                            </div> -->
                            <div class="mb-3 col-md-6">
                                <label for="salary" class="form-label">{{ trans('admin-auth.salary') }} (VND) *</label>
                                <select class="form-select" id="salary" name="salary">
                                    <option value="1000000-3000000">1,000,000 - 3,000,000</option>
                                    <option value="3500000-5000000">3,500,000 - 5,000,000</option>
                                    <option value="5500000-7000000">5,500,000 - 7,000,000</option>
                                    <option value="7500000-9000000">7,500,000 - 9,000,000</option>
                                    <option value="10000000+">{{ trans('all-jobs.over') }} 10,000,000</option>
                                    <option value="negotiable">{{trans('all-jobs.negotiable')}}</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="experience" class="form-label">{{trans('admin-auth.experience')}} *</label>
                                <input class="form-control" type="text" id="experience" name="experience"
                                    placeholder="{{trans('admin-auth.experience_de')}}" value=""  />
                            </div>
                            <!-- <div class="mb-3 col-md-6">
                                <label for="job_nature" class="form-label">{{trans('admin-auth.job_nature')}} *</label>
                                <input class="form-control" type="text" id="job_nature" name="job_nature"
                                    placeholder="{{trans('admin-auth.job_nature_de')}}" value=""  />
                            </div> -->
                            <div class="mb-3 col-md-6">
                                <label for="job_nature" class="form-label">{{trans('admin-auth.job_nature')}} *</label>
                                <select class="form-select py-0" style="height:58%" id="job_nature" name="job_nature" required>
                                    <option value="Full-time">{{trans('admin-auth.full_time')}}</option>
                                    <option value="Part-time">{{trans('admin-auth.part_time')}}</option>
                                    <option value="Freelancer">{{trans('admin-auth.freelancer')}}</option>
                                </select>
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
                            <button type="submit" name="submit" value="redirect" form="frmCreatePost"
                                class="btn btn-primary me-2">{{trans('admin-auth.create_post')}}</button>
                            <!-- <button type="submit" name="submit" value="continue-create" form="frmCreatePost"
                                class="btn btn-primary me-2">{{trans('admin-auth.keep_creating')}}</button> -->
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
        ClassicEditor.create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.log('123456');
            });
    </script>

    {{-- Input mask --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>
    <script>
        Inputmask().mask("input");
    </script>
    
    <script>

        $(document).ready(function () {
            $("#frmCreatePost").submit(function (event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

            function validateForm() {
                var avatarValue = $("#upload").val();

                var title = $("#title").val();
                var address = $("#address").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var deadline = $("#deadline").val();
                var vacancy = $("#vacancy").val();
                var position = $("#position").val();
                var salary = $("#salary").val();
                var experience = $("#experience").val();
                var jobNature = $("#job_nature").val();
                var content = $("#content").val();

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

                if (title === '' || address === '' || email === '' || phone === '' || deadline === '' || vacancy === '' || position === '' || salary === '' || experience === '' || jobNature === '' || content === '') {
                    $("#alertMessageInfo").fadeIn();

                    setTimeout(function () {
                        $("#alertMessageInfo").fadeOut();
                    }, 10000);

                    return false;
                }

                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!emailPattern.test(email)) {
                    $("#err-email").text("Định dạng email không hợp lệ.");
                    setTimeout(function () {
                        $('#err-email').text('');
                    }, 3000); 
                    return false;
                }

                var numberRegex = /^[0-9+()-]+$/;
                if (!numberRegex.test(phone)) {
                    $('#err-phone').text('Số điện thoại không hợp lệ. Không được chứa chữ và ký tự đặc biệt!');
                    setTimeout(function () {
                        $('#err-phone').text('');
                    }, 3000); 
                    return false;
                }

                return true;
            }
        });


    </script>



@endsection
