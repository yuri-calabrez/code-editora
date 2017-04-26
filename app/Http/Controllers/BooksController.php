<?php

namespace CodePub\Http\Controllers;

use CodePub\Http\Requests\BookCreateRequest;
use CodePub\Http\Requests\BookUpdateRequest;
use CodePub\Repositories\BookRepository;
use Auth;
use CodePub\Repositories\CategoryRepository;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $search = $request->get('search');
        //$this->repository->pushCriteria(new FindByTitleCriteria($search));
        $books = $this->repository->orderBy('id', 'desc')->paginate(15);
        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('books.create', compact('categories'));
    }

    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso!');
        return redirect()->to($url);
    }

    public function edit($id)
    {
        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except('author_id');
        $this->repository->update($data, $id);
        $url = $request->get('redirectTo', route('books.index'));
        $request->session()->flash('message', 'Livro editado com sucesso!');
        return redirect()->to($url);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro removido com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
