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
                        <th>{{trans('admin-auth.title_package')}}</th>
                        <th>{{trans('admin-auth.package_user')}}</th>
                        <th>{{trans('admin-auth.package_status')}}</th>
                        <th>{{trans('admin-auth.value_package')}}</th>
                        <th>{{trans('admin-auth.package_date')}}</th>
                        <th>{{trans('admin-auth.actions')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($package_list as $package)
                        <tr>
                            <td>
                                
                                <a href="{{ route('admin.posts.recruitment.edit', $package) }}" class="fw-bold fs-6">
                                    {{ $package->title_package }}
                                </a>
                            </td>
                            <td class="fs-6">
                                {{ $package->user->name }}
                            </td>
                            
                            <td>
                                @if ($package->package_status == 'active')
                                    <span class="badge bg-label-warning me-1 fs-6">{{trans('admin-auth.active')}}</span>
                                @elseif($package->package_status == 'inactive')
                                    <span class="badge bg-label-success me-1 fs-6">{{trans('admin-auth.inactive')}}</span>
                                @endif
                            </td>
                            <td class="fs-6">
                                {{ number_format($package->value_package, 0, ',', '.') }} VND
                            </td>

                            @if (!function_exists('formatPackageDate'))
                                @php
                                    function formatPackageDate($months)
                                    {
                                        switch ($months) {
                                            case 3:
                                                return trans('admin-auth.three_mo');
                                            case 6:
                                                return trans('admin-auth.six_mo');
                                            case 12:
                                                return trans('admin-auth.twelve_mo');
                                            default:
                                                return trans('admin-auth.unknown');
                                        }
                                    }
                                @endphp
                            @endif

                            <td class="fs-6">
                               {{ formatPackageDate($package->package_date) }}
                            </td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.payment_package.edit', $package) }}">
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
