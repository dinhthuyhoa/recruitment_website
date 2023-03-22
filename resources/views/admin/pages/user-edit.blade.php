@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">User Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ !is_null($user->avatar) ? asset('storage/' . $user->avatar) : asset('avatar-default.png') }}"
                            alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
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
                    <form id="frmEditUser" method="POST" action="{{ route('users.update', $user) }}"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" name="avatar" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="fullname" name="name"
                                    value="{{ $user->name }}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">Role</label>
                                <select id="country" class="select2 form-select" name="role">
                                    @foreach (\App\Enums\UserRole::toSelectArray() as $k => $role)
                                        <option value="{{ $k }}" {{ $user->role == $k ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                    value="{{ $user->phone }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" readonly type="text" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="Enter email..." />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}" placeholder="Address" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input class="form-control" type="date" id="birthday" name="birthday"
                                    placeholder="dd/mm/yyyy" value={{ date('Y-m-d', strtotime($user->birthday)) }} />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="select2 form-select">
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="select2 form-select">
                                    <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="Deactive" {{ $user->status == 'Deactive' ? 'selected' : '' }}>Deactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" form="frmEditUser" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            @if (Auth::user()->role == \App\Enums\UserRole::Administrator)
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formDelUser-{{ $user->id }}" action="{{ route('users.destroy', $user) }}"
                            method="post">
                            @method('delete')
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" required />
                                <label class="form-check-label" for="accountActivation">I confirm delete account</label>
                            </div>
                            <button form="formDelUser-{{ $user->id }}" type="submit"
                                class="btn btn-danger deactivate-account">Delete Account</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
