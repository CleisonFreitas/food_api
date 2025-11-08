<?php

namespace Database\Factories;

use App\Enums\StatusCarrinhoCompraEnun;
use App\Models\CarrinhoCompra;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarrinhoCompra>
 */
class CarrinhoCompraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory()->lazy(),
            'data_de_finalizacao' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(StatusCarrinhoCompraEnun::cases()),
        ];
    }
}
