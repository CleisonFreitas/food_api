<?php
declare(strict_types=1);

namespace App\Services\Food;

use App\Dtos\Food\FoodDto;
use App\Facades\RegisterSaveFacade;
use App\Models\Food;

class FoodCreateService
{
    public function create(array $dados): Food
    {
        $newFood = new Food();
        $dto = FoodDto::fromArray($dados);
        return RegisterSaveFacade::create($newFood, $dto);
    }
}