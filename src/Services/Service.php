<?php

namespace Nero\ValeExpress\Services;

abstract class Service
{
    /**
     * @var \Nero\ValeExpress\Repositories\Repository
     */
    protected $repository;

    /**
     * Busca pelos parametros
     * @param array $params Parametros da busca
     * @return array
     */
    public function index($params = [])
    {
        return [
            'list' => $this->repository->find($params),
        ];
    }

    /**
     * Salva o registro
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Busca registro pelo id
     * @param array $params Parametros da busca
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(int $entityId)
    {
        return $this->repository->findById($entityId);
    }

    /**
     * Altera o registro
     * @param int $entityId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $entityId, array $data)
    {
        return $this->repository->update($entityId, $data);
    }

    /**
     * Deleta o registro
     * @param int $entityId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $entityId)
    {
        return $this->repository->delete($entityId);
    }
}
