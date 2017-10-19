<?php

namespace Nero\ValeExpress\Services;

use Nero\ValeExpress\Repositories\FuelStationRepository;

class FuelStationService extends Service
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(FuelStationRepository $repository)
    {
        $this->repository = $repository;
    }
}
