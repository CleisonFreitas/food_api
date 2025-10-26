<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientOTP;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClientOTP>
 */
class ClientOTPFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => (string)random_int(1000, 9999),
            'ativo_ate' => $this->faker->dateTime,
            'cliente_id' => Client::factory()->lazy()
        ];
    }
}
