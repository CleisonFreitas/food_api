<?php
namespace App\Facades;

use App\Contracts\RegisterSaveContract;
use Illuminate\Support\Facades\Facade;

class RegisterSaveFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return RegisterSaveContract::class;
    }
}