@extends('admin.master.master')

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">{{trans('admin-auth.new_user')}}</h5>
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

                            <p class="text-muted mb-0">{{trans('admin-auth.allow_file')}}</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreateUser" method="POST" action="{{ route('users.store') }}"
                        enctype="multipart/form-data" >
                        @csrf

                        @if(session('errorMessageMail'))
                            <div id="errorAlertEmail" class="alert alert-danger">
                                <p>{{trans('auth.message_email_exists')}}</p>
                            </div>
                            @php
                                session()->forget('errorMessageMail');

                            @endphp
                        @endif
                        @if(session()->has('errorMessagePhone'))

                            <div id="errorAlertPhone" class="alert alert-danger ">
                                <p>{{trans('auth.message_phone_exists')}}</p>
                            </div>
                            @php
                                session()->forget('errorMessagePhone');
                            @endphp
                        @endif
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="alert alert-danger" id="alertMessage" style="display: none;">
                            {{trans('admin-auth.alert_message_create_user')}}
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">{{trans('admin-auth.full_name')}} *</label>
                                <input class="form-control" type="text" id="fullname" name="name" value=""
                                    autofocus  />
                            </div>

                            
                            <div class="mb-3 col-md-6">

                                <label for="phone" class="form-label">{{trans('admin-auth.phone')}} *</label>
                                <input class="form-control" type="text" name="phone" id="phone" value=""
                                     />
                                     <small><span id="err-phone" class="text-danger"></span></small>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.email')}} *</label>
                                <input class="form-control" type="text" id="email" name="email" value=""
                                    placeholder="{{trans('admin-auth.email')}}..."  />
                                    <small><span id="err-email" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">{{trans('admin-auth.address')}}</label>
                                <input type="text" class="form-control" id="address" name="address" value=""
                                    placeholder="{{trans('admin-auth.address')}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">{{trans('admin-auth.birthday')}}</label>
                                <input class="form-control" type="date" id="birthday" name="birthday"
                                max="{{ date('Y-m-d') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">{{trans('admin-auth.gender')}}</label>
                                <select id="gender" name="gender" class="select2 form-select py-0" style="height: 58%;">
                                    <option value="">{{trans('admin-auth.choose_gender')}}</option>
                                    <option value="{{trans('admin-auth.male')}}">{{trans('admin-auth.male')}}</option>
                                    <option value="{{trans('admin-auth.female')}}">{{trans('admin-auth.female')}}</option>
                                </select>
                            </div>
                            
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">{{trans('admin-auth.password')}} *</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="" placeholder="{{trans('admin-auth.password')}}"  />
                                    <small><span id="password-error" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="repassword" class="form-label">{{trans('admin-auth.re_password')}} *</label>
                                <input class="form-control" type="password" id="repassword" name="repassword"  />
                                <small><span id="err-repassword" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">{{trans('admin-auth.status')}} *</label>
                                <select id="status" name="status" class="select2 form-select py-0 h-75" >
                                    <option value="Deactive">{{trans('admin-auth.inactive')}}
                                    </option>
                                    <option value="Active">{{trans('admin-auth.active')}}
                                    </option>
                                    
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">{{trans('admin-auth.role')}} *</label>
                                <select id="country" class="select2 form-select py-0 h-75" name="role" required>
                                    @foreach (\App\Enums\UserRole::toSelectArray() as $k => $role)
                                        <option value="{{ $k }}">
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" form="frmCreateUser" class="btn btn-primary me-2">{{trans('admin-auth.create_user')}}</button>
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
    <script>
        // Hide the alert after 5 seconds
        setTimeout(function() {
            $('#errorAlertPhone').fadeOut('slow');
        }, 5000);
        setTimeout(function() {
            $('#errorAlertEmail').fadeOut('slow');
        }, 6000);
    </script>
    <script>
        $("#frmCreateUser").submit(function (event) {
            if (!checkSubmit() ) {
                event.preventDefault();
            }
        });
        function checkSubmit() {
            var name  = $("#fullname").val();
            var phone = $("#phone").val();
            var email = $("#email").val();

            var password = $("#password").val();
            var repassword = $("#repassword").val();
            var status = $("#status").val();
            if (!name || !phone || !email || !password || !repassword || !status ) {
                $("#alertMessage").fadeIn();

                    setTimeout(function () {
                        $("#alertMessage").fadeOut();
                    }, 10000);

                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $('#err-email').text('Email không hợp lệ.');
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
            
            if ($('#password').val().length < 6) {
                $("#password-error").text('Mật khẩu phải có độ dài lớn hơn hoặc bằng 6 ký tự!');
                setTimeout(function () {
                    $("#password-error").text('');
                }, 3000);

                return false;
            }
            if ($('#password').val() != $('#repassword').val()) {
                $('#err-repassword').text('Mật khẩu xác nhận chưa đúng!')
                setTimeout(function () {
                    $('#err-repassword').text('');
                }, 3000);
                return false;
            }

            return true;
        }

    </script>
@endsection
