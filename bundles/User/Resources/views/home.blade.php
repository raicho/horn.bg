@extends('layouts.master')

@section('pageTitle')
    {{  __('pages.register.title')  }}
@endsection

@section('content')
    Hi, {{ request()->user()->name }}
@endsection


