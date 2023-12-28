@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.not_found_verification_code.title')  }}
@endsection

@section('content')

    <div class="col-12">
        <form class="form-control" action="{{ route('request_new_verification_code') }}" method="POST">
            <div class="col-12 alert alert-warning">
                {!!  __('pages.not_found_verification_code.content') !!}
            </div>
            {{ csrf_field() }}
            <div class="col-md-12 mb-3">
                <div class="col-md-6 offset-md-3">
                    <label for="email" class="form-label">{{ __('forms.emailLabel') }}</label>
                    <input type="text" name="email" value="{{  request('email') }}" class="form-control" id="email">
                    <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('buttons.RequestNewCode') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection


