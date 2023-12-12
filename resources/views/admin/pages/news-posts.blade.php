@extends('admin.master.master')

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
<!-- Hoverable Table rows -->
<div class="card">
    <h5 class="card-header">{{trans('admin-auth.new_post_list')}}</h5>
    <div class="table-responsive text-nowrap m-3">
        <table id="tableNewsPostList" class="table table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>{{trans('admin-auth.title')}}</th>
                    <th>{{trans('admin-auth.author')}}</th>
                    <th>{{trans('admin-auth.category')}}</th>
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
                        <img src="{{ !is_null($post->post_image) ? asset('storage/' . $post->post_image) : '' }}" alt="Avatar" class="rounded-circle me-2" width="50" height="50" />
                        <a href="{{ route('admin.posts.news.edit', $post->id) }}" class="fw-bold post-title" >
                            {{ $post->post_title }}
                        </a>
                    </td>
                    <td>
                        {{ $post->user->name }}
                    </td>
                    <td>
                        @if ($post->post_meta->value == 'Hoc-bong')
                            {{trans('admin-auth.hoc_bong')}}
                        @elseif($post->post_meta->value == 'Cuoc-thi')
                            {{trans('admin-auth.cuoc_thi')}}
                        @else
                            {{trans('admin-auth.su_kien')}}
                            <!-- <span class="badge bg-label-danger me-1">{{trans('admin-auth.draft')}}</span> -->
                        @endif
                        
                    </td>
                    <td>{{ $post->post_view }}</td>
                    <td>
                        @if ($post->post_status == 'pending')
                        <span class="badge bg-label-warning me-1">{{trans('admin-auth.pending')}}</span>
                        @elseif($post->post_status == 'publish')
                        <span class="badge bg-label-success me-1">{{trans('admin-auth.publish')}}</span>
                        @else
                        <!-- <span class="badge bg-label-danger me-1">{{trans('admin-auth.draft')}}</span> -->
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
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.posts.news.edit', $post->id) }}"><i class="bx bx-edit-alt me-1"></i> {{trans('admin-auth.edit')}}</a>
                                @if($post->post_status == 'publish')
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalConfirmDisableNews-{{ $post->id }}" data-id="{{ $post->id }}">
                                    <i class="fa-solid fa-ban me-1 fs-6"></i>
                                    {{trans('admin-auth.disable_news')}}</button>
                                @endif
                                
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Modal confirm delete post -->
                <div class="modal fade" id="modalConfirmDisableNews-{{ $post->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">{{trans('admin-auth.confirm_disable')}}
                                    <!-- <b>{{ $post->post_title }}</b> -->
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formDisNews-{{ $post->id }}" action="{{ route('admin.posts.news.disable', $post) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="post_status" value="pending">
                                    <input class="form-check-input" type="hidden" name="accountActivation" id="accountActivation" value="on" />
                                    <p>{{trans('admin-auth.confirm_disable_news')}}</p>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button form="formDisNews-{{ $post->id }}" type="submit" class="btn btn-danger">{{trans('admin-auth.yes')}}</button>
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
    function shortenTitle(title, maxLength) {
        if (title.length > maxLength) {
            var shortenedPart = title.substring(0, maxLength);
            return shortenedPart + '...';
        } else {
            return title;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var postTitles = document.querySelectorAll(".post-title");
        postTitles.forEach(function(postTitle) {
            var originalTitle = postTitle.textContent.trim();
            var shortenedTitle = shortenTitle(originalTitle, 20);
            postTitle.textContent = shortenedTitle;
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tableNewsPostList thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#tableNewsPostList thead');

        var table = $('#tableNewsPostList').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        if (colIdx != 7) {
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