<?php

namespace App\Http\Controllers;

use App\Http\Requests\Food\FoodRequest;
use App\Models\Food;
use App\Services\Food\FoodCreateService;
use App\Services\Food\FoodDeleteService;
use App\Services\Food\FoodSearchService;
use App\Services\Food\FoodUpdateService;
use App\Traits\HandlesFilters;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class FoodController
{
    use HandlesFilters;

    public function __construct(
        private readonly FoodSearchService $searchservice
    ) {
        $this->setAllowedFilters(['id', 'nome']);
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $this->extractFiltersFrom($request);
        $orders  = $this->extractOrdersFrom($request);

        $foods = $this->searchservice->execute($filters, $orders);
        return response()->json($foods);
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
