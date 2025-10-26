<?php

namespace App\Dtos\Food;

use App\Dtos\BaseDto;

class FoodDto extends BaseDto
{
    public string $nome;
    public float $valor;
    public string $categoria;
    public int|string $estabelecimento_id;
    public ?string $image = null;
}
