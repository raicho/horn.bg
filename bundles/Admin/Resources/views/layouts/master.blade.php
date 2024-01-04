<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle')</title>
    @vite(['bundles/Admin/Resources/css/admin.css', 'bundles/Admin/Resources/js/admin.js'])
</head>
<body>


@if(session('flash-message'))
    <div class="container">
        <div id="flash-message" class="flash-balloon alert alert-{{ session('flash-message')['type'] }}">
            <button type="button" id="flash-balloon-close bubble left" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            @if(session('flash-message')['type']  == 'success')
                <i class="bi bi-check-circle text-success"></i>
            @endif
            {{ session('flash-message')['content'] }}
        </div>
    </div>
@endif

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div id="admin-left-bar" class="col-auto d-none d-sm-block col-md-3 col-xl-2 px-0 py-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start pt-0 text-white min-vh-100">
                @section('sidebar')
                    @include('admin::components.left_nav')
                @show
            </div>
        </div>

        <div class="col py-0 px-0">
            <div class="col bg-dark text-bg-dark py-3 px-3 shadow-sm p-3 mb-3">
                <div id="profile-menu" class="dropdown py-2">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="24" height="24" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user_logout') }}">
                                <i class="bi bi-door-closed"></i>
                                {{ __('admin::left_navbar.Logout') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <h2>@yield('pageTitle')</h2>
            </div>
            <button id="mobile-menu" class="btn btn-dark btn-sm d-sm-none"> ||| </button>
            <div class="px-3 w-100">
                @yield('content')
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="actionModal" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-gradient bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi fs-4 bi-exclamation-triangle text-danger"></i> {{ __('admin::alerts.warning.title') }}</h5>
            </div>
            <div class="modal-body text-warning">
                {{ __('admin::alerts.warning.message') }}
            </div>
            <div class="modal-footer w-100">
                <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">{{ __('admin::alerts.warning.button.close') }}</button>
                <button type="button" class="btn btn-danger" id="saveModalSubmit" data-form="">{{ __('admin::alerts.warning.button.continue') }}</button>
            </div>
        </div>
    </div>
</div>


</body>
</html>


