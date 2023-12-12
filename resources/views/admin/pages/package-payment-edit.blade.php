@extends('admin.master.master')

@section('content')


@if(session('successMessage'))
    <div id="successModalPost" class="modal" style="display: none;">
        <div class="modal-content modal-content-post">
            <span class="close" onclick="closeModal()">
                &times;
            </span>
            <h4 class="title-message">{{trans('admin-auth.title_message_success')}}</h4>
            <p class="message-success">{{trans('admin-auth.create_successful')}}</p>
        </div>
    </div>
    @php
        session()->forget('successMessage');
    @endphp
@endif
@if(session('successMessageUpdate'))
    <div id="successModalPostUpdate" class="modal" style="display: none;">
        <div class="modal-content modal-content-post">
            <span class="close" onclick="closeModalUpdate()">
                &times;
            </span>
            <h4 class="title-message">{{trans('admin-auth.title_message_success')}}</h4>
            <p class="message-success">{{trans('admin-auth.update_successful')}}</p>
        </div>
    </div>
    @php
        session()->forget('successMessageUpdate');
    @endphp
@endif


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                
            <h5 class="card-header">{{trans('admin-auth.edit_package')}}</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="frmUpdatePackage" method="POST" action="{{ route('admin.payment_package.update', $package->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        
                    <!-- Account -->
                    @if (Auth::check() && (Auth::user()->role == \App\Enums\UserRole::Administrator || Auth::user()->role == \App\Enums\UserRole::SubAdmin))
                                    <div class="mb-3 col-md-12">
                                        <label for="title" class="form-label">{{trans('admin-auth.status')}}</label>
                                        <select name="package_status" id="package_status" class="form-control">
                                            <option value="active" {{ $package->package_status == 'active' ? 'selected' : '' }}>
                                            {{trans('admin-auth.active')}}
                                            </option>
                                            <option value="inactive" {{ $package->package_status == 'inactive' ? 'selected' : '' }}>
                                            {{trans('admin-auth.inactive')}}
                                            </option>

                                        </select>
                                    </div>
                                @endif
                        <div class="alert alert-danger" id="alertMessageInfo" style="display: none;">
                            {{trans('admin-auth.alert_message_info')}}
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">{{trans('admin-auth.title_package')}} *</label>
                                <input class="form-control" type="text" id="title_package" name="title_package" value="{{ $package->title_package }}"
                                    autofocus  />
                            </div>
                            <div class="alert alert-danger" id="alertMessageValue" style="display: none;">
                                {{trans('admin-auth.alert_message_value')}}
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.value_package')}} (VND) *</label>
                                <input class="form-control" type="number" id="value_package" name="value_package" value="{{ $package->value_package }}"
                                autofocus style="height: 48px;"/>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="position" class="form-label">{{ trans('admin-auth.package_date') }} *</label>
                                <select class="form-select" id="package_date" name="package_date" required>
                                    <option value="3" {{ $package->package_date == '3' ? 'selected' : '' }}>{{ trans('admin-auth.three_mo') }}</option>
                                    <option value="6"{{ $package->package_date == '6' ? 'selected' : '' }}>{{ trans('admin-auth.six_mo') }}</option>
                                    <option value="12"{{ $package->package_date == '12' ? 'selected' : '' }}>{{ trans('admin-auth.twelve_mo') }}</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="content" class="form-label">{{trans('admin-auth.package_content')}} *</label>
                                <textarea class="form-control" id="package_content" rows="8" placeholder="{{trans('admin-auth.package_content')}}" name="package_content">{!! $package->package_content !!}</textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmUpdatePackage"
                                class="btn btn-primary me-2">{{trans('admin-auth.save_changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{trans('admin-auth.cancle')}}</button>
                        </div>

                    </div>
                </form>

                
            </div>
        </div>
    </div>
@endsection

@section('js')


    {{-- Input mask --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>
    <script>
        Inputmask().mask("input");
    </script>
    
    <script>
    $(document).ready(function () {
        $("#frmUpdatePackage").submit(function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            var title_package = $("#title_package").val();
            var value_package = $("#value_package").val();
            var package_date = $("#package_date").val();
            var package_content = $("#package_content").val();

            // Kiểm tra trường thông tin trống
            if (!title_package || !value_package || !package_date || !package_content) {
                $("#alertMessageInfo").fadeIn();
                setTimeout(function () {
                    $("#alertMessageInfo").fadeOut();
                }, 10000);
                return false;
            }

            // Kiểm tra giá trị của value_package không âm và không chứa ký tự đặc biệt
            if (isNaN(value_package) || parseFloat(value_package) < 0 || /[^a-zA-Z0-9]/.test(value_package)) {
                $("#alertMessageValue").fadeIn();
                setTimeout(function () {
                    $("#alertMessageValue").fadeOut();
                }, 10000);
                return false;
            }

            return true;
        }
    });
</script>

@endsection
