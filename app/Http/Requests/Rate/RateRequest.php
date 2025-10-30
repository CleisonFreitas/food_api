<?php
namespace App\Http\Requests\Rate;

use App\Enums\RateMorphEnum;
use App\Http\Requests\BaseRequest;

class RateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'between:1,5'],
            'model_type' => ['required', 'string', 'in:'. implode(',', RateMorphEnum::descriptions())],
            'model_id' => ['required', 'integer'],
        ];
    }
}