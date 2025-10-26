<?php

namespace App\Providers;

use App\Contracts\FilterableContract;
use App\Contracts\RegisterSaveContract;
use App\Repositories\FilterableRepository;
use App\Repositories\RegisterSaveRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(RegisterSaveContract::class, RegisterSaveRepository::class);
        $this->app->bind(FilterableContract::class, FilterableRepository::class);
    }
}
