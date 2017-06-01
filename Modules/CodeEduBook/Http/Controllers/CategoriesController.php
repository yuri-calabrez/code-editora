<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="categories-admin", description="Admnistração de categorias")
 */
class CategoriesController extends Controller
{
    /**
     * @var \CodeEduBook\Repositories\CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de categorias")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->repository->orderBy('id', 'desc')->paginate(10);
        return view('codeedubook::categories.index', compact('categories', 'search'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar categorias")
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
    }

    /**
     * @Permission\Action(name="create", description="Cadastar categorias")
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirectTo', route('categories.index'));
        $request->session()->flash('message', 'Categoria cadastrada com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar categorias")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('codeedubook::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar categorias")
     * @param CategoryRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirectTo', route('categories.index'));
        $request->session()->flash('message', 'Categoria editada com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir categorias")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Categoria removida com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
