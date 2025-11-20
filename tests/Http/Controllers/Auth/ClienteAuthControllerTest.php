<?php

namespace Tests\Http\Controllers\Auth;

use App\Models\Cliente;
use App\Models\ClienteOTP;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ClienteAuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function login(): void
    {
        $email = $this->faker->email;
        $senha = $this->faker->password;
        Cliente::factory()->create([
            'email' => $email,
            'senha' => Hash::make($senha),
        ]);
        $dados = [
            'email' => $email,
            'senha' => $senha,
        ];
        $response = $this->postJson('api/auth/login', $dados);
        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'cliente',
            'token'
        ]);
    }

    #[Test]
    public function logout(): void
    {
        $client = Cliente::factory()->create();
        Sanctum::actingAs($client);
        $response = $this->postJson('api/auth/logout');
        $response->assertOk();
        $this->assertEquals($client->toArray(), $response->json());
    }

    #[Test]
    public function send_email_to_recovery_password(): void
    {
        $client = Cliente::factory()->create();
        $data = ['email' => $client->email];
        $response = $this->postJson('api/auth/email-recovery', $data);
        $otpCode = ClienteOTP::whereClienteId($client->id);
        $this->assertTrue($otpCode->exists());
        $response->assertOk();
    }

    #[Test]
    public function checking_otp_code_recovery(): void
    {
        $client = Cliente::factory()->create();
        $optCode = ClienteOTP::factory()->for($client, 'cliente')->create([
            'ativo_ate' => now()->addMinutes(2)
        ]);
        $data = ['codigo_otp' => $optCode->codigo];
        $response = $this->postJson('api/auth/verify-otp-code', $data);
        $response->assertOk();
    }
}