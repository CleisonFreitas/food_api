<?php

namespace Database\Factories;

use App\Models\CarrinhoCompra;
use App\Models\CarrinhoCompraIten;
use App\Models\Prato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarrinhoCompraIten>
 */
class CarrinhoCompraItenFactory extends Factory
{

    public function definition(): array
    {
        return [
            'carrinho_id' => CarrinhoCompra::factory()->lazy(),
            'iten_id' => Prato::factory()->lazy(),
            'valor' => $this->faker->randomFloat(),
            'quantidade' => $this->faker->randomDigit(),
            'valor_desconto' => $this->faker->randomFloat(),
            'acrescimo' => $this->faker->randomFloat(),
        ];
    }
}
