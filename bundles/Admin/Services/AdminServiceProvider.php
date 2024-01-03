<?php

namespace Admin\Services;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\Translator;
class   AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // load migrations
        $this->loadMigrationsFrom(ADMIN_BASE_PATH . 'Migrations');
        // load translations
        $translator = $this->app->make(Translator::class);
        $translator->addNamespace('admin', ADMIN_BASE_PATH . 'translations');
    }

    public function register()
    {
        // load views //
        $viewsPath = ADMIN_BASE_PATH.'Resources/views/';
        $this->loadViewsFrom(realpath($viewsPath), 'admin');
    }
}

