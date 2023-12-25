<?php

namespace User\Services;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class   UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(USER_BASE_PATH . 'Migrations');
    }

    public function register()
    {
        // load views //
        $viewsPath = USER_BASE_PATH.'Resources/views/';
        $this->loadViewsFrom(realpath($viewsPath), 'user');
    }
}

