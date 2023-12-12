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
            @if($checkout->checkout_status == 'Paid')
                <h5 class="card-header">{{ trans('admin-auth.view_checkout') }}</h5>
            @else
                <h5 class="card-header">{{ trans('admin-auth.edit_checkout') }}</h5>
            @endif
            <!-- Account -->
            <hr class="my-0" />
            <div class="card-body">
                <form id="frmCreatePackage" method="POST" action="{{ route('admin.payment_management.update', $checkout->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-danger" id="alertMessageInfo" style="display: none;">
                        {{ trans('admin-auth.alert_message_info') }}
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="user_id" class="form-label">{{ trans('admin-auth.company') }} *</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="package_payment_id" class="form-label">{{ trans('admin-auth.package_payment') }} *</label>
                            <input type="text" class="form-control" id="package_payment_id" name="package_payment_id" value="{{ $package->title_package }}" readonly>
                        </div>

                        @if($checkout->checkout_status == "Paid")
                            <div class="mb-3 col-md-12">
                                <label for="checkout_status" class="form-label">{{ trans('admin-auth.package_payment') }} *</label>
                                <input type="text" class="form-control" id="checkout_status" name="checkout_status" value="{{ $checkout->checkout_status }}" readonly>
                            </div>

                        @else
                        <div class="mb-3 col-md-12">
                            <label for="checkout_status" class="form-label">{{ trans('admin-auth.checkout_status') }} *</label>
                            <select class="form-select" id="checkout_status" name="checkout_status" required>
                                <option value="Paid" {{ $checkout->checkout_status == "Paid" ? 'selected' : '' }}>{{trans('admin-auth.paid')}}</option>
                                <option value="Pending" {{ $checkout->checkout_status == "Pending" ? 'selected' : '' }}>{{trans('admin-auth.pending')}}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="submit" value="redirect" form="frmCreatePackage"
                                class="btn btn-primary me-2">{{trans('admin-auth.save_changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary">{{trans('admin-auth.cancle')}}</button>
                        </div>
                        @endif
                    </div>
                    
                    
                </form>
            </div>
            <!-- /Account -->
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
    

@endsection
