<?php
declare(strict_types=1);

namespace App\Services\Food;

use App\Dtos\Food\FoodDto;
use App\Facades\RegisterSaveFacade;
use App\Models\Prato;

class FoodCreateService
{
    public function create(array $dados): Prato
    {
        $newFood = new Prato();
        $dto = FoodDto::fromArray($dados);
        return RegisterSaveFacade::create($newFood, $dto);
    }
}