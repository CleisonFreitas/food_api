<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ApplyFiltersPipeline
{
    /**
     * @param  Builder  $query
     * @param  array<int, array<string, mixed>>  $filters
     * @return Builder
     */
    public function run(Builder $query, array $filters): Builder
    {
        if (empty($filters)) {
            return $query;
        }

        $table = $query->getModel()->getTable();

        foreach ($filters as $filter) {
            // Validar estrutura
            if (empty($filter['column']) || !array_key_exists('value', $filter)) {
                continue;
            }

            $column = $filter['column'];
            $value  = $filter['value'];

            // Lidar com filtro de relacionamento (por exemplo, cliente.nome)
            if (Str::contains($column, '.')) {
                [$relation, $relationColumn] = explode('.', $column, 2);

                $query->whereHas($relation, function (Builder $q) use ($relationColumn, $value) {
                    $q->where($relationColumn, 'like', "%{$value}%");
                });

                continue;
            }

            // Tente encontrar uma classe de filtro personalizada (por exemplo, FilterByStatus)
            $filterClass = $this->resolveFilterClass($column);

            if (class_exists($filterClass)) {
                (new $filterClass())->apply($query, $value);
                continue;
            }

            // Comportamento padrão (prefixo com tabela para evitar ambiguidade).
            $query->where("{$table}.{$column}", 'like', "%{$value}%");
        }

        return $query;
    }

    /**
     * Resolve o nome da classe de filtro personalizado com base na coluna.
     * por exemplo coluna: 'status' -> App\Filters\FilterByStatus
     */
    protected function resolveFilterClass(string $column): string
    {
        return 'App\\Filters\\FilterBy' . Str::studly($column);
    }
}