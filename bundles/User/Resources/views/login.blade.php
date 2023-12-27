@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.login.title')  }}
@endsection

@section('content')
    <form class="row g-3 mt-3" action="{{ route('login_page') }}" method="POST">
        {{ csrf_field() }}
        <div class="col-md-12">
            <label for="email" class="form-label">{{ __('forms.emailLabel') }}</label>
            <input type="text" name="email" value="{{  request('email') }}" class="form-control" id="email">
            @if(isset($errors['email']))
                @foreach($errors['email']  as $emailError)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $emailError }}</div>
                @endforeach
            @endif
        </div>

        <div class="col-md-12">
            <label for="password" class="form-label">{{ __('forms.passwordLabel') }}</label>
            <input type="password" name="password" class="form-control" id="password">
            @if(isset($errors['password']))
                @foreach($errors['password']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif

            @if(isset($errors['not_logged']))
                @foreach($errors['not_logged'] as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            <a class="float-md-start d-block mt-1  text-decoration-none"
               href="{{ route('user_forgot_password') }}">{{ __('pages.login.forgot_password_link_text') }}</a>

            <a class="float-md-end d-block mt-1  text-decoration-none"
               href="{{ route('register_page') }}">{{ __('pages.login.dont_have_an_account_link_text') }}</a>
        </div>
        <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-primary w-100">{{ __('buttons.Login') }}</button>
        </div>
    </form>
@endsection


