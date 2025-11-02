<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\ClienteOTP;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClienteOTP>
 */
class ClienteOTPFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => (string)random_int(1000, 9999),
            'ativo_ate' => $this->faker->dateTime,
            'cliente_id' => Cliente::factory()->lazy()
        ];
    }
}
