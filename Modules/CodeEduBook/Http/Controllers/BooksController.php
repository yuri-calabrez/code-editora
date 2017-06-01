<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Http\Requests\BookCreateRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Repositories\BookRepository;
use Auth;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="books-admin", description="Administração de livros")
 */
class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Permission\Action(name="list", description="Ver listagem de livros")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        //$this->repository->pushCriteria(new FindByTitleCriteria($search));
        $books = $this->repository->orderBy('id', 'desc')->paginate(15);
        return view('codeedubook::books.index', compact('books', 'search'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar livros")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * @Permission\Action(name="create", description="Cadastrar livros")
     * @param BookCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit', compact('book', 'categories'));
    }

    /**
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param BookUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except('author_id');
        $this->repository->update($data, $id);
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro editado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * @Permission\Action(name="destroy", description="Excluir livros")
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro removido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
