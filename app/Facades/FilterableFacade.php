<?php

namespace App\Facades;

use App\Contracts\FilterableContract;
use Illuminate\Support\Facades\Facade;

class FilterableFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return FilterableContract::class;
    }
}