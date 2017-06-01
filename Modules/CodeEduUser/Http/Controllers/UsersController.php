<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="users-admin", description="Administração de usuários")
 */
class UsersController extends Controller
{
    /**
     * @var \CodeEduUser\Repositories\UserRepository
     */
    private $repository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de usuários")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = $this->repository->orderBy('id', 'desc')->paginate(10);
        return view('codeeduuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar usuários")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar usuários")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirectTo', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrada com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar usuários")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar usuários")
     * @param UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except('password');
        $this->repository->update($data, $id);
        $url = $request->get('redirectTo', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário editado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir usuários")
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Usuário removido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
