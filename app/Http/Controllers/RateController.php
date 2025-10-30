<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Rate\RateRequest;
use App\Services\Rate\RateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class RateController
{
    public function rateUpdate(RateRequest $request, RateService $service): JsonResponse
    {
        $cliente = Auth::user();
        $rateData = $service->apply($request->validated(), $cliente->id);
        return response()->json($rateData);
    }
}
