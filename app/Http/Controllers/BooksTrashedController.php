<?php

namespace CodePub\Http\Controllers;

use CodePub\Repositories\BookRepository;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $search = $request->get('search');
        //$books = Book::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        $this->repository->onlyTrashed();
        $books = $this->repository->orderBy('id', 'desc')->paginate(15);
        return view('trashed.books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);

        return view('trashed.books.show', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirectTo', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso!');
        return redirect()->to($url);
    }
}
