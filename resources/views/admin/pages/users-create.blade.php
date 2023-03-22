@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">New user</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ asset('avatar-default.png') }}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>

                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreateUser" method="POST" action="{{ route('users.store') }}"
                        enctype="multipart/form-data" onsubmit="return checkSubmit()">
                        @csrf
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">Full Name *</label>
                                <input class="form-control" type="text" id="fullname" name="name" value=""
                                    autofocus required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">Role *</label>
                                <select id="country" class="select2 form-select" name="role" required>
                                    @foreach (\App\Enums\UserRole::toSelectArray() as $k => $role)
                                        <option value="{{ $k }}">
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone *</label>
                                <input class="form-control" type="text" name="phone" id="phone" value=""
                                    required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail *</label>
                                <input class="form-control" type="text" id="email" name="email" value=""
                                    placeholder="Enter email..." required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value=""
                                    placeholder="Address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input class="form-control" type="date" id="birthday" name="birthday"
                                    placeholder="dd/mm/yyyy" value= />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="select2 form-select">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status *</label>
                                <select id="status" name="status" class="select2 form-select">
                                    <option value="Active">Active
                                    </option>
                                    <option value="Deactive">Deactive
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="" placeholder="Password" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="repassword" class="form-label">repassword</label>
                                <input class="form-control" type="password" id="repassword" name="repassword"
                                    required />
                                <small><span id="err-repassword" class="text-danger"></span></small>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" form="frmCreateUser" class="btn btn-primary me-2">Create user</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
        function checkSubmit() {
            if ($('#password').val() != $('#repassword').val()) {
                $('#err-repassword').text('Mật khẩu xác nhận chưa đúng!')
                return false;
            }
            return true;
        }
    </script>
@endsection
