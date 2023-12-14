@extends('admin.master.master')

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">{{trans('admin-auth.user_details')}}</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ !is_null($user->avatar) ? asset('storage/' . $user->avatar) : asset('avatar-default.png') }}"
                            alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
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


                    <form id="frmEditUser" method="POST" action="{{ route('users.update', $user) }}"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">{{trans('admin-auth.full_name')}} *</label>
                                <input class="form-control" type="text" id="fullname" name="name"
                                    value="{{ $user->name }}" autofocus readonly />
                            </div>
                           <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">{{trans('admin-auth.role')}} *</label>
                                <input class="form-control" type="text" id="country" name="country"
                                    value="{{ $user->role }}" autofocus readonly />
                                <!-- <select id="country" class="select2 form-select py-0" style="height: 58%;" name="role">
                                    @foreach (\App\Enums\UserRole::toSelectArray() as $k => $role)
                                        <option value="{{ $k }}" {{ $user->role == $k ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select> -->
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">{{trans('admin-auth.phone')}} *</label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                    value="{{ $user->phone }}" readonly />
                                    <small><span id="err-phone" class="text-danger"></span></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.email')}} *</label>
                                <input class="form-control" readonly type="text" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="{{trans('admin-auth.email')}}..." />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">{{trans('admin-auth.address')}}</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}" placeholder="{{trans('admin-auth.address')}}" />
                            </div>

                            @if($user->role != 'recruiter')
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">{{trans('admin-auth.birthday')}}</label>
                                <input class="form-control" type="date" id="birthday" name="birthday"
                                    placeholder="dd/mm/yyyy" value="{{ date('Y-m-d', strtotime($user->birthday)) }}"
                                    max="{{ date('Y-m-d') }}" />
                            </div>

                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">{{trans('admin-auth.gender')}}</label>
                                    <select id="gender" name="gender" class="select2 form-select">
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>{{trans('admin-auth.male')}}</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>{{trans('admin-auth.female')}}
                                        </option>
                                    </select>
                                </div>
                            @endif
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">{{trans('admin-auth.status')}}</label>
                                @if($user->status == 'Pending')
                                <select id="status" name="status" class="select2 form-select py-0" style="height: 58%;">
                                    <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>{{trans('admin-auth.active')}}
                                    </option>
                                    <option value="Pending" {{ $user->status == 'Pending' ? 'selected' : '' }}>{{trans('admin-auth.pending')}}</option>

                                    <!-- <option value="Deactive" {{ $user->status == 'Deactive' ? 'selected' : '' }}>{{trans('admin-auth.inactive')}}
                                    </option> -->
                                </select>
                                @else
                                <input class="form-control" type="text" id="status" name="status"
                                    value="{{ $user->status }}" autofocus readonly />
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" form="frmEditUser" class="btn btn-primary me-2">{{trans('admin-auth.save_changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{trans('admin-auth.cancle')}}</button>
                        </div>
                    </form>    
                </div>
                <!-- /Account -->
            </div>
            @if (Auth::user()->role == \App\Enums\UserRole::Administrator && $user->status == 'Active')
                <div class="card">
                    <h5 class="card-header">{{trans('admin-auth.disable_account')}}</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">{{trans('admin-auth.disable_account_confirm')}}</h6>
                                <p class="mb-0">{{trans('admin-auth.disable_account_de')}}
                                </p>
                            </div>
                        </div>
                        <!-- <form id="formDelUser-{{ $user->id }}" action="{{ route('users.destroy', $user) }}"
                            method="post">
                            @method('delete')
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">{{trans('admin-auth.delete_account_yes')}}</label>
                            </div>
                            <button form="formDelUser-{{ $user->id }}" type="submit"
                                class="btn btn-danger deactivate-account">{{trans('admin-auth.delete_account')}}</button>
                        </form> -->
                        <form id="formDelUser-{{ $user->id }}" action="{{ route('users.disable', $user) }}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="status" value="Pending"> 
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">{{ trans('admin-auth.disable_account_yes') }}</label>
                            </div>
                            <button form="formDelUser-{{ $user->id }}" type="submit" class="btn btn-danger deactivate-account">
                                {{ trans('admin-auth.disable_account') }}
                            </button>
                        </form>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')

<script>
    $("#frmEditUser").submit(function (event) {
            if (!checkSubmit() ) {
                event.preventDefault();
            }
        });
        function checkSubmit() {
            var name  = $("#fullname").val();
            var phone = $("#phone").val();
            var email = $("#email").val();

            var status = $("#status").val();
            if (!name || !phone || !email ||  !status ) {
                $("#alertMessage").fadeIn();

                    setTimeout(function () {
                        $("#alertMessage").fadeOut();
                    }, 10000);

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
</script>
@endsection
