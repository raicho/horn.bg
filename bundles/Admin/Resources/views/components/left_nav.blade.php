<a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">

    <span class="fs-5 d-none d-sm-inline">{{ config('app.name') }}</span>
</a>

<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
    <li>
        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
            <li class="w-100">
                <a href="{{ route('admin_dashboard') }}" class="nav-link px-0">
                    <i class="bi bi-house"></i>
                    <span class="d-none d-sm-inline">{{ __('admin::left_navbar.Dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin_users') }}" class="nav-link px-0">
                    <i class="bi bi-people"></i>
                    <span class="d-none d-sm-inline">{{ __('admin::left_navbar.Users') }}</span> </a>
            </li>

            <li>
                <a href="{{ route('admin_users') }}" class="nav-link px-0">
                    <i class="bi bi-bell"></i>
                    <span class="d-none d-sm-inline">{{ __('admin::left_navbar.Notifications') }}</span> </a>
            </li>
        </ul>
    </li>
</ul>


<div class="dropdown pb-4 float-end">
    <a href="#" class="d-flex align-items-center  text-decoration-none dropdown-toggle" id="dropdownUser1"
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

