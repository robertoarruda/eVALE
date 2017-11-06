<?php

namespace Nero\Evale\Services;

use Nero\Evale\Repositories\FuelTypeRepository;
use Nero\Evale\Services\Service;

class FuelTypeService extends Service
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(FuelTypeRepository $repository)
    {
        $this->repository = $repository;
    }

}
