@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.user.dashboard.title')  }}
@endsection

@section('content')
    Hi, {{ request()->user()->name }}
@endsection


