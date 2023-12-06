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
                        <th>{{trans('admin-auth.checkout_type')}}</th>
                        <th>{{trans('admin-auth.checkout_user')}}</th>
                        <th>{{trans('admin-auth.status')}}</th>
                        <th>{{trans('admin-auth.checkout_value')}}</th>
                        <th>{{trans('admin-auth.checkout_date')}}</th>
                        <th>{{trans('admin-auth.checkout_expired_time')}}</th>
                        <th>{{trans('admin-auth.actions')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($payment_list as $payment)
                        <tr>
                            <td>
                                
                                <a href="{{ route('admin.posts.recruitment.edit', $payment) }}" class="fw-bold fs-6">
                                    {{ $payment->checkout_type }}
                                </a>
                            </td>
                            <td class="fs-6">
                                {{ $payment->user->name }}
                            </td>
                            
                            <td>
                                @if ($payment->checkout_status == 'Paid')
                                    <span class="badge bg-label-warning me-1 fs-6">{{trans('admin-auth.paid')}}</span>
                                @elseif($payment->checkout_status == 'Pending')
                                    <span class="badge bg-label-success me-1 fs-6">{{trans('admin-auth.pending')}}</span>
                                @endif
                            </td>
                            <td class="fs-6">
                                {{ number_format($payment->value_checkout, 0, ',', '.') }} VND
                            </td>

                            <td class=" fs-6">
                                {{ date('d/m/Y', strtotime($payment->checkout_date)) }}
                            </td>
                            <td class=" fs-6">
                                {{ date('d/m/Y', strtotime($payment->checkout_expired_time)) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.posts.recruitment.edit', $payment) }}">
                                            <i class="bx bx-edit-alt me-1 fs-6"></i> {{trans('admin-auth.edit')}}</a>
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
