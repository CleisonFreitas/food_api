<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Rate\AvaliacaoRequest;
use App\Services\Rate\RateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class AvaliacaoController
{
    public function update(AvaliacaoRequest $request, RateService $service): JsonResponse
    {
        $cliente = Auth::user();
        $rateData = $service->apply($request->validated(), $cliente->id);
        return response()->json($rateData);
    }
}
