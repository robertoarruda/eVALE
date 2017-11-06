<?php

namespace Nero\Evale\Services;

abstract class Service
{
    /**
     * @var \Nero\Evale\Repositories\Repository
     */
    protected $repository;

    /**
     * Busca registro pelos parametros
     * @param array $params
     * @return Colletion
     */
    public function find(array $params = [])
    {
        return $this->repository->find($params);
    }

    /**
     * Busca registro pelo id
     * @param int $entityId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(int $entityId)
    {
        return $this->repository->findById($entityId);
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
     * Altera o registro
     * @param int $entityId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $entityId, array $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

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
