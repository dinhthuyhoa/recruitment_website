@extends('admin.master.master')

@section('title','User | '. __('system.title'))

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">User list</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableUserList" class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>{{trans('admin-auth.full_name')}}</th>
                        <th>{{trans('admin-auth.email')}}</th>
                        <th>{{trans('admin-auth.role')}}</th>
                        <th>{{trans('admin-auth.status')}}</th>
                        <th>{{trans('admin-auth.actions')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($user_list as $user)
                        <tr>
                            <td>
                                <img src="{{ !is_null($user->avatar) ? asset('storage/' . $user->avatar) : asset('avatar-default.png') }}"
                                    alt="Avatar" class="rounded-circle me-2" width="50" />
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
                                    <span class="badge bg-label-success me-1">{{trans('admin-auth.active')}}</span>
                                @else
                                    <span class="badge bg-label-danger me-1">{{trans('admin-auth.inactive')}}</span>
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
                                                class="bx bx-edit-alt me-1"></i> {{trans('admin-auth.edit')}}</a>
                                        @if($user->status == 'Active')
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalConfirmDeleteUser-{{ $user->id }}"
                                            data-id="{{ $user->id }}">
                                            <i class="fa-solid fa-user-large-slash"></i>
                                            {{trans('admin-auth.disable_account')}}</button>
                                        @endif
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
                                        <h5 class="modal-title" id="modalCenterTitle">{{trans('admin-auth.disable_account')}}
                                            <b>{{ $user->name }}</b>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="formDelUser-{{ $user->id }}" action="{{ route('users.disable', $user) }}" method="post">
                                        @method('patch')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="status" value="Pending">
                                            <input class="form-check-input" type="hidden" name="accountActivation" id="accountActivation" value="on" />
                                            <p>{{ trans('admin-auth.disable_account_confirm') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button form="formDelUser-{{ $user->id }}" type="submit" class="btn btn-danger">{{ trans('admin-auth.disable_account_yes') }}</button>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('admin-auth.no') }}</button>
                                        </div>
                                    </form>
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
            // Setup - add a text input to each footer cell
            $('#tableUserList thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tableUserList thead');

            var table = $('#tableUserList').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            if (colIdx != 4) {
                                // Set the header cell to contain the input element
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input type="text" placeholder="' + title + '" />');
                            } else {
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('');
                            }

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
        });
    </script>
@endsection
