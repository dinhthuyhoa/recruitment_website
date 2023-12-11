@extends('admin.master.master')

@section('css')
    <style>
        .alert-message {
            width: 20%;
            margin-left: 35%;
            padding: 75%;
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #c07f00;
            color: white;
            padding: 15px;
            text-align: center;
            z-index: 1;
            margin-top: 40%;
        }

        #closeAlert, #closeAlertInfo {
            background-color: white;
            color: #020c26;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">{{trans('admin-auth.new_package')}}</h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
                    <form id="frmCreatePackage" method="POST" action="{{ route('admin.payment_package.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-danger" id="alertMessageInfo" style="display: none;">
                            {{trans('admin-auth.alert_message_info')}}
                        </div>


                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">{{trans('admin-auth.title_package')}} *</label>
                                <input class="form-control" type="text" id="title_package" name="title_package" value=""
                                    autofocus  />
                            </div>
                            <div class="alert alert-danger" id="alertMessageValue" style="display: none;">
                                {{trans('admin-auth.alert_message_value')}}
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{trans('admin-auth.value_package')}} (VND) *</label>
                                <input class="form-control" type="number" id="value_package" name="value_package" value=""
                                    placeholder=""  />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="position" class="form-label">{{ trans('admin-auth.package_date') }} *</label>
                                <select class="form-select py-0" id="package_date" name="package_date" style="height: 58%;" required>
                                    <option value="choose">{{ trans('admin-auth.choose_package') }}</option>
                                    <option value="3">{{ trans('admin-auth.three_mo') }}</option>
                                    <option value="6">{{ trans('admin-auth.six_mo') }}</option>
                                    <option value="12">{{ trans('admin-auth.twelve_mo') }}</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="content" class="form-label">{{trans('admin-auth.package_content')}} *</label>
                                <textarea class="form-control" id="package_content" rows="8" placeholder="{{trans('admin-auth.package_content')}}" name="package_content"></textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmCreatePackage"
                                class="btn btn-primary me-2">{{trans('admin-auth.create_post')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- CK_Editor --}}
    <script>
        ClassicEditor.create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.log('123456');
            });
    </script>

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
        $("#frmCreatePackage").submit(function (event) {
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
