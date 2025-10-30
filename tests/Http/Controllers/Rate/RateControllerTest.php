<?php

namespace Tests\Http\Controllers\Rate;

use App\Enums\RateMorphEnum;
use App\Models\Client;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class RateControllerTest extends TestCase
{
    #[Test]
    public function rate_update_restaurant(): void
    {
        $modelo = Restaurant::factory()->create();
        $rateEnum = RateMorphEnum::RESTAURANT;

        $this->validateResult($modelo, $rateEnum);
    }

    #[Test]
    public function rate_update_food(): void
    {
        $modelo = Food::factory()->create();
        $rateEnum = RateMorphEnum::FOOD;

        $this->validateResult($modelo, $rateEnum);
    }

    public function validateResult(Model $modelo, RateMorphEnum $rateEnum): void
    {
        $client = Client::factory()->create();

        Sanctum::actingAs($client);
        $dados = [
            'rate' => $this->faker->randomElement([1,2,3,4,5]),
            'model_type' => $rateEnum->description(),
            'model_id' => $modelo->id
        ];

        $resposta = $this->postJson('api/rate/update', $dados);
        $resposta->assertOk();
    }
}
