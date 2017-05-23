<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;

    public function __construct(RoleRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('name')->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Role cadastrada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Role editada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(RoleRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Role removida com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
