<?php

namespace Tests\Http\Controllers\Rate;

use App\Enums\RateMorphEnum;
use App\Models\Cliente;
use App\Models\Estabelecimento;
use App\Models\Prato;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class AvaliacaoControllerTest extends TestCase
{
    #[Test]
    public function rate_update_restaurant(): void
    {
        $modelo = Estabelecimento::factory()->create();
        $rateEnum = RateMorphEnum::ESTABELECIMENTO;

        $this->validateResult($modelo, $rateEnum);
    }

    #[Test]
    public function rate_update_food(): void
    {
        $modelo = Prato::factory()->create();
        $rateEnum = RateMorphEnum::PRATO;

        $this->validateResult($modelo, $rateEnum);
    }

    public function validateResult(Model $modelo, RateMorphEnum $rateEnum): void
    {
        $client = Cliente::factory()->create();

        Sanctum::actingAs($client);
        $dados = [
            'nota' => $this->faker->randomElement([1,2,3,4,5]),
            'model_type' => $rateEnum->description(),
            'model_id' => $modelo->id
        ];

        $resposta = $this->postJson('api/avaliacao/update', $dados);
        $resposta->assertOk();
    }
}
