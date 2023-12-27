@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.login.title')  }}
@endsection

@section('content')
    <form class="row g-3 mt-3" action="{{ route('user_forgot_password') }}" method="POST">
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
            <a class="float-md-start d-block mt-1 text-decoration-none"
               href="{{ route('login_page') }}">{{ __('pages.login.go_to_login_page_link') }}</a>

            <a class="float-md-end d-block mt-1  text-decoration-none"
               href="{{ route('register_page') }}">{{ __('pages.login.dont_have_an_account_link_text') }}</a>
        </div>
        <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-primary w-100">{{ __('buttons.ResetPassword') }}</button>
        </div>
    </form>
@endsection


