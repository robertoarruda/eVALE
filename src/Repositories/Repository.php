<?php

namespace Nero\Evale\Repositories;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Busca registro
     * @param array $params Parametros da busca
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(array $params = [])
    {
        return $this->model
            ->where($params)
            ->get();
    }

    /**
     * Busca registro pelo id
     * @param int $entityId Id da entidade
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(int $entityId)
    {
        return $this->model->find($entityId);
    }

    /**
     * Cria um novo registro
     * @param array $data Dados da entidade
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Atualiza um registro pelo id
     * @param int $entityId Id da entidade
     * @param array $data Dados da entidade
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $entityId, array $data)
    {
        return $this->model
            ->where('id', $entityId)
            ->first()
            ->fill($data)
            ->save();
    }

    /**
     * Apaga um registro pelo id
     * @param int $entityId Id da entidade
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $entityId)
    {
        return $this->model
            ->where('id', $entityId)
            ->delete();
    }
}
