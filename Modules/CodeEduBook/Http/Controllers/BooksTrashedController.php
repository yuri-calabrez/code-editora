<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="book-trashed-admin", description="Admnistração de livros excluídos")
 */
class BooksTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Permission\Action(name="list", description="Ver listagem de livros exlcuídos")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        //$books = Book::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        $this->repository->onlyTrashed();
        $books = $this->repository->orderBy('id', 'desc')->paginate(15);
        return view('codeedubook::trashed.books.index', compact('books', 'search'));
    }

    /**
     * @Permission\Action(name="show", description="Ver livro excluído")
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);

        return view('codeedubook::trashed.books.show', compact('book'));
    }

    /**
     * @Permission\Action(name="restore", description="Restaurar livro excluído")
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirectTo', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso!');
        return redirect()->to($url);
    }
}
