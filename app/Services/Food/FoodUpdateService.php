<?php

declare(strict_types=1);

namespace App\Services\Food;

use App\Dtos\Food\FoodDto;
use App\Facades\RegisterSaveFacade;
use App\Models\Food;

class FoodUpdateService
{
    public function execute(Food $food, array $dados): Food
    {
        $dto = FoodDto::fromArray($dados);
        return RegisterSaveFacade::create($food, $dto);
    }
}