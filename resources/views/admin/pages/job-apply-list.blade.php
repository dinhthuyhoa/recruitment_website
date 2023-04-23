@extends('admin.master.master');

{{-- @section('title', __('message.admin.dashboard.title')) --}}

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <h5 class="card-header">User list</h5>
        <div class="table-responsive text-nowrap m-3">
            <table id="tableApplyList" class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Recruiter</th>
                        <th>Candidate</th>
                        <th>Status</th>
                        <th>Date time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($apply_list as $apply)
                        <tr>
                            <td>
                                <img src="{{ isset($apply->recruiter->image) ? asset('storage/' . $apply->recruiter->image) : '' }}"
                                    alt="Avatar" class="rounded-circle me-2" width="50" />
                                <a href="javascript:void(0);" class="fw-bold">
                                    {{ $apply->post_title }}
                                </a>
                            </td>
                            <td>{{ $apply->recruiter->name }}</td>
                            <td>
                                {{ $apply->fullname }}
                            </td>
                            <td>
                                @if ($apply->status == 'pendding')
                                    <span class="badge bg-label-warning me-1">Pendding</span>
                                @elseif($apply->status == 'approved')
                                    <span class="badge bg-label-success me-1">Approved</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Faild</span>
                                @endif
                            </td>
                            <td>
                                {{ date('H:i d/m/Y', strtotime($apply->created_at)) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('users.edit', $apply) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
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
@endsection
