<?php

use Admin\Middlewares\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Admin\Classes\AdminController;

Route::group(['middleware' => ['web', AdminMiddleware::class, 'throttle:100,1']], function () {
    Route::get('admin/', [AdminController::class, 'dashboardAdmin'])
        ->name('admin_dashboard');

    Route::get('admin/users', [AdminController::class, 'usersAdmin'])
        ->name('admin_users');
});
