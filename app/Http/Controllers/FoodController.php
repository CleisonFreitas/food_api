<?php

namespace App\Http\Controllers;

use App\Http\Requests\Food\FoodRequest;
use App\Http\Resources\PratoResource;
use App\Models\Prato;
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
        $search = $this->sanitizeSearch($request);

        $pratos = $this->searchservice->execute(filters: $filters, orders: $orders, search: $search);
        return response()->json($pratos);
    }

    public function store(
        FoodCreateService $foodCreateService,
        FoodRequest $request
    ): JsonResponse
    {
        $food = $foodCreateService->create($request->validated());
        return response()->json($food, Response::HTTP_CREATED);
    }

    public function show(Prato $prato): JsonResponse
    {
        return response()->json($prato);
    }
    public function update(
        Prato $prato,
        FoodRequest $request,
        FoodUpdateService $service
    ): JsonResponse
    {
        $food = $service->execute($prato, $request->validated());
        return response()->json($food);
    }

    public function destroy(Prato $prato, FoodDeleteService $service): JsonResponse
    {
        $food = $service->execute($prato);
        return response()->json($food);
    }
}
