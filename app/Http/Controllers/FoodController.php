<?php

namespace App\Http\Controllers;

use App\Enums\FoodCategoryEnum;
use App\Http\Requests\Food\FoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use App\Services\Food\FoodCreateService;
use App\Services\Food\FoodDeleteService;
use App\Services\Food\FoodUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

final readonly class FoodController
{
    public function index(): JsonResponse
    {
        return response()->json('OK');
    }

    public function store(
        FoodCreateService $foodCreateService,
        FoodRequest $request
    ): JsonResponse
    {
        $food = $foodCreateService->create($request->validated());
        return response()->json($food, Response::HTTP_CREATED);
    }

    public function show(Food $food): JsonResponse
    {
        return response()->json($food);
    }
    public function update(
        Food $food,
        FoodRequest $request,
        FoodUpdateService $service
    ): JsonResponse
    {
        $food = $service->execute($food, $request->validated());
        return response()->json($food);
    }

    public function destroy(Food $food, FoodDeleteService $service): JsonResponse
    {
        $food = $service->execute($food);
        return response()->json($food);
    }
}
