<?php

namespace Nero\Evale\Repositories;

use Nero\Evale\Models\FillUp;

class FillUpRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(FillUp $model)
    {
        $this->model = $model;
    }
}
