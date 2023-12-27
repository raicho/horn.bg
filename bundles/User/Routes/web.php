<?php

use Illuminate\Support\Facades\Route;
use \User\Middlewares\UserMiddleware;
use \User\Middlewares\GhostMiddleware;
use User\Classes\UserController;
Route::group(['middleware' => ['web', 'throttle:100,1']], function () {
    Route::get('user/home', [UserController::class, 'homeUser'])
        ->middleware(UserMiddleware::class)
        ->name('user_home');

    Route::match(['GET', 'POST'], 'user/login', [UserController::class, 'loginUser'])
        ->middleware(GhostMiddleware::class)
        ->name('login_page');

    Route::match(['GET', 'POST'], 'user/register', [UserController::class, 'registerUser'])
        ->middleware(GhostMiddleware::class)
        ->name('register_page');

    Route::get('user/logout', [UserController::class, 'logoutUser'])
        ->middleware(UserMiddleware::class)
        ->name('user_logout');

    Route::match(['GET', 'POST'], 'user/forgot-password', [UserController::class, 'forgotPasswordUser'])
        ->middleware(GhostMiddleware::class)
        ->name('user_forgot_password');

    Route::match(['GET', 'POST'], 'user/reset-password/{token}', [UserController::class, 'resetPassword'])
        ->middleware(GhostMiddleware::class)
        ->name('reset_password');



    Route::get('page/terms-of-service', function () {
    })->name('terms_of_service');
});
