@extends('user::layouts.mail')

@section('pageTitle')
    {{  __('pages.forgot_password.title')  }}
@endsection

@section('content')
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h1 style="margin-bottom: 20px;">{{  __('mails.forgot_password.title')  }} </h1>
                <p>{{ __('mails.Hello') }} {{ $data['name'] }}, </p>
                <p>
                    You're receiving this email because you've requested a password reset. To complete the password
                    reset process, please follow the link below.
                </p>
                <p><a href="{{ route('reset_password', $data['token']) }}">Reset Your Password</p>

            </td>
        </tr>
    </table>
    <p>{{ __('mails.Regards') }}, <br>{{ config('app.name') }}</p>
@endsection


