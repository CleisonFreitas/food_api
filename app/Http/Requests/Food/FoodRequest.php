<?php

namespace App\Http\Requests\Food;

use App\Enums\FoodCategoryEnum;
use App\Http\Requests\BaseRequest;
use App\Models\Estabelecimento;
use Illuminate\Validation\Rule;

class FoodRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['string', 'max:255'],
            'valor' => ['required', 'numeric'],
            'categoria' => ['string', Rule::in(FoodCategoryEnum::values())],
            'estabelecimento_id' => ['required', 'integer', Rule::exists(Estabelecimento::class, 'id')],
            'image' => ['nullable', 'string']
        ];
    }
}
