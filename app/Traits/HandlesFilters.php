<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait HandlesFilters
{
    /**
     * A lista de filtros permitidos para este controlador.
     *
     * @var array<int, string>
     */
    protected array $allowedFilters = [];

    /**
     * Define filtros permitidos.
     */
    protected function setAllowedFilters(array $filters): void
    {
        $this->allowedFilters = $filters;
    }

    /**
     * Validar e extrair filtros da solicitação.
     *
     * @throws ValidationException
     */
    protected function extractFiltersFrom(Request $request): array
    {
        $filters = $request->input('filters', []);

        if (!is_array($filters)) {
            throw ValidationException::withMessages([
                'filters' => ['Filters must be an array.'],
            ]);
        }

        foreach ($filters as $filter) {
            if (empty($filter['column'])) {
                throw ValidationException::withMessages([
                    'filters' => ['Each filter must have a column field.'],
                ]);
            }

            $column = $filter['column'];

            // Validar em relação aos filtros predefinidos
            if (!in_array($column, $this->allowedFilters, true)) {
                throw ValidationException::withMessages([
                    'filters' => ["The filter '{$column}' is not allowed."],
                ]);
            }
        }

        return $filters;
    }

    /**
     * Validar e extrair pedidos da solicitação.
     */
    protected function extractOrdersFrom(Request $request): array
    {
        $orders = $request->input('orders', []);

        if (!is_array($orders)) {
            throw ValidationException::withMessages([
                'ordernacoes' => ['ordenações precisa ser um array.'],
            ]);
        }

        foreach ($orders as $order) {
            if (empty($order['column'])) {
                throw ValidationException::withMessages([
                    'ordem' => ['Cada ordem deve ter um campo coluna.'],
                ]);
            }

            $column = $order['column'];

            if (!in_array($column, $this->allowedFilters, true)) {
                throw ValidationException::withMessages([
                    'ordem' => ["A coluna de ordem '{$column}' não é permitida."],
                ]);
            }
        }

        return $orders;
    }
}
