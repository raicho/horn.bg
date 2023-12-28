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
@section('sidebar')
    @include('components.top_nav_bar')
@show


<div class="container">

    @if(session('flash-message'))
        <div id="flash-message" class="flash-balloon alert alert-{{ session('flash-message')['type'] }}">
            <button type="button" id="flash-balloon-close bubble left" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('flash-message')['content'] }}
        </div>
    @endif
    @yield('content')
</div>

</body>
</html>
