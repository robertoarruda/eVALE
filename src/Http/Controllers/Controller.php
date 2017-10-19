<?php

namespace Nero\ValeExpress\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var \Nero\ValeExpress\Services\Service
     */
    protected $service;

    /**
     * Index
     * @param Request $request
     * @return
     */
    public function index(Request $request)
    {
        return view("{$this->entity}.index", $this->service->index());
    }

    /**
     * Create
     * @param Request $request
     * @return
     */
    public function create(Request $request)
    {
        return view("{$this->entity}.form");
    }

    /**
     * Store
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        $created = $this->service->create($request->all());

        return redirect('company')->with('success', 'Registro salvo com sucesso!');
    }

    /**
     * Show
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return
     */
    public function show(Request $request, int $entityId)
    {
        $data = $this->service->findById($entityId);
    }

    /**
     * Edit
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return
     */
    public function edit(Request $request, int $entityId)
    {
        $data = $this->service->findById($entityId);
    }

    /**
     * Update
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return
     */
    public function update(Request $request, int $entityId)
    {
        return $this->service->update($entityId, $request->all());
    }

    /**
     * Delete
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return
     */
    public function delete(Request $request, int $entityId)
    {
        return $this->service->delete($entityId);
    }
}
