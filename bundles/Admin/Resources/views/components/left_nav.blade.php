<a href="/" class="d-flex w-100 align-items-center  pt-3 pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <span class="fs-1 w-100 text-center d-none d-sm-inline">{{ config('app.name') }}</span>
</a>

<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100 p-0" id="admin-menu">
    <ul class="collapse  show nav flex-column p-0 w-100 pe-3" id="submenu1" data-bs-parent="#menu">
        <li class="w-100 {{ app('request')->route()->getName() == 'admin_dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin_dashboard') }}" class="nav-link">
                <i class="bi bi-house"></i>
                <span class="d-none d-sm-inline">{{ __('admin::left_navbar.Dashboard') }}</span>
            </a>
        </li>

        <li class="w-100 bg-gradient {{ app('request')->route()->getName() == 'admin_users' ? 'active' : '' }}">
            <a href="{{ route('admin_users') }}" class="nav-link">
                <i class="bi bi-people"></i>
                <span class="d-none d-sm-inline">{{ __('admin::left_navbar.Users') }}</span>
            </a>
        </li>
    </ul>
</ul>


