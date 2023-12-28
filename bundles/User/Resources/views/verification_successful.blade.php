@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.verification_successful.title')  }}
@endsection

@section('content')

    <div class="col-12">
        <div class="col-12 alert alert-success">
            {!!  __('pages.verification_successful.content') !!}
        </div>
    </div>
@endsection


