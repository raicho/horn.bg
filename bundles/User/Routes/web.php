<?php

use Illuminate\Support\Facades\Route;
use \User\Middlewares\UserMiddleware;
use \User\Middlewares\GhostMiddleware;
use User\Classes\UserController;

Route::group(['middleware' => ['web', 'throttle:100,1']], function () {
    Route::get('page/user/home', [UserController::class, 'homeUser'])
        ->middleware(UserMiddleware::class)
        ->name('user_home');

    Route::match(['GET', 'POST'], 'page/user/login', [UserController::class, 'loginUser'])
        ->middleware(GhostMiddleware::class)
        ->name('login_page');

    Route::match(['GET', 'POST'], 'page/user/register', [UserController::class, 'registerUser'])
        ->middleware(GhostMiddleware::class)
        ->name('register_page');

    Route::get('page/user/logout', [UserController::class, 'logoutUser'])
        ->middleware(UserMiddleware::class)
        ->name('user_logout');

    Route::match(['GET', 'POST'], 'page/user/forgot-password', [UserController::class, 'forgotPasswordUser'])
        ->middleware(GhostMiddleware::class)
        ->name('user_forgot_password');

    Route::match(['GET', 'POST'], 'page/user/reset-password/{token}', [UserController::class, 'resetPassword'])
        ->name('reset_password');

    // TODO: terms_of_service
    Route::get('page/terms-of-service', function () {
    })->name('terms_of_service');

    Route::get('page/confirm-email/{code}', [UserController::class, 'confirmedEmail'])
        ->name('confirm_email');

    Route::post('page/request-new-verification-code', [UserController::class, 'requestNewVerificationCode'])
        ->name('request_new_verification_code');

});
