<?php

namespace Database\Factories;

use App\Enums\FoodCategoryEnum;
use App\Models\Food;
use App\Models\Restaurant;
use App\Support\Helper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Food>
 */
class FoodFactory extends Factory
{
    public function definition(): array
    {
        $food = $this->faker->randomElement(Helper::FoodFactory());
        return [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'image' => $food['image'],
            'estabelecimento_id' => Restaurant::factory()->lazy(),
        ];
    }
}
