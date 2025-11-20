<?php

use App\Http\Controllers\Auth\ClienteAuthController;
use App\Http\Controllers\Auth\ClientRegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function ($router) {
    $router->controller(ClienteAuthController::class)
        ->group(function ($router) {
            $router->post('login', 'login');
            $router->post('email-recovery', 'sendEmailToRecoveryPassword');
            $router->post('verify-otp-code', 'checkingOtpCodeRecovery');
            $router->middleware('auth:sanctum')->group(function ($router) {
                $router->post('logout', 'logout');
                $router->get('me', 'me');
            });
        });

    $router->controller(ClientRegisterController::class)->group(function ($router) {
        $router->post('register', 'register');
    });
});