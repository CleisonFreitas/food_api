<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ApplyOrdersPipeline
{
    /**
     * @param  Builder  $query
     * @param  array<int, array<string, mixed>>  $orders
     * @return Builder
     */
    public function run(Builder $query, array $orders): Builder
    {
        if (empty($orders)) {
            return $query;
        }

        $table = $query->getModel()->getTable();

        foreach ($orders as $order) {
            if (empty($order['column'])) {
                continue;
            }

            $column = $order['column'];
            $direction = strtolower($order['order'] ?? 'asc');
            $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

            // Lidar com a ordenação por relação.
            if (Str::contains($column, '.')) {
                [$relation, $relationColumn] = explode('.', $column, 2);

                $query->whereHas($relation, function (Builder $q) use ($relationColumn, $direction) {
                    $q->orderBy($relationColumn, $direction);
                });

                continue;
            }

            // Ordem padrão por coluna da tabela de modelo.
            $query->orderBy("{$table}.{$column}", $direction);
        }

        return $query;
    }
}
