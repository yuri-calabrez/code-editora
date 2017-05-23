<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var \CodeEduUser\Repositories\UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        return view('codeeduuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
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
     *
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
