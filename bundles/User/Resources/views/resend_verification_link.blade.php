@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.resend_verification_link.title')  }}
@endsection

@section('content')
    <div class="col-12">
        <div class="col-12 alert alert-{{ $errors == 0 ? 'success' : 'danger' }}">
            @if($errors == 0)
                {!!  __('pages.resend_verification_link.content') !!}
            @elseif($errors == 1)
                {!!  __('pages.resend_verification_link.error') !!}
            @elseif($errors == 2)
                {!!  __('pages.resend_verification_link.error_user_verification_exist') !!}
            @endif
        </div>
    </div>
@endsection


