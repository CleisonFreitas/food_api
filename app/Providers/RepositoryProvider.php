<?php

namespace App\Providers;

use App\Contracts\RegisterSaveContract;
use App\Repositories\RegisterSaveRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(RegisterSaveContract::class, RegisterSaveRepository::class);
    }
}
