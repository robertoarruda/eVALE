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
    protected $view;

    /**
     * @var \Nero\ValeExpress\Services\Service
     */
    protected $service;

    /**
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("{$this->view}.index", $this->service->index());
    }

    /**
     * Create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->view}.form");
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    protected function mainStore(Request $request)
    {
        $this->service->create($request->all());

        return redirect()->route("{$this->view}.index")
            ->with('success', 'Registro salvo com sucesso!');
    }

    /**
     * Show
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function show(int $entityId)
    {
        return redirect()->route("{$this->view}.edit", $entityId);
    }

    /**
     * Edit
     * @param int $entityId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function edit(int $entityId)
    {
        $data = $this->service->findById($entityId);

        return view("{$this->view}.form", $data->toArray());
    }

    /**
     * Update
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    protected function mainUpdate(Request $request, int $entityId)
    {
        $this->service->update($entityId, $request->all());

        return redirect()->route("{$this->view}.index")
            ->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Destroy
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $entityId)
    {
        $this->service->delete($entityId);

        return redirect()->route("{$this->view}.index")
            ->with('success', 'Registro excluido com sucesso!');
    }
}
