<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('assets/images/logo.png') }}" height="64" style="background: transparent !important;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>

            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ __('navbars.top_nav.userDropDownTitle') }}
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end w-100" aria-labelledby="dropdownMenuButton">
                    @if(auth()->user())
                        @if(auth()->user()->is_admin == 1)
                            <li><a class="dropdown-item" href="{{ route('admin_dashboard') }}">{{ __('navbars.top_nav.AdminPanelLinkTitle') }}</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('user_logout') }}">{{ __('navbars.top_nav.logoutLinkTitle') }}</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('register_page') }}">{{ __('navbars.top_nav.registerLinkTitle') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('login_page') }}">{{ __('navbars.top_nav.loginLinkTitle') }}</a></li>
                    @endif
                    <!-- Добавете останалите опции, както е необходимо -->
                </ul>
            </div>

        </div>
    </div>
</nav>
