@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.login.title')  }}
@endsection

@section('content')
    <form class="row g-3 mt-3" action="{{ route('reset_password', $token) }}" method="POST">
        {{ csrf_field() }}


        <div class="col-md-12">
            <label for="password" class="form-label">{{ __('forms.newPasswordLabel') }}</label>
            <input type="password" name="password" class="form-control" id="password">
            @if(isset($errors['password']))
                @foreach($errors['password']  as $error)
                    <div class="alert alert-danger mt-1 mb-1"> {{ $error }}</div>
                @endforeach
            @endif

            <label for="new-password" class="form-label">{{ __('forms.repeatPasswordLabel') }}</label>
            <input type="password" name="repeat_password" class="form-control" id="new-password">
        </div>

        <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-primary w-100">{{ __('buttons.UpdatePassword') }}</button>
        </div>
    </form>
@endsection


