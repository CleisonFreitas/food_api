<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Dtos\BaseDto;
use Illuminate\Database\Eloquent\Model;

interface RegisterSaveContract
{
    /**
     * Contrato será utilizado para padronizar a inserção
     * de registros utilizando a classe Dto como base.
     * @param Model $model
     * @param BaseDto $dto
     * @return Model
     */
    public function create(Model $model, BaseDto $dto): Model;
}
