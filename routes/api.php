<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('food')
        ->controller(FoodController::class)
        ->group(function ($router) {
            $router->get('/', 'index');
            $router->post('/', 'store');
            $router->get('/{food}', 'show');
            $router->put('/{food}', 'update');
            $router->delete('/{food}', 'destroy');
        });

    
});

Route::prefix('rate')
        ->controller(RateController::class)
        ->group(function ($router) {
            $router->match(['POST', 'PUT'], 'update', 'rateUpdate');
        });

require __DIR__ . '/auth.php';
