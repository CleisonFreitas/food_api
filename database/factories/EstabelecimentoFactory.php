<?php

namespace Database\Factories;

use App\Enums\RestaurantSegmentEnum;
use App\Models\Estabelecimento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Estabelecimento>
 */
class EstabelecimentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'segmento' => $this->faker->randomElement(RestaurantSegmentEnum::toValues()),
        ];
    }
}
