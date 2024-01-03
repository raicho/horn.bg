@extends('admin::layouts.master')

@section('pageTitle')
    {{  trans('admin::pages.dashboard.title')  }}
@endsection

@section('content')
    Users {{ count($users) }}
@endsection



