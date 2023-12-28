@extends('user::layouts.mail')

@section('pageTitle')
    {{  __('pages.forgot_password.title')  }}
@endsection

@section('content')
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h1 style="margin-bottom: 20px;">{{  __('mails.verification_link.title')  }} </h1>
                <p>{{ __('mails.Hello') }} {{ $data['name'] }}, </p>
                <p>
                    {{ __('mails.verification_link.message') }}
                </p>
                <p><a href="{{ route('confirm_email', $data['code']) }}">{{ __('buttons.VerifyEmail') }}</a></p>

            </td>
        </tr>
    </table>
    <p>{{ __('mails.Regards') }}, <br>{{ config('app.name') }}</p>
@endsection


