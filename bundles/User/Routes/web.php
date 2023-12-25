<?php

use Illuminate\Support\Facades\Route;
use \User\Middlewares\UserMiddleware;
use \User\Middlewares\GhostMiddleware;
use User\Classes\UserController;

Route::get('user/home', [UserController::class, 'homeUser'])
    ->middleware(UserMiddleware::class)
    ->name('user_home');

Route::match(['GET', 'POST'],'user/login',  [UserController::class, 'loginUser'])
    ->middleware(GhostMiddleware::class)
    ->name('login_page');

Route::match(['GET', 'POST'],'user/register',  [UserController::class, 'registerUser'])
    ->middleware(GhostMiddleware::class)
    ->name('register_page');

Route::get('logout',  [UserController::class, 'logoutUser'])
    ->middleware(UserMiddleware::class)
    ->name('user_logout');



Route::get('page/terms-of-service', function() {})
    ->name('terms_of_service');
