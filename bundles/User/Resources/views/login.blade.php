@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.register.title')  }}
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
            TODO: forgot password
        </div>
        <div class="col-md-6 offset-md-3">   <button type="submit" class="btn btn-primary w-100">{{ __('buttons.Login') }}</button></div>
    </form>
@endsection


