<?php

namespace Tests\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClientRegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function register(): void
    {
        $senha = $this->faker->password;
        $data = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'senha' => $senha,
            'confirm_senha' => $senha,
        ];
        $response = $this->postJson('api/auth/register', $data);
        $response->assertCreated();
        $response->assertJsonStructure([
            'message',
            'cliente',
            'token'
        ]);
    }
}
