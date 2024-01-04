@extends('admin::layouts.master')

@section('pageTitle')
    {{  trans('admin::pages.dashboard.title')  }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 mb-3 d-block">
            <div class="col-box bg-primary bg-gradient text-white shadow">
                <h3 class="col-box-center-title">EXAMPLE</h3>
                <div class="col-box-bottom-line">
                    <span class="float-start">Lorem ipsum dolor sit amet.</span>
                    <span class="float-end"> dolor sit amet.</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-3 d-block">
            <div class="col-box bg-success bg-gradient text-white shadow">
                <h3 class="col-box-center-title">EXAMPLE</h3>
                <div class="col-box-bottom-line">
                    <span class="float-start">Lorem ipsum dolor sit amet.</span>
                    <span class="float-end"> dolor sit amet.</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-3 d-block">
            <div class="col-box bg-dark bg-gradient text-white shadow">
                <h3 class="col-box-center-title">EXAMPLE</h3>
                <div class="col-box-bottom-line">
                    <span class="float-start">Lorem ipsum dolor sit amet.</span>
                    <span class="float-end"> dolor sit amet.</span>
                </div>
            </div>
        </div>
    </div>
@endsection



