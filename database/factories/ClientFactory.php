<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'senha' => Hash::make($this->faker->password),
        ];
    }
}
