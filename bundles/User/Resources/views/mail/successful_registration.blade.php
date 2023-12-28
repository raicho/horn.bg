@extends('user::layouts.mail')

@section('pageTitle')
    {{  __('pages.successful_registration.title')  }}
@endsection

@section('content')
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h1 style="margin-bottom: 20px;">{{  __('mails.successful_registration.title')  }} </h1>
                <p>{{ __('mails.Hello') }} {{ $data['name'] }}, </p>
                <p>
                    {{ __('mails.successful_registration.message') }}
                </p>
            </td>
        </tr>
    </table>
    <p>{{ __('mails.Regards') }}, <br>{{ config('app.name') }}</p>
@endsection


