<?php
namespace App\Repositories;

use App\Contracts\RegisterSaveContract;
use App\Dtos\BaseDto;
use Illuminate\Database\Eloquent\Model;

class RegisterSaveRepository implements RegisterSaveContract
{
    /**
     * @inheritDoc
     */
    public function create(Model $model, BaseDto $dto): Model
    {
        $model->fill($dto->toArray());
        $model->save();
        return $model->refresh();
    }
}