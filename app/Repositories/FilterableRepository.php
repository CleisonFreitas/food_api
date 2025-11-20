<?php

namespace App\Repositories;

use App\Contracts\FilterableContract;
use App\Pipelines\ApplyFiltersPipeline;
use App\Pipelines\ApplyOrdersPipeline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FilterableRepository implements FilterableContract
{
    /**
     * @inheritDoc
     */
    public function search(Builder $query, array $params): Builder
    {
        // Run pipeline for filters
        $query = app(ApplyFiltersPipeline::class)->run($query, $params['filters'] ?? []);

        // Run pipeline for orders
        $query = app(ApplyOrdersPipeline::class)->run($query, $params['orders'] ?? []);

        return $query;
    }
}