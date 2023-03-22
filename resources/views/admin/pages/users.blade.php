@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">User list</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableUserList" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($user_list as $user)
                        <tr>
                            <td>
                                <img src="{{ asset('admin_template/assets/img/avatars/5.png') }}" alt="Avatar"
                                    class="rounded-circle me-2" width="50" />
                                <a href="{{ route('users.edit', $user) }}" class="fw-bold">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ \App\Enums\UserRole::getKey($user->role) }}
                            </td>
                            <td>
                                @if ($user->status == 'Active')
                                    <span class="badge bg-label-success me-1">Active</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Deactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('users.edit', $user) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalConfirmDeleteUser-{{ $user->id }}"
                                            data-id="{{ $user->id }}">
                                            <i class="bx bx-trash me-1"></i>
                                            Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal confirm delete user -->
                        <div class="modal fade" id="modalConfirmDeleteUser-{{ $user->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Delete user
                                            <b>{{ $user->name }}</b>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formDelUser-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <p>Muốn xóa người dùng này thiệt hông?</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="formDelUser-{{ $user->id }}" type="submit" class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            No
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#tableUserList').DataTable();
        });
    </script>
@endsection
