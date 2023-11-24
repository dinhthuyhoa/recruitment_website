@extends('frontend.master.master')
@section('css')
    <style>
        .message-payment-success {
            text-align: center; 
            margin-top: 100px;
        }
    </style>
@endsection

@section('content')
    @if(isset($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    <div class="message-payment-success">
        <h1>Payment and Registration Successful!</h1>
        <p>Thank you for choosing our services. Your payment has been processed successfully, and your registration is complete.</p>
        <p>You will receive a confirmation email shortly with further details.</p>
    </div>
@endsection

