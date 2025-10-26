<?php

namespace Database\Factories;

use App\Enums\RestaurantSegmentEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'segmento' => $this->faker->randomElement(RestaurantSegmentEnum::toValues()),
        ];
    }
}
