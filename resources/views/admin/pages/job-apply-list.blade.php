@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
    <h5 class="card-header text-uppercase fw-bold" style="color: #C07F00;">{{trans('admin-auth.title_candidate_list')}}</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableApplyList" class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>{{trans('admin-auth.post')}}</th>
                        <th>{{trans('admin-auth.recruiter')}}</th>
                        <th>{{trans('admin-auth.candidate')}}</th>
                        <th>{{trans('admin-auth.status')}}</th>
                        <th>{{trans('admin-auth.date_apply')}}</th>
                        <th>{{trans('admin-auth.actions')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($apply_list as $apply)
                        <tr>
                            <td>
                                <!-- <img src="{{ !is_null($apply->post->post_image) ? asset('storage/' . $apply->post->post_image) : '' }}"
                                    alt="Avatar" class="rounded-circle me-2" width="50" height="50" /> -->
                                <a href="{{ route('admin.job_apply.edit', $apply->id) }}" class="fw-bold fs-6">
                                    {{ $apply->post->post_title }}
                                </a>
                            </td>
                            <td class=" fs-6">{{ $apply->post->user->name }}</td>
                            <td class=" fs-6">
                                {{ $apply->fullname }}
                            </td>
                            <td>
                                @if ($apply->status == 'pending')
                                    <span class="badge bg-label-warning me-1  fs-6">{{trans('admin-auth.pending')}}</span>
                                @elseif($apply->status == 'approved')
                                    <span class="badge bg-label-success me-1 fs-6">{{trans('admin-auth.approved')}}</span>
                                @else
                                    <span class="badge bg-label-danger me-1 fs-6">{{trans('admin-auth.failed')}}</span>
                                @endif
                            </td>
                            <td class=" fs-6">
                                {{ date('H:i d/m/Y', strtotime($apply->created_at)) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow fs-6"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded fs-6"></i>
                                    </button>
                                    <div class="dropdown-menu fs-6">
                                        <a class="dropdown-item fs-6" href="{{ route('admin.job_apply.edit', $apply->id) }}"><i
                                                class="bx bx-edit-alt me-1 fs-6"></i> {{trans('admin-auth.view_details')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
            $('#tableApplyList thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tableApplyList thead');

            var table = $('#tableApplyList').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            if (colIdx != 5) {
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
