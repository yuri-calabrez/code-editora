<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Criteria\FindPermissionsGroupCriteria;
use CodeEduUser\Criteria\FindPermissionsResouceCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\RoleRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="role-admin", description="Administração de papéis de usuário")
 */
class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {

        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @Permission\Action(name="list", description="Listar papéis de usuário")
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('name')->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * @Permission\Action(name="store", description="Cadastrar papel de usuário")
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Cadastrar papel de usuário")
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
     * @Permission\Action(name="update", description="Atualizar papel de usuário")
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar papel de usuário")
     * @param  Request $request
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Role editada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir papel de usuário")
     * @return Response
     */
    public function destroy(RoleRequest $request, $id)
    {
        try{
            $this->repository->delete($id);
            \Session::flash('message', 'Role removida com sucesso!');
        } catch (QueryException $e) {
            \Session::flash('error', 'Papel de usuário não pode ser exlcuido. Ele esta relacionado com outros registros.');
        }


        return redirect()->to(\URL::previous());
    }

    public function editPermission($id)
    {
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResouceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());

        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    public function updatePermission(PermissionRequest $request, $id)
    {
        $data = $request->get('permissions', []);
        $this->repository->updatePermission($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Permissões atribuidas com sucesso!');
        return redirect()->to($url);
    }
}
