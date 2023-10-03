@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="card">
                <div class="card-header">
                    Verify Email
                </div>
                <div class="card-body">
                        <p>Your account has not been verified. Please verify your account!</p><br>
                        <a href="{{route('resend.email')}}" class="btn btn-outline btn-sm">Resend Verification Email </a>
                </div>
            </div>
        </div>
    </div>
@endsection