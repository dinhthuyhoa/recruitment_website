@extends('admin.master.master')

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <!-- Hoverable Table rows -->

    <div class="card">
        <h5 class="card-header text-uppercase fw-bold" style="color: #C07F00;">{{trans('admin-auth.recruitment_post_list')}}</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableRecruitmentPostList" class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>{{trans('admin-auth.title')}}</th>
                        <th>{{trans('admin-auth.author')}}</th>
                        <th>{{trans('admin-auth.view')}}</th>
                        <th>{{trans('admin-auth.status')}}</th>
                        <th>{{trans('admin-auth.date_created')}}</th>
                        <th>{{trans('admin-auth.last_updated')}}</th>
                        <th>{{trans('admin-auth.actions')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($post_list as $post)
                        <tr>
                            <td>
                                <!-- <img src="{{ !is_null($post->post_image) ? asset('storage/' . $post->post_image) : '' }}"
                                    alt="Avatar" class="rounded-circle me-2" width="50" height="50" /> -->
                                <a href="{{ route('admin.posts.recruitment.edit', $post) }}" class="fw-bold fs-6">
                                    {{ $post->post_title }}
                                </a>
                            </td>
                            <td class="fs-6">
                                {{ $post->user->name }}
                            </td>
                            <td><i class="fa-regular fa-eye fs-6"></i> {{ $post->post_view }} </td>
                            <td>
                                @if ($post->post_status == 'pending')
                                    <span class="badge bg-label-warning me-1 fs-6">{{trans('admin-auth.pending')}}</span>
                                @elseif($post->post_status == 'publish')
                                    <span class="badge bg-label-success me-1 fs-6">{{trans('admin-auth.publish')}}</span>
                                @else
                                    <!-- <span class="badge bg-label-danger me-1 fs-6">{{trans('admin-auth.draft')}}</span> -->
                                @endif
                            </td>
                            <td class=" fs-6">
                                {{ date('d/m/Y', strtotime($post->post_date)) }}
                            </td>
                            <td class=" fs-6">
                                {{ date('d/m/Y', strtotime($post->post_date_update)) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.posts.recruitment.edit', $post) }}">
                                            <i class="bx bx-edit-alt me-1 fs-6"></i> {{trans('admin-auth.edit')}}</a>
                                        <a class="dropdown-item" href="{{ route('posts.recruitment.details', $post) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-eye fs-6"></i> {{trans('admin-auth.preview')}}</a>
                                        @if ($post->post_status == 'pending')
                                            <button class="dropdown-item fs-6" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirmDeletePost-{{ $post->id }}"
                                                data-id="{{ $post->id }}">
                                                <i class="bx bx-trash me-1 fs-6"></i>
                                                {{trans('admin-auth.delete')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal confirm delete post -->
                        <div class="modal fade" id="modalConfirmDeletePost-{{ $post->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">{{trans('admin-auth.confirm_delete')}}
                                            <b>{{ $post->name }}</b>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formDelPost-{{ $post->id }}"
                                            action="{{ route('admin.posts.recruitment.delete', $post) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <p>{{trans('admin-auth.confirm_delete_post')}}</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="formDelPost-{{ $post->id }}" type="submit"
                                            class="btn btn-danger">{{trans('admin-auth.yes')}}</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        {{trans('admin-auth.no')}}
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
            // Setup - add a text input to each footer cell
            $('#tableRecruitmentPostList thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tableRecruitmentPostList thead');

            var table = $('#tableRecruitmentPostList').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            if (colIdx != 6) {
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
    <style>
        .dropup, .dropend, .dropdown, .dropstart {
            text-align: center;
        }
        .filters th input{
            height: 30px;
            border: 1px #000 solid;
            border-radius: 5px;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 15px;
            padding-bottom: 10px;
            padding-left: 10px;
        }
    </style>


@endsection
