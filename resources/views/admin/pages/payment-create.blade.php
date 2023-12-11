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
            <h5 class="card-header">{{ trans('admin-auth.new_payment') }}</h5>
            <!-- Account -->
            <hr class="my-0" />
            <div class="card-body">
                <form id="frmCreatePackage" method="POST" action="{{ route('admin.payment_management.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-danger" id="alertMessageInfo" style="display: none;">
                        {{ trans('admin-auth.alert_message_info') }}
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="user_id" class="form-label">{{ trans('admin-auth.company') }} *</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="choose">{{ trans('admin-auth.choose_company') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="package_payment_id" class="form-label">{{ trans('admin-auth.package_payment') }} *</label>
                            <select class="form-select" id="package_payment_id" name="package_payment_id" required>
                                <option value="choose">{{ trans('admin-auth.choose_package_payment') }}</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->title_package }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="mb-3 col-md-12">
                            <label for="checkout_status" class="form-label">{{ trans('admin-auth.checkout_status') }} *</label>
                            <select class="form-select" id="checkout_status" name="checkout_status" required>
                                <option value="Paid">{{trans('admin-auth.paid')}}</option>
                                <option value="Pending">{{trans('admin-auth.pending')}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" name="submit" value="redirect" form="frmCreatePackage" class="btn btn-primary me-2">{{ trans('admin-auth.create_post') }}</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('frmCreatePackage').addEventListener('submit', function (event) {
            var userSelect = document.getElementById('user_id');
            var packageSelect = document.getElementById('package_payment_id');
            var checkoutStatusSelect = document.getElementById('checkout_status');

            if (
                userSelect.value === 'choose' ||
                packageSelect.value === 'choose' ||
                checkoutStatusSelect.value === ''
            ) {
                event.preventDefault();
                document.getElementById('alertMessageInfo').style.display = 'block';
            } else {
                document.getElementById('alertMessageInfo').style.display = 'none';
            }
        });
    });
</script>

@endsection
