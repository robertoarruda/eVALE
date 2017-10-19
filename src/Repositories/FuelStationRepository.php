<?php

namespace Nero\ValeExpress\Repositories;

use Nero\ValeExpress\Models\FuelStation;

class FuelStationRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(FuelStation $repository)
    {
        $this->model = $repository;
    }
}
