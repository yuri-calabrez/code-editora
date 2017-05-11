<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;

class UserSettingsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::user_settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        $request->session()->flash('message', 'Usuário editado com sucesso!');
        return redirect()->route('codeeduuser.user_settings.edit');
    }
}
