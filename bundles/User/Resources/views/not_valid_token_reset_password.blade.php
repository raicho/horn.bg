@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.login.title')  }}
@endsection

@section('content')
    <div class="col-md-12">
        <div class="alert alert-warning">
            ⚠️ {{ __('pages.not_valid_token_password.alert_msg') }}
        </div>
        <div class="col-6 offset-md-3">
            <a class="btn btn-primary w-100 mt-1 text-decoration-none"
               href="{{ route('user_forgot_password') }}">{{ __('buttons.NewPasswordRequest') }}</a>
        </div>
    </div>
@endsection


