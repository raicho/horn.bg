<?php

namespace FormProtector\Services;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class   FormProtectorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // migrations //
        $this->loadMigrationsFrom(FORM_PROTECTOR_BASE_PATH . 'Migrations');
        // views


    }

    public function register()
    {
        // load views //
        $viewsPath = FORM_PROTECTOR_BASE_PATH.'Resources/views/';
        $this->loadViewsFrom(realpath($viewsPath), 'protector');
    }
}

