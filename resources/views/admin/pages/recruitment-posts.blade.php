@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">Recruitment post list</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableRecruitmentPostList" class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>View</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($post_list as $post)
                        <tr>
                            <td>
                                <a href="{{ route('admin.posts.recruitment.edit', $post) }}" class="fw-bold">
                                    {{ $post->post_title }}
                                </a>
                            </td>
                            <td>
                                {{ $post->user->name }}
                            </td>
                            <td><i class="fa-regular fa-eye"></i> {{ $post->post_view }} </td>
                            <td>
                                @if ($post->post_status == 'pendding')
                                    <span class="badge bg-label-warning me-1">Pendding</span>
                                @elseif($post->post_status == 'publish')
                                    <span class="badge bg-label-success me-1">Puclished</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Faild</span>
                                @endif
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($post->post_date)) }}
                            </td>
                            <td>
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
                                            <i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('posts.recruitment.details', $post) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-eye"></i> Preview</a>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalConfirmDeletePost-{{ $post->id }}"
                                            data-id="{{ $post->id }}">
                                            <i class="bx bx-trash me-1"></i>
                                            Delete</button>
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
                                        <h5 class="modal-title" id="modalCenterTitle">Delete post
                                            <b>{{ $post->name }}</b>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formDelPost-{{ $post->id }}"
                                            action="{{ route('users.destroy', $post) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <p>Muốn xóa bài viết này thiệt hông?</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="formDelPost-{{ $post->id }}" type="submit"
                                            class="btn btn-danger">Yes</button>
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
