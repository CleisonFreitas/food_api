<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('prato')
        ->controller(FoodController::class)
        ->group(function ($router) {
            $router->get('/', 'index');
            $router->post('/', 'store');
            $router->get('/{prato}', 'show');
            $router->put('/{prato}', 'update');
            $router->delete('/{prato}', 'destroy');
        }); 
});

Route::prefix('avaliacao')
        ->controller(AvaliacaoController::class)
        ->group(function ($router) {
            $router->match(['POST', 'PUT'], 'update', 'update');
        });

require __DIR__ . '/auth.php';
