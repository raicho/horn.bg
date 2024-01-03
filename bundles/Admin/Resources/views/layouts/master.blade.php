<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


@if(session('flash-message'))
    <div class="container">
        <div id="flash-message" class="flash-balloon alert alert-{{ session('flash-message')['type'] }}">
            <button type="button" id="flash-balloon-close bubble left" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('flash-message')['content'] }}
        </div>
    </div>
@endif

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                @section('sidebar')
                    @include('admin::components.left_nav')
                @show
            </div>
        </div>

        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>


