<?php
namespace App\Http\Requests\Rate;

use App\Enums\RateMorphEnum;
use App\Http\Requests\BaseRequest;

class AvaliacaoRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nota' => ['required', 'numeric', 'between:1,5'],
            'model_type' => ['required', 'string', 'in:'. implode(',', RateMorphEnum::descriptions())],
            'model_id' => ['required', 'integer'],
            'comentario' => ['nullable', 'string'],
        ];
    }
}