<?php

namespace Database\Factories;

use App\Enums\FoodCategoryEnum;
use App\Models\Estabelecimento;
use App\Models\Prato;
use App\Support\Helper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prato>
 */
class PratoFactory extends Factory
{
    public function definition(): array
    {
        $food = $this->faker->randomElement(Helper::FoodFactory());
        return [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'image' => $food['image'],
            'estabelecimento_id' => Estabelecimento::factory()->lazy(),
        ];
    }
}
