<?php

namespace Nero\ValeExpress\Services;

abstract class Service
{
    /**
     * @var \Nero\ValeExpress\Repositories\Repository
     */
    protected $repository;

    /**
     * Busca registro
     * @param array $params Parametros da busca
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function index()
    {
        return [
            'list' => $this->repository->find(),
        ];
    }
    /**
     * Salva o registro
     * @param array $params Parametros da busca
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
