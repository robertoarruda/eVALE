<?php

namespace Nero\Evale\Repositories;

use Nero\Evale\Models\FuelType;

class FuelTypeRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(FuelType $model)
    {
        $this->model = $model;
    }
}
