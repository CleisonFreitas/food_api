<?php

namespace Tests\Http\Controllers\Auth;

use App\Models\Client;
use App\Models\ClientOTP;
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
        $senha = Hash::make($this->faker->password);
        Client::factory()->create([
            'email' => $email,
            'senha' => $senha,
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
        $client = Client::factory()->create();
        Sanctum::actingAs($client);
        $response = $this->postJson('api/auth/logout');
        $response->assertOk();
        $this->assertEquals($client->toArray(), $response->json());
    }

    #[Test]
    public function send_email_to_recovery_password(): void
    {
        $client = Client::factory()->create();
        $data = ['email' => $client->email];
        $response = $this->postJson('api/auth/email-recovery', $data);
        $otpCode = ClientOTP::whereClienteId($client->id);
        $this->assertTrue($otpCode->exists());
        $response->assertOk();
    }

    #[Test]
    public function checking_otp_code_recovery(): void
    {
        $client = Client::factory()->create();
        $optCode = ClientOTP::factory()->for($client, 'cliente')->create([
            'ativo_ate' => now()->addMinutes(2)
        ]);
        $data = ['codigo_otp' => $optCode->codigo];
        $response = $this->postJson('api/auth/verify-otp-code', $data);
        $response->assertOk();
    }
}