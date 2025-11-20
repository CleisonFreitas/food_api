<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isString;

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
                    'filters' => ['cada filtro deve possuir um campo coluna.'],
                ]);
            }

            $column = $filter['column'];

            // Validar em relação aos filtros predefinidos
            if (!in_array($column, $this->allowedFilters, true)) {
                throw ValidationException::withMessages([
                    'filters' => ["O filtro '{$column}' não está habilitado."],
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

    /**
     * Validar a estrutura do texto enviado
     * @param Request $request
     * @return string
     */
    protected function sanitizeSearch(Request $request): string
    {
        $search = $request->input('pesquisa');

        // Accept: null, empty string, string
        if (is_null($search) || $search === '') {
            return '';
        }

        // Reject anything that is NOT a string
        if (!is_string($search)) {
            throw ValidationException::withMessages([
                'pesquisa' => ['Insira um texto válido no campo pesquisa.'],
            ]);
        }

        return $search;
    }
}
